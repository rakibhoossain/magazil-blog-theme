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
			<!-- Start top-post Area -->
			<section class="top-post-area pt-10">
				<div class="container no-padding">
					<div class="row small-gutters">
						<div class="col-lg post-top-popular">

						<?php 
							$top_type = get_theme_mod( 'magazil_top_post_type', 'popular' );
							get_template_part( 'inc/components/posts-top', $top_type ); // Get Breaking News template 
						?>
						</div>
						<div class="col-lg-12">
						<?php get_template_part( 'inc/components/breaking-news' ); // Get Breaking News template ?>
						</div>
					</div>
				</div>
			</section>


			<!-- End top-post Area -->
			<!-- Start latest-post Area -->
			<section class="latest-post-area pb-120 pt-50">
				<div class="container no-padding">
					<div class="row">
						<div class="col-lg-8 post-list magazil__sticky_sidebar">
							
						<?php if ( is_active_sidebar( 'content-area' ) ) { ?>
							<?php dynamic_sidebar( 'content-area' ); ?>
						<?php } ?>

						</div>
						<div class="col-lg-4 magazil__sticky_sidebar">
							<?php get_sidebar(); ?>
						</div>
					</div>
				</div>
			</section>
			
		</div><!-- End latest-post Area -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
