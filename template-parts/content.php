<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package magazil
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-latest-post row align-items-center">
		<div class="col-lg-5 post-left">
			<div class="feature-img relative">
				<div class="overlay overlay-bg"></div>
				<?php if ( has_post_thumbnail()) {
					$feat_image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

					printf('<img class="img-fluid" src="%1$s" alt="%2$s">' ,esc_url($feat_image_url),get_the_title());
				}?>


			</div>
			<?php magazil_post_categories(); ?>
								</div>
								<div class="col-lg-7 post-right">
									<?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><h4 class="entry-title"><h4>', '</h4></a>' );
									// if ( is_singular() ) :
									// 	the_title( '<h4 class="entry-title">', '</h4>' );
									// else :
										
									// endif;
									?>
										<?php magazil_entry_meta(); ?>
										<p class="excert">
											<?php
											the_content( sprintf(
												wp_kses(
													/* translators: %s: Name of current post. Only visible to screen readers */
													__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'magazil' ),
													array(
														'span' => array(
															'class' => array(),
														),
													)
												),
												get_the_title()
											) );

											wp_link_pages( array(
												'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'magazil' ),
												'after'  => '</div>',
											) );
											?>
										</p>
									</div>
								</div>


</article><!-- #post-<?php the_ID(); ?> -->