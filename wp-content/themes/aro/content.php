<article id="post-<?php the_ID(); ?>" <?php post_class('article-default'); ?>>
	<div class="post-inner">
		<?php aro_post_thumbnail('post-thumbnail', false); ?>
		<div class="post-content">
			<?php
			/**
			 * Functions hooked in to aro_loop_post action.
			 *
			 * @see aro_post_header          - 15
			 * @see aro_post_content         - 30
			 */
			do_action('aro_loop_post');
			?>
		</div>
	</div>
</article><!-- #post-## -->