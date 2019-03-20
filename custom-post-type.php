<?php
/*
* Creating a function to create our CPT
*/

function csv_post_type() {

// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'CSV IMPORT', 'Post Type General Name', 'twentythirteen' ),
        'singular_name'       => _x( 'CSV IMPORT', 'Post Type Singular Name', 'twentythirteen' ),
        'menu_name'           => __( 'CSV IMPORT', 'twentythirteen' ),
        // 'parent_item_colon'   => __( 'Parent Movie', 'twentythirteen' ),
        // 'all_items'           => __( 'All Movies', 'twentythirteen' ),
        // 'view_item'           => __( 'View Movie', 'twentythirteen' ),
        // 'add_new_item'        => __( 'Add New Movie', 'twentythirteen' ),
        // 'add_new'             => __( 'Add New', 'twentythirteen' ),
        // 'edit_item'           => __( 'Edit Movie', 'twentythirteen' ),
        // 'update_item'         => __( 'Update Movie', 'twentythirteen' ),
        // 'search_items'        => __( 'Search Movie', 'twentythirteen' ),
        'not_found'           => __( 'Not Found', 'twentythirteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
    );

// Set other options for Custom Post Type

    $args = array(
        'label'               => __( 'CSV IMPORT', 'twentythirteen' ),
        // 'description'         => __( 'Movie news and reviews', 'twentythirteen' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy.
        // 'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => false,
        'public'              => true,
        // 'show_ui'             => true,
        // 'show_in_menu'        => true,
        // 'show_in_nav_menus'   => true,
        // 'show_in_admin_bar'   => true,
        // 'menu_position'       => 5,
        // 'can_export'          => true,
        // 'has_archive'         => true,
        // 'exclude_from_search' => false,
        // 'publicly_queryable'  => true,
        // 'capability_type'     => 'page',
    );

    // Registering your Custom Post Type
    register_post_type( 'csv-import', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'csv_post_type', 0 )
