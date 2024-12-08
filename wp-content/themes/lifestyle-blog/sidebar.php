<aside id="secondary" class="widget-area">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php else : ?>
        <p>No widgets found. Add some in the WordPress admin.</p>
	<?php endif; ?>
</aside>

