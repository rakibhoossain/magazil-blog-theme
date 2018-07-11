<?php
/**
 * Template part for blog post layout
 *
 * @package magazil
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="posts-box">
        <div class="relative">
            <?php
            $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'magazil-small-feature' );
            ?>
            <a class="posts-box-img" href="<?php echo get_the_permalink(); ?>">
                <?php printf('<span style="background: url(\''.esc_url($image_url[0]).'\'); ?>)"></span>'); ?>
            </a>
            <div class="posts-meta-details">
                <?php magazil_post_categories(); ?>
            </div>
        </div>
        <div class="post-box-content">
            <?php the_title( '<a href="' . esc_url( get_the_permalink() ) . '" rel="bookmark"><h3 class="entry-title page-title">', '</h3></a>' );?>
            <?php magazil_entry_meta(); ?>
            <div class="excert">
                <?php the_excerpt(); ?>
            </div>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->