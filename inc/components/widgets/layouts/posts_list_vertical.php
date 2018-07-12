<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( $posts->have_posts() ): ?>
	<div class="container no-padding">
		<div class="row small-gutters">
			<div class="col-lg-12 mb-20">
				<h4 class="cat-title">
					<?php
					$idObj = get_category_by_slug( $instance['magazil_category'] );
					?>
					<?php
					if ( ! empty( $instance['title'] ) ) {
						?>
		                <span><?php echo esc_html( $instance['title'] ); ?></span>
						<?php
					} else {
						?>
		                <a href="<?php echo esc_url( get_category_link( $idObj->term_id ) ) ?>">
							<?php echo ( empty( $instance['title'] ) && $idObj !== false ) ? esc_html( $idObj->name ) : esc_html( $instance['title'] ); ?>
		                </a>
					<?php } ?>
		        </h4>
			</div>
			<?php
			$count=(int)0;
			while ( $posts->have_posts() ) : $posts->the_post(); 
			$class = ($count == 0)? 'col-lg-12 large ' : 'col-lg-6 padding';
			$padding = ($count == 1)? 'lg-pr-10 ' : 'lg-pl-10'; ?>

			<div class="<?php echo esc_attr( $class ); ?> <?php echo esc_attr( $padding ); ?>">

				<?php if ($count == 0): ?>
					<?php get_template_part( 'template-parts/loop/post', 'grid' ); ?>
				<?php else: ?>
					<?php get_template_part( 'template-parts/loop/post', 'content' ); ?>
				<?php endif; ?>
				<?php
					$count++; 
					if ($count == 3) {
						$count=0;
					}
				?>
			</div>
			<?php endwhile; wp_reset_postdata(); $count=0; ?>
		</div>
	</div>
<?php endif; ?>