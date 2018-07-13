<?php
require get_template_directory() . '/inc/components/widgets/class-widget-magazil-posts-list-vertical.php';
require get_template_directory() . '/inc/components/widgets/class-widget-magazil-posts-list-horizontal.php';
require get_template_directory() . '/inc/components/widgets/class-widget-magazil-posts-list-sidebar.php';

function magazil_companion_recent_posts(){
	
	register_widget('Widget_Magazil_Posts_List_Sidebar');
	register_widget('Widget_Magazil_Posts_List_Horizontal');
	register_widget('Widget_Magazil_Posts_List_Vertical');
						
}
add_action( 'widgets_init', 'magazil_companion_recent_posts' );

?>