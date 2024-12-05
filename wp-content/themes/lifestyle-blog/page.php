<?php get_header(); ?>


<!-- # site-content
================================================== -->
<div id="content" class="s-content s-content--page">

    <div class="row entry-wrap">
        <div class="column lg-12">

            <article class="entry">

                <header class="entry__header entry__header--narrower">

                    <h1 class="entry__title">
                        <?php the_title(); ?>
                    </h1>

                </header>

                <?php while( have_posts() ) : the_post(); ?>

                    <?php the_content(); ?>

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