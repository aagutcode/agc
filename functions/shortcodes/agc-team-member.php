<?php /* AGC Team Member Shortcode */
function agc_team_member( $atts, $content = null ) {    
  
    $params = shortcode_atts( array(
        'picture' => '',
        'name' => '',
        'position' => '',
        'description' => '',
        'email' => '',
        'phone' => '',
        'facebook' => '',
        'twitter' => '',
        'instagram' => '',
        'youtube' => '',
        'linkedin' => ''
    ), $atts );    
    
    $picture_url = wp_get_attachment_image_src($params["picture"],'full');
    $img_tag = !empty($picture_url[0]) ? '<img src="'.$picture_url[0].'" alt="'.$params['name'].'" />' : '';

    
    $name = $params['name'] !== '' ? '<h3>'.$params['name'].'</h3>' : '';
    $position = $params['position'] !== '' ? '<h4>'.$params['position'].'</h4>' : '';
    $description = $params['description'] !== '' ? '<p>'.$params['description'].'</p>' : '';
    $email = $params['email'] !== '' ? '<p><a href="mailto:'.$params['email'].'">'.str_replace(';', ' ',$params['email']).'</a></p>' : '';
    $phone = $params['phone'] !== '' ? '<p><a href="tel:'.$params['phone'].'">'.$params['phone'].'</a></p>' : '';
    $instagram =  $params['instagram'] !== '' ? '<li><a href="'.$params["instagram"].'" target="_blank" class="icon-instagram"></a></li>' : '';
    $facebook =  $params['facebook'] !== '' ? '<li><a href="'.$params["facebook"].'" target="_blank" class="icon-facebook"></a></li>' : '';
    $twitter =  $params['twitter'] !== '' ? '<li><a href="'.$params["twitter"].'" target="_blank" class="icon-twitter"></a></li>' : '';
    $youtube =  $params['youtube'] !== '' ? '<li><a href="'.$params["youtube"].'" target="_blank" class="icon-youtube"></a></li>' : '';
    $linkedin =  $params['linkedin'] !== '' ? '<li><a href="'.$params["linkedin"].'" target="_blank" class="icon-linkedin"></a></li>' : '';

    $team_member = '<div class="agc-team-member">
        <div class="picture">
        '.$img_tag.'
        </div>
        <div class="info">
            <div class="content">'.
                $name.
                $position.
                $description.
                $email.
                $phone
                .'
                <ul class="social-media small">
                '.
                    $instagram.
                    $facebook.
                    $twitter.
                    $youtube.
                    $linkedin   
                .'
                </ul>
            </div>
        </div>
     </div>';


    return $team_member;
}
add_shortcode( 'agc-team-member', 'agc_team_member' );

function create_vc_team_member() {
  vc_map([
        "category" => "agutcode",
        "name" => "Team Member",
        "base" => "agc-team-member",
        "description" => "Team member card",
        "show_settings_on_create" => true,
        "class" => "vc-project-details-block",
        "icon" => "",
        "params" => array(
            array(
              "type" => "attach_image",
              "heading" => __("Picture", "agutcode"),
              "param_name" => "picture",
              "description" => __("Add a Picture of this team member.", "agutcode")
            ),
            array(
                "heading"       => "Name",
                "type"          => "textfield",
                "param_name"    => "name",
                "description"   => "",
                "value"         => '',
                "admin_label"   => true
            ),
            array(
                "heading"       => "Job Position",
                "type"          => "textfield",
                "param_name"    => "position",
                "description"   => "",
                "value"         => '',
                "admin_label"   => false
            ),
            array(
                "heading"       => "Description",
                "type"          => "textarea",
                "param_name"    => "description",
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
                "description"   => "Instagram profile URL",
                "value"         => '',
                "admin_label"   => false
            ),
            array(
                "heading"       => "Facebook",
                "type"          => "textfield",
                "param_name"    => "facebook",
                "description"   => "Facebook profile URL",
                "value"         => '',
                "admin_label"   => false
            ),
            array(
                "heading"       => "Twitter",
                "type"          => "textfield",
                "param_name"    => "twitter",
                "description"   => "Twitter profile URL",
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
                "heading"       => "LinkedIn",
                "type"          => "textfield",
                "param_name"    => "linkedin",
                "description"   => "LinkedIn profile URL",
                "value"         => '',
                "admin_label"   => false
            )
        )
   ]);
}
add_action( 'vc_before_init', 'create_vc_team_member' );