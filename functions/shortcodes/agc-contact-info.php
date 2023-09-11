<?php /* AGC Contact Info Layout Shortcode */
function agc_contact_info( $atts, $content = null ) {    
  
    $params = shortcode_atts( array(
        'location' => '',
        'email' => '',
        'phone' => '',
        'facebook' => '',
        'twitter' => '',
        'instagram' => '',
        'youtube' => '',
        'size' => 'small'
    ), $atts );


    $contact_info = '<div class="agc-contact-info">';
    $contact_info .= $params['location'] !== '' ? '<div><label>Location</label><span>'.$params['location'].'</span></div>' : '';
    $contact_info .= $params['email'] !== '' ? '<div><label>Email</label><a href="mailto:'.$params['email'].'">'.str_replace(';', ' ',$params['email']).'</a></div>' : '';
    $contact_info .= $params['phone'] !== '' ? '<div><label>Phone</label><a href="tel:'.$params['phone'].'">'.$params['phone'].'</a></div>' : '';
    $contact_info .= '<div>
    <label>Social Media</label>
    <ul class="social-media '.$params['size'].'">';
        if($params['instagram'] !== ''){
            $contact_info .= '<li><a href="'.$params["instagram"].'" target="_blank" class="icon-instagram"></a></li>';
        } 
        if($params['facebook'] !== ''){
            $contact_info .= '<li><a href="'.$params["facebook"].'" target="_blank" class="icon-facebook"></a></li>';
        } 
        if($params['twitter'] !== ''){
            $contact_info .= '<li><a href="'.$params["twitter"].'" target="_blank" class="icon-twitter"></a></li>';
        } 
        if($params['youtube'] !== ''){ 
            $contact_info .= '<li><a href="'.$params["youtube"].'" target="_blank" class="icon-youtube"></a></li>';
        } 
        $contact_info .= '</ul>
     </div>
     </div>';


    return $contact_info;
}
add_shortcode( 'agc-contact-info', 'agc_contact_info' );

function create_vc_contact_info() {
  vc_map([
        "category" => "agutcode",
        "name" => "Contact Info",
        "base" => "agc-contact-info",
        "description" => "Ordered contact Info",
        "show_settings_on_create" => true,
        "class" => "vc-project-details-block",
        "icon" => "",
        "params" => array(
            array(
                "heading"       => "Location",
                "type"          => "textfield",
                "param_name"    => "location",
                "description"   => "",
                "value"         => '',
                "admin_label"   => false
            ),
            array(
                "heading"       => "Email",
                "type"          => "textfield",
                "param_name"    => "email",
                "description"   => "Email addresses separated by ;",
                "value"         => '',
                "admin_label"   => false
            ),
            array(
                "heading"       => "Phone",
                "type"          => "textfield",
                "param_name"    => "phone",
                "description"   => "Phone number without special chars.",
                "value"         => '',
                "admin_label"   => false
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
                "heading"       => "Size",
                "type"          => "dropdown",
                "param_name"    => "size",
                "description"   => "Select the size of the social network icons.",
                "value"         => array(
                    "Small" => "small",
                    "Medium" => "medium",
                    "Large" => "large",
                ),
                "admin_label"   => true
            )
        )
   ]);
}
add_action( 'vc_before_init', 'create_vc_contact_info' );