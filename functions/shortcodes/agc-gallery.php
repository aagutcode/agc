<?php /* AGC Gallery Banner */
    function gallery_banner_callback($atts, $content=null){
        $params = shortcode_atts(array(
            'images' => '',
            'headline' => '',
            'extra_class' => ''
        ), $atts);
        $gallery_banner = '<div class="agc-gallery-banner">
        <span class="square"></span>
        <div class="gallery fade-in-gallery">';
        $images = explode(',',$params['images']);
        foreach ($images as $image) {
            $image_url = wp_get_attachment_image_src($image, 'full');
            $gallery_banner .= '<img class="image" src="'.$image_url[0].'"/>';
        }
        $gallery_banner .= '
            </div>
            <div class="heading"><h2>'.$params['headline'].'</h2></div>
        </div>';

        return $gallery_banner;

    }
    add_shortcode( 'agc-gallery-banner', 'gallery_banner_callback');

    function create_vc_gallery_banner(){
        vc_map([
            "category" => "agutcode",
            "name" => "Gallery Banner",
            "base" => "agc-gallery-banner",
            "description" => "Create a banner including a gallery with selected images.",
            "show_settings_on_create" => true,
            "class" => "vc-project-details-block",
            "icon" => "icon-wpb-images-carousel",
            "params" => array(
                array(
                    "heading"       => "Headline",
                    "type"          => "textfield",
                    "param_name"    => "headline",
                    "description"   => "Some intro text that describes you or your company",
                    "admin_label"   => true,
                    "value"       => ''
                ),
                array(
                    "heading"       => "Images",
                    "type"          => "attach_images",
                    "param_name"    => "images",
                    "description"   => "Choose images",
                    "admin_label"   => true
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
    add_action( 'vc_before_init', 'create_vc_gallery_banner')
?>