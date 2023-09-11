<?php /* AGC Social Network Links Shortcode */
function agc_social_networks( $atts, $content = null ) {    
    
    $params = shortcode_atts( array(
        'size' => 'small',
        'facebook' => '',
        'twitter' => '',
        'instagram' => '',
        'youtube' => '',
        'title' => '',
        'class' => ''
    ), $atts );

    $facebook = $params['facebook'] ? '<li><a href="'.$params['facebook'].'" target="_blank" class="icon-facebook"></a></li>' : '';
    $twitter = $params['twitter'] ? '<li><a href="'.$params['twitter'].'" target="_blank" class="icon-twitter"></a></li>' : '';
    $instagram = $params['instagram'] ? '<li><a href="'.$params['instagram'].'" target="_blank" class="icon-instagram"></a></li>' : '';
    $youtube = $params['youtube'] ? '<li><a href="'.$params['youtube'].'" target="_blank" class="icon-youtube"></a></li>' : '';
    $title = $params['title'] ? '<li><span>'.$params['title'].'</span></li>' : '';

    $social_networks = '<ul class="social-media '.$params['size'].' '.$params['class'].'">
    '.$instagram.'
    '.$facebook.'
    '.$twitter.'
    '.$youtube.'
    '.$title.'
    </ul>';


    return $social_networks;
}
add_shortcode( 'agc-social-media', 'agc_social_networks' );

function create_vc_social_networks() {
  vc_map([
        "category" => "agutcode",
        "name" => "Social Media Bar",
        "base" => "agc-social-media",
        "description" => "Create a social media links bar.",
        "show_settings_on_create" => true,
        "class" => "vc-project-details-block",
        "icon" => "",
        "params" => array(
            array(
                "heading"       => "Tamaño",
                "type"          => "dropdown",
                "param_name"    => "size",
                "description"   => "Select the size of the icons",
                "value"         => array(
                    "Small" => "small",
                    "Medium" => "medium",
                    "Large" => "large",
                ),
                "admin_label"   => true
            ),
            array(
                "heading"       => "Instagram",
                "type"          => "textfield",
                "param_name"    => "instagram",
                "description"   => "Instagram URL",
                "value"         => '',
                "admin_label"   => false
            ),
            array(
                "heading"       => "Facebook",
                "type"          => "textfield",
                "param_name"    => "facebook",
                "description"   => "Facebook URL",
                "value"         => '',
                "admin_label"   => false
            ),
            array(
                "heading"       => "Twitter",
                "type"          => "textfield",
                "param_name"    => "twitter",
                "description"   => "Twitter URL",
                "value"         => '',
                "admin_label"   => false
            ),
            array(
                "heading"       => "Youtube",
                "type"          => "textfield",
                "param_name"    => "youtube",
                "description"   => "Youtube URL",
                "value"         => '',
                "admin_label"   => false
            ),
            array(
                "heading"       => "Username",
                "type"          => "textfield",
                "param_name"    => "title",
                "description"   => "Username",
                "value"         => '',
                "admin_label"   => false
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
add_action( 'vc_before_init', 'create_vc_social_networks' );