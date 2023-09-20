<?php get_template_part('head');
$header_type = get_post_meta(get_the_ID(), 'header_type', true);
?>
	<header class="header py-4 <?= $header_type; ?>" role="banner">
		<div class="container">
			<div class="d-flex align-items-center justify-content-between">
				<nav class="nav-left col-5">
					<?php agutcode_nav('header-menu'); ?>
				</nav>
				<div class="logo col-2 justify-content-center">
					<?php if ( function_exists( 'the_custom_logo' ) ) {
						the_custom_logo();
					} else { ?>
						<a href="<?php echo home_url(); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Logo">
						</a>
					<?php } ?>
				</div>			
				<nav class="nav-right col-5">
					<?php agutcode_nav('extra-menu'); ?>
				</nav>	
			</div>
		</div>
	</header>
