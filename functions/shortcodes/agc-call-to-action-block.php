<?php /* AGC Call To Action Block Shortcode*/
function cta_block_callback($attr){
  $params = shortcode_atts(array(
    'video' => '',
    'mobile_video' => '',
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
  ), $attr);

    $video_url = wp_get_attachment_url($params["video"]);

    $mobile_video_url = wp_get_attachment_url($params["mobile_video"]);

    $img_url = wp_get_attachment_image_src($params["image"],'full');

    $mobile_img_url = wp_get_attachment_image_src($params["mobile_image"],'large');
    
    $mobile_img_tag = !empty($mobile_img_url[0]) ? '<img src="'.$mobile_img_url[0].'" alt="'.$params['title'].'" class="d-lg-none">' : '';

    $img_tag_class = !empty($mobile_img_tag) ? 'class="d-none d-lg-block"' : '';

    $img_tag = !empty($img_url[0]) ? '<img src="'.$img_url[0].'" alt="'.$params['title'].'" '.$img_tag_class.'>' : '';

    $bgcolor = !empty($params['bgcolor']) ? 'style="background-color:'.$params['bgcolor'].'"' : '';

    $title1color = !empty($params['title1color']) ? 'style="color:'.$params['title1color'].'"' : '';

    $title2color = !empty($params['title2color']) ? 'style="color:'.$params['title2color'].'"' : '';

    $desc_color = !empty($params['description_color']) ? 'style="color:'.$params['description_color'].'"' : '';

    $url_link = vc_build_link($params['url']);

    $btn_content = $params['btn_type'] == 'Play' ? '<i class="icon-play"></i>' : $params['btn_text'];


  $block = '
  <div class="agc-cta-block '.$params['class'].'" '.$bgcolor.'>';
  $block .= $params["video"] !== '' ? 
    '<div class="video-bg-layer">
      <div class="video-wrapper">
        <div class="center-content">
          <video role="presentation" preload="auto" loop="" muted="" class="bgVideovideo d-none d-lg-block" autoplay="" src="'.$video_url.'"></video>
          <video role="presentation" preload="auto" loop="" muted="" class="bgVideovideo d-lg-none" autoplay="" src="'.$mobile_video_url.'"></video>
        </div>
      </div>
    </div>' : '
    <div class="image-bg-layer">
      <div class="image-wrapper">
      '.$img_tag.$mobile_img_tag.'
      </div>
    </div>';
    $block .= '<div class="cta-overlay '.$params['overlay'].'">
      <div class="cta-content">
        <h2 class="mb-0" '.$title1color.'>'.$params['title1'].'</h3>
        <h2 class="mb-4" '.$title2color.'>'.$params['title2'].'</h3>
        <p class="cta-description" '.$desc_color.'>'.$params['description'].'</p>
        <a href="'.esc_url($url_link['url']).'">'.$btn_content.'</a>
      </div>
    </div>
  </div>';
 return $block;
}
add_shortcode('cta_block', 'cta_block_callback');

function vc_map_cta_block(){
  vc_map([
    "category" => "agutcode",
    "name" => __("Video CTA Block", "agutcode"),
    "base" => "cta_block",
    "icon" => "icon-wpb-toggle-small-expand",
    "show_settings_on_create" => true,
    "params" => array(
      array(
        'type' => 'file_picker',
        'class' => '',
        'heading' => __( 'Background Video', 'js_composer' ),
        'param_name' => 'video',
        'value' => '',
      ),
      array(
        'type' => 'file_picker',
        'class' => '',
        'heading' => __( 'Background Video (Mobile)', 'js_composer' ),
        'param_name' => 'mobile_video',
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
add_action('vc_before_init', 'vc_map_cta_block');