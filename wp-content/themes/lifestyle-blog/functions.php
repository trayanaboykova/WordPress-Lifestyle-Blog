<?php

add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

add_action( 'wp_enqueue_scripts', 'lifestyle_theme_enqueue_styles' );
function lifestyle_theme_enqueue_styles() {
	// Load all CSS files
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'main-style', get_stylesheet_directory_uri() . '/css/styles.css');
	wp_enqueue_style( 'main-style', get_stylesheet_directory_uri() . '/css/vendor.css');
}

