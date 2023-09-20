<?php 
function agregar_campo_personalizado_al_metabox_de_atributos($post) {
    if ('page' == $post->post_type) {
        // Recupera el valor actual del campo personalizado
        $valor_actual = get_post_meta($post->ID, 'header_type', true);

        // Define las opciones para el dropdown
        $opciones = array(
            'absolute' => 'Absoluto',
            'static' => 'Estático',
            'fixed' => 'Fijo',
            // Agrega más opciones según tus necesidades.
        );

        // Agregar el campo nonce
        wp_nonce_field('save_header_type_field', 'header_type_nonce');

        // Muestra el campo personalizado dentro del metabox de atributos de página
        ?>
        <p class="post-attributes-label-wrapper parent-id-label-wrapper">
            <label class="post-attributes-label" for="header_type">Tipo de Header</label>
        </p>
        <select id="header_type" name="header_type">
            <?php foreach ($opciones as $clave => $opcion) : ?>
                <option value="<?php echo esc_attr($clave); ?>" <?php selected($valor_actual, $clave); ?>><?php echo esc_html($opcion); ?></option>
            <?php endforeach; ?>
        </select>
        <?php
    }
}

function guardar_campo_personalizado_de_metabox_de_atributos($post_id) {
    // Verifica el nonce
    if (!isset($_POST['header_type_nonce']) || !wp_verify_nonce($_POST['header_type_nonce'], 'save_header_type_field')) {
        return $post_id;
    }

    // Guarda el valor del dropdown.
    if (isset($_POST['header_type'])) {
        $valor = sanitize_text_field($_POST['header_type']);
        update_post_meta($post_id, 'header_type', $valor);
        error_log('Valor guardado: ' . $valor); // Agrega esta línea para depuración
    }
}
add_action('save_post', 'guardar_campo_personalizado_de_metabox_de_atributos');
add_action('page_attributes_misc_attributes', 'agregar_campo_personalizado_al_metabox_de_atributos');
