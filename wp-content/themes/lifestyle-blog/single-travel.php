<?php get_header(); ?>

<!-- # site-content
================================================== -->
<div id="content" class="s-content s-content--single-travel">

    <div class="row entry-wrap">
        <div class="column lg-12">

            <article class="entry travel-entry">

                <header class="entry__header entry__header--narrower">

                    <h1 class="entry__title">
						<?php the_title(); ?>
                    </h1>

					<?php if ( has_post_thumbnail() ) : ?>
                        <div class="entry__thumb">
							<?php the_post_thumbnail('large'); ?>
                        </div>
					<?php endif; ?>

                </header>

				<?php while( have_posts() ) : the_post(); ?>

                    <div class="entry__content">
						<?php the_content(); ?>
                    </div>

                    <!-- Display country -->
					<?php
					$country = get_post_meta(get_the_ID(), '_travel_country', true);
					if ($country) {
						echo '<div class="entry__country">';
						echo '<p><strong>Country:</strong> ' . esc_html($country) . '</p>';
						echo '</div>';
					} else {
						echo '<div class="entry__country">';
						echo '<p><strong>Country:</strong> Not specified</p>';
						echo '</div>';
					}
					?>

                    <!-- Display taxonomy terms -->
					<?php
					$terms = get_the_terms(get_the_ID(), 'travel_category');
					if ($terms && !is_wp_error($terms)) {
						echo '<div class="entry__taxonomy">';
						echo '<p><strong>Categories:</strong> ';
						$term_links = [];
						foreach ($terms as $term) {
							$term_links[] = '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
						}
						echo implode(', ', $term_links);
						echo '</p>';
						echo '</div>';
					}
					?>

                    <!-- Display Travel Notes -->
					<?php
					$travel_notes = get_field('travel_notes'); // ACF field retrieval
					if ($travel_notes) {
						echo '<div class="entry__notes">';
						echo '<h3>Travel Notes</h3>';
						echo '<p>' . esc_html($travel_notes) . '</p>';
						echo '</div>';
					}
					?>

				<?php endwhile; ?>

            </article> <!-- end entry -->

        </div>
    </div> <!-- end entry-wrap -->

</div> <!-- end s-content -->

<?php get_footer(); ?>

<!-- Java Script
================================================== -->
<script src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>

</body>
</html>
