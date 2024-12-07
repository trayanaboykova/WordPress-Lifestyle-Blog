<?php get_header(); ?>

	<!-- # site-content
	================================================== -->
	<section id="content" class="s-content">


		<!-- pageheader -->
		<div class="s-pageheader">
			<div class="row">
				<div class="column large-12">
					<h1 class="page-title">
						<span class="page-title__small-type">Category:</span>
						Inspiration
					</h1>
				</div>
			</div>
		</div> <!-- end s-pageheader-->


		<!--  masonry -->
		<div id="bricks" class="bricks">

			<div class="masonry">

				<div class="bricks-wrapper" data-animate-block>

					<div class="grid-sizer"></div>

					<?php
					// Custom query for posts
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 8,
						'order' => 'DESC',
						'orderby' => 'date',
						'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
					);

					$query = new WP_Query( $args );

					if ( $query->have_posts() ) :
						while ( $query->have_posts() ) : $query->the_post();
							?>

							<article class="brick entry" data-animate-el>

								<div class="entry__thumb">
									<a href="<?php the_permalink(); ?>" class="thumb-link">
										<?php if ( has_post_thumbnail() ) : ?>
											<?php the_post_thumbnail( 'large' ); ?>
										<?php endif; ?>
									</a>
								</div>

								<!-- end entry__thumb -->

								<div class="entry__text">
									<div class="entry__header">
										<div class="entry__meta">
                            <span class="cat-links">
                               <?php the_category( ' ' ); ?>
                            </span>
											<span class="byline">
                            By:
                            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                                <?php the_author(); ?>
                            </a>
                        </span>
										</div>
										<h1 class="entry__title">
											<a href="<?php the_permalink(); ?>">
												<?php the_title(); ?>
											</a>
										</h1>
									</div>
									<div class="entry__excerpt">
										<p>
											<?php the_excerpt(); ?>
										</p>
									</div>
									<a class="entry__more-link" href="<?php the_permalink(); ?>">Read More</a>
								</div> <!-- end entry__text -->

							</article> <!-- end article -->

						<?php
						endwhile;
					else :
						echo 'No posts found';
					endif;

					wp_reset_postdata();
					?>

				</div> <!-- end bricks-wrapper -->

			</div> <!-- end masonry -->

			<!-- pagination -->
			<!--            @TODO: MAKE PAGINATION DYNAMIC-->
			<div class="row pagination">
				<div class="column lg-12">
					<nav class="pgn">
						<ul>
							<li>
								<?php previous_posts_link( '<a class="pgn__prev" href="#">' .
								                           '<svg width="24" height="24" fill="none" viewBox="0 0 24 24">' .
								                           '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>' .
								                           '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>' .
								                           '</svg>' . 'Previous</a>' ); ?>
							</li>

							<?php
							echo paginate_links( array(
								'total' => $query->max_num_pages,
								'prev_text' => 'Previous',
								'next_text' => 'Next',
								'before_page_number' => '<li><a class="pgn__num" href="#">',
								'after_page_number' => '</a></li>',
							) );
							?>

							<li>
								<?php next_posts_link( '<a class="pgn__next" href="#">' .
								                       '<svg width="24" height="24" fill="none" viewBox="0 0 24 24">' .
								                       '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.75 6.75L19.25 12L13.75 17.25"></path>' .
								                       '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 12H4.75"></path>' .
								                       '</svg>' . 'Next</a>' ); ?>
							</li>
						</ul>
					</nav> <!-- end pgn -->
				</div> <!-- end column -->
			</div>
			<!-- end pagination -->

		</div> <!-- end bricks -->

	</section> <!-- end s-content -->


<?php get_footer(); ?>


	<!-- Java Script
	================================================== -->
<script src="<?php echo get_template_directory_uri(); ?> /js/plugins.js"></script>
<script src="<?php echo get_template_directory_uri(); ?> /js/main.js"></script>

</body>
</html>