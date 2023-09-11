<?php /* Template Name: Artists */ get_header(); ?>

	<main role="main" id="artists">
		<!-- section -->
		<section class="heading border-bottom">
			<div class="wrapper">
				<h1 class="title"><?php the_title(); ?></h1>

				<div class="filters" id="artists-filters">
					<?php echo agutcode_categories('artist-category'); ?>
				</div>
			</div>
		</section>
		<section class="content">
			<div class="wrapper">
				<div class="posts">
				<?php 
					$categories = get_terms( 
						array(
							'taxonomy' => 'artist-category',
							'hide_empty' => 1
						) 
					);
					
					foreach ($categories as $category) { ?>
						<div class="artist-cat-wrapper <?= $category->slug; ?>">
							<h2 class="artist-category"><?= $category->name; ?></h2>
							<?php $artists = new WP_Query( array(
								'post_type' => 'artist',
								'tax_query' => array(
									array (
										'taxonomy' => 'artist-category',
										'field' => 'slug',
										'terms' => $category->slug,
									)
								),
							) );
							if ($artists->have_posts()): while ($artists->have_posts()) : $artists->the_post();
								get_template_part('loop','artists');
							endwhile; endif;
							wp_reset_postdata(); ?>
						</div>
				<?php } ?>
				</div>
	
			</div>
		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
