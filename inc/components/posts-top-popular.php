<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

$popular_show = get_theme_mod( 'magazil_top_post_limit', 3 );
$posts = new WP_Query( array(
	'post_type' => 'post',//'page ,post',
	'meta_key' => 'wpb_post_views_count',
	'meta_query' => array(array('key' => '_thumbnail_id')) ,
	'orderby' => 'meta_value_num',
	'order' => 'DESC',
	'ignore_sticky_posts' => true,
	'posts_per_page' => absint($popular_show)
) ); 

?>		

<?php if ( $posts->have_posts() && $posts->found_posts >= $popular_show): $count = (int)0; ?>	

	<div class="grid-post post-grid-<?php echo esc_attr( $popular_show ); ?>">

	<?php
		/* Start the Loop */
		while ( $posts->have_posts() ) : $posts->the_post();?>

		<?php
		/**
		 * Run the loop for the search to output the results.
		 * If you want to overload this in a child theme then include a file
		 * called content-search.php and that will be used instead.
		 */

		if ($count == 0) {
			get_template_part( 'template-parts/loop/post-top', 'large' );
		}else{
			get_template_part( 'template-parts/loop/post', 'top' );
		}

		$count++; 
		endwhile;
		$count=0;
		wp_reset_query();
		wp_reset_postdata();
	?>
	</div>
<?php
endif;?>