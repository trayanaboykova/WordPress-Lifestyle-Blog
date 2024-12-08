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

/*
 * Pagination
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
function lifestyle_widgets_init() {
	register_sidebar( array(
		'name'          => 'Main Sidebar',
		'id'            => 'sidebar-1',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'lifestyle_widgets_init' );

/**
 * Menu
 * @return void
 */
function lifestyle_register_nav_menus() {
	register_nav_menu( 'primary', 'Primary Menu' );
}
add_action( 'after_setup_theme', 'lifestyle_register_nav_menus', 0 );

/**
 * Custom Post Type - Travel Destinations
 * @return void
 */
function lifestyle_custom_post_type() {
	// Register Travel Destinations Custom Post Type
	$labels = array(
		'name'                  => __('Travel Destinations', 'textdomain'),
		'singular_name'         => __('Travel Destination', 'textdomain'),
		'menu_name'             => __('Travel Destinations', 'textdomain'),
		'name_admin_bar'        => __('Travel Destination', 'textdomain'),
		'add_new'               => __('Add New', 'textdomain'),
		'add_new_item'          => __('Add New Travel Destination', 'textdomain'),
		'edit_item'             => __('Edit Travel Destination', 'textdomain'),
		'new_item'              => __('New Travel Destination', 'textdomain'),
		'view_item'             => __('View Travel Destination', 'textdomain'),
		'search_items'          => __('Search Travel Destinations', 'textdomain'),
		'not_found'             => __('No Travel Destinations Found', 'textdomain'),
		'not_found_in_trash'    => __('No Travel Destinations Found in Trash', 'textdomain'),
		'all_items'             => __('All Travel Destinations', 'textdomain'),
		'archives'              => __('Travel Destination Archives', 'textdomain'),
		'insert_into_item'      => __('Insert into Travel Destination', 'textdomain'),
		'uploaded_to_this_item' => __('Uploaded to this Travel Destination', 'textdomain'),
	);

	$args = array(
		'labels'                => $labels,
		'public'                => true,
		'has_archive'           => true,
		'show_in_menu'          => true,
		'menu_icon'             => 'dashicons-location-alt',
		'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
		'rewrite'               => array('slug' => 'travel-destinations'),
		'show_in_rest'          => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'hierarchical'          => false,
	);

	register_post_type('travel', $args);
}
add_action('init', 'lifestyle_custom_post_type');





