<?php
if(!class_exists('Widget_Magazil_Posts_List_Sidebar')){
 class Widget_Magazil_Posts_List_Sidebar extends WP_Widget {
    
	public function __construct() {
		
		parent::__construct(
			'magazil_recent_posts', // Base ID
			__( 'Magazil: Recent Posts', 'magazil' ), // Name
			array( 'description' => __( 'Recent Posts.', 'magazil' ), ) // Args
		);
		
	}
 	function form( $instance ) {
 	    $defaults = array('list_num' => 4, 'title' => __( 'Recent Posts', 'magazil' ));
 		$instance = wp_parse_args( (array) $instance, $defaults );
 	
	?>

<p>
  <label for="<?php echo esc_attr( $this->get_field_id( 'title' )); ?>">
    <?php _e('Title', 'magazil'); ?>
    :</label>
  <br />
  <input id="<?php echo esc_attr( $this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
</p>
<p>
  <label for="<?php echo esc_attr( $this->get_field_id( 'list_num' )); ?>">
    <?php _e('Recent Posts List Num', 'magazil'); ?>
    :</label>
  <br />
  <input id="<?php echo esc_attr( $this->get_field_id( 'list_num' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'list_num' )); ?>" value="<?php echo absint($instance['list_num']); ?>" />
</p>
<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
			$instance['list_num']  = absint($new_instance['list_num']);
			$instance['title']     = esc_attr($new_instance['title']);

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 	    $title    = apply_filters(__('Recent Posts', 'magazil'), esc_attr($instance['title']) );
		$list_num = absint($instance['list_num']);
		
		echo wp_specialchars_decode($before_widget);
		if($title)
			$widget_title = $before_title . $title . $after_title;
		echo wp_specialchars_decode($widget_title);
		
		$my_query = new WP_Query( 'showposts='.absint($list_num).'&ignore_sticky_posts=1');
		?>


<div class="editors-pick-post">
    <?php $first_viewed = true; while ($my_query->have_posts() ) : $my_query->the_post(); ?>

    <?php if ($first_viewed && has_post_thumbnail() ){

         $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'magazil-small-feature');
		 $source = get_site_url();
		 if($featured_image[0] !=""){
			$thumb = $featured_image[0];
			?>
	<div class="feature-img-wrap relative">
		<div class="feature-img relative">
			<div class="overlay overlay-bg"></div>
			<?php echo '<img src="'.esc_url($thumb).'" class="img-fluid" alt="'.esc_attr(get_the_title()).'" />'; ?>
		</div>
		<?php magazil_post_categories();?>
	</div>


	<div class="details">
		<a href="<?php the_permalink();?>"><h4 class="mt-20"><?php the_title();?></h4></a>
			<ul class="meta">
				<li><a href="<?php the_permalink();?>"><span class="lnr lnr-calendar-full"></span><?php echo get_the_date();?></a></li>
				<li><a href="<?php the_permalink();?>"><span class="lnr lnr-bubble"></span><?php echo get_comments_number();?></a></li>
			</ul>
		<div class="excert">
			<?php the_excerpt(); ?>
		</div>
	</div>

			<?php
		}

    }else{
   ?>
<div class="single-post d-flex flex-row">
	<?php
    	   if ( has_post_thumbnail() ) {
         $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'magazil-small-icon');
		 $source = get_site_url();
		 if($featured_image[0] !=""){
			$thumb = $featured_image[0]; 
			echo '<div class="thumb"> <a href="'.esc_url(get_permalink()).'" ><img src="'.esc_url($thumb).'" class="widget-img xs" alt="'.esc_attr(get_the_title()).'" /></a></div>';
			 }
		}

		?>
		<div class="detail">
			<a href="<?php the_permalink();?>"><h6><?php the_title();?></h6></a>
			<ul class="meta">
				<li><a href="<?php the_permalink();?>"><span class="lnr lnr-calendar-full"></span><?php echo get_the_date();?></a></li>
				<li><a href="<?php the_permalink();?>"><span class="lnr lnr-bubble"></span><?php echo get_comments_number();?></a></li>
			</ul>
		</div>
</div>

		<?php

    }
	$first_viewed=false;
    endwhile;
    wp_reset_postdata();
    ?>
</div>
<?php 
	echo wp_specialchars_decode($after_widget);
 	}
 }
 
function magazil_companion_recent_posts(){
	
	register_widget('Widget_Magazil_Posts_List_Sidebar');
	register_widget('Widget_Magazil_Posts_List_Horizontal');
	register_widget('Widget_Magazil_Posts_List_Vertical');
						
}
add_action( 'widgets_init', 'magazil_companion_recent_posts' );
 
}