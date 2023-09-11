<?php /* AGC Post Carousel Shortcode */
function posts_carousel_callback( $atts, $content = null ) {  
  $params = shortcode_atts( array(
      'limit' => -1,
      'carousel_id' => '',
      'extra_class' => ''
    ), $atts);

  $id = $params['carousel_id'] != '' ? $params['carousel_id'] : 'carrusel-'.mt_rand(100,999);
  $args = array( 'post_type' => 'post' );
  $loop = new WP_Query( $args );   

  echo '<div class="px-sm-3">
  <div id="'.$id.'" class="owl-carousel posts-carousel">';
      while ( $loop->have_posts() ) : $loop->the_post();
        get_template_part('post-card');
      endwhile; 
      wp_reset_query();
  echo '</div>
  </div>
  <script>
  jQuery(document).ready(function($){
    $("#'.$id.'").owlCarousel({
    loop:true,
    nav:true,
    dots:false,
    responsiveClass:true,
    responsive:{
      0:{
          items:1,
          margin:10
      },
      768:{
          items:1,
          margin:15
      },
      1000:{
          items:4,
          loop:true,
          margin:15
      }
    }
  })
})
</script>';    

}
add_shortcode( 'posts-carousel', 'posts_carousel_callback' );

function create_vc_post_carousel() {
  vc_map([
      "category" => "agutcode",
      "name" => "posts carousel",
      "base" => "posts-carousel",
      "description" => "Carousel",
      "show_settings_on_create" => true,
      "class" => "vc-project-details-block",
      "icon" => "icon-wpb-images-carousel",
      "params" => array(
          array(
            "type"          => "textfield",
            "heading"       => __("Page limit", "agutcode"),
            "param_name"    => "limit",
            "description"   => "Max quantity of posts to show. (Leave empty for unlimited)",
            "admin_label"   => true
          ),
          array(
            "type"          => "textfield",
            "heading"       => __("Carousel ID", "agutcode"),
            "param_name"    => "carousel_id",
            "description"    => __("Must be unique", "agutcode")
          ),
          array(
            "type"          => "textfield",
            "heading"       => __("Extra Class", "agutcode"),
            "param_name"    => "extra_class",
            "description"    => __("", "agutcode")
          )
      )
  ]);
}
add_action( 'vc_before_init', 'create_vc_post_carousel' );