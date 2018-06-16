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
function astore_comment($comment, $args, $depth) {

?>
   
<li <?php comment_class("comment media-comment"); ?> id="comment-<?php comment_ID() ;?>">
    <div class="media-avatar media-left">
    <?php echo get_avatar($comment,'70','' ); ?>
  </div>
  <div class="media-body">
      <div class="media-inner">
          <h4 class="media-heading clearfix">
             <?php echo get_comment_author_link();?> - <?php comment_date(); ?> <?php edit_comment_link(__('(Edit)','astore'),'  ','') ;?>
             <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ;?>
          </h4>
          
          <?php if ($comment->comment_approved == '0') : ?>
                   <em><?php esc_attr_e('Your comment is awaiting moderation.','astore') ;?></em>
                   <br />
                <?php endif; ?>
                
          <div class="comment-content"><?php comment_text() ;?></div>
      </div>
  </div>
</li>
                                            
<?php
    }



class Bootstrap_Comment_Walker extends Walker_Comment {
    /**
     * Output a comment in the HTML5 format.
     *
     * @since 1.0.0
     *
     * @see wp_list_comments()
     *
     * @param object $comment the comments list.
     * @param int    $depth   Depth of comments.
     * @param array  $args    An array of arguments.
     */
    protected function html5_comment( $comment, $depth, $args ) {
        $tag = ( $args['style'] === 'div' ) ? 'div' : 'li';
?>      
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'has-children media' : ' media' ); ?>>
            

            <div class="media-body card mt-3 " id="div-comment-<?php comment_ID(); ?>">
                <div class="card-header hoverable">
                    <div class="flex-center">
                        <?php if ( $args['avatar_size'] != 0  ): ?>
                        <a href="<?php echo get_comment_author_url(); ?>" class="media-object float-left">
                            <?php echo get_avatar( $comment, $args['avatar_size'],'mm','', array('class'=>"comment_avatar rounded-circle") ); ?>
                        </a>
                        <?php endif; ?>
                        <h4 class="media-heading "><?php echo get_comment_author_link() ?></h4>
                    </div>
                    <div class="comment-metadata flex-center">
                        <a class="hidden-xs-down" href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
                            <time class=" small btn btn-secondary chip" datetime="<?php comment_time( 'c' ); ?>">
                                <?php comment_date() ?>,
                                <?php comment_time() ?>
                            </time>
                        </a>
                        <ul class="list-inline">
                            <?php edit_comment_link( __( 'Edit' ), '<li class="edit-link list-inline-item btn btn-secondary chip">', '</li>' ); ?>
                            <?php
                                comment_reply_link( array_merge( $args, array(
                                    'add_below' => 'div-comment',
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before'    => '<li class=" reply-link list-inline-item btn btn-secondary chip">',
                                    'after'     => '</li>'
                                ) ) );  
                            ?>
                        </ul>
                    </div><!-- .comment-metadata -->
                </div>
                <div class="card-block warning-color">
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="card-text comment-awaiting-moderation label label-info text-muted small"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
                    <?php endif; ?>             

                    <div class="comment-content card-text">
                        <?php comment_text(); ?>
                    </div><!-- .comment-content -->
                                
                <!-- </div> -->

            <!-- </div>      -->
<?php
    }   
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