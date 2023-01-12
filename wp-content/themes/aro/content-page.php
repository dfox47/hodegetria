<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to aro_page action
	 *
	 * @see aro_page_header          - 10
	 * @see aro_page_content         - 20
	 *
	 */
	do_action( 'aro_page' );
	?>
</article><!-- #post-## -->
