<?php
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