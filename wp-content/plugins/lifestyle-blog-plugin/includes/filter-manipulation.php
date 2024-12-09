<?php
/**
* Add a prefix to the titles of travel posts.
*
* @param string $title The original title.
* @param int    $post_id The post ID.
*
* @return string The modified title.
*/
function my_plugin_filter_travel_titles( $title, $post_id ) {
// Only modify on the front-end
if ( ! is_admin() && get_post_type( $post_id ) === 'travel' ) {
$title = '✈ ' . $title;
}
return $title;
}
add_filter( 'the_title', 'my_plugin_filter_travel_titles', 10, 2 );
