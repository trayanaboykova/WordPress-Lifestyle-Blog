
<?php

add_action('wp_enqueue_scripts', 'lifestyle_blog_enqueue_assets');
function lifestyle_blog_enqueue_assets(): void {
    wp_enqueue_style('lifestyle-blog', get_stylesheet_uri());
}