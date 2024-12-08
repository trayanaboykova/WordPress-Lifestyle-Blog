<?php
/* Template Name: Travel Destinations */
get_header(); ?>

<!-- # site-content
================================================== -->
<div id="content" class="s-content s-content--travel-archive">

    <div class="row entry-wrap">
        <div class="column lg-12">

            <article class="entry travel-archive">

                <header class="entry__header entry__header--narrower">
                    <h1 class="entry__title">Travel Destinations</h1>
                </header>

                <div class="entry__content">
                    <div class="travel-grid">
						<?php
						$args = array(
							'post_type'      => 'travel',
							'posts_per_page' => -1,
							'orderby'        => 'date',
							'order'          => 'DESC',
						);
						$query = new WP_Query($args);

						if ($query->have_posts()) :
							while ($query->have_posts()) : $query->the_post(); ?>
                                <div class="travel-card">
                                    <h2 class="travel-card__title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>

									<?php if (has_post_thumbnail()) : ?>
                                        <div class="travel-card__thumb">
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                                        </div>
									<?php endif; ?>

                                    <div class="travel-card__excerpt">
										<?php the_excerpt(); ?>
                                    </div>

                                    <!-- Display country -->
                                    <div class="travel-card__country">
										<?php
										$country = get_post_meta(get_the_ID(), '_travel_country', true);
										if ($country) {
											echo '<p><strong>Country:</strong> ' . esc_html($country) . '</p>';
										} else {
											echo '<p><strong>Country:</strong> Not specified</p>';
										}
										?>
                                    </div>

                                    <!-- Display taxonomy terms -->
                                    <div class="travel-card__taxonomy">
										<?php
										$terms = get_the_terms(get_the_ID(), 'travel_category');
										if ($terms && !is_wp_error($terms)) {
											echo '<p><strong>Categories:</strong> ';
											$term_links = [];
											foreach ($terms as $term) {
												$term_links[] = '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
											}
											echo implode(', ', $term_links);
											echo '</p>';
										} else {
											echo '<p><strong>Categories:</strong> None</p>';
										}
										?>
                                    </div>

                                    <!-- Display Travel Notes -->
                                    <div class="travel-card__notes">
										<?php
										$travel_notes = get_field('travel_notes'); // ACF field retrieval
										if ($travel_notes) {
											echo '<p><strong>Notes:</strong> ' . esc_html($travel_notes) . '</p>';
										} else {
											echo '<p><strong>Notes:</strong> None</p>';
										}
										?>
                                    </div>
                                </div>
							<?php endwhile;
							wp_reset_postdata();
						else : ?>
                            <p>No travel destinations found.</p>
						<?php endif; ?>
                    </div> <!-- end travel-grid -->
                </div> <!-- end entry__content -->

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
