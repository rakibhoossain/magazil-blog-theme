<?php
/**
 * In case we don't have an image, we terminate here
 */
$banner_image = get_theme_mod( 'magazil_banner_image', get_template_directory_uri() . '/img/banner-ad.jpg' );
$default = get_template_directory_uri() . '/img/banner-ad.jpg';
$link    = get_theme_mod( 'magazil_banner_link', 'https://rakib.ooo/' );

/**
 * In case the user did not select an image ( default ), we fallback to the placeholder banner
 */
if ( $banner_image !== $default ) {
	//$attachment_id = wp_get_attachment_image_src( get_theme_mod( 'newsmag_banner_image' ) ); ?>
	<a href="<?php echo esc_url( $link ) ?>">
		<?php //echo wp_get_attachment_image( $attachment_id, 'newsmag-wide-banner' ); ?>

		<?php echo '<img src="' . esc_url( $banner_image ) . '" />'; ?>
	</a>
<?php } else { ?>
	<a href="<?php echo esc_url( $link ) ?>">
		<?php
		echo '<img src="' . esc_url( $default ) . '" />';
		?>
	</a>
<?php }
