<?php
add_action( 'wp_enqueue_scripts', 'lifestyle_theme_enqueue_styles' );
function lifestyle_theme_enqueue_styles() {
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/style.css' );
}
