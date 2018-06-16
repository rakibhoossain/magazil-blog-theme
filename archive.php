<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package magazil
 */

get_header();
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
							<!-- Start latest-post Area -->
							<div class="latest-post-wrap">
								<h4 class="cat-title">Latest News</h4>


								<?php
								if ( have_posts() ) :

									if ( is_home() && ! is_front_page() ) :
										?>
									<header>
										<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
									</header>
									<?php
								endif;

								/* Start the Loop */
								while ( have_posts() ) :
									the_post();

									/*
									 * Include the Post-Type-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content', get_post_type() );

								endwhile;

								the_posts_navigation();

								else :

									get_template_part( 'template-parts/content', 'none' );

								endif;
								?>


								<div class="load-more">
									<a href="#" class="primary-btn">Load More Posts</a>
								</div>
								
							</div>
							<!-- End latest-post Area -->
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
get_sidebar();
get_footer();
