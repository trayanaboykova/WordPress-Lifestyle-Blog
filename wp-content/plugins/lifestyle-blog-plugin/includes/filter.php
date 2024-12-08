<?php
/*
 * Enqueue JS for AJAX
 */
function enqueue_ajax_filter_scripts() {
	wp_enqueue_script('ajax-filter', plugin_dir_url(__FILE__) . 'js/ajax-filter.js', ['jquery'], null, true);
	wp_localize_script('ajax-filter', 'ajax_filter_params', [
		'ajax_url' => admin_url('admin-ajax.php'),
	]);
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_filter_scripts');


/*
 * Handle the AJAX request
 */
function filter_posts() {
	$category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
	$post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : '';

	$args = [
		'post_type' => $post_type ? [$post_type] : ['post', 'travel'],
		'posts_per_page' => -1,
	];

	if ($category) {
		$args['category_name'] = $category;
	}

	$query = new WP_Query($args);

	if ($query->have_posts()) :
		while ($query->have_posts()) : $query->the_post(); ?>
			<article class="brick entry" data-animate-el>
				<div class="entry__thumb">
					<a href="<?php the_permalink(); ?>" class="thumb-link">
						<?php the_post_thumbnail('large'); ?>
					</a>
				</div>
				<div class="entry__text">
					<div class="entry__header">
						<div class="entry__meta">
							<span class="cat-links"><?php the_category(' '); ?></span>
							<span class="byline">By:
                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                <?php the_author(); ?>
                            </a>
                        </span>
						</div>
						<h1 class="entry__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					</div>
					<div class="entry__excerpt">
						<p><?php the_excerpt(); ?></p>
					</div>
					<a class="entry__more-link" href="<?php the_permalink(); ?>">Read More</a>
				</div>
			</article>
		<?php endwhile;
	else :
		echo '<p>No posts found.</p>';
	endif;

	wp_reset_postdata();
	die();
}

add_action('wp_ajax_filter_posts', 'filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');

