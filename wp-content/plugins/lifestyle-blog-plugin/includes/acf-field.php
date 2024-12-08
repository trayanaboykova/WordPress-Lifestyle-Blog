<?php
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