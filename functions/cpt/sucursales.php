<?php 
/*------------------------------------*\
	Custom Post Types Taxonomy
\*------------------------------------*/
function create_location_tags_taxonomy() {
 
    // Add new taxonomy, make it hierarchical like categories
    //first do the translations part for GUI
     
      $labels = array(
        'name' => _x( 'Tags', 'taxonomy general name' ),
        'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Tags' ),
        'all_items' => __( 'All Tag' ),
        'parent_item' => __( 'Parent Tag' ),
        'parent_item_colon' => __( 'Parent Tag:' ),
        'edit_item' => __( 'Edit Tag' ), 
        'update_item' => __( 'Update Tag' ),
        'add_new_item' => __( 'Add New Tag' ),
        'new_item_name' => __( 'New Tag Name' ),
        'menu_name' => __( 'Tags' ),
      );    
     
    // Now register the taxonomy
      register_taxonomy('location-tags',array('sucursal'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => false,
      ));
     
}
add_action( 'init', 'create_location_tags_taxonomy', 0 );
/*------------------------------------*\
	Custom Post Type Template
\*------------------------------------*/
function create_post_type_sucursal()
{
    register_post_type('sucursal', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Sucursales', 'agutcode'), // Rename these to suit
            'singular_name' => __('Sucursal', 'agutcode'),
            'add_new' => __('Add New', 'agutcode'),
            'add_new_item' => __('Add New Sucursal', 'agutcode'),
            'edit' => __('Edit', 'agutcode'),
            'edit_item' => __('Edit sucursal', 'agutcode'),
            'new_item' => __('New sucursal', 'agutcode'),
            'view' => __('View sucursal', 'agutcode'),
            'view_item' => __('View sucursal', 'agutcode'),
            'search_items' => __('Search sucursal', 'agutcode'),
            'not_found' => __('No sucursales found', 'agutcode'),
            'not_found_in_trash' => __('No sucursales found in Trash', 'agutcode')
        ),
        'public' => false,
        'exclude_from_search' => false,
        'public_queryable' => false,
        'query_var' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => false,
        'menu_icon' => 'dashicons-location-alt', 
        'supports' => array(
            'title',
            //'editor',
        ), // Go to Dashboard sucursales for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => [ 'location_tags'] 
    ));
} 
add_action('init', 'create_post_type_sucursal'); // Add our AGUTCODE Custom Post Type

// Agrega un campo para seleccionar una imagen desde la biblioteca de medios
function agregar_campo_image_location_tags($term) {
    $image_id = get_term_meta($term->term_id, 'image_id', true);
    $image_url = wp_get_attachment_url($image_id);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="image_id">Imagen</label>
        </th>
        <td>
            <input type="hidden" name="image_id" id="image_id" value="<?php echo esc_attr($image_id); ?>" />
            <div id="imagen-preview">
                <?php if ($image_url) : ?>
                    <img src="<?php echo esc_url($image_url); ?>" alt="Imagen seleccionada" style="max-width: 100px;" />
                <?php endif; ?>
            </div>
            <button id="cargar-imagen" class="button">Cargar Imagen</button>
            <button id="quitar-imagen" class="button">Quitar Imagen</button>
            <p class="description">Seleccione una imagen desde la biblioteca de medios.</p>
        </td>
    </tr>
    <?php
}
add_action('location-tags_add_form_fields', 'agregar_campo_image_location_tags');
add_action('location-tags_edit_form_fields', 'agregar_campo_image_location_tags', 10, 2);

// Enqueue scripts
function enqueue_custom_scripts() {
    wp_enqueue_media(); // Carga la biblioteca de medios de WordPress
    wp_enqueue_script('tax-wp-media', get_template_directory_uri() . '/assets/js/tax-wp-media.js', array('jquery'), '1.0', true);
}
add_action('admin_enqueue_scripts', 'enqueue_custom_scripts');

// Guarda el valor del campo personalizado cuando se guarda el término
function guardar_campo_image_location_tags($term_id) {
    if (isset($_POST['image_id'])) {
        update_term_meta($term_id, 'image_id', $_POST['image_id']);
    }
}
add_action('edited_location-tags', 'guardar_campo_image_location_tags');
add_action('create_location-tags', 'guardar_campo_image_location_tags');
