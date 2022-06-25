<?php

function portfolio_init() {
    $labels = array(
        'name' => _x('Portfolio', 'Post type general name', 'billykulpa2022'),
        'singular_name' => _x('Portfolio Item', 'Post type singular name', 'billykulpa2022'),
        'menu_name' => _x('Portfolio', 'Admin Menu text', 'billykulpa2022'),
        'name_admin_bar' => _x('Portfolio', 'Add New on Toolbar', 'billykulpa2022'),
        'add_new' => __('Add new', 'billykulpa2022'),
        'add_new_item' => __('Add new portfolio item', 'billykulpa2022'),
        'new_item' => __('New portfolio item', 'billykulpa2022'),
        'edit_item' => __('Edit portfolio item', 'billykulpa2022'),
        'view_item' => __('View portfolio', 'billykulpa2022'),
        'all_items' => __('All portfolio items', 'billykulpa2022'),
        'search_items' => __('Search portfolio', 'billykulpa2022'),
        'parent_item_colon' => __('Parent portfolio item:', 'billykulpa2022'),
        'not_found' => __('No portfolio items found.', 'billykulpa2022'),
        'not_found_in_trash' => __('No portfolio items found in Trash.', 'billykulpa2022'),
        'featured_image' => _x('Portfolio item preview image', 'Overrides the "Featured Image" phrase for this post type. Added in 4.3', 'billykulpa2022'),
        'set_featured_image' => _x('Set portfolio item preview image', 'Overrides the "Set featured image" phrase for this post type. Added in 4.3', 'billykulpa2022'),
        'remove_featured_image' => _x('Remove portfolio item preview image', 'Overrides the "Remove featured image" phrase for this post type. Added in 4.3', 'billykulpa2022'),
        'use_featured_image' => _x('Use as portfolio item preview image', 'Overrides the "Use as featured image" phrase for this post type. Added in 4.3', 'billykulpa2022'),
        'archives' => _x('Portfolio archives', 'The post type archive label used in nav menus. Default "Post Archives". Added in 4.4', 'billykulpa2022'),
        'insert_into_item' => _x('Insert into portfolio item', 'Overrides the "Insert into post"/"Insert into page" phrase (used when inserting media into a post). Added in 4.4', 'billykulpa2022'),
        'uploaded_to_this_item' => _x('Uploaded to this portfolio item', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase (used when viewing media attached to a post). Added in 4.4', 'billykulpa2022'),
        'filter_items_list' => _x('Filter portfolio items list', 'Screen reader text for the filter links heading on the post type listing screen. Default "Filter posts list"/"Filter pages list". Added in 4.4', 'billykulpa2022'),
        'items_list_navigation' => _x('Portfolio items list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default "Posts list navigation"/"Pages list navigation". Added in 4.4', 'billykulpa2022'),
        'items_list' => _x('Portfolio items list', 'Screen reader text for the items list heading on the post type listing screen. Default "Posts list"/"Pages list". Added in 4.4', 'billykulpa2022'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-portfolio',
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'query_var' => false,
        'rewrite' => array('slug' => 'portfolio', 'with_front' => false),
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 4,
        // 'map_meta_cap'          => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author', 'revisions', 'custom-fields', 'post-formats'),
        'taxonomies' => array('post_tag', 'category'),
    );

    register_post_type('portfolio-item', $args);
}

add_action('init', 'portfolio_init');





// THIS RECONFIGURES THE COLUMNS FOR THE MEDIA APPEARANCES ADMIN SCREEN
add_filter( 'manage_edit-portfolio-item_columns', 'my_edit_portfolio_item_columns' ) ;

function my_edit_portfolio_item_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => __( 'Title' ),
        'year' => __( 'Year' ),
        'portfolio_type' => __( 'Type' ),
        'date' => __( 'Page Created' )
    );
    return $columns;
}



// THIS POPULATES THE COLUMNS WE SET IN THE ABOVE STEP
add_action( 'manage_portfolio-item_posts_custom_column', 'my_manage__portfolio_item_columns', 10, 2 );

function my_manage__portfolio_item_columns( $column, $post_id ) {
    global $post;

    // vars
    $year = get_field('year');
    $portfolio_type = get_field('portfolio_type');
    $portfolio_type_counter = 0;
    $total_portfolio_type_count = count($portfolio_type);

    switch( $column ) {

        /* If displaying the 'portfolio_type' column. */
        case 'portfolio_type' :

            /* If no portfolio_type is set, output a default message. */
            if(empty($portfolio_type))
                echo __('Not set');
            /* If there is a portfolio_type set, let's show the name of it. */
            else
                foreach($portfolio_type as $type) :
                    echo $type['label']; if($portfolio_type_counter != $total_portfolio_type_count - 1) : echo ', '; endif; $portfolio_type_counter++; endforeach;
                // echo $portfolio_type_label;
            break;

        /* If displaying the 'year' column. */
        case 'year' :

            /* If no year is set, output a default message. */
            if(empty($year))
                echo __('Not set');
            /* If there is a year set, let's show the name of it. */
            else
                echo $year;
            break;

        /* Just break out of the switch statement for everything else. */
        default :
            break;
    }
}



// THIS SETS THE DEFAULT SORT
add_action('pre_get_posts', 'portfolio_item_default_order', 99);

function portfolio_item_default_order($query) {
    if ($query->get('post_type') == 'portfolio-item') {
        if ($query->get('orderby') == '') {
            $query->set('orderby', 'meta_value');
            $query->set('meta_query', array(
                'year' => array(
                    'key' => 'year',
                ),
                'portfolio_type' => array(
                    'key' => 'portfolio_type',
                ),
            ));
        }
        if ($query->get('order') == '') {
            $query->set('orderby', array(
                'year' => 'DESC', 
                'portfolio_type' => 'ASC', 
                'title' => 'ASC'
            )); 
        }
    }
}



// THIS ENABLES SORTING FUNCTION BY CUSTOM FIELDS
add_filter( 'manage_edit-portfolio-item_sortable_columns', 'my_portfolio_item_sortable_columns' ); // BE VERY CAREFUL HERE. 'portfolio-item' IS THE POST TYPE

function my_portfolio_item_sortable_columns( $columns ) {
    $columns['year'] = 'year';
    $columns['portfolio_type'] = 'portfolio_type';
    return $columns;
}




// THIS LETS US SORT BY THE SPECIFIC META KEY

/* Only run our customization on the 'edit.php' page in the admin. */
add_action( 'load-edit.php', 'my_edit_portfolio_item_load' );

function my_edit_portfolio_item_load() {
    add_filter( 'request', 'my_sort_portfolio_item' );
}


/* Sorts the portfolio_items. */
function my_sort_portfolio_item( $vars ) {
    /* Check if we're viewing the 'portfolio-item' post type. */
    if ( isset( $vars['post_type'] ) && 'portfolio-item' == $vars['post_type'] ) {
        /* Check if 'orderby' is set to 'year'. */
        if ( isset( $vars['orderby'] ) && 'year' == $vars['orderby'] ) { // DON'T use the groupname_subfieldname syntax
            /* Merge the query vars with our custom variables. */

            $vars = array_merge(
                $vars,
                array(
                    'meta_key'  =>  'year', // DO use the groupname_subfieldname syntax
                    'order'     =>  'DESC',
                    'orderby'   =>  'meta_value meta_value_num'
                )
            );
        }
    }
    return $vars;
}