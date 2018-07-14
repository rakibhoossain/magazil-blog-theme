<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package magazil
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<?php if ( have_comments() ) : ?>
	
	<h2 class="comments-title">
	<?php
		printf( // WPCS: XSS OK.
			esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'magazil' ) ),
			number_format_i18n( get_comments_number() ),
			'<span>' . get_the_title() . '</span>'
		);
	?>
	</h2>

	<ol id="thecomments" class="commentlist comments-list">
	<?php wp_list_comments('type=comment&callback=magazil_comment');?>
	</ol>

<!-- comments pagenavi Start. -->
	<?php
	if (get_option('page_comments')) {
		$comment_pages = paginate_comments_links('echo=0');
		if ($comment_pages) {
?>
		<div id="commentnavi">
			<span class="pages"><?php esc_attr_e('Comment pages', 'magazil'); ?></span>
			echo '<div id="commentpager">'.$comment_pages.'</div>';			
			<div class="fixed"></div>
		</div>
<?php
		}
	}
?>

<?php else :  ?>

	<?php if ( comments_open() ) : ?>

	<?php else : ?>
		<!-- If comments are closed. -->
		<p class="nocomments"></p>

	<?php endif; ?>
<?php endif; ?>

<?php if ( comments_open() ) : ?>

<div id="respond" class="respondbg">

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'magazil'),  esc_url(wp_login_url( get_permalink() ))); ?></p>
<?php else : ?>
<?php 
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
global $required_text;

$comments_args = array(
'class_submit' => 'primary-btn text-uppercase',
         'comment_notes_before' => '<p class="comment-notes">' .
    esc_attr__( 'Your email address will not be published.', 'magazil' ) . ( $req ? $required_text : '' ) .
    '</p>',
        'title_reply'=>esc_attr__('Leave a Reply', 'magazil'),
        'comment_notes_after' => '',
        'comment_field' => '<div class="clear"></div><p class="form-allowed-tags"></p>
<section class="comment-form-comment form-group"><div id="comment-textarea"><textarea id="comment" name="comment" placeholder="'.esc_attr__('Message', 'magazil').'"  cols="45" rows="8"  class="textarea-comment form-control" aria-required="true"></textarea></div></section>',
		'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<div class="row"><section class="comment-form-author form-group col-md-4"><input id="author" class="input-name form-control" name="author" placeholder="'.esc_attr__('Name', 'magazil').'"  type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30"' . $aria_req . ' /></section>',

    'email' =>
      '<section class="comment-form-email form-group col-md-4"><input id="email" class="input-name form-control" name="email" placeholder="'.esc_attr__('Email', 'magazil').'"  type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30"' . $aria_req . ' /></section>',

    'url' =>
      '<section class="comment-form-url form-group col-md-4"><input id="url" class="input-name form-control" placeholder="'.esc_attr__('Website', 'magazil').'" name="url"  type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30" /></section></div>'
    ))
);
?>
<?php comment_form($comments_args);?>

<?php endif;?>
</div>
<?php endif;?>