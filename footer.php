<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package magazil
 */

?>

	</div><!-- #content -->

	<!-- start footer Area -->
	<footer class="footer-area section-gap">
		<div class="container">
			<div class="row">

				<?php $footer_wigdet_class = array('3', '2', '2', '2', '3');
				foreach ($footer_wigdet_class as $key => $value) {
					if (is_active_sidebar("footer-".($key+1))) :
						echo '<div class="col-lg-'.$value.' col-md-6 single-footer-widget">';
						dynamic_sidebar("footer-".($key+1));
						echo '</div>';

					endif;
				}
				?>

			</div>
			<div class="footer-bottom row align-items-center">
				<p class="footer-text m-0 col-lg-8 col-md-12">
			<?php
				/* translators: 1: Theme name, 2: Theme author. */

				printf( esc_html__( 'Theme: %1$s by %2$s.', 'magazil' ), 'magazil', '<a href="http://rakibhossain.cf/">Rakib Hossain</a>' );
			?>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
					<div class="col-lg-4 col-md-12 footer-social">
						<?php
						wp_nav_menu( array(
							'theme_location'    => 'social',
							'menu_class'        => 'social-menu-footer',
							'container'         => false,
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span><i class="fa fa-chain"></i>',
						) );
						?>
					</div>
				</div>
			</div>
		</footer>
		<!-- End footer Area -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
