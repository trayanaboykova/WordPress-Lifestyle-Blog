
<?php
// author.php - Template for displaying author archive pages (posts by a specific author)
get_header(); ?>

<section id="content" class="s-content">
	<div class="container">
		<?php
		if ( have_posts() ) :
			$author = get_queried_object();
			?>
            <div class="author-info">
                <h1 class="author-name">Posts by <?php echo get_the_author_meta( 'display_name', $author->ID ); ?></h1>
                <div class="author-bio">
					<?php echo get_the_author_meta( 'description', $author->ID ); ?>
                </div>
            </div>
		<?php else : ?>
            <h1>No posts found for this author.</h1>
		<?php endif; ?>

		<!-- masonry -->
		<div id="bricks" class="bricks">
			<div class="masonry">
				<div class="bricks-wrapper" data-animate-block>
					<div class="grid-sizer"></div>

					<?php
					$author_id = get_query_var( 'author' );
					$args = array(
						'post_type'      => 'post',
						'posts_per_page' => -1,
						'order'          => 'DESC',
						'orderby'        => 'date',
						'author'         => $author_id
					);

					$query = new WP_Query( $args );

					if ( $query->have_posts() ) :
						while ( $query->have_posts() ) : $query->the_post(); ?>
							<article class="brick entry" data-animate-el>
								<div class="entry__thumb">
									<a href="<?php the_permalink(); ?>" class="thumb-link">
										<?php the_post_thumbnail( 'large' ); ?>
									</a>
								</div>
								<div class="entry__text">
									<div class="entry__header">
										<div class="entry__meta">
											<span class="cat-links"><?php the_category(' '); ?></span>
											<span class="byline">By:
                                                <a href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>">
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
						echo 'No posts found for this author';
					endif;

					// Reset the query after custom loop
					wp_reset_postdata();
					?>
				</div> <!-- end bricks-wrapper -->
			</div> <!-- end masonry -->
		</div> <!-- end bricks -->

	</div> <!-- end container -->
</section> <!-- end s-content -->

<?php get_footer(); ?>

<!-- Java Script
================================================== -->
<script src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>

</body>
</html>
