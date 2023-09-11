<?php /* Template Name: Without Header */ ?>
<?php get_template_part('head'); ?>	
	<main role="main">
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; endif; ?>
	</main>
<?php get_footer(); ?>