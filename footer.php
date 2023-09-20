		<section class="prefooter">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 text-start">
						<div class="logo">
							<?php if ( function_exists( 'the_custom_logo' ) ) {
								the_custom_logo();
							} ?>
						</div>
					</div>
					<div class="col-lg-3 text-center text-lg-start">
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widgets-1')) ?>
					</div>
					<div class="col-lg-3 text-center text-lg-start">
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widgets-2')) ?>
					</div>
					<div class="col-lg-3 text-center text-lg-start">
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widgets-3')) ?>
					</div>
				</div>
			</div>
		</section>
		<footer class="footer" role="contentinfo">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-9 text-center text-lg-start">
							<?php agutcode_nav('footer-menu'); ?>
						</div>
						<div class="col-lg-3 text-center text-lg-start">
							<p class="my-2 my-lg-0">&copy; <?php echo date('Y'); ?>. <?php bloginfo('name'); ?>. All rights reserved.</p>
						</div>
					</div>
				</div>
				
		</footer>
		<?php wp_footer(); ?>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	</body>
</html>
