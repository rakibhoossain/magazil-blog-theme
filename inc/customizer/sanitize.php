<?php
/**
 * validate checkbox option.
 */
function magazil_sanitize_checkbox( $input ) {
	return ( isset( $input ) && true == $input ? true : false );
}
/**
 *  Sanitize Radio Buttons
 */
if ( ! function_exists( 'magazil_sanitize_radio_buttons' ) ) {
	function magazil_sanitize_radio_buttons( $input, $setting ) {
		global $wp_customize;

		$control = $wp_customize->get_control( $setting->id );

		if ( array_key_exists( $input, $control->choices ) ) {
			return $input;
		} else {
			return $setting->default;
		}
	}
}

/**
 * validate int.
 */
function magazil_sanitize_int( $input ) {
$return = absint($input);
    return $return;
}


/**
 * Sanitization for textarea field
 */
function magazil_sanitize_textarea( $input ) {
    global $allowedposttags;
    $output = wp_kses( $input, $allowedposttags );
    return $output;
}
?>