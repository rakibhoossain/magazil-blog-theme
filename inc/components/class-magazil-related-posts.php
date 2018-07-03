<?php
/**
 * Class Magazil_Related_Posts_Output
 *
 * This file does the social sharing handling for the Muscle Core Lite Framework
 *
 * @author      Rakib Hossain
 * @copyright   (c) Copyright by Rakib Hossain
 * @link        http://rakibhossain.cf/
 * @package     magazil
 * @since       Version 1.0.0
 */

// @todo : more effects for hover images
// @todo: pull in more than post title & date

if ( ! function_exists( 'magazil_call_related_posts_class' ) ) {
	/**
	 *
	 * Gets called only if the "display related posts" option is checked
	 * in the back-end
	 *
	 * @since   1.0.0
	 *
	 */
	function magazil_call_related_posts_class() {
		// instantiate the class & load everything else
		Magazil_Related_Posts::get_instance();
	}

	add_action( 'wp_loaded', 'magazil_call_related_posts_class' );
}


if ( ! class_exists( 'Magazil_Related_Posts' ) ) {

	/**
	 * Class Magazil_Related_Posts
	 */
	class Magazil_Related_Posts {

		/**
		 * @var Singleton The reference to *Singleton* instance of this class
		 */
		private static $instance;

		/**
		 *
		 */
		protected function __construct() {
			add_action( 'magazil_single_after_article', array( $this, 'output_related_posts' ), 2 );
		}

		/**
		 * Returns the *Singleton* instance of this class.
		 *
		 * @return Singleton The *Singleton* instance.
		 */
		public static function get_instance() {
			if ( null === static::$instance ) {
				static::$instance = new static();
			}

			return static::$instance;
		}

		/**
		 * Private clone method to prevent cloning of the instance of the
		 * *Singleton* instance.
		 *
		 * @return void
		 */
		private function __clone() {
		}

		/**
		 * Private unserialize method to prevent unserializing of the *Singleton*
		 * instance.
		 *
		 * @return void
		 */
		private function __wakeup() {
		}


		/**
		 * Get related posts by category
		 *
		 * @param  integer $post_id current post id
		 * @param  integer $number_posts number of posts to fetch
		 *
		 * @return object                  object with posts info
		 */
		public function get_related_posts( $post_id, $number_posts = - 1 ) {

			$related_postsuery = new WP_Query();
			$args              = '';

			if ( 0 == $number_posts ) {
				return $related_postsuery;
			}

			$args = wp_parse_args( $args, array(
				'category__in'        => wp_get_post_categories( $post_id ),
				'ignore_sticky_posts' => 0,
				'posts_per_page'      => $number_posts,
				'post__not_in'        => array( $post_id ),
				'meta_key'            => '_thumbnail_id',
			) );

			$related_postsuery = new WP_Query( $args );

			// reset post query
			wp_reset_postdata();
			wp_reset_query();

			return $related_postsuery;
		}

		/**
		 * Render related posts carousel
		 *
		 * @return string                    HTML markup to display related posts
		 **/
		function output_related_posts() {
 
			// Check if related posts should be shown
			$related_posts = $this->get_related_posts( get_the_ID(), get_option( 'posts_per_page' ) );
			if ( $related_posts->have_posts() ): ?>

            <div class="related-post">
            	<h3 class="label-title"><?php esc_attr_e('Related posts', 'magazil'); ?></h3>
                <ul class="slides" id="related_posts">
			<?php
                // Loop through related posts
			while ( $related_posts->have_posts() ) {
				$related_posts->the_post();

                echo '<li class="posts-i">';
                if ( has_post_thumbnail( $related_posts->post->ID ) ) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $related_posts->post->ID ), 'post-thumbnail' );
					echo '<a class="posts-i-img" href="' . esc_url( get_the_permalink() ) . '"><span style="background: url(' . esc_url( $image[0] ) . ')"></span></a>';
				}

                $category = get_the_category( $related_posts->post->ID );

				echo '<time class="posts-i-date" datetime="'.get_the_date().'">'.get_the_date().'</time><div class="posts-i-info">';
				if ( $category && !is_wp_error( $category ) ) :
  					echo '<a href="'.get_category_link($category[0]->cat_ID).'" class="posts-i-ctg">' . $category[0]->cat_name . '</a>';
                endif;
                	echo '
                        <h3 class="posts-i-ttl"><a href="' . esc_url( get_the_permalink() ) . '">' . get_the_title() . '</a></h3>
                     </div>
                </li>';
                 }   

            echo'
            	</ul>
            </div>';

			wp_reset_query();
			wp_reset_postdata();

			endif;
		}
	}
}// End if().