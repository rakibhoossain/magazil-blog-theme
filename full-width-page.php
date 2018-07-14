<?php

//Template Name: Full width without banner
get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="site-main-container">
			<!-- Start latest-post Area -->
			<section class="blog-post-area pb-120 mt-10">
				<div class="container no-padding">
					<div class="row">
						<div class="col-lg-12 post-list">
							<!-- Start latest-post Area -->
							<div class="post-area-wrapper">

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
									the_content();
								endwhile;
								endif;
								?>
								
							</div>
							<!-- End latest-post Area -->
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