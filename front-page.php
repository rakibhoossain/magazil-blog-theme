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
						$popular_show = 3; 
						$popular_post = new WP_Query( array(
							'post_type' => 'post',//'page ,post',
							'meta_key' => 'wpb_post_views_count',
							'meta_query' => array(array('key' => '_thumbnail_id')) ,
							'orderby' => 'meta_value_num',
							'order' => 'DESC',
							'posts_per_page' => $popular_show
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
									front_page_post('top-post-large',true,'top-layout large');
								}else{
									front_page_post('top-post-small',true,'top-layout');
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
							<div class="news-tracker-wrap">

								<div class="ticker-wrap">
									<div class="ticker">
										<div class="ticker__item">Letterpress chambray brunch.</div>
										<div class="ticker__item">Vice mlkshk crucifix beard chillwave meditation hoodie asymmetrical Helvetica.</div>
										<div class="ticker__item">Ugh PBR&B kale chips Echo Park.</div>
										<div class="ticker__item">Gluten-free mumblecore chambray mixtape food truck. </div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</section>


			<!-- End top-post Area -->
			<!-- Start latest-post Area -->
			<section class="latest-post-area pb-120 pt-50">
				<div class="container no-padding">
					<div class="row">
						<div class="col-lg-8 post-list">
							<!-- Start latest-post Area -->
							<div class="post-area-wrapper">
								<h4 class="cat-title">Latest News (Change)</h4>
								<?php 
									$args = array( 
									'post_type' => 'post',
									'posts_per_page' => 10);
									$loop = new WP_Query( $args );
								?>
								<?php
								if ( $loop->have_posts() ) :

									/* Start the Loop */
									while ( $loop->have_posts() ) :
										$loop->the_post();
										/*
										 * Include the Post-Type-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
										 */
										
										get_template_part( 'template-parts/content', 'blog' );

									endwhile;
									wp_reset_postdata();
								endif;
								?>
							</div>
							<!-- End latest-post Area -->

							<!-- Start banner-ads Area -->
							<div class="col-lg-12 ad-widget-wrap mt-30 mb-30">
								<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/img/banner-ad.jpg" alt="ad">
							</div>
							<!-- End banner-ads Area -->




							<!-- Start top-post Area -->
							<section class="post-feature post-area-wrapper">
								<div class="container no-padding">
									<div class="row small-gutters">
										<div class="col-lg-12 mb-10">
											<h4 class="cat-title">Latest News (Change)</h4>
										</div>

								<?php 
									$args = array( 
										'post_type' => 'post',
										'posts_per_page' => 5
									);
									$loop = new WP_Query( $args );
								?>		

								<?php 
									if ( $loop->have_posts() ) : 
										$count=(int)0; $mt='';


										/* Start the Loop */
										while ( $loop->have_posts() ) : $loop->the_post(); 
											$class = ($count == 0)? 'col-lg-12 '.$mt : 'col-lg-6 mt-10';?>

											<div class="<?php echo esc_attr( $class ); ?>">

											<?php
											/**
											 * Run the loop for the search to output the results.
											 * If you want to overload this in a child theme then include a file
											 * called content-search.php and that will be used instead.
											 */
											if ($count == 0) {
												front_page_post('feature-post-large');
											}else{
												front_page_post('feature-post-small');
											}

											$count++; 
											if ($count == 3) {
												$count=0;
												$mt='mt-10';
											}
											?>

											</div>

											<?php
										endwhile;
										wp_reset_postdata();

									else :
										get_template_part( 'template-parts/content', 'none' );
									endif;
								?>
									</div>
								</div>
							</section>

						</div>
						<div class="col-lg-4">
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
