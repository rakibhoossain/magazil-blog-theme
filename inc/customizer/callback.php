<?php

function banners_type_callback( $control ) {
	if ( $control->manager->get_setting( 'magazil_banner_type' )->value() == 'image' ) {
		return true;
	}

	return false;
}

function banners_type_false_callback( $control ) {
	if ( $control->manager->get_setting( 'magazil_banner_type' )->value() == 'image' ) {
		return false;
	}

	return true;
}
?>