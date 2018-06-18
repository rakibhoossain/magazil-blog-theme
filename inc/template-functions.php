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
<li <?php comment_class("comment single-comment justify-content-between d-flex"); ?> id="comment-<?php comment_ID() ;?>">
  <div class="user justify-content-between d-flex">
    <div class="thumb">
      <?php echo get_avatar($comment,'60','' ); ?>
    </div>
    <div class="comment-desc">
      <h5 class="comment-author"><?php echo get_comment_author_link();?></h5>
      <p class="comment-date"><?php comment_date(); ?></p>
      <div class="comment-content">
        <?php if ($comment->comment_approved == '0') : ?>
        <em><?php esc_attr_e('Your comment is awaiting moderation.','magazil') ;?></em>
        <br />
       <?php endif; ?>
       <?php comment_text() ;?>
       <?php edit_comment_link(__('(Edit)','magazil'),'  ','') ;?>
      </div>
    </div>
  </div>
  <div class="reply-btn">
    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ;?>
  </div>
</li>
                                            
<?php
    }


/*
 * Set post views count using post meta
 */
function setPostViews($postID) {
    $countKey = 'post_views_count';
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


// frontpage post

function front_page_post($image_size = 'top-post-small' , $img_bg = false, $extra_class='') {
    $is_img = 'no-img';
    if ( has_post_thumbnail() ) {
      $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $image_size );
      $image = esc_url($image_url[0]);
      // $image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

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
        <div class="post-box-details <?php echo $is_img; ?>">
            <?php magazil_post_categories(); ?>
            <?php 
            the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><h3 class="entry-title"><h3>', '</h3></a>' );
            ?>
            <?php magazil_entry_meta(); ?>
        </div>
    </div>

    <?php
}


function siblings($link) {
    global $post;
    $siblings = get_pages('child_of='.$post->post_parent.'&parent='.$post->post_parent);
    foreach ($siblings as $key=>$sibling){
        if ($post->ID == $sibling->ID){
            $ID = $key;
        }
    }
    $closest = array('before'=>get_permalink($siblings[$ID-1]->ID),'after'=>get_permalink($siblings[$ID+1]->ID));

    if ($link == 'before' || $link == 'after') { echo $closest[$link]; } else { return $closest; }
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