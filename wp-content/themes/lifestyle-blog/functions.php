<?php
add_action( 'wp_enqueue_scripts', 'lifestyle_blog_enqueue_assets' );

function lifestyle_blog_enqueue_assets() {
    // Enqueue Styles
    wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', array(), '1.0' );
    wp_enqueue_style( 'icomoon', get_template_directory_uri() . '/icomoon/icomoon.css', array(), '1.0' );
    wp_enqueue_style( 'fonts', get_template_directory_uri() . '/fonts/fonts.css', array(), '1.0' );
    wp_enqueue_style( 'lifestyle-blog-style', get_stylesheet_uri(), array( 'normalize', 'icomoon', 'fonts' ), '1.0' );

    // Enqueue Scripts
    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '1.0', false );
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-1.11.0.min.js', array(), '1.0', true );
    wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0', true );
}
