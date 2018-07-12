<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
<?php 
if ( $posts->have_posts() ): ?>
			<?php
			$idObj = get_category_by_slug( $instance['magazil_category'] );
			?>
			<h4 class="cat-title  mb-20">
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
		<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
            <?php get_template_part( 'template-parts/loop/post', 'horizontal' ); ?>
		<?php endwhile; wp_reset_postdata();?>

<?php endif; ?>