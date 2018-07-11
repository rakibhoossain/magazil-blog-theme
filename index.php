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
?>



	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="site-main-container">
			<?php magazil_before_post(); ?>
			<!-- Start latest-post Area -->
			<section class="blog-post-area pb-120 mt-10">
				<div class="container no-padding">
					<div class="row">
						<div class="col-lg-8 post-list magazil__sticky_sidebar">
							<!-- Start latest-post Area -->
							<div class="posts-list blog-page post-area-wrapper">
								<?php
								if ( have_posts() ) :

									if ( is_home() && ! is_front_page() ) :
										?>
									<header>
										<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
									</header>
									<div class="row">
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
									echo '<div class="col-lg-6 posts2-i">';
									get_template_part( 'template-parts/content', get_post_type() );
									echo '</div>';
								endwhile;
								echo '</div>';
								the_posts_pagination( array(
									'prev_text' => '<i class="fa fa-arrow-left"></i><span class="screen-reader-text">' . __( 'Previous Page', 'magazil' ) . '</span>',
									'next_text' => '<span class="screen-reader-text">' . __( 'Next Page', 'magazil' ) . '</span><i class="fa fa-arrow-right"></i>' ,
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'magazil' ) . ' </span>',
								) );

								else :

									get_template_part( 'template-parts/content', 'none' );

								endif;
								?>
								
							</div>
							<!-- End latest-post Area -->
						</div>
						<div class="col-lg-4 magazil__sticky_sidebar">
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
