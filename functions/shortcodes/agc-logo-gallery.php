<?php /* AGC Images Carousel Shortcode */
function logo_gallery_callback( $atts, $content = null ) {  
    $params = shortcode_atts( array(
        'title'                 => '',
        'images'                => '',
        'elements_per_row'       => 4,
        'class'                 => '',
    ), $atts);

    $title = !empty($params['title']) ? '<h3 class="gallery-title">'.$params["title"].'</h3>' : '';
    $images = explode(',', $params['images']);
    $cols_per_item = 12/intval($params['elements_per_row']);
    foreach ($images as $image) {
        $image_url = wp_get_attachment_image_src($image, 'full');
        $gallery .= '<div class="col-6 col-lg-'.$cols_per_item.' item">
            <img src="'.$image_url[0].'" >
        </div>';
    }   

    if(count($images) > 0){
        $n = 0;
        $return = '<div class="agc-logo-gallery '.$params['class'].'">
        '.$title.'
        <div class="row justify-content-center">
        ' .$gallery.'
        </div>';      
    }
    return $return;
}
add_shortcode( 'logo-gallery', 'logo_gallery_callback' );

function create_vc_logo_gallery() {
vc_map([
  "category" => "agutcode",
  "name" => "Logo Gallery",
  "base" => "logo-gallery",
  "description" => "Logo Gallery.",
  "show_settings_on_create" => true,
  "class" => "vc-project-details-block",
  "icon" => "icon-wpb-logo-gallery",
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
      "type" => "dropdown",
      "heading"       => __("Grid elements per row", "agutcode"),
      "param_name"    => "elements_per_row",
      "description"   => __("Select number of single grid elements per row.", "agutcode"),
      "value"       => array(
        "2"  => "2",
        "3" => "3",
        "4" => "4",
        "6" => "6",
      ),
      "4" => "4"
    ),
    array(
        "heading"       => __("Extra class name", "agutcode"),
        "type"          => "textfield",
        "param_name"    => "class",
        "description"   => __("Style particular content element differently - add a class name and refer to it in custom CSS.", "agutcode"),
        "admin_label"   => true
    ),
  )
]);
}
add_action( 'vc_before_init', 'create_vc_logo_gallery' );