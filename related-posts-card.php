<article id="post-<?php the_ID(); ?>" class="mb-2">	
    <div class="row no-gutters align-items-center">
	    <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="col-lg-4">
			<?php the_post_thumbnail('thumbnail'); // Declare pixel size you need inside the array ?>
		</a>
	    <?php endif; ?>
        <div class="col-lg-8 px-3 summary">
            <h3>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
            </h3>
        </div>
    </div>
</article>