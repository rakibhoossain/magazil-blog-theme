<?php
/**
 * Template part for top post large layout
 *
 * @package magazil
 */ 


?>
<div class="post-box-img top-layout large">
	<?php if(has_post_thumbnail()): 
		$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'magazil-large-feature' );
	?>
		<a class="posts-box-link" href="<?php echo get_the_permalink(); ?>" <?php echo 'style="background: url(\''.esc_url($image_url[0]).'\')"'; ?>></a>
	<?php else: ?>
		<a class="posts-box-link" href="<?php echo get_the_permalink(); ?>"></a>
	<?php endif; ?>
	
  	<div class="post-box-details">
    	<?php magazil_post_categories(); ?>
    	<?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><h3 class="entry-title page-title">', '</h3></a>' );?>
    	<?php magazil_entry_meta(); ?>
  	</div>
</div>