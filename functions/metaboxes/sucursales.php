<?php // Agrega los metaboxes al post type "Sucursal"
// Agrega los metaboxes al post type "Sucursal"
function agregar_metaboxes_sucursal() {
    add_meta_box('ubicacion_metabox', 'Ubicación', 'mostrar_metabox_ubicacion', 'sucursal', 'normal', 'default');
    add_meta_box('precios_metabox', 'Precios', 'mostrar_metabox_precios', 'sucursal', 'normal', 'default');
}
add_action('add_meta_boxes', 'agregar_metaboxes_sucursal');

// Callback para el metabox "Ubicación"
function mostrar_metabox_ubicacion($post) {
    $direccion = get_post_meta($post->ID, 'direccion', true);
    $gmaps_url = get_post_meta($post->ID, 'gmaps', true);
    $latitud = get_post_meta($post->ID, 'latitud', true);
    $longitud = get_post_meta($post->ID, 'longitud', true);
    ?>
    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion" value="<?php echo esc_attr($direccion); ?>" /><br />
    <label for="direccion">Link google Maps:</label>
    <input type="text" id="gmaps" name="gmaps" value="<?php echo esc_attr($gmaps_url); ?>" /><br />
    <label for="latitud">Latitud:</label>
    <input type="text" id="latitud" name="latitud" value="<?php echo esc_attr($latitud); ?>" /><br />
    <label for="longitud">Longitud:</label>
    <input type="text" id="longitud" name="longitud" value="<?php echo esc_attr($longitud); ?>" />
    <?php
}

// Resto de los callbacks y funciones de guardado se mantienen igual


// Callback para el metabox "Precios"
function mostrar_metabox_precios($post) {
    $precio_diesel = get_post_meta($post->ID, 'precio_diesel', true);
    $precio_sp95 = get_post_meta($post->ID, 'precio_sp95', true);
    echo '<label for="precio_diesel">Precio Diesel:</label> ';
    echo '<input type="text" id="precio_diesel" name="precio_diesel" value="' . esc_attr($precio_diesel) . '" /> €/L<br />';
    echo '<label for="precio_sp95">Precio SP95:</label> ';
    echo '<input type="text" id="precio_sp95" name="precio_sp95" value="' . esc_attr($precio_sp95) . '" /> €/L';
}

// Guarda los datos de los metaboxes al actualizar el post
function guardar_metaboxes_sucursal($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $campos = array('direccion','gmaps', 'precio_diesel', 'precio_sp95', 'latitud', 'longitud');

    foreach ($campos as $campo) {
        if (isset($_POST[$campo])) {
            update_post_meta($post_id, $campo, sanitize_text_field($_POST[$campo]));
        }
    }
}
add_action('save_post', 'guardar_metaboxes_sucursal');
