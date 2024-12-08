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

/**
 * Add a Metabox for the Travel CPT
 */
function travel_add_country_metabox() {
	add_meta_box(
		'travel_country',
		__('Travel Destination Country', 'textdomain'),
		'travel_country_metabox_callback',
		'travel',
		'normal',
		'default'
	);
}
add_action('add_meta_boxes', 'travel_add_country_metabox');

/**
 * Callback Function to Display Fields in the Metabox
 */
function travel_country_metabox_callback($post) {
	$travel_country = get_post_meta($post->ID, '_travel_country', true);

	wp_nonce_field('travel_save_country_metabox', 'travel_country_nonce');

	echo '<label for="travel_country">' . __('Enter the Country:', 'textdomain') . '</label>';
	echo '<input type="text" id="travel_country" name="travel_country" value="' . esc_attr($travel_country) . '" placeholder="e.g., United States" style="width: 100%; max-width: 400px; margin-top: 10px;">';
}

/**
 * Save the Metabox Data
 */
function travel_save_country_metabox($post_id) {
	if (!isset($_POST['travel_country_nonce']) || !wp_verify_nonce($_POST['travel_country_nonce'], 'travel_save_country_metabox')) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	if (isset($_POST['travel_country'])) {
		$travel_country = sanitize_text_field($_POST['travel_country']);
		update_post_meta($post_id, '_travel_country', $travel_country);
	}
}
add_action('save_post', 'travel_save_country_metabox');

/**
 * Register an ACF Field Group
 */
if (function_exists('acf_add_local_field_group')) {
	acf_add_local_field_group([
		'key' => 'group_travel_notes',
		'title' => 'Travel Notes',
		'fields' => [
			[
				'key' => 'field_travel_notes',
				'label' => 'Travel Notes',
				'name' => 'travel_notes',
				'type' => 'textarea',
				'instructions' => 'Add additional notes for this travel destination.',
				'required' => false,
			],
		],
		'location' => [
			[
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'travel',
				],
			],
		],
	]);
}

// Hook to create the custom plugin menu
add_action('admin_menu', 'lifestyle_options_create_menu');

function lifestyle_options_create_menu() {
	add_menu_page(
		'Lifestyle Options',
		'Lifestyle Options',
		'administrator',
		'lifestyle-options',
		'lifestyle_options_settings_page',
		'dashicons-admin-generic',
		90
	);

	add_action('admin_init', 'register_lifestyle_options_settings');
}

function register_lifestyle_options_settings() {
	// Register settings
	register_setting('lifestyle-options-settings-group', 'hide_header');
	register_setting('lifestyle-options-settings-group', 'hide_footer');
}

function lifestyle_options_settings_page() {
	?>
	<div class="wrap">
		<h1>Lifestyle Options</h1>
		<form method="post" action="options.php">
			<?php
			settings_fields('lifestyle-options-settings-group');
			do_settings_sections('lifestyle-options-settings-group');
			?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">Hide Header</th>
					<td>
						<label>
							<input type="checkbox" name="hide_header" value="yes" <?php checked(get_option('hide_header'), 'yes'); ?> />
							Check to hide the site header
						</label>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">Hide Footer</th>
					<td>
						<label>
							<input type="checkbox" name="hide_footer" value="yes" <?php checked(get_option('hide_footer'), 'yes'); ?> />
							Check to hide the site footer
						</label>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

// Frontend functionality to hide elements
function lifestyle_options_hide_elements() {
	if (get_option('hide_header') === 'yes') {
		echo '<style>header { display: none !important; }</style>';
	}
	if (get_option('hide_footer') === 'yes') {
		echo '<style>footer { display: none !important; }</style>';
	}
}
add_action('wp_head', 'lifestyle_options_hide_elements');