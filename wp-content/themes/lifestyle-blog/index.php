<?php get_header(); ?>

<!-- # site-content
================================================== -->
<section id="content" class="s-content">

    <!-- Filter Section -->
    <div id="post-filters" class="filters">
        <select id="filter-category">
            <option value="">All Categories</option>
			<?php
			$categories = get_categories();
			foreach ($categories as $category) {
				echo '<option value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</option>';
			}
			?>
        </select>

        <select id="filter-post-type">
            <option value="">All Post Types</option>
		    <?php
		    $post_types = get_post_types(['public' => true], 'objects');
		    foreach ($post_types as $post_type) {
			    echo '<option value="' . esc_attr($post_type->name) . '">' . esc_html($post_type->labels->singular_name) . '</option>';
		    }
		    ?>
        </select>

    </div>

    <!-- Masonry Section -->
    <div id="bricks" class="bricks">
        <div class="masonry">
            <div class="bricks-wrapper" data-animate-block>
                <div class="grid-sizer"></div>

                <!-- Posts Container -->
                <div id="posts-container">
					<?php
					$args = array(
						'post_type'      => array('post', 'travel'),
						'posts_per_page' => -1,
						'order'          => 'DESC',
						'orderby'        => 'date'
					);

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
					?>
                </div> <!-- end #posts-container -->

            </div> <!-- end bricks-wrapper -->
        </div> <!-- end masonry -->
    </div> <!-- end bricks -->

</section> <!-- end s-content -->

<?php get_footer(); ?>

<?php wp_footer(); ?>

<!-- Java Script
================================================== -->
<script src="<?php echo get_template_directory_uri(); ?> /js/plugins.js"></script>
<script src="<?php echo get_template_directory_uri(); ?> /js/main.js"></script>

</body>
</html>
