<!-- # site-footer ================================================== -->
<footer id="colophon" class="s-footer">
    <div class="row s-footer__subscribe">
        <div class="column lg-12">
            <h2>Subscribe to Our Newsletter.</h2>
            <p>Subscribe now to get all latest updates</p>
            <form id="mc-form" class="mc-form">
                <input type="email" name="EMAIL" id="mce-EMAIL" class="u-fullwidth text-center" placeholder="Your Email Address" required>
                <input type="submit" name="subscribe" value="Subscribe" class="btn--small btn--primary u-fullwidth">
                <div class="mc-status"></div>
            </form>
        </div>
    </div> <!-- end s-footer__subscribe -->

    <div class="row s-footer__main">
        <div class="column lg-5 md-6 tab-12 s-footer__about">
            <!-- Sidebar -->
            <div class="row">
                <div class="column lg-12">
			        <?php get_sidebar(); ?>
                </div>
            </div> <!-- end row -->
        </div> <!-- end s-footer__about -->

        <div class="column lg-5 md-6 tab-12">
            <div class="row">
                <div class="column lg-6">
                    <h4>Categories</h4>
                    <ul class="link-list">
						<?php
						$categories = get_categories( array( 'orderby' => 'name', 'order' => 'ASC', 'number' => 6 ) );
						foreach ( $categories as $category ) :
							?>
                            <li><a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
						<?php endforeach; ?>
                    </ul>
                </div>
                <div class="column lg-6">
                    <h4>Site Links</h4>
                    <ul class="link-list">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="category.html">Categories</a></li>
                        <li><a href="category.html">Blog</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="about.html">Contact</a></li>
                        <li><a href="#0">Terms & Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- end s-footer__main -->

    <div class="row s-footer__bottom">
        <div class="column lg-7 md-6 tab-12">
            <ul class="s-footer__social">
                <li><a href="https://www.facebook.com">Facebook</a></li>
                <li><a href="https://www.twitter.com">Twitter</a></li>
                <li><a href="https://www.instagram.com">Instagram</a></li>
                <li><a href="https://www.pinterest.com">Pinterest</a></li>
            </ul>
        </div>

        <div class="column lg-5 md-6 tab-12">
            <div class="ss-copyright">
                <span>© Copyright <?php echo get_bloginfo('name'); ?> <?php echo date('Y'); ?></span>
                <span>Design by <a href="https://www.styleshout.com/">StyleShout</a> Distribution <a href="https://themewagon.com">ThemeWagon</a></span>
            </div>
        </div>
    </div> <!-- end s-footer__bottom -->

    <div class="ss-go-top">
        <a class="smoothscroll" title="Back to Top" href="#top">
            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.25 10.25L12 4.75L6.75 10.25"/>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 19.25V5.75"/>
            </svg>
        </a>
    </div> <!-- end ss-go-top -->
</footer><!-- end s-footer -->

<?php wp_footer(); ?>
