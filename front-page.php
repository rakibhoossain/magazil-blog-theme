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
						<div class="col-lg">
						<?php
						$popular_show = get_theme_mod( 'magazil_top_post_limit', 3 );
						$popular_post = new WP_Query( array(
							'post_type' => 'post',//'page ,post',
							'meta_key' => 'wpb_post_views_count',
							'meta_query' => array(array('key' => '_thumbnail_id')) ,
							'orderby' => 'meta_value_num',
							'order' => 'DESC',
							'posts_per_page' => absint($popular_show)
						) );

						
						
						?>		

						<?php if ( $popular_post->have_posts() && $popular_post->found_posts >= $popular_show): $count = (int)0; ?>		
							<div class="grid-post post-grid-<?php echo esc_attr( $popular_show ); ?>">

							<?php
								/* Start the Loop */
								while ( $popular_post->have_posts() ) : $popular_post->the_post();?>

								<?php
								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */

								if ($count == 0) {
									front_page_post('magazil-large-top',true,'top-layout large');
								}else{
									front_page_post('magazil-small-top',true,'top-layout');
								}
								$count++; 
								endwhile;
								$count=0;
								wp_reset_query();
								wp_reset_postdata();
							?>
							</div>
						<?php
						endif;?>
		
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
