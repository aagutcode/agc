<?php /* AGC Animated Counter */
    function animated_counter_callback($atts, $content=null){
        $params = shortcode_atts(array(
            'number' => '1',
            'title' => '',
            'color' => '#',
            'extra_class' => ''
        ), $atts);
        
        $color = $params["color"] ? 'style="color:'.$params["color"].'"' : '';
        $animated_counter = '<div class="agc-animated-counter" '.$color.'>
            <span class="counter">'.$params['number'].'</span>
            <h3 class="counter-title">'.$params['title'].'</h3>
        </div>';

        return $animated_counter;

    }
    add_shortcode( 'agc-animated-counter', 'animated_counter_callback');

    function create_vc_animated_counter(){
        vc_map([
            "category" => "agutcode",
            "name" => "Animated Counter",
            "base" => "agc-animated-counter",
            "description" => "Animate a number from 0.",
            "show_settings_on_create" => true,
            "class" => "vc-project-details-block",
            "icon" => "vc_icon-vc-hoverbox",
            "params" => array(
                array(
                    "heading"       => "Number",
                    "type"          => "textfield",
                    "param_name"    => "number",
                    "description"   => "Stats number",
                    "admin_label"   => true,
                    "value"       => ''
                ),
                array(
                    "heading"       => "Title",
                    "type"          => "textfield",
                    "param_name"    => "title",
                    "description"   => "What's this stat name?",
                    "admin_label"   => true,
                    "value"       => ''
                ),
                array(
                    "heading"       => "Text Color",
                    "type"          => "colorpicker",
                    "param_name"    => "color",
                    "description"   => "Choose text color",
                    "value"         => "",
                    "admin_label"   => false
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
    add_action( 'vc_before_init', 'create_vc_animated_counter')
?>