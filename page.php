<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package magazil
 */

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

	<?php
		// $theParent = wp_get_post_parent_id(get_the_ID());
		$is_parent_child = false;
		$theParent = false;
		$row_size = 8;
		$ancestors = get_post_ancestors(get_the_ID());

		if ($ancestors) {
		$parent_root=count($ancestors)-1;
		$theParent = $ancestors[$parent_root];
		}
		
		$pagelist = array();
		$theChild = get_pages(array(
			'child_of' => get_the_ID()
		));

		//page has child or parent pages
		if ($theParent or $theChild) { $is_parent_child = true; $row_size = 9;}
	?>

			<div class="site-main-container">
			<?php magazil_before_post(); ?>
			<!-- Start latest-post Area -->
			<section class="page-content-area pb-120">
				<div class="container no-padding mt-10">
					<div class="row">

						<?php if($is_parent_child){ ?>
						<div class="col-lg-3">
							<div class="sidebars-area">
							<?php 
							if($is_parent_child){ ?>
								<div class="page-links">
									<h2 class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a></h2>
									<ul class="min-list" id="side-menu">
										<?php
										if ($theParent) {
											$findChildrenOf = $theParent;
										} else {
											$findChildrenOf = get_the_ID();
										}
										wp_list_pages(array(
											'title_li' => NULL,
											'child_of' => $findChildrenOf,
											'sort_column' => 'menu_order',
											'sort_order'	=> 'asc'
										));
										$pagelist = get_pages('child_of='. $findChildrenOf .'&sort_column=menu_order&sort_order=asc');
										?>
									</ul>
								</div>
							<?php } ?>
						</div>
						</div>
						<?php } ?>

						<div class="col-lg-<?php echo absint($row_size);?> post-list">	
							<!-- Start latest-post Area -->
							<div class="post-area-wrapper">

								<?php
								while ( have_posts() ) :
									the_post();
									get_template_part( 'template-parts/content', 'page' );
									if($is_parent_child){magazil_page_navigation($pagelist);}
									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;

								endwhile; // End of the loop.
								?>
								
							</div>
							<!-- End latest-post Area -->
						</div>

						<?php if(!$is_parent_child){ ?>
						<div class="col-lg-4">
							<?php get_sidebar();?>
						</div>
						<?php } ?>

					</div>
				</div>
			</section>
			<!-- End latest-post Area -->
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();