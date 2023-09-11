<?php /*Template Name: Eventos */ get_header(); ?>
<main role="main" id="grid" class="list">
	<div class="title-section py-4">
		<div class="container text-center">
			<h1 class="m-0"><?php the_title(); ?></h1>
		</div>
	</div>
	<section class="container py-5">
		<div class="row">
			<?php query_posts('post_type=event&posts_per_page=-1');
			get_template_part('loop-event'); ?>
		</div>
		<?php get_template_part('pagination'); ?>
	</section>
</main>
<?php get_footer(); ?>
