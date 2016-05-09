<?php
/**
 * components functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WT1
 */

if ( ! function_exists( 'wt1_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the aftercomponentsetup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wt1_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'wt1' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wt1', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'wt1-featured-image', 640, 9999 );
	add_image_size( 'wt1-hero', 1280, 1000, true );
	add_image_size( 'wt1-thumbnail-avatar', 100, 100, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top' => esc_html__( 'Top', 'wt1' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wt1_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'wt1_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wt1_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wt1_content_width', 640 );
}
add_action( 'after_setup_theme', 'wt1_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wt1_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wt1' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wt1_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wt1_scripts() {
	wp_enqueue_style( 'wt1-style', get_stylesheet_uri() );

	wp_enqueue_script( 'wt1-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'wt1-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wt1_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

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
*Add menu items for custom taxonomies
*
*/
add_filter( 'wp_nav_menu_items', 'add_taxonomies_links', 10, 2 );

function add_taxonomies_links( $items, $args ) {
    if( $args->theme_location == 'top')  {
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