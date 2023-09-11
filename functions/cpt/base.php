<?php 
/*------------------------------------*\
	Custom Post Type Template
\*------------------------------------*/
function create_post_type_base()
{
    register_taxonomy_for_object_type('post_tag', 'base');
    register_post_type('base', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('bases', 'agutcode'), // Rename these to suit
            'singular_name' => __('base', 'agutcode'),
            'add_new' => __('Add New', 'agutcode'),
            'add_new_item' => __('Add New base', 'agutcode'),
            'edit' => __('Edit', 'agutcode'),
            'edit_item' => __('Edit base', 'agutcode'),
            'new_item' => __('New base', 'agutcode'),
            'view' => __('View base', 'agutcode'),
            'view_item' => __('View base', 'agutcode'),
            'search_items' => __('Search base', 'agutcode'),
            'not_found' => __('No bases found', 'agutcode'),
            'not_found_in_trash' => __('No bases found in Trash', 'agutcode')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard base for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag'
        ) // Add Post Tags support
    ));
} 
add_action('init', 'create_post_type_base'); // Add our AGUTCODE Custom Post Type