<?php
/**
 * bingle Theme Sanitizer Extended
 *
 * @package bingle
 */
function bingle_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}
function bingle_sanitize_integer($input){
	return intval( $input );
}
function bingle_sanitize_wrapper( $input ) {

	$valid_keys = array(
		'bingle-wrapper' => esc_html__( 'Wrapped', 'bingle' ),
		'bingle-fullwidth' => esc_html__( 'Fullwidth', 'bingle' ),
	);

	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}
function bingle_sanitize_yesno( $input ) {

	$valid_keys = array(
		'yes' => esc_html__( 'Yes', 'bingle' ),
		'no' => esc_html__( 'No', 'bingle' ),
	);

	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

function bingle_sanitize_gridlist( $input ) {

	$valid_keys = array(
		'list' => esc_html__( 'List', 'bingle' ),
		'grid' => esc_html__( 'Grid', 'bingle' ),
	);

	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}
function bingle_sanitize_layout( $input ) {

	$valid_keys = array(
		'lay0' => __('Default Layout', 'bingle'),
		'lay1' => __('Layout One', 'bingle'),
		'lay2' => __('Layout Two', 'bingle'),
		'lay3' => __('Layout Three', 'bingle'),
		'lay4' => __('Layout Four', 'bingle'),
		'lay5' => __('Layout Five', 'bingle'),
		'lay6' => __('Layout Six', 'bingle'),
		'lay7' => __('Layout Seven', 'bingle'),
		'lay8' => __('Layout Eight', 'bingle'),
		'lay9' => __('Layout Nine', 'bingle'),
		'lay10' => __('Layout Ten', 'bingle'),
		'lay11' => __('Layout Eleven', 'bingle'),
	);

	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}
function bingle_sanitize_sidebar( $input ) {
	$valid_keys = array(
		'sidebar-left' => array('image'=> get_template_directory_uri().'/assets/images/bingle-sidebar-left.jpg',
			'name'=>__('Left Sidebar', 'bingle')
		),
		'sidebar-right' => array('image'=> get_template_directory_uri().'/assets/images/bingle-sidebar-right.jpg',
			'name'=>__('Right Sidebar', 'bingle')
		),
		'sidebar-none' => array('image'=> get_template_directory_uri().'/assets/images/bingle-sidebar-none.jpg',
			'name'=>__('No Sidebar', 'bingle')
		),
	);

	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

/* Theme Active Callbacks */
function bingle_container_style_wrapper(){
	$bingle_lay = get_theme_mod( 'bingle_container_style','bingle-wrapper');
	if( $bingle_lay == 'bingle-wrapper') {
		return true;
	}
	return false;
}
function wrap_bingle_header_style_top_header(){
	$bingle_lay = get_theme_mod( 'bingle_header_style_top_header','bingle-wrapper');
	if( $bingle_lay == 'bingle-wrapper') {
		return true;
	}
	return false;
}
function wrap_bingle_header_style_main_header(){
	$bingle_lay = get_theme_mod( 'bingle_header_style_main_header','bingle-wrapper');
	if( $bingle_lay == 'bingle-wrapper') {
		return true;
	}
	return false;
}
function wrap_bingle_header_style_bottom_header(){
	$bingle_lay = get_theme_mod( 'bingle_header_style_bottom_header','bingle-wrapper');
	if( $bingle_lay == 'bingle-wrapper') {
		return true;
	}
	return false;
}
function wrap_bingle_footer_style_top_footer(){
	$bingle_lay = get_theme_mod( 'bingle_footer_style_top_footer','bingle-wrapper');
	if( $bingle_lay == 'bingle-wrapper') {
		return true;
	}
	return false;
}
function wrap_bingle_footer_style_main_footer(){
	$bingle_lay = get_theme_mod( 'bingle_footer_style_main_footer','bingle-wrapper');
	if( $bingle_lay == 'bingle-wrapper') {
		return true;
	}
	return false;
}
function bingle_inner_single_content_wrapper(){
	$bingle_lay = get_theme_mod( 'bingle_inner_single_content_wrap','bingle-wrapper');
	if( $bingle_lay == 'bingle-wrapper') {
		return true;
	}
	return false;
}
function bingle_inner_blog_content_wrapper(){
	$bingle_lay = get_theme_mod( 'bingle_inner_blog_content_wrap','bingle-wrapper');
	if( $bingle_lay == 'bingle-wrapper') {
		return true;
	}
	return false;
}
