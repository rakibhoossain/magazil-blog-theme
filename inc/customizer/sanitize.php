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

/**
 * Validate the options against the breaking news types
 *
 * @param  string[] $input
 *
 * @return string
 */
function magazil_sanitize_array_breaking_type( $input ) {
  $valid = magazil_breaking_news_type();
    if ( ! array_key_exists( $input, $valid ) ) {
      return;
    }

  return $input;
}


/**
 * Validate the options against the existing pages
 *
 * @param  string[] $input
 *
 * @return string
 */
function magazil_sanitize_array_page( $input ) {
  $valid = magazil_page_list();

  foreach ( $input as $value ) {
    if ( ! array_key_exists( $value, $valid ) ) {
      return [];
    }
  }

  return $input;
}

/**
 * Validate the options against the existing categories
 *
 * @param  string[] $input
 *
 * @return string
 */
function magazil_sanitize_array_catagory( $input ) {
  $valid = magazil_cat_list();

  foreach ( $input as $value ) {
    if ( ! array_key_exists( $value, $valid ) ) {
      return [];
    }
  }

  return $input;
}



/**
 * Validate the options against the existing tags
 *
 * @param  string[] $input
 *
 * @return string
 */
function magazil_sanitize_array_tags( $input ) {
  $valid = magazil_tag_list();

  foreach ( $input as $value ) {
    if ( ! array_key_exists( $value, $valid ) ) {
      return [];
    }
  }

  return $input;
}

/**
 * Validate the options against the existing effects
 *
 * @param  string[] $input
 *
 * @return string
 */
function magazil_sanitize_array_effects( $input ) {
  $valid = magazil_jquery_effects();

  foreach ( $input as $value ) {
    if ( ! array_key_exists( $value, $valid ) ) {
      return [];
    }
  }

  return $input;
}

?>