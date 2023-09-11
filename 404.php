<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section class="container vh-100 d-flex align-items-center justify-content-center">
			<div class="error-page text-center">
				<div class="error-code">
					<strong>404</strong>
				</div>
				<div class="error-message">
					<h3>Page not Found!</h3>
				</div>
				<div class="error-body">
					<p>Try using the button below to go to main page of the site </p>
					<a href="<?php echo home_url(); ?>" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Back to Home Page</a>
				</div>
			</div>
		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
