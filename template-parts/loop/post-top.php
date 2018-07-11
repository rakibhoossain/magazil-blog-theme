<?php
/**
 * Template part for top post layout
 *
 * @package magazil
 */ 

$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'magazil-feature-image' );
?>


<div class="post-box-img top-layout relative">
	<a class="posts-box-link" href="<?php echo get_the_permalink(); ?>" <?php if ($image_url[0]) echo 'style="background: url(\''.esc_url($image_url[0]).'\')"'; ?> ></a>
	<div class="post-box-details">
		<?php magazil_post_categories(); ?>
		<?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><h3 class="entry-title"><h3>', '</h3></a>' );?>
		<?php magazil_entry_meta(); ?>
	</div>
</div>