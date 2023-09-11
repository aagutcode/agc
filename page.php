<?php get_header(); ?>
<main role="main">
	<section class="container py-5">
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; endif; ?>
	</section>
</main>
<?php get_footer(); ?>
