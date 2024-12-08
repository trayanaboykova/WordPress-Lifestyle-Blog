<!DOCTYPE html>
<html <?php language_attributes(); ?> lang="">
<head>

	<!--- basic page needs
	================================================== -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php the_title(); ?></title>

	<script>
        document.documentElement.classList.remove('no-js');
        document.documentElement.classList.add('js');
	</script>

	<!-- CSS
	================================================== -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?> /css/vendor.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?> /css/styles.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?> /style.css">

    <!-- favicons
	================================================== -->
	<!--    @TODO: ADD MY OWN ICONS-->
	<link rel="icon" type="image/png" sizes="32x32"
	      href="<?php echo get_template_directory_uri(); ?> /images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16"
	      href="<?php echo get_template_directory_uri(); ?> /images/favicon-16x16.png">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?> /images/apple-touch-icon.png">
	<link rel="manifest" href="<?php echo get_template_directory_uri(); ?> /site.webmanifest">


	<?php wp_head(); ?>
</head>


<body id="top">


<!-- preloader
================================================== -->
<div id="preloader">
	<div id="loader" class="dots-fade">
		<div></div>
		<div></div>
		<div></div>
	</div>
</div>


<!-- page wrap
================================================== -->
<div id="page" class="s-pagewrap ss-home">


	<!-- # site header
	================================================== -->
	<header id="masthead" class="s-header">

		<div class="s-header__branding">
			<p class="site-title">
				<a href="<?php echo home_url(); ?>" rel="home">Lifestyle.</a>
			</p>
		</div>

		<div class="row s-header__navigation">

			<nav class="s-header__nav-wrap">

				<h3 class="s-header__nav-heading">Navigate to</h3>

				<ul class="s-header__nav">
                    <li class="current-menu-item"><a href="<?php echo home_url(); ?>" title="">Home</a></li>
                    <li class="has-children">
                        <a href="#" title="" class="">Blog</a>
                        <ul class="sub-menu">
                            <li class="current-menu-item"><a href="<?php echo home_url('/?post_type=post'); ?>" title="">All Posts</a></li>
							<?php
							$authors = get_users();
							foreach ($authors as $author) :
								?>
                                <li><a href="<?php echo get_author_posts_url( $author->ID ); ?>" title="Posts by <?php echo esc_html($author->display_name); ?>">Posts by <?php echo esc_html($author->display_name); ?></a></li>
							<?php endforeach; ?>
							<?php
							global $wpdb;
							$years = $wpdb->get_results("SELECT DISTINCT YEAR(post_date) as year FROM {$wpdb->posts} WHERE post_status = 'publish' AND post_type = 'post' ORDER BY year DESC");
							foreach ($years as $year) :
								?>
                                <li><a href="<?php echo get_year_link( $year->year ); ?>" title="Posts from <?php echo $year->year; ?>">Posts from <?php echo $year->year; ?></a></li>
							<?php endforeach; ?>
                        </ul>
                    </li>

                    <li class="has-children">
                        <a href="#" title="" class="">Categories</a>
                        <ul class="sub-menu">
							<?php
							$categories = get_categories( array(
								'orderby' => 'name',
								'order'   => 'ASC'
							) );

							foreach ( $categories as $category ) :
								?>
                                <li>
                                    <a href="<?php echo get_category_link( $category->term_id ); ?>">
										<?php echo esc_html( $category->name ); ?>
                                    </a>
                                </li>
							<?php endforeach; ?>
                        </ul>
                    </li>
					<!--                            @TODO: MAKE DYNAMIC-->
					<li><a href="resources.html" title="">Resources</a></li>
					<li><a href="about.html" title="">About</a></li>
					<li><a href="contact.html" title="">Contact</a></li>
				</ul> <!-- end s-header__nav -->

			</nav> <!-- end s-header__nav-wrap -->

		</div> <!-- end s-header__navigation -->

		<div class="s-header__search">

			<div class="s-header__search-inner">
				<div class="row">

					<form role="search" method="get" class="s-header__search-form" action="#">
						<label>
							<span class="u-screen-reader-text">Search for:</span>
							<input type="search" class="s-header__search-field" placeholder="Search for..." value=""
							       name="s" title="Search for:" autocomplete="off">
						</label>
						<input type="submit" class="s-header__search-submit" value="Search">
					</form>

					<a href="#0" title="Close Search" class="s-header__search-close">Close</a>

				</div> <!-- end row -->
			</div> <!-- s-header__search-inner -->

		</div> <!-- end s-header__search -->

		<a class="s-header__menu-toggle" href="#0"><span>Menu</span></a>
		<a class="s-header__search-trigger" href="#">
			<svg width="24" height="24" fill="none" viewBox="0 0 24 24">
				<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
				      d="M19.25 19.25L15.5 15.5M4.75 11C4.75 7.54822 7.54822 4.75 11 4.75C14.4518 4.75 17.25 7.54822 17.25 11C17.25 14.4518 14.4518 17.25 11 17.25C7.54822 17.25 4.75 14.4518 4.75 11Z"></path>
			</svg>
		</a>

	</header> <!-- end s-header -->


	<!-- # site-content
	================================================== -->
	<section id="content" class="s-content">


        <!-- hero -->
        <div class="hero">
            <div class="hero__slider swiper-container">
                <div class="swiper-wrapper">
					<?php
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 3,
						'orderby' => 'date',
						'order' => 'DESC',
					);

					$query = new WP_Query($args);

					if ($query->have_posts()) :
						while ($query->have_posts()) : $query->the_post();
							?>
                            <article class="hero__slide swiper-slide">
                                <div class="hero__entry-image"
                                     style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>');">
                                </div>
                                <div class="hero__entry-text">
                                    <div class="hero__entry-text-inner">
                                        <div class="hero__entry-meta">
                                    <span class="cat-links">
                                        <?php the_category(' '); ?>
                                    </span>
                                        </div>

                                        <h2 class="hero__entry-title">
                                            <a href="<?php the_permalink(); ?>">
												<?php the_title(); ?>
                                            </a>
                                        </h2>
                                        <p class="hero__entry-desc">
											<?php the_excerpt(); ?>
                                        </p>
                                        <a class="hero__more-link" href="<?php the_permalink(); ?>">Read More</a>
                                    </div>
                                </div>
                            </article>
						<?php
						endwhile;
					else :
						echo 'No posts found';
					endif;

					wp_reset_postdata();
					?>
                </div> <!-- swiper-wrapper -->

                <div class="swiper-pagination"></div>

            </div> <!-- end hero slider -->

            <a href="#bricks" class="hero__scroll-down smoothscroll">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M19.25 12H5"></path>
                </svg>
                <span>Scroll</span>
            </a>
        </div> <!-- end hero -->

        <!-- masonry -->
        <div id="bricks" class="bricks">
            <div class="masonry">
                <div class="bricks-wrapper" data-animate-block>
                    <div class="grid-sizer"></div>

					<?php
					$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
					if ( get_query_var('page') ) {
						$paged = get_query_var('page');
					}

					$args = array(
						'post_type'      => 'post',
						'posts_per_page' => 8,
						'order'          => 'DESC',
						'orderby'        => 'date',
						'paged'          => $paged,
					);

					$query = new WP_Query( $args );

					if ( $query->have_posts() ) :
						while ( $query->have_posts() ) : $query->the_post(); ?>
                            <!-- Your loop content -->
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
                                            <span class="byline">
                                        By: <a href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>"><?php the_author(); ?></a>
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
						echo 'No posts found';
					endif;

					wp_reset_postdata();
					?>
                </div> <!-- end bricks-wrapper -->
            </div> <!-- end masonry -->

            <!-- pagination -->
            <div class="row pagination">
                <div class="column lg-12">
					<?php
					// Try query-string pagination first to see if it works:
					$pagination = paginate_links( array(
						'base'      => add_query_arg('paged','%#%'),
						'format'    => '?paged=%#%',
						'current'   => $paged,
						'total'     => $query->max_num_pages,
						'prev_text' => '« Previous',
						'next_text' => 'Next »',
						'type'      => 'list',
					) );

					if ( $pagination ) {
						echo '<nav class="pgn">' . $pagination . '</nav>';
					}
					?>

                </div> <!-- end column -->
            </div> <!-- end pagination -->
        </div> <!-- end bricks -->

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