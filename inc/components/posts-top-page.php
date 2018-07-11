<?php

$top_type = get_theme_mod( 'magazil_top_post_type', 'popular' );
if ( $top_type == 'page' ) {
	$top_page = get_theme_mod( 'magazil_top_post_page');
	$args = array('post_type' => 'page', 'page_id' => $top_page, 'no_found_rows' => 1 );
	$top_page_query = new wp_query( $args  ); 
	
	if( $top_page_query->have_posts() ) : ?>
		<?php while( $top_page_query->have_posts() ) : $top_page_query->the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; wp_reset_postdata(); wp_reset_query(); ?>
	<?php endif; ?>

<?php
} 
?>