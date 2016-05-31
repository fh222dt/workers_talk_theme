<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Edin
 */

//acf_form_head();
get_header(); ?>

	<div class="content-wrapper clear">

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php
					$postid = get_the_ID();

					if (current_user_can('edit_post', $postid ) ){

						// acf_form(array(
						// 	'field_groups' => array(91),
						// 	'submit_value'	=> 'Spara'
						// ));
					}

					?>


					<?php get_template_part( 'content', get_post_type( $post ) ); ?>

					<?php //edin_post_nav(); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>