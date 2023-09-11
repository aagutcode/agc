<?php if (have_posts()): while (have_posts()) : the_post(); ?>

<div class="col-md-6 col-lg-12 my-3">
	<article id="post-<?php the_ID(); ?>" class="event row no-gutters">	
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="col-lg-5">
				<?php the_post_thumbnail('large'); // Declare pixel size you need inside the array ?>
			</a>
		<?php endif; ?>
		<div class="summary col-lg-7 p-3 p-lg-4 text-left">
			<h2>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h2>
			<span class="date"><?php the_time('F j, Y'); ?></span>
			<!-- /post details -->

			<?php agutcode_excerpt('agutcode_index'); // Build your custom callback length in functions.php ?>

			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="btn btn-primary mt-2">Leer Más</a>
		</div>

	</article>
</div>

<?php endwhile; ?>
<?php endif; ?>
