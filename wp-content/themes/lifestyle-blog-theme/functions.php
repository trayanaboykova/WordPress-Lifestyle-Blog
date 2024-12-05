<?php
add_theme_support('title-tag');
add_theme_support( 'post-thumbnails' );

add_action('wp_enqueue_scripts', 'lifestyle_blog_enqueue_assets');
function lifestyle_blog_enqueue_assets() {
    wp_enqueue_style('lifestyle-blog', get_stylesheet_uri());
}