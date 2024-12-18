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

/**
 * Pagination
 * @return void
 */
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


/**
 * Sidebar
 * @return void
 */
function lifestyle_register_sidebars() {
	// Register Main Sidebar
	register_sidebar( array(
		'name'          => 'Footer Sidebar',
		'id'            => 'footer-sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	// Register Front Page Sidebar
	register_sidebar( array(
		'name'          => 'Front Page Sidebar',
		'id'            => 'sidebar-front-page',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'lifestyle_register_sidebars' );


/**
 * Menu
 * @return void
 */
function lifestyle_register_nav_menus() {
	register_nav_menu( 'primary', 'Primary Menu' );
}
add_action( 'after_setup_theme', 'lifestyle_register_nav_menus', 0 );







