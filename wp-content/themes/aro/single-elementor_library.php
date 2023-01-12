<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php while ( have_posts() ) :
				the_post();

				do_action('aro_single_post_before');

				get_template_part('content', 'single');

				do_action('aro_single_post_after' );
			endwhile; ?>
		</main>
	</div>

<?php get_footer();