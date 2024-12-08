<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			if ( '1' === $comment_count ) {
				printf(
					__( 'One response to &ldquo;%s&rdquo;', 'textdomain' ),
					get_the_title()
				);
			} else {
				printf(
					_nx(
						'%1$s response to &ldquo;%2$s&rdquo;',
						'%1$s responses to &ldquo;%2$s&rdquo;',
						$comment_count,
						'comments title',
						'textdomain'
					),
					number_format_i18n( $comment_count ),
					get_the_title()
				);
			}
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
			) );
			?>
		</ol>

		<?php the_comments_pagination(); ?>

	<?php endif; // have_comments() ?>

	<?php
	if ( ! comments_open() && get_comments_number() ) :
		?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'textdomain' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
