<?php /* AGC Grid Gallery */
    function cs_layout_callback($atts, $content=null){
        $params = shortcode_atts(array(
            'first_gallery_images' => '',
            'second_gallery_images' => '',
            'third_gallery_images' => '',
            'logo' => '',
            'headline' => '',
            'short' => '',
            'facebook' => '',
            'twitter' => '',
            'instagram' => '',
            'youtube' => '',
            'size' => 'small',
            'email' => '',
            'phone' => '',
            'chat' => '',
            'color' => 'black'
        ), $atts);

        $email = $params["email"] ? '<a href="mailto:'.$params["email"].'" class="email sq"><i class="icon-mail"></i></a>':'';
        $phone = $params["phone"] ? '<a href="tel:'.$params["phone"].'" class="call sq"><i class="icon-phone"></i></a>':'';
        $chat = $params["chat"] ? '<a href="https://web.whatsapp.com/send?phone='.$params["chat"].'" class="chat sq d-none d-lg-inline-flex" target="_blank"><i class="icon-chat"></i></a><a href="https://api.whatsapp.com/send?phone='.$params["chat"].'" class="chat sq d-lg-none" target="_blank"><i class="icon-chat"></i></a>':'';
        $images[0] = explode(',',$params['first_gallery_images']);
        $images[1] = explode(',',$params['second_gallery_images']);
        $images[2] = explode(',',$params['third_gallery_images']);
        
        $facebook = $params['facebook'] ? '<li><a href="'.$params['facebook'].'" target="_blank" class="icon-facebook"></a></li>' : '';
        $twitter = $params['twitter'] ? '<li><a href="'.$params['twitter'].'" target="_blank" class="icon-twitter"></a></li>' : '';
        $instagram = $params['instagram'] ? '<li><a href="'.$params['instagram'].'" target="_blank" class="icon-instagram"></a></li>' : '';
        $youtube = $params['youtube'] ? '<li><a href="'.$params['youtube'].'" target="_blank" class="icon-youtube"></a></li>' : '';
        $logo_url = wp_get_attachment_image_src($params["logo"], 'full');
        $logo .= $logo_url ? '<img class="logo" src="'.$logo_url[0].'"/>' : '';

        $gallery_content = array();
        for($i = 0; $i < count($images); $i++){
            $content = '';
            foreach ($images[$i] as $image) {
                $image_url = wp_get_attachment_image_src($image, 'full');
                $content .= $image_url ? '<img class="image" src="'.$image_url[0].'"/>' : '';
            }
            $gallery_content[$i] = $content;
        }


        $cs_page = '<div id="coming-soon" class="agc-cs-layout"> 
            <div class="gallery-container">
            <div class="agc-grid-gallery d-none d-lg-block">
                <div class="item">
                    <div class="gallery fade-in-gallery">'.$gallery_content[0].'</div>
                </div>
                <div class="item">
                    <div class="gallery fade-in-gallery">'.$gallery_content[1].'</div>
                </div>
                <div class="item">
                    <div class="gallery fade-in-gallery">'.$gallery_content[2].'</div>
                </div>
            </div>
            <div class="agc-swipe-gallery d-lg-none">
                <div class="item">
                    <div class="gallery fade-in-gallery">'.$gallery_content[0].$gallery_content[1].$gallery_content[2].'</div>
                </div>
            </div>
            </div>
            <div class="text-container">
                '.$logo.'
                <h1 class="title">'.$params['headline'].'</h1>
                <h2 class="cs-text">'.$params['short'].'</h2>
                <ul class="social-media '.$params['size'].'">
                '.$instagram.'
                '.$facebook.'
                '.$twitter.'
                '.$youtube.'
                </ul>
                <div class="contact-bar '.$params["color"].'">
                    <span class="book-now wide">Reach Out</span>
                    '.$email.'
                    '.$phone.'
                    '.$chat.'        
                </div>
            </div>
        </div>';

        return $cs_page;

    }
    add_shortcode( 'agc-cs-layout', 'cs_layout_callback');

    function create_vc_cs_layout(){
        vc_map([
            "category" => "agutcode",
            "name" => "Coming Soon Layout",
            "base" => "agc-cs-layout",
            "description" => "Create a banner including a gallery with selected images.",
            "show_settings_on_create" => true,
            "class" => "vc-project-details-block",
            "icon" => "icon-wpb-images-carousel",
            "params" => array(
                array(
                    "heading"       => "Logo",
                    "type"          => "attach_image",
                    "param_name"    => "logo",
                    "description"   => "Choose logo image",
                    "admin_label"   => true
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Headline", "agutcode"),
                  "param_name" => "headline",
                  "description" => __("Page Headline", "agutcode"),
                  "admin_label"   => true
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Description", "agutcode"),
                  "param_name" => "short",
                  "description" => __("Coming Soon text", "agutcode"),
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
                    "heading"       => "Social media icon's size",
                    "type"          => "dropdown",
                    "param_name"    => "size",
                    "description"   => "Select the size of the social network icons.",
                    "value"         => array(
                        "Small" => "small",
                        "Medium" => "medium",
                        "Large" => "large",
                    ),
                    "admin_label"   => true
                ),
                array(
                    "heading"       => "First Gallery Images",
                    "type"          => "attach_images",
                    "param_name"    => "first_gallery_images",
                    "description"   => "Choose images",
                    "admin_label"   => true
                ),
                array(
                    "heading"       => "Second Gallery Images",
                    "type"          => "attach_images",
                    "param_name"    => "second_gallery_images",
                    "description"   => "Choose images",
                    "admin_label"   => true
                ),
                array(
                    "heading"       => "Third Gallery Images",
                    "type"          => "attach_images",
                    "param_name"    => "third_gallery_images",
                    "description"   => "Choose images",
                    "admin_label"   => true
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
                    "heading"       => "Chat",
                    "type"          => "textfield",
                    "param_name"    => "chat",
                    "description"   => "Whatsapp phone number including country code.",
                    "value"         => '',
                    "admin_label"   => false
                ),
                array(
                  "type" => "dropdown",
                  "heading" => __("Contact bar color", "agutcode"),
                  "param_name" => "color",
                  "description" => __("contact bar color.", "agutcode"),      
                  "value"       => array(
                    "Black"  => "black",
                    "White" => "white",
                  ),
                  "std" => "Black",
                  "admin_label"   => true
                ),
            )
        ]);
    }
    add_action( 'vc_before_init', 'create_vc_cs_layout')
?>