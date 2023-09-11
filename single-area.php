<?php get_header(); ?>

<main role="main">
	<!-- section -->
	<section class="container py-5">
		<div class="row">
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" class="col-lg-9">

					<h1 class="mb-4"><?php the_title(); ?></h1>
					
					<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
						<a href="<?php the_permalink(); ?>"  class="image-wrapper mb-4" title="<?php the_title(); ?>">
							<?php the_post_thumbnail(); // Fullsize image for the single post ?>
						</a>
					<?php endif; ?>
					
					<?php /*
					<!-- post details -->
					<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
					<span class="author"><?php _e( 'Published by', 'agutcode' ); ?> <?php the_author_posts_link(); ?></span>
					<span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'agutcode' ), __( '1 Comment', 'agutcode' ), __( '% Comments', 'agutcode' )); ?></span>
					<!-- /post details --> */ ?>
					<div class="text-justify">
						<?php the_content(); // Dynamic Content ?>
					</div>
					<?php /* the_tags( __( 'Tags: ', 'agutcode' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>

					<p><?php _e( 'Categorised in: ', 'agutcode' ); the_category(', '); // Separated by commas ?></p>

					<p><?php _e( 'This post was written by ', 'agutcode' ); the_author(); ?></p>

					<?php edit_post_link(); // Always handy to have Edit Post Links available ?>

					<?php comments_template(); */ ?>
				</article>				
			<?php endwhile; endif; ?>
			<aside class="col-lg-3">
				<div class="related pt-4">
					<h3 class="pt-5 pb-4">Otras Áreas de Atención</h3>
					<?php $args = array( 
						'post_type' => get_post_type(get_the_ID()),
						'posts_per_page' => '10',
						'post__not_in' => array(get_the_ID())
					);
					$loop = new WP_Query( $args );  				
						while ( $loop->have_posts() ) : $loop->the_post();
							get_template_part('related-posts-card');
						endwhile; 
						wp_reset_query(); ?>
				</div>
			</aside>
		</div>
	</section>
	<!-- /section -->
</main>

<?php get_footer(); ?>