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
<script src="<?php echo get_template_directory_uri(); ?> /js/plugins.js"></script>
<script src="<?php echo get_template_directory_uri(); ?> /js/main.js"></script>

</body>
</html>
