<?php
/**
 * The template used for displaying hero content.
 *
 * @package WT1
 */
?>

<?php if ( has_post_thumbnail() ) : ?>
	<div class="wt1-hero">
		<?php the_post_thumbnail( 'wt1-hero' ); ?>
	</div>
<?php endif; ?>
