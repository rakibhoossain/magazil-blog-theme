<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package magazil
 */

get_header();
setPostViews(get_the_ID());
?>



	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<div class="site-main-container">
			<?php magazil_before_post(); ?>
			<!-- Start latest-post Area -->
			<section class="latest-post-area pb-120">
				<div class="container no-padding">
					<div class="row">
						<div class="col-lg-8 post-list">
							<div class="single-post-wrap">
							<?php
							while ( have_posts() ) :
								the_post();

								get_template_part( 'template-parts/content', 'single' );

								the_post_navigation();

								do_action( 'magazil_single_after_article' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; // End of the loop.
							?>
							</div>
						<!-- End single-post Area -->
					</div>
					<div class="col-lg-4">
						<?php get_sidebar();?>
					</div>
				</div>
			</div>
		</section>
		<!-- End latest-post Area -->
	</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
