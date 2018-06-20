<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-box-ltrt row align-items-center pt-20">
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
			?>
			<?php magazil_entry_meta(); ?>
			<div class="excert">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
