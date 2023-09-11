<?php //AGC Services 
// Shortcode para el elemento padre "servicios"
function servicios_callback($atts, $content = null) {
    return '<div class="agc-services">' . do_shortcode($content) . '</div>';
}
add_shortcode('services_container', 'servicios_callback');

// Shortcode para el elemento hijo "servicio"
function servicio_callback($atts) {
    $atts = shortcode_atts(array(
        'nombre' => '',
        'descripcion' => '',
    ), $atts);

    return '<div class="service-item">' .
            '<div class="service-title">
                <h2>' . esc_attr($atts['nombre']) . '</h2>
            </div>
            <p>' . esc_textarea($atts['descripcion']) . '</p>
        </div>';
}
add_shortcode('service_element', 'servicio_callback');

function create_vc_services() {
    // Registro del elemento padre "Servicios"
    vc_map(array(
        "name" => "Services Container",
        "base" => "services_container",
        "category" => "agutcode",
        "as_parent" => array('only' => 'service_element'), // Permitir elementos hijos "Servicio"
        "content_element" => true,
        "show_settings_on_create" => true,
        "params" => array(
            // Aquí puedes agregar parámetros adicionales para el elemento padre si es necesario
        ),
        "js_view" => 'VcColumnView',
    ));

    // Registro del elemento hijo "Servicio"
    vc_map(array(
        "name" => "Service Element",
        "base" => "service_element",
        "category" => "agutcode",
        "content_element" => true,
        "as_child" => array('only' => 'services_container'), // Indicar que solo puede ser hijo de "Servicios"
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => "Nombre del servicio",
                "param_name" => "nombre",
                "description" => "Ingrese el nombre del servicio",
                "admin_label" => true
            ),
            array(
                "type" => "textarea",
                "heading" => "Descripción del servicio",
                "param_name" => "descripcion",
                "description" => "Ingrese la descripción del servicio",
            ),
        ),
    ));
}
add_action('vc_before_init', 'create_vc_services');

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_services_container extends WPBakeryShortCodesContainer {
    }
  }
  if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_service_element extends WPBakeryShortCode {
    }
  }