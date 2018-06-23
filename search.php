<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package magazil
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">



			<div class="site-main-container">
			<!-- Start latest-post Area -->
			<section class="top-post-area mt-10">
				<div class="container no-padding">
					<div class="row">
						<div class="col-lg-12">
							<div class="hero-nav-area mb-10">
								<h1 class="page-title text-white">
									<?php
									/* translators: %s: search query. */
									printf( esc_html__( 'Search Results for: %s', 'magazil' ), '<span>' . get_search_query() . '</span>' );
									?>
								</h1>
							</div>
						</div>
						<div class="col-lg-8 search-list">
							<!-- Start latest-post Area -->
							<div class="single-search-wrap">


								<?php
								if ( have_posts() ) :

								/* Start the Loop */
								while ( have_posts() ) :
									the_post();

									/*
									 * Include the Post-Type-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content', 'search' );

								endwhile;

								the_posts_pagination();

								else :

									get_template_part( 'template-parts/content', 'none' );

								endif;
								?>
								
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
	</section><!-- #primary -->

<?php
get_footer();
