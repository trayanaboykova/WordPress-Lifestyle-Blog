<?php get_header(); ?>

<!-- # site-content
================================================== -->
<div id="content" class="s-content s-content--blog">

    <div class="row entry-wrap">
        <div class="column lg-12">

            <article class="entry format-standard">

                <header class="entry__header">

                    <h1 class="entry__title">
						<?php the_title(); ?>
                    </h1>

                    <div class="entry__meta">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                            <div class="entry__meta-author">
                                <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <circle cx="12" cy="8" r="3.25" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="1.5"></circle>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="1.5"
                                          d="M6.8475 19.25H17.1525C18.2944 19.25 19.174 18.2681 18.6408 17.2584C17.8563 15.7731 16.068 14 12 14C7.93201 14 6.14367 15.7731 5.35924 17.2584C4.82597 18.2681 5.70558 19.25 6.8475 19.25Z"></path>
                                </svg>
                                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php echo get_the_author(); ?>
                                </a>
                            </div>

						<?php endwhile; endif; ?>

                        <div class="entry__meta-date">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="7.25" stroke="currentColor" stroke-width="1.5"></circle>
                                <path stroke="currentColor" stroke-width="1.5" d="M12 8V12L14 14"></path>
                            </svg>
							<?php echo get_the_date(); ?>
                        </div>
                        <div class="entry__meta-cat">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M19.25 17.25V9.75C19.25 8.64543 18.3546 7.75 17.25 7.75H4.75V17.25C4.75 18.3546 5.64543 19.25 6.75 19.25H17.25C18.3546 19.25 19.25 18.3546 19.25 17.25Z"></path>
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M13.5 7.5L12.5685 5.7923C12.2181 5.14977 11.5446 4.75 10.8127 4.75H6.75C5.64543 4.75 4.75 5.64543 4.75 6.75V11"></path>
                            </svg>

							<?php
							$categories = wp_get_post_categories( get_the_ID() );
							?>
							<?php if ( ! empty( $categories ) ) : ?>
                                <span class="cat-links">
                                    <?php foreach ( $categories as $cat ) :
	                                    $category = get_category( $cat );
	                                    ?>
                                        <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
                                            <?php echo esc_html( $category->name ); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </span>
							<?php endif; ?>

                        </div>
                    </div>

                </header>

                <div class="entry__media">
                    <figure class="featured-image">
						<?php
						// Check if the post has a featured image
						if ( has_post_thumbnail() ) :
							// Display the featured image with different sizes
							the_post_thumbnail( 'full', array(
								'srcset' => wp_get_attachment_image_srcset( get_post_thumbnail_id() ),
								'sizes'  => '(max-width: 2400px) 100vw, 2400px',
								'alt'    => get_the_title()
							) );
						endif;
						?>
                    </figure>
                </div>

                <div class="content-primary">

                    <div class="entry__content">
						<?php
						// The Loop
						while ( have_posts() ) : the_post();
							the_content();
						endwhile;
						?>

                        <p class="entry__tags">
                            <strong>Tags:</strong>

                            <span class="entry__tag-list">
                                <?php the_tags( '', ' ', '' ); ?>
                            </span>
                        </p>

                        <div class="entry__author-box">
                            <figure class="entry__author-avatar">
                                <img alt=""
                                     src="<?php echo get_template_directory_uri(); ?> /images/avatars/trayana-author.jpg"
                                     class="avatar">
                            </figure>
                            <div class="entry__author-info">
                                <h5 class="entry__author-name">
                                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
										<?php echo get_the_author(); ?>
                                    </a>
                                </h5>
                                <p>
									<?php echo get_the_author_meta( 'description' ); ?>
                                </p>
                            </div>
                        </div>

                    </div> <!-- end entry-content -->

                    <div class="post-nav">
                        <div class="post-nav__prev">
							<?php
							$prev_post = get_previous_post();
							if ( ! empty( $prev_post ) ): ?>
                                <a href="<?php echo get_permalink( $prev_post->ID ); ?>" rel="prev">
                                    <span>Prev</span>
									<?php echo get_the_title( $prev_post->ID ); ?>
                                </a>
							<?php endif; ?>
                        </div>
                        <div class="post-nav__next">
							<?php
							$next_post = get_next_post();
							if ( ! empty( $next_post ) ): ?>
                                <a href="<?php echo get_permalink( $next_post->ID ); ?>" rel="next">
                                    <span>Next</span>
									<?php echo get_the_title( $next_post->ID ); ?>
                                </a>
							<?php endif; ?>
                        </div>
                    </div>

					<?php
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					?>

                </div> <!-- end content-primary -->

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
