<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-content">
		<?php
		/**
		 * Functions hooked in to aro_single_post_top action
		 *
		 */
		do_action('aro_single_post_top');

		/**
		 * Functions hooked in to aro_single_post action
		 * @see aro_post_thumbnail - 10
		 * @see aro_post_header         - 20
		 * @see aro_post_content         - 30
		 */
		do_action('aro_single_post');

		/**
		 * Functions hooked in to aro_single_post_bottom action
		 *
		 * @see aro_post_taxonomy      - 5
		 * @see aro_post_nav            - 10
		 * @see aro_display_comments    - 20
		 */
		do_action('aro_single_post_bottom');
		?>

	</div>

</article><!-- #post-## -->
