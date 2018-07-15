<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Widget_Magazil_Posts_List_Horizontal extends WP_Widget {

	function __construct() {
		add_action( 'admin_init', array( $this, 'enqueue' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'customize_preview_init', array( $this, 'enqueue' ) );

		parent::__construct( 'magazil_widget_posts_list_horizontal', __( 'Magazil - Horizontal Posts List', 'magazil' ), array(
			'classname'                   => 'magazil_builder',
			'description'                 => __( 'Front page horizontal post layout', 'magazil' ),
			'customize_selective_refresh' => true
		) );
	}

	public function enqueue() {
			wp_enqueue_script( 'jquery-ui' );
			wp_enqueue_script( 'jquery-ui-slider' );
			wp_enqueue_style( 'magazil-widget-range' );
			wp_enqueue_script( 'magazil-widget-range' );
	}

	public function form( $instance ) {
		$defaults = array(
			'title'            => __( 'Recent posts', 'magazil' ),
			'show_post'        => 4,
			'magazil_category' => 'uncategorized',
			'order' 		   => 'desc'

		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		?>
        <p>
            <label><?php _e( 'Title', 'magazil' ); ?> :</label>
            <input class="widefat" type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                   id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>

        <p>
            <label><?php _e( 'Category', 'magazil' ); ?> :</label>
            <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'magazil_category' ) ); ?>"
                    id="<?php echo esc_attr( $this->get_field_id( 'magazil_category' ) ); ?>">
                <option value="" <?php if ( empty( $instance['magazil_category'] ) ) {
					echo 'selected="selected"';
				} ?>><?php _e( '&ndash; Select a category &ndash;', 'magazil' ) ?></option>
				<?php
				$categories = get_categories( 'hide_empty=0' );
				foreach ( $categories as $category ) { ?>
                    <option
                            value="<?php echo esc_attr( $category->slug ); ?>" <?php selected( esc_attr( $category->slug ), $instance['magazil_category'] ); ?>><?php echo esc_attr( $category->cat_name ); ?></option>
				<?php } ?>
            </select>
        </p>
        <p>
            <label><?php _e( 'Order', 'magazil' ); ?> :</label>
            <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>"
                    id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" class="pull-right">
                <option value ="desc" <?php echo ($instance['order'] == 'desc') ? 'selected' : '';?> ><?php echo esc_html__( 'Descending', 'magazil' )?></option>
                <option value ="asc" <?php echo ($instance['order'] == 'asc') ? 'selected' : '';?> ><?php echo esc_html__( 'Ascending', 'magazil' )?></option>
                <option value ="rand" <?php echo ($instance['order'] == 'rand') ? 'selected' : '';?> ><?php echo esc_html__( 'Random', 'magazil' )?></option>
            </select>
        </p>
        <label class="block" for="input_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ); ?>">
            <span class="customize-control-title">
               <?php _e( 'Posts to Show', 'magazil' ); ?> :
            </span>
        </label>
		<div class="slider-container">
	        <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'show_post' ) ); ?>" class="rl-slider"
	               id="input_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ); ?>"
	               value="<?php echo esc_attr( $instance['show_post'] ); ?>"/>

	        <div id="slider_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ) ?>" data-attr-min="4"
	             data-attr-max="12" data-attr-step="2" class="ss-slider"></div>
		</div>
	<?php }

	public function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance['title']            = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['magazil_category'] = ( ! empty( $new_instance['magazil_category'] ) ) ? strip_tags( $new_instance['magazil_category'] ) : '';
		$instance['show_post']        = ( ! empty( $new_instance['show_post'] ) ) ? absint( $new_instance['show_post'] ) : '';
		$instance['order']            = ( ! empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : '';

		return $instance;

	}

	/**
	 * Proxy function to return posts
	 *
	 * @param $args
	 *
	 * @return WP_Query
	 */
	public function get_posts( $args ) {

		$idObj = get_category_by_slug( $args['magazil_category'] );
		$atts  = array(
			'posts_per_page' => $args['show_post']
		);

		$atts['order'] = $args['order'];
		$atts['orderby'] = 'date';

		if('rand' == $atts['order'] ){
			$atts['order'] = '';
			$atts['orderby'] = 'rand';
		}

		if ( $idObj ) {
			$id          = $idObj->term_id;
			$atts['cat'] = $id;
		}

		$posts = new WP_Query( $atts );

		wp_reset_postdata();

		return $posts;
	}

	public function widget( $args, $instance ) {
		$defaults = array(
			'title'            => __( 'Recent posts', 'magazil' ),
			'show_post'        => 4,
			'magazil_category' => '',
			'order'            => 'desc',
			'ignore_sticky_posts' => true,
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		echo wp_specialchars_decode($args['before_widget']);
		$filepath = get_template_directory() . '/inc/components/widgets/layouts/posts_list_horizontal.php';

		$posts = $this->get_posts( $instance );

		if ( file_exists( $filepath ) ) {
			include $filepath;
		} else {
			esc_html_e( 'Please configure your widget', 'magazil' );
		}


		echo wp_specialchars_decode($args['after_widget']);

	}

}