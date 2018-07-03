<?php

$code = get_theme_mod( 'magazil_banner_adsense_code', '' );

/**
 * In case we don't have an image, we terminate here
 */
if ( empty( $code ) ) {
	return false;
}
?>
<div class="magazil-adsense">
	<?php
	echo htmlspecialchars_decode( $code );
	?>
	<p class="adsense__loading"><span><?php echo __( 'Loading', 'magazil' ); ?></span></p>
</div>
