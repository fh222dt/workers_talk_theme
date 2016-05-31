<?php
/**
 * @package Edin
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="clearfix">
			<div class="links"><a href="#">Läs hela</a></div>
			<div class="links"><a href="#">Lämna betyg</a></div>
			<div class="links"><a href="#">Alla omdömmen</a></div>
		</div>
	</header><!-- .entry-header -->

	<?php edin_post_thumbnail(); ?>

	<div class="entry-content">


		<?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'edin' ),
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->


</article><!-- #post-## -->
