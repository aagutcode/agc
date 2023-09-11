<?php /* Template Name: Blog */ get_header(); ?>

	<main role="main" id="blog">
		<!-- section -->
		<section class="heading border-bottom">
			<div class="wrapper">
				<h1 class="title"><?php the_title(); ?></h1>

				<div class="filters">
					<?php echo agutcode_categories(); ?>
				</div>
			</div>
		</section>
		<section class="content">
			<div class="wrapper">
				<div class="posts">
					<?php query_posts( 'post_type=post' ); ?>
					<?php get_template_part('loop'); ?>
				</div>
	
				<?php get_template_part('pagination'); ?>
			</div>
		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
