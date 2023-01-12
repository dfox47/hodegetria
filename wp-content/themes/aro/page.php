<?php get_header(); ?>

	<div id="primary">
		<main id="main" class="site-main">

			<?php while ( have_posts() ) :
				the_post();

				do_action( 'aro_page_before' );

				get_template_part( 'content', 'page' );

				// Functions hooked in to aro_page_after action
				// @see aro_display_comments - 10
				do_action( 'aro_page_after' );
			endwhile; ?>
		</main>
	</div>

<?php //do_action( 'aro_sidebar' );

get_footer();
