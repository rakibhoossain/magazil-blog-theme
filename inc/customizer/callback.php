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

function breaking_tag_callback( $control ) {
	if ( $control->manager->get_setting( 'magazil_breaking_news_type' )->value() == 'tag' ) {
		return true;
	}
	return false;
}

function breaking_cat_callback( $control ) {
	if ( $control->manager->get_setting( 'magazil_breaking_news_type' )->value() == 'category' ) {
		return true;
	}
	return false;
}

function breaking_page_callback( $control ) {
	if ( $control->manager->get_setting( 'magazil_breaking_news_type' )->value() == 'page' ) {
		return true;
	}
	return false;
}

function breaking_limit_callback( $control ) {
	if ( $control->manager->get_setting( 'magazil_breaking_news_type' )->value() == 'page' ) {
		return false;
	}

	return true;
}

?>