<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
						<div class="col-lg-8 post-list magazil__sticky_sidebar">
							<div class="single-post-wrap">

					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'magazil' ); ?></h1>
					</header><!-- .page-header -->


				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'magazil' ); ?></p>

					<?php
					get_search_form();

					the_widget( 'WP_Widget_Recent_Posts' );
					?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'magazil' ); ?></h2>
						<ul>
							<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
							?>
						</ul>
					</div><!-- .widget -->

					<?php
					/* translators: %1$s: smiley */
					$magazil_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'magazil' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$magazil_archive_content" );

					the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div><!-- .page-content -->


								
							</div><!-- End single-post Area -->
						</div>
						<div class="col-lg-4 magazil__sticky_sidebar">
						<?php get_sidebar();?>
						</div>
					</div>
				</div>
			</section>
		</div><!-- End latest-post Area -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
