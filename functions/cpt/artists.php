<?php 
/*------------------------------------*\
	Custom Post Types Taxonomy
\*------------------------------------*/
function create_artists_category_taxonomy() {
 
    // Add new taxonomy, make it hierarchical like categories
    //first do the translations part for GUI
     
      $labels = array(
        'name' => _x( 'Categories', 'taxonomy general name' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search categories' ),
        'all_items' => __( 'All Categories' ),
        'parent_item' => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item' => __( 'Edit Category' ), 
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add New Category' ),
        'new_item_name' => __( 'New Category Name' ),
        'menu_name' => __( 'Categories' ),
      );    
     
    // Now register the taxonomy
      register_taxonomy('artist-category',array('artist'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => false,
      ));
     
}
add_action( 'init', 'create_artists_category_taxonomy', 0 );
/*------------------------------------*\
	Custom Post Types Taxonomy
\*------------------------------------*/
function create_artists_business_taxonomy() {
 
  // Add new taxonomy, make it hierarchical like categories
  //first do the translations part for GUI
   
    $labels = array(
      'name' => _x( 'Business', 'taxonomy general name' ),
      'singular_name' => _x( 'Business', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search categories' ),
      'all_items' => __( 'All Business' ),
      'parent_item' => __( 'Parent Business' ),
      'parent_item_colon' => __( 'Parent Business:' ),
      'edit_item' => __( 'Edit Business' ), 
      'update_item' => __( 'Update Business' ),
      'add_new_item' => __( 'Add New Business' ),
      'new_item_name' => __( 'New Business Name' ),
      'menu_name' => __( 'Business' ),
    );    
   
  // Now register the taxonomy
    register_taxonomy('artist-business',array('artist'), array(
      'hierarchical' => true,
      'labels' => $labels,
      'show_ui' => true,
      'show_in_rest' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewrite' => false,
    ));
   
}
add_action( 'init', 'create_artists_business_taxonomy', 0 );

function create_artists_location_taxonomy() {
 
    // Add new taxonomy, make it hierarchical like categories
    //first do the translations part for GUI
     
      $labels = array(
        'name' => _x( 'Location', 'taxonomy general name' ),
        'singular_name' => _x( 'Location', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Locations' ),
        'all_items' => __( 'All Location' ),
        'parent_item' => __( 'Parent Location' ),
        'parent_item_colon' => __( 'Parent Location:' ),
        'edit_item' => __( 'Edit Location' ), 
        'update_item' => __( 'Update Location' ),
        'add_new_item' => __( 'Add New Location' ),
        'new_item_name' => __( 'New Location Name' ),
        'menu_name' => __( 'Locations' ),
      );    
     
    // Now register the taxonomy
      register_taxonomy('artist-location',array('artist'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => false,
      ));
     
}
add_action( 'init', 'create_artists_location_taxonomy', 0 );

/*------------------------------------*\
	Custom Post Type artist
\*------------------------------------*/
// Create 1 Custom Post type for a Demo, called Events
function create_post_type_artist()
{
    register_post_type('artist', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Artists', 'agutcode'), // Rename these to suit
            'singular_name' => __('Artist', 'agutcode'),
            'add_new' => __('Add New', 'agutcode'),
            'add_new_item' => __('Add New Artist', 'agutcode'),
            'edit' => __('Edit', 'agutcode'),
            'edit_item' => __('Edit artist', 'agutcode'),
            'new_item' => __('New artist', 'agutcode'),
            'view' => __('View artist', 'agutcode'),
            'view_item' => __('View artist', 'agutcode'),
            'search_items' => __('Search artist', 'agutcode'),
            'not_found' => __('No artists found', 'agutcode'),
            'not_found_in_trash' => __('No artists found in Trash', 'agutcode')
        ),
        'public' => true,
        'exclude_from_search' => false,
        'public_queryable' => true,
        'query_var' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => false,
        'menu_icon'   => 'dashicons-groups',
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ), // Go to Dashboard Event for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => [ 'artist-category', 'artist-business', 'artist-location'] 
    ));
} 
add_action('init', 'create_post_type_artist'); // Add our AGUTCODE Custom Post Type