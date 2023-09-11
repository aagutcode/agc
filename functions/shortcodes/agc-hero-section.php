<?php /* AGC Gallery Banner */
    function hero_section_callback($atts, $content=null){
        $params = shortcode_atts(array(
            'images' => '',
            'image' => '',
            'headline' => '',
            'extra_class' => ''
        ), $atts);

        $images = explode(',', $params['images']);
        
        $hero_section = '<div class="agc-hero-section">
            <div class="background-images">';
            foreach ($images as $image) {
                $n++;
                $image_url = wp_get_attachment_image_src($image, 'full');
                $hero_section .= '<img class="item-'.$n.'" src="'.$image_url[0].'" width="'.$image_url[1].'" height="'.$image_url[2].'" >';
            } 
            $hero_section .= '</div>
                <div class="wrapper">
                    <a href="'.home_url().'/the-artists" class="back-link"><i>←</i> DIRECTORY</a>
                    <div class="artist-info">
                        <h1 class="post-title">'.get_the_title().'</h1>
                        <p class="post-categories">'.agutcode_post_terms(get_the_ID(), "artist-category").'</p>                        
                    </div>
                </div>
                <div class="contact-bar white">
                    <a href="#" class="book-now wide">Book Now</a>
                    <a href="#" class="email sq"><i class="icon-mail"></i></a>
                    <a href="#" class="call sq"><i class="icon-phone"></i></a>
                    <a href="#" class="chat sq"><i class="icon-chat"></i></a>
                </div>
        </div>';

        return $hero_section;

    }
    add_shortcode( 'agc-hero-section', 'hero_section_callback');

    function create_vc_hero_section(){
        vc_map([
            "category" => "agutcode",
            "name" => "Hero Section",
            "base" => "agc-hero-section",
            "description" => "Create an animated hero section.",
            "show_settings_on_create" => true,
            "class" => "vc-project-details-block",
            "icon" => "vc_icon-vc-hoverbox",
            "params" => array(
                array(
                    "heading"       => "Background Images",
                    "type"          => "attach_images",
                    "param_name"    => "images",
                    "description"   => "Choose 2 to 4 images that represent this artist. Just the first one will be shown in the mobile version.",
                    "admin_label"   => true
                ),
                array(
                    "heading"       => "Artist Profile Picture",
                    "type"          => "attach_image",
                    "param_name"    => "image",
                    "description"   => "",
                    "admin_label"   => false
                ),
                array(
                    "heading"       => "Description",
                    "type"          => "textarea_html",
                    "param_name"    => "content",
                    "description"   => "Some intro text that describes you or your company",
                    "admin_label"   => true
                )
            )
        ]);
    }
    add_action( 'vc_before_init', 'create_vc_hero_section')
?>