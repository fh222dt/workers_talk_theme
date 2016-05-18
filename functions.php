<?php

/*--------------------------------------------Childtheme-added stuff--------------------------------------------------------------------*/
/**
 * Ladda in Google fonts
 */
function google_fonts() {
    $query_args = array(
    'family' => 'Montserrat|Pontano+Sans',
    'subset' => 'latin,latin-ext',
    );
    wp_enqueue_style( 'google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
}
add_action('wp_enqueue_scripts', 'google_fonts');

/**
 * Ladda in css
 */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/stylesheets/screen.css',
        array('parent-style')
    );
}

/**
 * [Sökruta som används på startsidan]
 * @param  [type] $form [description]
 * @return [type]       [description]
 */
function wpbsearchform( $form ) {

    $form = '<div id="employer_search" class="widget widget_search"><form role="search" method="get" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
    <input type="text" class="search-field" placeholder="Sök arbetsgivare..." value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="employer_searchsubmit" value="'. esc_attr__('Search') .'" />
    </div>
    </form>
    </div>';

    return $form;
}

add_shortcode('wpbsearch', 'wpbsearchform');

/**
 * Ladda in js-filer
 *
 */
function childScripts() {
    wp_enqueue_script(
        'chart-js',
        get_stylesheet_directory_uri() . '/js/Chart.min.js',
        array( 'jquery' ),
        '20150420',
        true
        );

    wp_enqueue_script(
        'fh_charts',
        get_stylesheet_directory_uri() . '/js/fh_charts.js',
        array( 'jquery' ),
        '20150420',
        true
        );
}
add_action( 'wp_enqueue_scripts', 'childScripts' );

/**
 * Hämta info för presentation av diagram
 */

function child_displayChart($chart) {
    //echo($chart);
    if ($chart == 'donut') {
        //börja med att köra kod för att hämta siffror för resp post/arbgiv
        $data = 33; //dummysiffra

        $chart = '<div class="progress-pie-chart" data-percent="' .$data. '">
                    <div class="ppc-progress">
                        <div class="ppc-progress-fill"></div>
                    </div>
                    <div class="ppc-percents">
                    <div class="pcc-percents-wrapper">
                        <span>%</span>
                    </div>
                    </div>
                </div>';

        echo $chart;
        //return '<p>hejsan!</p>';

    }

    else if ($chart == 'pie') {     //inte klart, tror class & id inte stämmer i css/js
        $data = 33; //dummysiffra

        $chart = '<div id="pieChart" class="pie_chart"></div>';

        echo $chart;
    }

    else if ($chart == 'polar') {
        $chart = '<canvas id="polarChart"></canvas>';

        echo $chart;
    }

    else if ($chart == 'vertical') {
        $data = [5, 15, 95, 45, 67 ];

        foreach ($data as $value) {
            $heights[] = ($value * 2) + 30;
        }

        $chart = '<div class="verticalChart">
                    <div class="clearfix"><div class="verticalBar" data-height='.$heights[0].'>'.$data[0].'%</div></div>
                    <div class="clearfix"><div class="verticalBar" data-height='.$heights[1].'>'.$data[1].'%</div></div>
                    <div class="clearfix"><div class="verticalBar" data-height='.$heights[2].'>'.$data[2].'%</div></div>
                    <div class="clearfix"><div class="verticalBar" data-height='.$heights[3].'>'.$data[3].'%</div></div>
                    <div class="clearfix"><div class="verticalBar" data-height='.$heights[4].'>'.$data[4].'%</div></div>
                </div>';
        echo $chart;
    }

    else if ($chart == 'horizontal') {
        $data = [95, 95, 95, 95, 95 ];

        foreach ($data as $value) {
            $widths[] = ($value * 2) + 50;
        }

        $chart = '<div class="horizontalChart">
                    <div class="clearfix"><div class="horizontalBar" data-width='.$widths[0].'>'.$data[0].'%</div></div>
                    <div class="clearfix"><div class="horizontalBar" data-width='.$widths[2].'>'.$data[2].'%</div></div>
                    <div class="clearfix"><div class="horizontalBar" data-width='.$widths[1].'>'.$data[1].'%</div></div>
                    <div class="clearfix"><div class="horizontalBar" data-width='.$widths[3].'>'.$data[3].'%</div></div>
                    <div class="clearfix"><div class="horizontalBar" data-width='.$widths[4].'>'.$data[4].'%</div></div>
                </div>';
        echo $chart;
    }




    else {
        $chart = '<p>Statistik saknas just nu. <a href="#">Vill du lämna ett omdömme?</a></p>';
        echo $chart;
    }
}

/**
 * Disable admin bar on the frontend of your website
 * for user role subscriber.
 */
function fh_disable_admin_bar() {
    if(current_user_can('subscriber') ){
        add_filter('show_admin_bar', '__return_false');
    }
}
add_action( 'after_setup_theme', 'fh_disable_admin_bar' );

/**
 * Redirect back to homepage and not allow access to
 * WP admin for user role subscriber.
 */
/*function fh_redirect_admin(){
    if (current_user_can('subscriber') ){
        wp_redirect( site_url() );
        exit;
    }
}
add_action( 'admin_init', 'fh_redirect_admin' );*/


/**
*Add menu items for custom taxonomies
*
*/
add_filter( 'wp_nav_menu_items', 'add_taxonomies_links', 10, 2 );

function add_taxonomies_links( $items, $args ) {
    if( $args->theme_location == 'primary')  {
        $taxonomies = ['bransch', 'region'];            //Add all taxonomies you want to make a menu item of

        foreach ($taxonomies as $tax) {
            if (taxonomy_exists($tax)) {
                $items .='<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children"><a href="#">'.$tax.'er</a>';
                $items .='<ul class="sub-menu">';
                $terms = get_terms( $tax, array('hide_empty' => false) );

                foreach ($terms as $item) {
                    $link = get_term_link($item);        //get link to archive of term
                    $name = $item->name;

                    $items .='<li class="menu-item menu-item-type-taxonomy"><a href="'. $link .'">'.$name.'</a></li>';

                }
                $items .='</ul>';
                $items .='</li>';
            }
        }
    }

    return $items;
}