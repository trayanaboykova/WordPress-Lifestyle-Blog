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

				<?php endwhile; ?>

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
