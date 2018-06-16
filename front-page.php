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

						<?php 
						$popular_post = new WP_Query( array(
							// 'meta_key' => 'post_views_count',
							// 'orderby' => 'meta_value meta_value_num',
							// 'order' => 'ASC',
							'posts_per_page' => 5
						) );
						?>		

						<?php if ( $popular_post->have_posts() ) : $count = (int)0; ?>
									
						<div class="col-lg">

							<div class="grid-post">


			<?php
			/* Start the Loop */
			while ( $popular_post->have_posts() ) : $popular_post->the_post();
$class = ($count == 0)? 'col-lg-8 ' : 'col-lg-4 top-post-right'; ?>
	<!-- <div class="<?php //echo $class; ?>"> -->


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
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;?>
		
							</div>
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
			<section class="latest-post-area pb-120">
				<div class="container no-padding">
					<div class="row">
						<div class="col-lg-8 post-list">
							<!-- Start latest-post Area -->
							<div class="latest-post-wrap">
								<h4 class="cat-title">Latest News</h4>
								<?php $args = array( 
									// 'post_type' => 'post',
									'posts_per_page' => 2);
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
									get_template_part( 'template-parts/content', get_post_type() );

								endwhile;
								wp_reset_postdata();

								endif;
								?>

							</div>
							<!-- End latest-post Area -->
							
							<!-- Start banner-ads Area -->
							<div class="col-lg-12 ad-widget-wrap mt-30 mb-30">
								<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/img/banner-ad.jpg" alt="">
							</div>
							<!-- End banner-ads Area -->




			<!-- Start top-post Area -->
			<section class="top-post-area pt-10">
				<div class="container no-padding">
					<div class="row small-gutters">

		<?php $args = array( 
						'post_type' => 'post',
						 'posts_per_page' => 12);
				$loop = new WP_Query( $args );		?>		

		<?php if ( $loop->have_posts() ) : $count=(int)0; $mt=''; ?>

			

			<?php
			/* Start the Loop */
			while ( $loop->have_posts() ) : $loop->the_post(); 
				$class = ($count == 0)? 'col-lg-12 '.$mt : 'col-lg-6 mt-10';?>
<div class="<?php echo $class; ?>">
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

				echo '</div>';

			endwhile;
			wp_reset_postdata();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>


						<div class="col-lg-12">
							<div class="news-tracker-wrap">
								<h6><span>Breaking News:</span>   <a href="#">Astronomy Binoculars A Great Alternative</a></h6>
							</div>
						</div>
					</div>
				</div>
			</section>




							
							<!-- End popular-post Area -->
							<!-- Start relavent-story-post Area -->
							<div class="relavent-story-post-wrap mt-30">
								<h4 class="title">Relavent Stories</h4>
								<div class="relavent-story-list-wrap">
									<div class="single-relavent-post row align-items-center">
										<div class="col-lg-5 post-left">
											<div class="feature-img relative">
												<div class="overlay overlay-bg"></div>
												<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/img/r1.jpg" alt="">
											</div>
											<ul class="tags">
												<li><a href="#">Lifestyle</a></li>
											</ul>
										</div>
										<div class="col-lg-7 post-right">
											<a href="image-post.html">
												<h4>A Discount Toner Cartridge Is
												Better Than Ever.</h4>
											</a>
											<ul class="meta">
												<li><a href="#"><span class="lnr lnr-user"></span>Mark wiens</a></li>
												<li><a href="#"><span class="lnr lnr-calendar-full"></span>03 April, 2018</a></li>
												<li><a href="#"><span class="lnr lnr-bubble"></span>06 Comments</a></li>
											</ul>
											<p class="excert">
												Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.
											</p>
										</div>
									</div>
									<div class="single-relavent-post row align-items-center">
										<div class="col-lg-5 post-left">
											<div class="feature-img relative">
												<div class="overlay overlay-bg"></div>
												<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/img/r2.jpg" alt="">
											</div>
											<ul class="tags">
												<li><a href="#">Science</a></li>
											</ul>
										</div>
										<div class="col-lg-7 post-right">
											<a href="image-post.html">
												<h4>A Discount Toner Cartridge Is
												Better Than Ever.</h4>
											</a>
											<ul class="meta">
												<li><a href="#"><span class="lnr lnr-user"></span>Mark wiens</a></li>
												<li><a href="#"><span class="lnr lnr-calendar-full"></span>03 April, 2018</a></li>
												<li><a href="#"><span class="lnr lnr-bubble"></span>06 Comments</a></li>
											</ul>
											<p class="excert">
												Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.
											</p>
										</div>
									</div>
									<div class="single-relavent-post row align-items-center">
										<div class="col-lg-5 post-left">
											<div class="feature-img relative">
												<div class="overlay overlay-bg"></div>
												<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/img/r3.jpg" alt="">
											</div>
											<ul class="tags">
												<li><a href="#">Travel</a></li>
											</ul>
										</div>
										<div class="col-lg-7 post-right">
											<a href="image-post.html">
												<h4>A Discount Toner Cartridge Is
												Better Than Ever.</h4>
											</a>
											<ul class="meta">
												<li><a href="#"><span class="lnr lnr-user"></span>Mark wiens</a></li>
												<li><a href="#"><span class="lnr lnr-calendar-full"></span>03 April, 2018</a></li>
												<li><a href="#"><span class="lnr lnr-bubble"></span>06 Comments</a></li>
											</ul>
											<p class="excert">
												Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.
											</p>
										</div>
									</div>
								</div>
							</div>
							<!-- End relavent-story-post Area -->
						</div>
						<div class="col-lg-4">
							<?php get_sidebar(); ?>
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
