<?php
/**
 * Template part for displaying single posts
 *
 * @package magazil
 */

?>

<div class="feature-img-thumb relative">
	<div class="overlay overlay-bg"></div>
	<?php if ( has_post_thumbnail()) {
		$feat_image_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
		printf('<img class="img-fluid" src="%1$s" alt="%2$s">' ,esc_url($feat_image_url),get_the_title());
	}?>
</div>
<div class="content-wrap">
	<?php magazil_post_categories(true); ?>
	<h1 class="page-title"><?php the_title(); ?></h1>
	<?php magazil_entry_meta(); ?>
	<div class="post__view_area">
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
	</div>
</div>