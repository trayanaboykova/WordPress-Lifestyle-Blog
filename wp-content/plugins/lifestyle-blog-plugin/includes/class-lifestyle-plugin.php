<?php

class LifestylePlugin {

	/**
	 * Constructor to initialize the plugin.
	 */
	public function __construct() {
		// Register hooks and actions
		add_action('init', [$this, 'register_post_type']);
		add_action('init', [$this, 'register_taxonomy']);
		add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
		add_action('save_post', [$this, 'save_meta_box_data']);
	}

	/**
	 * Register the Custom Post Type - Travel Destinations.
	 */
	public function register_post_type() {
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
		);

		register_post_type('travel', $args);
	}

	/**
	 * Register Custom Taxonomy - Travel Categories.
	 */
	public function register_taxonomy() {
		$labels = array(
			'name'              => __('Travel Categories', 'textdomain'),
			'singular_name'     => __('Travel Category', 'textdomain'),
		);

		$args = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_in_rest'      => true,
		);

		register_taxonomy('travel_category', 'travel', $args);
	}

	/**
	 * Add Meta Boxes for Travel CPT.
	 */
	public function add_meta_boxes() {
		add_meta_box(
			'travel_country',
			__('Travel Destination Country', 'textdomain'),
			[$this, 'meta_box_callback'],
			'travel',
			'normal',
			'default'
		);
	}

	/**
	 * Callback for Meta Box Content.
	 */
	public function meta_box_callback($post) {
		$country = get_post_meta($post->ID, '_travel_country', true);
		wp_nonce_field('travel_save_country_metabox', 'travel_country_nonce');
		echo '<label for="travel_country">' . __('Enter the Country:', 'textdomain') . '</label>';
		echo '<input type="text" id="travel_country" name="travel_country" value="' . esc_attr($country) . '" style="width:100%; margin-top:10px;">';
	}

	/**
	 * Save Meta Box Data.
	 */
	public function save_meta_box_data($post_id) {
		if (!isset($_POST['travel_country_nonce']) || !wp_verify_nonce($_POST['travel_country_nonce'], 'travel_save_country_metabox')) {
			return;
		}

		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

		if (isset($_POST['travel_country'])) {
			$country = sanitize_text_field($_POST['travel_country']);
			update_post_meta($post_id, '_travel_country', $country);
		}
	}
}

// Initialize the class
new LifestylePlugin();
