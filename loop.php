<?php if (have_posts()): while (have_posts()) : the_post(); ?>

<div class="col-md-6 col-lg-4 my-3">
	<article id="post-<?php the_ID(); ?>">	
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-image">
				<?php the_post_thumbnail('large'); // Declare pixel size you need inside the array ?>
			</a>
		<?php endif; ?>
		<div class="summary p-3 p-lg-4 text-center">
			<h3>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h3>
			<?php /*<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
			<!-- /post details --> */ ?>

			<?php agutcode_excerpt('agutcode_index'); // Build your custom callback length in functions.php ?>

			<?php //edit_post_link(); ?>
		</div>

	</article>
</div>

<?php endwhile; ?>
<?php endif; ?>
