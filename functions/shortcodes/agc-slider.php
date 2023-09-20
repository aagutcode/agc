<?php /* AGC Slider Shortcode */
function slider_callback( $atts, $content = null ) {  
    $params = shortcode_atts( array(
            'el_class'    => '',
            'id'       => 'temporal'
        ), $atts);
    $carrusel = '';
    $id = $params['id'] != '' ? $params['id'] : 'carrusel-'.mt_rand(100,999);
    if($content != null){
      $carrusel = '<div id="'.$id.'" class="agc-slider owl-carousel img-carousel">';
      $carrusel .= do_shortcode($content); 
      $carrusel .= '</div>';  
    }
    return $carrusel;
}
add_shortcode( 'slider', 'slider_callback' );

// Map Slider Container
function create_vc_slider() {
  vc_map([
    "category" => "agutcode",
    "name" => __("Slider", "agutcode"),
    "base" => "slider",
    "as_parent" => array('only' => 'slide'), 
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "icon" => "icon-wpb-ui-pageable",
    "params" => array(
      array(
          "heading"       => "Unique ID",
          "type"          => "textfield",
          "param_name"    => "id",
          "description"   => "Unique ID to identify carrusel (random if empty)",
          "admin_label"   => true
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "agutcode"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "agutcode")
      )
    ),
    "js_view" => 'VcColumnView'
  ]);
}
add_action( 'vc_before_init', 'create_vc_slider' );

//Nested Slide Shortcode
function slide_callback( $atts ) {  
  $params = shortcode_atts(array(
    'video' => '',
    'image' => '',
    'mobile_image' => '',
    'bg-color' => '',
    'overlay' => '',
    'title1' => '',
    'title1color' => '#fff',
    'title2' => '',
    'title2color' => '#1b1b1b',
    'description' => '',
    'description_color' => '#fff',
    'btn_type' => '',
    'btn_text' => '',
    'url' => '',
    'class' => ''
  ), $atts);

  //Slide Background Image & Color
  $bgcolor = !empty($params['bgcolor']) ? 'style="background-color:'.$params['bgcolor'].'"' : '';
  $img_url = wp_get_attachment_image_src($params["image"],'full');
  $mobile_img_url = wp_get_attachment_image_src($params["mobile_image"],'large');
    
  //If is set mobile image add img tag and create display class
  $mobile_img_tag = !empty($mobile_img_url[0]) ? '<img src="'.$mobile_img_url[0].'" alt="'.$params['title'].'" class="d-lg-none">' : '';
  $img_tag_class = !empty($mobile_img_tag) ? 'class="d-none d-lg-block"' : '';

  //If isset desktop image add img tag
  $img_tag = !empty($img_url[0]) ? '<img src="'.$img_url[0].'" alt="'.$params['title'].'" '.$img_tag_class.'>' : '';
  
  //Title text and color
  $title1color = !empty($params['title1color']) ? 'style="color:'.$params['title1color'].'"' : '';    
  $title1 = !empty($params['title1']) ? '<h1 class="mb-3" '.$title1color.'>'.$params['title1'].'</h1>': '';

  //Title 2 text and color
  $title2color = !empty($params['title2color']) ? 'style="color:'.$params['title2color'].'"' : '';
  $title2 = !empty($params['title2']) ? '<h2 class="mb-0" '.$title1color.'>'.$params['title2'].'</h2>': '';

  //Description text & color
  $desc_color = !empty($params['description_color']) ? 'style="color:'.$params['description_color'].'"' : '';
  $description = !empty($params['description']) ? '<p class="cta-description" '.$desc_color.'>'.$params['description'].'</p>' : '';

  //If isset button
  $url_link = vc_build_link($params['url']);
  $btn_content = $params['btn_type'] == 'Play' ? '<i class="icon-play"></i>' : $params['btn_text'];
  $button .= !empty($url_link['url']) ? '<a class="btn btn-primary mt-4" href="'.esc_url($url_link['url']).'">'.$btn_content.'</a>' : '';

  //Slide structure
  $slide = '
  <div class="slide '.$params['class'].'" '.$bgcolor.'>';
  $slide .= $params['video'] 
  ? 
    '<div class="video-bg-layer">
      <video role="presentation" preload="auto" loop="" muted="" class="background-video" autoplay="" src="'.wp_get_attachment_url($params["video"]).'"></video>
    </div>' 
  : 
    '<div class="image-bg-layer">
      '.$img_tag.$mobile_img_tag.'
    </div>' ;
  $slide .= '
    <div class="cta-overlay '.$params['overlay'].'">
      <div class="cta-content">
      '.$title1.'
      '.$title2.'
      '.$description.'
      '.$button.'
      </div>
    </div>
  </div>';
  return $slide;
}
add_shortcode( 'slide', 'slide_callback' );

