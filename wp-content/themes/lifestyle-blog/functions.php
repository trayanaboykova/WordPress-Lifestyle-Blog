<?php

add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

add_action( 'wp_enqueue_scripts', 'lifestyle_theme_enqueue_styles' );
function lifestyle_theme_enqueue_styles() {
	// Enqueue vendor styles first (since other styles depend on it)
	wp_enqueue_style( 'lifestyle-vendor-styles', get_stylesheet_directory_uri() . '/css/vendor.css' );

	// Enqueue custom styles with 'vendor.css' as a dependency
	wp_enqueue_style( 'lifestyle-theme-styles', get_stylesheet_directory_uri() . '/css/styles.css', array( 'lifestyle-vendor-styles' ) );

	// Enqueue main theme styles (if applicable)
	wp_enqueue_style( 'lifestyle-main-style', get_template_directory_uri() . '/style.css', array( 'lifestyle-vendor-styles' ) );
}

//Pagination
function fix_paged_parameter($query) {
	if (!is_admin() && $query->is_main_query()) {
		if (is_category() || is_tag() || is_archive()) {
			if (get_query_var('paged')) {
				$query->set('paged', get_query_var('paged'));
			}
		}
	}
}
add_action('pre_get_posts', 'fix_paged_parameter');

