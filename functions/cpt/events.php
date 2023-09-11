<?php 
/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/
// Create 1 Custom Post type for a Demo, called Events
function create_post_type_event()
{
    register_taxonomy_for_object_type('post_tag', 'event');
    register_post_type('event', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Events', 'agutcode'), // Rename these to suit
            'singular_name' => __('Event', 'agutcode'),
            'add_new' => __('Add New', 'agutcode'),
            'add_new_item' => __('Add New Event', 'agutcode'),
            'edit' => __('Edit', 'agutcode'),
            'edit_item' => __('Edit Event', 'agutcode'),
            'new_item' => __('New Event', 'agutcode'),
            'view' => __('View Event', 'agutcode'),
            'view_item' => __('View Event', 'agutcode'),
            'search_items' => __('Search Event', 'agutcode'),
            'not_found' => __('No Events found', 'agutcode'),
            'not_found_in_trash' => __('No Events found in Trash', 'agutcode')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Event for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag'
        ) // Add Post Tags support
    ));
} 
add_action('init', 'create_post_type_event'); // Add our AGUTCODE Custom Post Type