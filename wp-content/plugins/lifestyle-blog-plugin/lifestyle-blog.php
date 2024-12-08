<?php
/*
 * Plugin Name: Lifestyle Plugin
 * Description: This is my plugin that works with the Lifestyle Blog theme.
 * Author: Trayana Boykova
 */

/**
 * Custom Post Type - Travel Destinations
 * @return void
 */
function lifestyle_custom_post_type() {
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

/**
 * Register Custom Taxonomy - Travel Categories
 * @return void
 */
function lifestyle_register_taxonomy() {
	$labels = array(
		'name'              => __('Travel Categories', 'textdomain'),
		'singular_name'     => __('Travel Category', 'textdomain'),
		'search_items'      => __('Search Travel Categories', 'textdomain'),
		'all_items'         => __('All Travel Categories', 'textdomain'),
		'parent_item'       => __('Parent Travel Category', 'textdomain'),
		'parent_item_colon' => __('Parent Travel Category:', 'textdomain'),
		'edit_item'         => __('Edit Travel Category', 'textdomain'),
		'update_item'       => __('Update Travel Category', 'textdomain'),
		'add_new_item'      => __('Add New Travel Category', 'textdomain'),
		'new_item_name'     => __('New Travel Category Name', 'textdomain'),
		'menu_name'         => __('Travel Categories', 'textdomain'),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_in_menu'      => true,
		'show_in_rest'      => true,
		'show_tagcloud'     => false,
		'rewrite'           => array('slug' => 'travel-categories'),
	);

	register_taxonomy('travel_category', 'travel', $args);
}
add_action('init', 'lifestyle_register_taxonomy');
