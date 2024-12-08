<?php
/* Template Name: All Authors */
get_header(); ?>

<section id="content" class="s-content">
    <div class="container">
        <h1 class="page-title">All Authors</h1>

		<?php
		$authors = get_users([
			'role__in' => ['Administrator', 'Editor', 'Author', 'Contributor'],
			'orderby'  => 'display_name',
			'order'    => 'ASC',
		]);

		if (!empty($authors)) : ?>
            <div class="author-list">
				<?php foreach ($authors as $author) : ?>
                    <div class="author-card">

                        <div class="author-posts">
                            <h3>Posts by <a href="<?php echo esc_url(get_author_posts_url($author->ID)); ?>">
		                            <?php echo esc_html($author->display_name); ?>
                                </a>:</h3>
                            <ul class="author-post-list">
								<?php
								$args = [
									'post_type'      => 'post',
									'author'         => $author->ID,
									'orderby'        => 'date',
									'order'          => 'DESC',
								];
								$query = new WP_Query($args);

								if ($query->have_posts()) :
									while ($query->have_posts()) :
										$query->the_post();
										?>
                                        <li class="author-post">
                                            <a href="<?php the_permalink(); ?>">
												<?php the_title(); ?>
                                            </a> - <span class="post-date"><?php echo get_the_date(); ?></span>
                                        </li>
									<?php endwhile;
								else : ?>
                                    <li>No posts found for this author.</li>
								<?php endif;

								// Reset the query
								wp_reset_postdata();
								?>
                            </ul>
                            <a class="view-all-link" href="<?php echo esc_url(get_author_posts_url($author->ID)); ?>">
                                View all posts by <?php echo esc_html($author->display_name); ?>
                            </a>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
		<?php else : ?>
            <p>No authors found.</p>
		<?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>

<!-- Java Script -->
<script src="<?php echo get_template_directory_uri(); ?> /js/plugins.js"></script>
<script src="<?php echo get_template_directory_uri(); ?> /js/main.js"></script>
