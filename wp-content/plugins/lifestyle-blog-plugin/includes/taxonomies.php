<?php
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