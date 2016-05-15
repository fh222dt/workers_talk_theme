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
		
		<div id="employer-area" class="clearfix" >
			<h5>Om arbetsgivaren</h5>
			<div id="employer-about">
				<p>Mer om oss</p>
				<p class="content-disclaimer">Denna information har arbetsgivaren själv lämnat</p>
			</div>
			<div class="employer-fields" id="employer-www">
				<p>Webb</p>
				<a href="http://<?php the_field('webbadress'); ?>"><?php the_field('webbadress'); ?></a> 
			</div>
			<div class="employer-fields" id="boss">
				<p>Högsta chef</p>
				<p><?php the_field('hogsta_chef'); ?></p>
			</div>		<!-- hur hantera tomma??? -->
		</div>
		<!-- divar för sammanställning av ratings -->
		<div id="results">
			<div class="rating-diagrams"><p>Företagskultur</p><?php child_displayChart('polar'); ?></div>
			<div class="rating-diagrams"><p>Utveckling</p><?php child_displayChart('horizontal'); ?></div>
			<div class="rating-diagrams"><p>Rekommenderar</p><?php child_displayChart('vertical'); ?></div>
			<div class="rating-diagrams"><p>Lön & förmåner</p><?php child_displayChart('donut'); ?></div>
			<div class="rating-diagrams"><p>Jobbar kvar om 1 år</p><?php child_displayChart('donut'); ?> </div>
			<div class="rating-diagrams"><p>Förtroende för ledning</p><?php child_displayChart('pie'); ?></div>
			<div id="all-statistics"><a href="#">Se hela sammanfattningen</a></div>
		</div>

		<!-- Positivt & negativt -->
		<div id="positive"><p>Positivt sagt</p> 
			<div class="mensions">Ett omdömme</div>
			<div class="mensions">Två omdömme</div>
			<div class="mensions">Tre omdömme</div>
		</div>
		<div id="negative"><p>Förbättringsförslag</p>
			<div class="mensions">Ett omdömme</div>
			<div class="mensions">Två omdömme</div>
			<div class="mensions">Tre omdömme</div>
		</div>

		<!-- förmåner -->
		<div id="benefits">Förmåner</div>
		<!-- annonsutrymme -->
		<div id="ad">Annonsplats</div>

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
