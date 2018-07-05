<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package magazil
 */

?>

<?php if(is_single()): 
	get_template_part( 'template-parts/content', 'single' );
?>

<?php else: ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php $is_img = 'no-img';
	if ( has_post_thumbnail() ) {
		$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'magazil-small-feature' );
      	$feat_image_url = esc_url($image_url[0]);
		$is_img = 'tight';
	// echo '<div class="post-box-img bg-img" style="background-image:url('. esc_url($feat_image_url).')">';
		echo '<div class="post-box-img has-img">';	
		printf('<img class="img-fluid" src="%1$s" alt="%2$s">' ,esc_url($feat_image_url),get_the_title());
		echo '<div class="overlay overlay-bg"></div>';
	}else{
		echo '<div class="post-box-img no-img">';
	}?>

	<div class="post-box-details <?php echo esc_attr( $is_img ); ?>">
		<?php magazil_post_categories(); ?>
		<?php 
		the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><h3 class="entry-title"><h3>', '</h3></a>' );
		?>
		<?php magazil_entry_meta(); ?>
	</div>


</div>
<div class="excert">
	<?php the_excerpt(); ?>
</div>
</article><!-- #post-<?php the_ID(); ?> -->
<?php endif; ?>