//Map Slide Element
function create_vc_slide() {
  vc_map([
    "category" => "agutcode",
    "name" => __("Slide", "agutcode"),
    "base" => "slide",
    "content_element" => true,
    "icon" => "vc_icon-vc-hoverbox",
    "show_settings_on_create" => true,
    "as_child" => array('only' => 'slider'), 
    "params" => array(
      array(
        'type' => 'file_picker',
        'class' => '',
        'heading' => __( 'Background Video', 'js_composer' ),
        'param_name' => 'video',
        'value' => '',
      ),
      array(
        "type" => "attach_image",
        "heading" => __("Background Image (Desktop)", "agutcode"),
        "param_name" => "image",
        "description" => __("Add a Background image.", "agutcode")
      ),
      array(
        "type" => "attach_image",
        "heading" => __("Background Image (Mobile)", "agutcode"),
        "param_name" => "mobile_image",
        "description" => __("Add a Background image.", "agutcode")
      ),
      array(
        "type" => "colorpicker",
        "heading" => __("Background Color", "agutcode"),
        "param_name" => "bgcolor",
        "value"=>"",
        "description" => __("Add a Background color.", "agutcode")
      ),
      array(
        "type" => "checkbox",
        "heading" => __("Add Overlay", "agutcode"),
        "param_name" => "overlay",
        "value"=> '',        
        "description" => __("Add an overlay.", "agutcode"),
        "admin_label"   => true
      ),
      array(
        "type" => "textfield",
        "heading" => __("Title (Line 1)", "agutcode"),
        "param_name" => "title1",
        "description" => __("Block Title", "agutcode"),
        "admin_label"   => true
      ),
      array(
        "type" => "colorpicker",
        "heading" => __("Line 1 Text Color", "agutcode"),
        "param_name" => "title1color",
        "value"=>"#fff",
        "description" => __("Add a Text color.", "agutcode")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Title (Line 2)", "agutcode"),
        "param_name" => "title2",
        "description" => __("Block Title", "agutcode")
      ),
      array(
        "type" => "colorpicker",
        "heading" => __("Line 2 Text Color", "agutcode"),
        "param_name" => "title2color",
        "value"=>"#1b1b1b",
        "description" => __("Add a text color.", "agutcode")
      ),
      array(
        "type" => "textarea",
        "heading" => __("Description", "agutcode"),
        "param_name" => "description",
        "description" => __("Description text", "agutcode")
      ),
      array(
        "type" => "colorpicker",
        "heading" => __("Description Text Color", "agutcode"),
        "param_name" => "description_color",
        "value"=>"#fff",
        "description" => __("Add a Text color.", "agutcode")
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Button Type", "agutcode"),
        "param_name" => "btn_type",
        "description" => __("Link button type", "agutcode"),      
        "value"       => array(
          "Text"  => "text",
          "Play" => "play",
        ),
        "std" => "Play"
      ),
      array(
        "type" => "textfield",
        "heading" => __("Button Text", "agutcode"),
        "param_name" => "btn_text",
        "description" => __("Button's visible text", "agutcode")
      ),
      array(
        "type" => "vc_link",
        "heading" => __("Button Link", "agutcode"),
        "param_name" => "url",
        "description" => __("URL", "agutcode")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra Class", "agutcode"),
        "param_name" => "class",
        "description" => __("", "agutcode")
      )
    )
  ]);
}
add_action( 'vc_before_init', 'create_vc_slide' );

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_slider extends WPBakeryShortCodesContainer {
  }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_slide extends WPBakeryShortCode {
  }
}