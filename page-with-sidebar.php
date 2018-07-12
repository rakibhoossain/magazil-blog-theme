<?php

//Template Name: Page template
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
							<div class="post-area-wrapper">
								<?php
								if ( have_posts() ) :
								/* Start the Loop */
								while ( have_posts() ) :
									the_post();
									the_content();
								endwhile;
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
