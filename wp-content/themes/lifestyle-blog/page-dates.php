<?php
/* Template Name: All Dates */
get_header(); ?>

<section id="content" class="s-content">
    <div class="container">
        <h1 class="page-title">Posts by Date</h1>

        <div class="date-list">
			<?php
			global $wpdb;
			$dates = $wpdb->get_results("
    SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month
    FROM wordpress.wp_posts
    WHERE post_status = 'publish' AND post_type = 'post'
    ORDER BY post_date DESC
");

			if (!empty($dates)) :
				foreach ($dates as $date) :
					$year = $date->year;
					$month = $date->month;
					$month_name = date('F', mktime(0, 0, 0, $month, 10)); // Get month name
					?>
                    <div class="date-card">
                        <div class="date-info">
                            <h2 class="date-title">
                                <a href="<?php echo get_month_link($year, $month); ?>">
									<?php echo esc_html("$month_name $year"); ?>
                                </a>
                            </h2>
                        </div>

                        <div class="date-posts">
                            <h3>Posts from <?php echo esc_html("$month_name $year"); ?>:</h3>
                            <ul class="date-post-list">
								<?php
								$args = [
									'post_type'      => 'post',
									'orderby'        => 'date',
									'order'          => 'DESC',
									'year'           => $year,
									'monthnum'       => $month,
								];
								$query = new WP_Query($args);

								if ($query->have_posts()) :
									while ($query->have_posts()) : $query->the_post(); ?>
                                        <li class="date-post">
                                            <a href="<?php the_permalink(); ?>">
												<?php the_title(); ?>
                                            </a> - <span class="post-date"><?php echo get_the_date(); ?></span>
                                        </li>
									<?php endwhile;
								else : ?>
                                    <li>No posts found for this period.</li>
								<?php endif;

								wp_reset_postdata();
								?>
                            </ul>
                            <a class="view-all-link" href="<?php echo get_month_link($year, $month); ?>">
                                View all posts from <?php echo esc_html("$month_name $year"); ?>
                            </a>
                        </div>
                    </div>
				<?php endforeach;
			else : ?>
                <p>No posts found.</p>
			<?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>

<!-- Java Script -->
<script src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
