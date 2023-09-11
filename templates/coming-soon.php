<?php /* Template Name: Coming soon*/ ?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<?php get_template_part('head'); ?>	
	<body id="coming-soon">
        <header class="header" role="banner">	
            <img src="<?php echo get_template_directory_uri(); ?>/img/belle-and-company-logo.webp" alt="Logo" class="logo-img">
        </header>
		<main role="main">
            <section class="marquees">
                <div class="marquee rtl">
                    <div class="marquee__inner" aria-hidden="true">                           
                        <div class="group">
                            <span>photographers</span>
                            <span>directors</span>
                            <span>editors</span>
                        </div>                                    
                        <div class="group">
                            <span>photographers</span>
                            <span>directors</span>
                            <span>editors</span>
                        </div>                                    
                        <div class="group">
                            <span>photographers</span>
                            <span>directors</span>
                            <span>editors</span>
                        </div>                                    
                        <div class="group">
                            <span>photographers</span>
                            <span>directors</span>
                            <span>editors</span>
                        </div>                              
                        <?php /*get_template_part('templates/parts/marquee-group'); ?> 
                        <?= get_template_part('templates/parts/marquee-group'); ?> 
                        <?= get_template_part('templates/parts/marquee-group'); ?> 
                        <?= get_template_part('templates/parts/marquee-group'); */ ?> 
                    </div>
                </div>
                <div class="marquee ltr">
                    <div class="marquee__inner" aria-hidden="true">                        
                        <div class="group">
                            <span>artists</span>
                            <span>producers</span>
                            <span>designers</span>
                        </div>                          
                        <div class="group">
                            <span>artists</span>
                            <span>producers</span>
                            <span>designers</span>
                        </div>                          
                        <div class="group">
                            <span>artists</span>
                            <span>producers</span>
                            <span>designers</span>
                        </div>                          
                        <div class="group">
                            <span>artists</span>
                            <span>producers</span>
                            <span>designers</span>
                        </div>                     
                    </div>
                </div>
                <div class="marquee rtl">
                    <div class="marquee__inner" aria-hidden="true">                       
                        <div class="group">
                            <span>editors</span>
                            <span>photographers</span>
                            <span>directors</span>
                        </div>                         
                        <div class="group">
                            <span>editors</span>
                            <span>photographers</span>
                            <span>directors</span>
                        </div>                         
                        <div class="group">
                            <span>editors</span>
                            <span>photographers</span>
                            <span>directors</span>
                        </div>                         
                        <div class="group">
                            <span>editors</span>
                            <span>photographers</span>
                            <span>directors</span>
                        </div>                       
                    </div>
                </div>
            </section>
            <section class="content">
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<?php the_content(); ?>

			<?php endwhile; endif; ?>
            </section>
            <section class="marquees">
                <div class="marquee rtl">
                    <div class="marquee__inner" aria-hidden="true">                     
                        <div class="group">
                            <span>stylists</span>
                            <span>makeup</span>
                            <span>hair</span>
                        </div>                        
                        <div class="group">
                            <span>stylists</span>
                            <span>makeup</span>
                            <span>hair</span>
                        </div>                        
                        <div class="group">
                            <span>stylists</span>
                            <span>makeup</span>
                            <span>hair</span>
                        </div>                        
                        <div class="group">
                            <span>stylists</span>
                            <span>makeup</span>
                            <span>hair</span>
                        </div>                       
                    </div>
                </div>
                <div class="marquee ltr">
                    <div class="marquee__inner" aria-hidden="true">                     
                        <div class="group">
                            <span>directors</span>
                            <span>editors</span>
                            <span>photographers</span>
                        </div>                                       
                        <div class="group">
                            <span>directors</span>
                            <span>editors</span>
                            <span>photographers</span>
                        </div>                                       
                        <div class="group">
                            <span>directors</span>
                            <span>editors</span>
                            <span>photographers</span>
                        </div>                                       
                        <div class="group">
                            <span>directors</span>
                            <span>editors</span>
                            <span>photographers</span>
                        </div>                      
                    </div>
                </div>
                <div class="marquee rtl">
                    <div class="marquee__inner" aria-hidden="true">                      
                        <div class="group">
                            <span>hair</span>
                            <span>set designers</span>
                            <span>stylists</span>
                        </div>                  
                        <div class="group">
                            <span>hair</span>
                            <span>set designers</span>
                            <span>stylists</span>
                        </div>                  
                        <div class="group">
                            <span>hair</span>
                            <span>set designers</span>
                            <span>stylists</span>
                        </div>                  
                        <div class="group">
                            <span>hair</span>
                            <span>set designers</span>
                            <span>stylists</span>
                        </div>                        
                    </div>
                </div>
            </section>
		</main>
        <footer class="contact-footer">
            <span class="wide" id="subscribe-toggle">get early access</span>
            <a href="mailto:hello@belleandcompany.com" class="email sq"><i class="icon-mail"></i></a>
            <a href="tel:3057413099" class="call sq"><i class="icon-phone"></i></a>
        </footer>
		<?php wp_footer(); ?>
    </body>
</html>