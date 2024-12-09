<aside id="secondary" class="widget-area">
	<?php if ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
		<?php dynamic_sidebar( 'footer-sidebar' ); ?>
	<?php else : ?>
        <p>No widgets found. Add some in the WordPress admin.</p>
	<?php endif; ?>
</aside>