<?php
/**
 * Template part for blog post grid layout
 *
 * @package magazil
 */

?>
<?php $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'magazil-large-feature' );?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="posts-box">
		<div class="relative">
			<a class="posts-box-img" href="<?php echo get_the_permalink(); ?>">
				<?php printf('<span style="background: url(\''.esc_url($image_url[0]).'\'); ?>)"></span>'); ?>
			</a>
			<div class="posts-meta-details">
				<?php magazil_post_categories(); ?>
				<?php the_title( '<a href="' . esc_url( get_the_permalink() ) . '" rel="bookmark"><h3 class="entry-title page-title">', '</h3></a>' );?>
				<?php magazil_entry_meta(); ?>
			</div>	
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->