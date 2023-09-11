<?php /* AGC Gallery Banner */
    function main_banner_callback($atts, $content=null){
        $params = shortcode_atts(array(
            'image' => '',
            'headline' => '',
            'description' => '',
            'extra_class' => ''
        ), $atts);
        
        $img_url = wp_get_attachment_image_src($params["image"],'full');
        $main_banner = '<div class="agc-main-banner">
        <div class="heading"><h2>'.$params['headline'].'</h2></div>
        <span class="square"></span>
        <div class="main-banner-image">
            <img class="image" src="'.$image_url[0].'"/>
        </div>
        <div class="description">'.$params['description'].'</div>
        </div>';

        return $main_banner;

    }
    add_shortcode( 'agc-main-banner', 'main_banner_callback');

    function create_vc_main_banner(){
        vc_map([
            "category" => "agutcode",
            "name" => "Gallery Banner",
            "base" => "agc-main-banner",
            "description" => "Create a banner including a gallery with selected images.",
            "show_settings_on_create" => true,
            "class" => "vc-project-details-block",
            "icon" => "icon-wpb-images-carousel",
            "params" => array(
                array(
                    "heading"       => "Headline",
                    "type"          => "textfield",
                    "param_name"    => "headline",
                    "description"   => "Some headline that describes you or your company",
                    "admin_label"   => true,
                    "value"       => ''
                ),
                array(
                    "heading"       => "Image",
                    "type"          => "attach_image",
                    "param_name"    => "image",
                    "description"   => "Choose image",
                    "admin_label"   => true
                ),
                array(
                    "heading"       => "Description",
                    "type"          => "textarea",
                    "param_name"    => "description",
                    "description"   => "Some intro text that describes you or your company"
                ),
                array(
                    "heading"       => "Extra class",
                    "type"          => "textfield",
                    "param_name"    => "extra_class",
                    "description"   => "Custom classes for dev purposes",
                    "admin_label"   => false
                )
            )
        ]);
    }
    add_action( 'vc_before_init', 'create_vc_main_banner')
?>