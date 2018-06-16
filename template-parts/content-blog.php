								
<?php $is_img = 'no-img';
if ( has_post_thumbnail() ) {
	$feat_image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	$is_img = 'tight';
	// echo '<div class="post-box-img bg-img" style="background-image:url('. esc_url($feat_image_url).')">';
		echo '<div class="post-box-img has-img">';	
printf('<img class="img-fluid" src="%1$s" alt="%2$s">' ,esc_url($feat_image_url),get_the_title());
echo '<div class="overlay overlay-bg"></div>';
	}else{
	echo '<div class="post-box-img no-img">';
}?>

	<div class="post-box-details <?php echo $is_img; ?>">
		<?php magazil_post_categories(); ?>
		<?php 
		the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><h3 class="entry-title"><h3>', '</h3></a>' );
		?>
		<?php magazil_entry_meta(); ?>
	</div>

</div>

