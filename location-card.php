<article class="location-card<?= $args['index'] == 0 ? ' active' : '';?>" id="post-<?php the_ID(); ?>" data-lat="<?= get_post_meta(get_the_ID(), 'latitud', true); ?>" data-lng="<?= get_post_meta(get_the_ID(), 'longitud', true); ?>">

	<h2 class="title"><?php the_title(); ?></h2>

	<h3 class="address"><?= get_post_meta(get_the_ID(), 'direccion', true); ?></h3>

	<?php $post_tags = get_the_terms(get_the_ID(), 'location-tags');
	if ($post_tags) { ?>
		<ul class="tags">
			<?php foreach ($post_tags as $tag) { ?>
				<?php $image_id = get_term_meta($tag->term_id, 'image_id', true);
				$image_url = wp_get_attachment_url($image_id); ?>
				<li><img src="<?= $image_url; ?>" alt="<?= $tag->name; ?>" /></li>
			<?php } ?>
		</ul>
	<?php } ?>
	<?php $gmaps = get_post_meta(get_the_ID(), 'gmaps', true);
	if ($gmaps) { ?>
		<a class="btn" target="_blank" href="<?= $gmaps; ?>">CÓMO LLEGAR<i class="icon-location"></i></a>
	<?php } ?>

	<div class="prices">
		<?php $precio_diesel = get_post_meta(get_the_ID(), 'precio_diesel', true);
		if ($precio_diesel) { ?>
			<div class="price-tag">
				<h4>DIESEL</h4>
				<span class="price">
					<?= $precio_diesel; ?>€/L
				</span>
			</div>
		<?php } ?>
		<?php $precio_sp95 = get_post_meta(get_the_ID(), 'precio_sp95', true);
		if ($precio_sp95) { ?>
			<div class="price-tag secondary">
				<h4>SP95</h4>
				<span class="price">
					<?= $precio_sp95; ?>€/L
				</span>
			</div>
		<?php } ?>
	</div>
	<span class="date">Precio de la gasolina hoy (<?= strftime('%A, %e de %B %Y'); ?>)</span>
	<?php /*<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
	  <!-- /post details --> */?>

	<?php //edit_post_link(); ?>
</article>