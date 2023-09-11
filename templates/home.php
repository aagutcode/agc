<?php /* Template Name: Home */ get_header(); ?>

	<main role="main">
        <div id="sticky-bg"></div>
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; ?>

		<?php else: ?>
				<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
		<?php endif; ?>

	</main>

<?php get_footer(); ?>
