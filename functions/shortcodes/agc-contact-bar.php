<?php /* AGC Contact bar */
function agc_contact_bar( $atts, $content = null ) {    
  
    $params = shortcode_atts( array(
        'email' => '',
        'phone' => '',
        'chat' => '',
        'color' => 'black',
    ), $atts );

    $email = $params["email"] ? '<a href="mailto:'.$params["email"].'" class="email sq"><i class="icon-mail"></i></a>':'';
    $phone = $params["phone"] ? '<a href="tel:'.$params["phone"].'" class="call sq"><i class="icon-phone"></i></a>':'';
    $chat = $params["chat"] ? '<a href="https://web.whatsapp.com/send?phone='.$params["chat"].'" class="chat sq d-none d-lg-inline-flex" target="_blank"><i class="icon-chat"></i></a><a href="https://api.whatsapp.com/send?phone='.$params["chat"].'" class="chat sq d-lg-none" target="_blank"><i class="icon-chat"></i></a>':'';

    $contact_bar = '<div class="contact-bar '.$params["color"].'">
        <span class="book-now wide">Reach Out</span>
        '.$email.'
        '.$phone.'
        '.$chat.'        
    </div>';


    return $contact_bar;
}
add_shortcode( 'agc-contact-bar', 'agc_contact_bar' );

function create_vc_contact_bar() {
  vc_map([
        "category" => "agutcode",
        "name" => "Contact Bar",
        "base" => "agc-contact-bar",
        "description" => "Ordered contact Info",
        "show_settings_on_create" => true,
        "class" => "vc-project-details-block",
        "icon" => "",
        "params" => array(
            array(
                "heading"       => "Email",
                "type"          => "textfield",
                "param_name"    => "email",
                "description"   => "Email addresses separated by ;",
                "value"         => '',
                "admin_label"   => true
            ),
            array(
                "heading"       => "Phone",
                "type"          => "textfield",
                "param_name"    => "phone",
                "description"   => "Phone number without special chars.",
                "value"         => '',
                "admin_label"   => true
            ),
            array(
                "heading"       => "Chat",
                "type"          => "textfield",
                "param_name"    => "chat",
                "description"   => "Whatsapp phone number including country code.",
                "value"         => '',
                "admin_label"   => false
            ),
            array(
              "type" => "dropdown",
              "heading" => __("Color", "agutcode"),
              "param_name" => "color",
              "description" => __("Border, text and icons color.", "agutcode"),      
              "value"       => array(
                "Black"  => "black",
                "White" => "white",
              ),
              "std" => "Black",
              "admin_label"   => true
            )
        )
   ]);
}
add_action( 'vc_before_init', 'create_vc_contact_bar' );