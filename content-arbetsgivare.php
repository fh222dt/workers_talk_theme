<?php
/**
 * @package Edin
 */
?>
<!-- Modal -->
<div class="modal fade" id="br-report-review-modal" tabindex="-1" role="dialog" aria-labelledby="br-report-review-modalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Anmäl för granskning</h4>
      </div>
      <div class="modal-body">
        <p>Vill du anmäla den här recensionen för olämpligt innehåll?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Nej</button>
        <button id="br-confirm-report-review" type="button" class="btn btn-primary">Ja</button>
      </div>
    </div>
  </div>
</div>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
            $id = get_the_ID();
            $score = Buildable_reviews_admin::get_total_score_of_object($id);
            the_title( '<h1 class="entry-title">', '</h1><span class="score-icons" data-score="'.$score.'"></span>' );

        ?>
		<div id="review-result"></div>
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
			<div id="br-review-button" class="links"><a class="button-minimal" href="#">Recensera</a></div>
			<div id="br-view-all-button" class="links"><a class="button-minimal" href="#">Se alla</a></div>
			<div id="br-summary-button" class="links"><a class="button-minimal" href="#">Sammanfattning</a></div>
		</div>

        <div id="employer-area" class="clearfix" >
            <h5>Om arbetsgivaren</h5>
            <p class="content-disclaimer">Denna information har arbetsgivaren själv lämnat</p>
            <div class="row">
                <div class="employer-fields col-md-6">
                    <?php $url = get_post_meta(get_the_ID(), 'webbadress', true) ?>
                    <p>Hemsida: <a href="<?php echo esc_url($url); ?>"><?php echo esc_url($url); ?></a> </p>
                </div>
                <div class="employer-fields col-md-6">
                    <?php $boss = get_post_meta(get_the_ID(), 'hogsta_chef', true) ?>
                    <p>Högsta chef: <?php echo esc_attr($boss); ?></p>
                </div>
                <!-- <div class="employer-fields col-md-4">
                    <h6>Förmåner</h6>
                    <?php //get_template_part( 'partials/employer', 'benefits' ); ?>
                </div> -->
                <!-- <div class="employer-fields col-md-4">
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
                </div> -->
            </div>

        </div>

		<div id="review-form" style="display: none">
			<?php echo BR_public_display_form::br_review_form(); ?>
		</div>

		<div id="list-all-reviews" style="display: none">
			<?php echo BR_public_display_result::br_review_object_list(); ?>
		</div>

		<div id="review-summary" style="display: none">
            <?php echo BR_public_display_result::br_review_object_summary(); ?>
        </div>



		<?php
			the_content();

			// wp_link_pages( array(
			// 	'before'      => '<div class="page-links">' . __( 'Pages:', 'edin' ),
			// 	'after'       => '</div>',
			// 	'link_before' => '<span>',
			// 	'link_after'  => '</span>',
			// ) );
		?>
	</div><!-- .entry-content -->


</article><!-- #post-## -->
