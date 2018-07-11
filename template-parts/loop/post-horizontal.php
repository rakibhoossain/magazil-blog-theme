<?php
/**
 * Template part for blog post horizontal layout
 *
 * @package magazil
 */

	$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'magazil-feature-image' );
	$image = esc_url($image_url[0]);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-box-ltrt  row align-items-center pt-20">

		<div class="col-lg-5 post-left relative posts-box">
			<a class="posts-box-img" href="<?php echo get_the_permalink(); ?>"><span style="background: url(<?php echo esc_url($image); ?>)"></span></a>
			<div class="posts-meta-details">
				<?php magazil_post_categories(); ?>
			</div>
			
		</div>
		<div class="col-lg-7 post-right">
			<?php the_title( '<a href="' . esc_url( get_the_permalink() ) . '" rel="bookmark"><h4 class="entry-title page-title"><h4>', '</h4></a>' );
			?>
			<?php magazil_entry_meta(); ?>
			<div class="excert">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->