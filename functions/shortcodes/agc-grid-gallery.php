<?php /* AGC Grid Gallery */
    function grid_gallery_callback($atts, $content=null){
        $params = shortcode_atts(array(
            'first_gallery_images' => '',
            'second_gallery_images' => '',
            'third_gallery_images' => ''
        ), $atts);

        $images[0] = explode(',',$params['first_gallery_images']);
        $images[1] = explode(',',$params['second_gallery_images']);
        $images[2] = explode(',',$params['third_gallery_images']);

        $gallery_content = array();
        for($i = 0; $i < count($images); $i++){
            $content = '';
            foreach ($images[$i] as $image) {
                $image_url = wp_get_attachment_image_src($image, 'full');
                $content .= $image_url ? '<img class="image" src="'.$image_url[0].'"/>' : '';
            }
            $gallery_content[$i] = $content;
        }


        $grid_gallery = '<div class="agc-grid-gallery">
        <div class="item">
            <div class="gallery fade-in-gallery">'.$gallery_content[0].'</div>
        </div>
        <div class="item">
            <div class="gallery fade-in-gallery">'.$gallery_content[1].'</div>
        </div>
        <div class="item">
            <div class="gallery fade-in-gallery">'.$gallery_content[2].'</div>
        </div>
        </div>';

        return $grid_gallery;

    }
    add_shortcode( 'agc-grid-gallery', 'grid_gallery_callback');

    function create_vc_grid_gallery(){
        vc_map([
            "category" => "agutcode",
            "name" => "Grid Gallery",
            "base" => "agc-grid-gallery",
            "description" => "Create a banner including a gallery with selected images.",
            "show_settings_on_create" => true,
            "class" => "vc-project-details-block",
            "icon" => "icon-wpb-images-carousel",
            "params" => array(
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
            )
        ]);
    }
    add_action( 'vc_before_init', 'create_vc_grid_gallery')
?>