<?php /* AGC Images Marquee Shortcode */
function images_marquee_callback( $atts, $content = null ) {  
    $params = shortcode_atts( array(
        'title'     => '',
        'images'    => '',
        'id'        => '',
    ), $atts);
    $marquee = '';
    $id = $params['id'] != '' ? $params['id'] : 'marquee-'.mt_rand(100,999);
    $images = explode(',', $params['images']);

    $marquee = '<div class="agc-images-marquee">
    <span class="square"></span>';
    if(count($images) > 0){        
        $marquee .= !empty($params['title']) ? '<h3 class="title">'.$params["title"].'</h3>' : '';
        
        $marquee .= '<div id="'.$id.'" class="marquee">
        <div class="images-wrapper">';

        $n = 0;
        foreach ($images as $image) {
            $n++;
            $image_url = wp_get_attachment_image_src($image, 'full');
            $marquee .= '<img class="item-'.$n.'" src="'.$image_url[0].'" width="'.$image_url[1].'" height="'.$image_url[2].'" >';
        }   
        $marquee .= '</div></div></div>';      
    }
    return $marquee;
}
add_shortcode( 'images-marquee', 'images_marquee_callback' );

function create_vc_images_marquee() {
vc_map([
  "category" => "agutcode",
  "name" => "Images marquee",
  "base" => "images-marquee",
  "description" => "Create a marquee with selected images.",
  "show_settings_on_create" => true,
  "class" => "vc-project-details-block",
  "icon" => "icon-wpb-images-marquee",
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
        "heading"       => "Unique ID",
        "type"          => "textfield",
        "param_name"    => "id",
        "description"   => "Unique ID to identify marquee (random if empty)",
        "admin_label"   => true
    ),
  )
]);
}
add_action( 'vc_before_init', 'create_vc_images_marquee' );