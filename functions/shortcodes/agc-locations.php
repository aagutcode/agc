<?php //AGC Locations 

function locations_callback($atts) {
    $atts = shortcode_atts(array(
        'nombre' => '',
        'descripcion' => '',
    ), $atts);
    $args = array( 
        'post_type' => 'sucursal',
        'orderby' => 'title',
        'order' => 'ASC',
        'posts_per_page' => -1
    );
    $loop = new WP_Query( $args );   
    
    $results = '';  
    $select_options = '';
    $i = 0;

    while ( $loop->have_posts() ) : $loop->the_post();
    $select_options .= '<li class="option" data-value="'.$i.'">'.get_the_title().'</li>';
    ob_start(); // Iniciar el almacenamiento en búfer de salida para la plantilla
    get_template_part('location-card',null,array('index' =>$i));
    $results .= ob_get_clean(); // Agregar contenido almacenado en búfer a la variable
    $i++;
    endwhile; 
    wp_reset_query();
    $output = '
    <div class="agc-locations">
        <div class="row">
            <div class="col-lg-6">
                <div id="location-select">
                    <input type="text" class="selected-option" value="BUSCAR TIENDA" readonly />
                    <ul class="options-list">
                    '.$select_options.'
                    </ul>
                </div>
                '.$results.'
            </div>
            <div class="col-lg-6">
                <div id="map"></div>
            </div>
        </div>
    </div>';

    return $output;
}
add_shortcode('locations', 'locations_callback');

function create_vc_locations() {
    // Registro del elemento padre "locations"
    vc_map(array(
        "name" => "Sucursales",
        "base" => "locations",
        "category" => "agutcode",
        "as_parent" => array('only' => 'location_element'), // Permitir elementos hijos "location"
        "content_element" => true,
        "show_settings_on_create" => true,
        "params" => array(
            // Aquí puedes agregar parámetros adicionales para el elemento padre si es necesario
        ),
        "js_view" => 'VcColumnView',
    ));

}
add_action('vc_before_init', 'create_vc_locations');

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_locations_container extends WPBakeryShortCodesContainer {
    }
  }
  if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_location_element extends WPBakeryShortCode {
    }
  }