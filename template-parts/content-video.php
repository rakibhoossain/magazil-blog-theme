<?php
/**
 * Template part for displaying single image posts
 *
 * @package magazil
 */

?>
<div class="content-wrap">
	<?php magazil_post_categories(true); ?>
	<h3 class="page-title"><?php the_title(); ?></h3>
	<?php magazil_entry_meta('pb-20 post-meta'); ?>
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