		<section class="prefooter py-5">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 text-start">
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widgets-1')) ?>
					</div>
					<div class="col-lg-4 text-center">
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widgets-2')) ?>
					</div>
					<div class="col-lg-4 text-end">
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widgets-3')) ?>
					</div>
				</div>
			</div>
		</section>
		<footer class="footer" role="contentinfo">
				<div class="container">
					<div class="row p-3 align-items-center">
						<div class="col-lg-4">
							<p class="my-2 my-lg-0">&copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?>.</p>
						</div>
						<div class="col-lg-4 text-center">
							<p class="my-2 my-lg-0">info@trama.la</p>
						</div>
						<div class="col-lg-4 text-lg-end">
							<p class="my-2 my-lg-0"><a href="https://www.linkedin.com/company/tramaexecutivesearch/" target="_blank">Linkedin</a></p>							
						</div>
					</div>
				</div>
				
		</footer>
		<?php wp_footer(); ?>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	</body>
</html>
