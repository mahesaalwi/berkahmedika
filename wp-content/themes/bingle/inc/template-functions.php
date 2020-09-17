<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package bingle
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bingle_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	$header_layout = get_theme_mod('bingle_header_layout_setting','lay0');
	$classes[] = 'header-'.$header_layout;

	$footer_layout = get_theme_mod('bingle_footer_layout_setting','lay2');
	$classes[] = 'footer-'.$footer_layout;
	
	if(is_singular()){

		$single_c_layout = get_theme_mod('bingle_inner_single_content_wrap','bingle-wrapper');
		$classes[] = $single_c_layout.'-single';

		$single_layout = get_theme_mod('bingle_inner_single_sidebar','sidebar-right');
		$classes[] = 'single-'.$single_layout;
	}else{
		$archive_layout = get_theme_mod('bingle_inner_blog_content_wrap','bingle-wrapper');
		$classes[] = $archive_layout.'-archive';

		$blog_layout = get_theme_mod('bingle_inner_blog_sidebar','sidebar-right');
		$classes[] = 'archive-'.$blog_layout;

		$archive_layout = get_theme_mod('bingle_inner_blog_layout','list');
		$classes[] = 'archive-'.$archive_layout;
	}

	return $classes;
}
add_filter( 'body_class', 'bingle_body_classes' );

/**
 * Add a pingback url auto-discovery header for bingle posts, pages, or attachments.
 */
function bingle_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'bingle_pingback_header' );
