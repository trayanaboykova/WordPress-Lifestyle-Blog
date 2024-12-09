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
<div id="page" class="s-pagewrap">


	<!-- # site header
	================================================== -->
	<header id="masthead" class="s-header">

		<div class="s-header__branding">
			<p class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Lifestyle.</a>
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