<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package magazil
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function magazil_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'magazil_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function magazil_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'magazil_pingback_header' );

/**
 *  Breadcrumb
 *
 *
 */
if ( ! function_exists( 'magazil_breadcrumbs' ) ) :

    /**
     * Simple breadcrumb.
     *
     * @since 1.0.0
     *
     * @link: https://gist.github.com/melissacabral/4032941
     *
     * @param  array $args Arguments
     */
    function magazil_breadcrumbs( $args = array() ) {
        // Bail if Home Page.
        // if ( is_front_page() || is_home() ) {
        if ( is_front_page() ) {
            return;
        }

        if ( ! function_exists( 'breadcrumb_trail' ) ) {
            require_once trailingslashit(get_template_directory()) . '/inc/breadcrumbs.php';
        }

        $breadcrumb_args = array(
            'container'   => 'div',
            'show_browse' => false,
        );
        breadcrumb_trail( $breadcrumb_args );
       
    }

endif;

function magazil_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'magazil_comment_field_to_bottom' );
?>

<?php
/**
 *  Custom comments list
 */ 
function magazil_comment($comment, $args, $depth) { ?>
<li <?php comment_class("comment single-comment"); ?> id="comment-<?php comment_ID() ;?>">


    
    <div class="comment-top-area justify-content-between d-flex">

      <div class="user d-flex">
        <div class="thumb">
          <?php echo get_avatar($comment,'60','' ); ?>
        </div>
        <div class="comment-meta">
          <h5 class="comment-author"><?php echo get_comment_author_link();?></h5>
          <h6 class="comment-date"><?php comment_date(); ?></h6>
          <?php edit_comment_link(__('(Edit)','magazil'),'  ','') ;?>
        </div>
      </div>

      <div class="reply-btn">
        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ;?>
      </div>

    </div>

    <div class="comment-desc">
      <div class="comment-content">
        <?php if ($comment->comment_approved == '0') : ?>
          <em><?php esc_attr_e('Your comment is awaiting moderation.','magazil') ;?></em>
          <br />
        <?php endif; ?>
        <?php comment_text() ;?>
      </div>


    </div>

</li>
                                            
<?php
    }


/*
 * Set post views count using post meta
 */
function setPostViews($postID) {
    $countKey = 'wpb_post_views_count';
    $count = get_post_meta($postID, $countKey, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '0');
    }else{
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}


/**
 *  frontpage post layout
 *  parm 1 image size
 *  parm 2 image bg
 *  parm 3 extra class
 */ 
function front_page_post($image_size = 'magazil-feature-image' , $img_bg = false, $extra_class='') {
    $is_img = 'no-img';
    if ( has_post_thumbnail() ) {
      $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $image_size );
      $image = esc_url($image_url[0]);
        $is_img = 'tight';
        if ($img_bg) {
          echo '<div class="post-box-img bg-img '.$extra_class.'" style="background-image:url(\''.$image.'\')">';
        }else{
          echo '<div class="post-box-img has-img '.$extra_class.'">';
          printf('<img class="img-fluid" src="%1$s" alt="%2$s">' ,$image,get_the_title());
        }
        echo '<div class="overlay overlay-bg"></div>';
    }else{
        echo '<div class="post-box-img no-img '.$extra_class.'">';
    }?>
        <div class="post-box-details <?php echo esc_attr( $is_img ); ?>">
            <?php magazil_post_categories(); ?>
            <?php 
            the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><h3 class="entry-title"><h3>', '</h3></a>' );
            ?>
            <?php magazil_entry_meta(); ?>
        </div>
    </div>

    <?php
}



function magazil_page_navigation($pagelist = array()){
  $pages = array();
  foreach ($pagelist as $page) {
   $pages[] += $page->ID;
 }
 $current = array_search(get_the_ID(), $pages);
 $prevID = ( isset($pages[$current-1]) ) ? $pages[$current-1] : '';
 $nextID = ( isset($pages[$current+1]) ) ? $pages[$current+1] : '';
?>
<nav class="child-pagination">
    <?php if (!empty($prevID)) { ?>
    <div class="alignleft">
    <a href="<?php  echo get_permalink($prevID); ?>"
      title="<?php  echo get_the_title($prevID); ?>" class="previous-page"><?php  esc_attr_e('Previous', 'magazil'); ?></a>
    </div>
    <?php }
    if (!empty($nextID)) { ?>
    <div class="alignright">
    <a href="<?php echo get_permalink($nextID); ?>" 
     title="<?php  echo get_the_title($nextID); ?>" class="next-page"><?php  esc_attr_e('Next', 'magazil'); ?></a>
    </div>
    <?php } ?>
</nav><!-- #pagination -->
<?php

}



/**
 * Display Fontawesome icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function magazil_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
  // Get supported social icons.
  $social_icons =  magazil_social_links_icons();

  // Change SVG icon inside social links menu if there is supported URL.
  if ( 'social' === $args->theme_location ) {
    foreach ( $social_icons as $attr => $value ) {
      if ( false !== strpos( $item_output, $attr ) ) {

        $item_output = str_replace( $args->link_after, '</span><i class="fa fa-'.esc_attr( $value ).'"></i>', $item_output );
      }
    }
  }

  return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'magazil_nav_menu_social_icons', 10, 4 );


/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
function magazil_social_links_icons() {
  // Supported social links icons.
  $social_links_icons = array(
    'behance.net'     => 'behance',
    'codepen.io'      => 'codepen',
    'deviantart.com'  => 'deviantart',
    'digg.com'        => 'digg',
    'docker.com'      => 'dockerhub',
    'dribbble.com'    => 'dribbble',
    'dropbox.com'     => 'dropbox',
    'facebook.com'    => 'facebook',
    'flickr.com'      => 'flickr',
    'foursquare.com'  => 'foursquare',
    'plus.google.com' => 'google-plus',
    'github.com'      => 'github',
    'instagram.com'   => 'instagram',
    'linkedin.com'    => 'linkedin',
    'mailto:'         => 'envelope-o',
    'medium.com'      => 'medium',
    'pinterest.com'   => 'pinterest-p',
    'pscp.tv'         => 'periscope',
    'getpocket.com'   => 'get-pocket',
    'reddit.com'      => 'reddit-alien',
    'skype.com'       => 'skype',
    'skype:'          => 'skype',
    'slideshare.net'  => 'slideshare',
    'snapchat.com'    => 'snapchat-ghost',
    'soundcloud.com'  => 'soundcloud',
    'spotify.com'     => 'spotify',
    'stumbleupon.com' => 'stumbleupon',
    'tumblr.com'      => 'tumblr',
    'twitch.tv'       => 'twitch',
    'twitter.com'     => 'twitter',
    'vimeo.com'       => 'vimeo',
    'vine.co'         => 'vine',
    'vk.com'          => 'vk',
    'wordpress.org'   => 'wordpress',
    'wordpress.com'   => 'wordpress',
    'yelp.com'        => 'yelp',
    'youtube.com'     => 'youtube',
  );

  /**
   * Filter Magazil social links icons.
   *
   * @since Magazil 1.0
   *
   * @param array $social_links_icons Array of social links icons.
   */
  return apply_filters( 'magazil_social_links_icons', $social_links_icons );
}