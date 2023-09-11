<?php get_template_part('head'); ?>
	<header class="header py-3 px-3 px-lg-5" role="banner">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-4 col-lg-2 logo">
					<?php if ( function_exists( 'the_custom_logo' ) ) {
						the_custom_logo();
					} else { ?>
						<a href="<?php echo home_url(); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Logo">
						</a>
					<?php } ?>
				</div>			
				<div class="col-8 col-lg-10 text-end">
					<nav class="d-flex justify-content-end align-items-center">
						<div class="menu d-none d-lg-block">
							<?php agutcode_nav(); ?>
						</div>
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('header-widget-area')); ?>
					</nav>
					<!-- <nav id="menu-wrapper" class="nav d-lg-flex align-items-center justify-content-center justify-content-lg-end" role="navigation">
						<?php agutcode_nav(); ?>
					</nav>						
					<button class="menu-toggle d-lg-none">
						<span class="line"></span>
					</button>	 -->
				</div>	
			</div>
		</div>
	</header>
