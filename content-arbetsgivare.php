<?php
/**
 * @package Edin
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div id="review-result">***</div>
	</header><!-- .entry-header -->

	<?php edin_post_thumbnail(); ?>

	<div class="entry-content">

		<!-- divar för sammanställning av ratings -->
		<div id="results" class="clearfix">
			<div class="row">
				<div class="col-md-4"><div class="review-diagrams">
					<p>Företagskultur</p><?php child_displayChart('polar'); ?>
				</div></div>
				<div class="col-md-4"><div class="review-diagrams">
					<p>Utveckling</p><?php child_displayChart('horizontal'); ?>
				</div></div>
				<div class="col-md-4"><div class="review-diagrams">
					<p>Rekommenderar</p><?php child_displayChart('vertical'); ?>
				</div></div>
			</div>
			<div class="row">
				<div class="col-md-4"><div class="review-diagrams">
					<p>Lön & förmåner</p><?php child_displayChart('donut'); ?>
				</div></div>
				<div class="col-md-4"><div class="review-diagrams">
					<p>Jobbar kvar om 1 år</p><?php child_displayChart('donut'); ?>
				</div></div>
				<div class="col-md-4"><div class="review-diagrams">
					<p>Förtroende för ledning</p><?php child_displayChart('pie'); ?>
				</div></div>
				<!-- <div id="all-statistics"><a href="#">Se hela sammanfattningen</a></div> -->
			</div>
		</div>

		<div class="clearfix">
			<div class="links"><a class="button-minimal" href="#">Recensera</a></div>
			<div class="links"><a class="button-minimal" href="#">Se alla</a></div>
			<div class="links"><a class="button-minimal" href="#">Sammanfattning</a></div>
		</div>

		<div id="review-form">
			Formulär
		</div>

		<div id="list-all-reviews">
			Alla recensioner
		</div>

		<div id="review-summary">
			Sammanfattning
		</div>

		<div id="employer-area" class="clearfix" >
			<h5>Om arbetsgivaren</h5>
			<p class="content-disclaimer">Denna information har arbetsgivaren själv lämnat</p>	
			<div class="row">
				<div class="employer-fields col-md-4">
					<p>Webb</p>
					<p>Högsta chef</p>
				</div>
				<div class="employer-fields col-md-4">					
					<h6>Förmåner</h6>
					<?php get_template_part( 'partials/employer', 'benefits' ); ?>
				</div>
				<div class="employer-fields col-md-4">
					<h6>Bilder</h6>					
					<div class="css-gallery autoplay items-3">
					    <div id="item-1" class="control-operator"></div>
						    <div id="item-2" class="control-operator"></div>
						    <div id="item-3" class="control-operator"></div>

						    <figure class="item">
						      <h1>Item 1</h1>
						    </figure>

						    <figure class="item">
						      <h1>Item 2</h1>
						    </figure>

						    <figure class="item">
						      <h1>Item 3</h1>
						    </figure>

						    <div class="controls">
						      <a href="#item-1" class="control-button">•</a>
						      <a href="#item-2" class="control-button">•</a>
						      <a href="#item-3" class="control-button">•</a>
					    	</div>
					  </div>
				</div>
			</div>

		</div>
		
		<?php
			//the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'edin' ),
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->


</article><!-- #post-## -->
