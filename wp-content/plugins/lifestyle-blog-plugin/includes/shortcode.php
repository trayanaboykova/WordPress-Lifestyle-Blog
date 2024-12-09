<?php
/**
* Shortcode to display travel destinations.
*
* Attributes:
* - posts_per_page (int): number of posts to display (default: 5)
* - category (string): slug of travel_category to filter by (default: '')
*/
function lifestyle_display_travel_destinations_shortcode( $atts ) {
$atts = shortcode_atts( array(
'posts_per_page' => 5,
'category'       => '',
), $atts, 'my_travel_destinations' );

$args = array(
'post_type'      => 'travel',
'posts_per_page' => intval( $atts['posts_per_page'] ),
'post_status'    => 'publish',
'orderby'        => 'date',
'order'          => 'DESC',
);

if ( ! empty( $atts['category'] ) ) {
$args['tax_query'] = array(
array(
'taxonomy' => 'travel_category',
'field'    => 'slug',
'terms'    => $atts['category'],
),
);
}

$query = new WP_Query( $args );

$output = '<div class="travel-grid shortcode-travel-grid">';

	if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
	$query->the_post();

	$output .= '<div class="travel-card">';
		$output .= '<h2 class="travel-card__title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

		if ( has_post_thumbnail() ) {
		$output .= '<div class="travel-card__thumb">';
			$output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail( get_the_ID(), 'medium' ) . '</a>';
			$output .= '</div>';
		}

		$output .= '<div class="travel-card__excerpt">' . get_the_excerpt() . '</div>';

		// Country (from meta)
		$country = get_post_meta( get_the_ID(), '_travel_country', true );
		$output .= '<div class="travel-card__country">';
			if ( $country ) {
			$output .= '<p><strong>Country:</strong> ' . esc_html($country) . '</p>';
			} else {
			$output .= '<p><strong>Country:</strong> Not specified</p>';
			}
			$output .= '</div>';

		// Categories (from taxonomy)
		$terms = get_the_terms( get_the_ID(), 'travel_category' );
		$output .= '<div class="travel-card__taxonomy">';
			if ( $terms && ! is_wp_error( $terms ) ) {
			$output .= '<p><strong>Categories:</strong> ';
				$term_links = array();
				foreach ( $terms as $term ) {
				$term_links[] = '<a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
				}
				$output .= implode( ', ', $term_links );
				$output .= '</p>';
			} else {
			$output .= '<p><strong>Categories:</strong> None</p>';
			}
			$output .= '</div>';

		// Travel Notes (from ACF)
		$travel_notes = get_field('travel_notes');
		$output .= '<div class="travel-card__notes">';
			if ( $travel_notes ) {
			$output .= '<p><strong>Notes:</strong> ' . esc_html($travel_notes) . '</p>';
			} else {
			$output .= '<p><strong>Notes:</strong> None</p>';
			}
			$output .= '</div>'; // .travel-card__notes

		$output .= '</div>'; // .travel-card
	}

	wp_reset_postdata();
	} else {
	$output .= '<p>No travel destinations found.</p>';
	}

	$output .= '</div>'; // .travel-grid

return $output;
}

/**
* Register the shortcode.
*/
function lifestyle_register_shortcodes() {
add_shortcode( 'my_travel_destinations', 'lifestyle_display_travel_destinations_shortcode' );
}
add_action( 'init', 'lifestyle_register_shortcodes' );
