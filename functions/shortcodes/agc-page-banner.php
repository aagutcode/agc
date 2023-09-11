<?php /* AGC Gallery Banner */
    function page_banner_callback($atts, $content=null){
        $params = shortcode_atts(array(
            'image' => '',
            'headline' => '',
            'extra_class' => ''
        ), $atts);
        
        $image_url = wp_get_attachment_image_src($params["image"],'full');
        $page_banner = '<div class="agc-page-banner">
            <div class="content">
                <div class="heading">
                    <h2 class="title">'.$params['headline'].'</h2>
                </div>
                <span class="square"></span>
                <div class="page-banner-image">
                    <img class="image" src="'.$image_url[0].'"/>
                </div>
                <div class="description">'.$content.'</div>
            </div>
        </div>';

        return $page_banner;

    }
    add_shortcode( 'agc-page-banner', 'page_banner_callback');

    function create_vc_page_banner(){
        vc_map([
            "category" => "agutcode",
            "name" => "Page Banner",
            "base" => "agc-page-banner",
            "description" => "Create a banner including a gallery with selected images.",
            "show_settings_on_create" => true,
            "class" => "vc-project-details-block",
            "icon" => "vc_icon-vc-hoverbox",
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
                    "type"          => "textarea_html",
                    "param_name"    => "content",
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
    add_action( 'vc_before_init', 'create_vc_page_banner')
?>