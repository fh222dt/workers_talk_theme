<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Edin-child
 */
?>

	</div><!-- #content -->
	
	<div id="footer-ad-space"></div> 

	<?php get_sidebar( 'footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-wrapper clear">
			
			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<nav class="footer-navigation" role="navigation">
					<?php
						wp_nav_menu( array(
							'theme_location'  => 'footer',
							'menu_class'      => 'clear',
							'depth'           => 1,
						) );
					?>
				</nav><!-- .footer-navigation -->
			<?php endif; ?>
		</div><!-- .footer-wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
