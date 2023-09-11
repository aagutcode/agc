<?php /* AGC Images Carousel Shortcode */
function images_carousel_callback( $atts, $content = null ) {  
    $params = shortcode_atts( array(
        'title'     => '',
        'images'    => '',
        'qty'       => 3,
        'id'        => '',
        'loop'      => false,
        'autoplay'  => false
    ), $atts);
    $carrusel = '';
    $id = $params['id'] != '' ? $params['id'] : 'carrusel-'.mt_rand(100,999);
    $images = explode(',', $params['images']);

    if(count($images) > 0){
        $n = 0;
        $carrusel = '<div class="agc-images-carousel">';
        if(!empty($params['title'])){
            $carrusel .= '<h3 class="gallery-title">'.$params["title"].'</h3>';
        }
        $carrusel .= '<div id="'.$id.'" class="swiper-container">
        <div class="swiper-wrapper">';
        
        foreach ($images as $image) {
            $n++;
            $image_url = wp_get_attachment_image_src($image, 'full');
            $carrusel .= '<div class="swiper-slide" lightbox-toggle><img class="item-'.$n.'" src="'.$image_url[0].'" width="'.$image_url[1].'" height="'.$image_url[2].'" ></div>';
        }   
        $carrusel .= '</div>        
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        </div>';  
        $qty_tablet = $params['qty'] > 3 ? 4 : 1 ;
        $carrusel .= '<script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var mySwiper = new Swiper ("#'.$id.'", {
                loop: true,
                loopedSlides: 8,
                centeredSlides: true,
                slidesPerView: "auto",
                spaceBetween: 40,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                speed: 5000,
                autoplay: {
                  delay: 3,
                }
            })
        });
        </script>';     
    }
    return $carrusel;
}
add_shortcode( 'images-carousel', 'images_carousel_callback' );

function create_vc_images_carousel() {
vc_map([
  "category" => "agutcode",
  "name" => "Images Carousel",
  "base" => "images-carousel",
  "description" => "Create a carousel with selected images.",
  "show_settings_on_create" => true,
  "class" => "vc-project-details-block",
  "icon" => "icon-wpb-images-carousel",
  "params" => array(
    array(
        "heading"       => "Title",
        "type"          => "textfield",
        "param_name"    => "title",
        "description"   => "Gallery Title",
        "admin_label"   => true
    ),
    array(
        "heading"       => "Images",
        "type"          => "attach_images",
        "param_name"    => "images",
        "description"   => "Choose images",
        "admin_label"   => true
    ),
    array(
        "heading"       => "Visible slides",
        "type"          => "textfield",
        "param_name"    => "qty",
        "description"   => "How many slides are visible at once?",
        "admin_label"   => true,
        "value"       => 3
    ),
    array(
        "heading"       => "Loop Images",
        "type"          => "checkbox",
        "param_name"    => "loop",
        "description"   => "Infinite Loop?",
        "admin_label"   => false,
        "value"       => ''
    ),
    array(
        "heading"       => "Autoplay",
        "type"          => "checkbox",
        "param_name"    => "autoplay",
        "description"   => "Autoplay carousel?",
        "admin_label"   => false,
        "value"       => ''
    ),
    array(
        "heading"       => "Unique ID",
        "type"          => "textfield",
        "param_name"    => "id",
        "description"   => "Unique ID to identify carrusel (random if empty)",
        "admin_label"   => true
    ),
  )
]);
}
add_action( 'vc_before_init', 'create_vc_images_carousel' );