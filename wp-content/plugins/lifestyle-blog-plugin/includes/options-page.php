<?php
/**
 * Register Options Page
 */
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