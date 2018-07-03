<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( $posts->have_posts() ): ?>
	<div class="container no-padding">
		<div class="row small-gutters">
			<div class="col-lg-12 mb-10">
				<h4 class="cat-title">
					<?php
					$idObj = get_category_by_slug( $instance['newsmag_category'] );
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
			$count=(int)0; $mt='';
			while ( $posts->have_posts() ) : $posts->the_post(); 
				$class = ($count == 0)? 'col-lg-12 '.$mt : 'col-lg-6 mt-10';?>

				<div class="<?php echo esc_attr( $class ); ?>">

					<?php
					/**
					* Run the loop for the search to output the results.
					* If you want to overload this in a child theme then include a file
					* called content-search.php and that will be used instead.
					*/
					if ($count == 0) {
						front_page_post('magazil-large-feature');
					}else{
						front_page_post('magazil-small-feature');
					}

					$count++; 
					if ($count == 3) {
						$count=0;
						$mt='mt-10';
					}
					?>

				</div>
			<?php endwhile; wp_reset_postdata();?>
		</div>
	</div>
<?php endif; ?>