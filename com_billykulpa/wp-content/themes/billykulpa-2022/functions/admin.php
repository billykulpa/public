<?php

// Remove unused admin menus
add_action( 'admin_menu', 'remove_menu_items' );
function remove_menu_items() {
    remove_menu_page('link-manager.php');
    remove_menu_page('edit-comments.php');

    $user = wp_get_current_user();
    if ( !in_array( 'administrator', (array) $user->roles ) ) {
        //remove if not an administrator
        remove_menu_page('tools.php');
    }
}

add_action( 'admin_menu' , 'add_submenu_options' );
function add_submenu_options() {
    global $submenu;
    $submenu['edit.php?post_type=page'][] = ['CMS Guide', 'editor', '/cms'];
}

// Remove Patterns tab from Gutenberg block selector
add_action( 'after_setup_theme', 'remove_core_patterns' );
function remove_core_patterns() {
    remove_theme_support('core-block-patterns');
    //unregister_block_pattern_category('buttons');
    //unregister_block_pattern_category('columns');
    //unregister_block_pattern_category('gallery');
    //unregister_block_pattern_category('header');
    //unregister_block_pattern_category('text');
    //unregister_block_pattern_category('uncategorized');
}

// Allowlist only the most essential blocks for non-admins
add_filter( 'allowed_block_types', 'fabtech_allowed_block_types' );
function fabtech_allowed_block_types() {
    $user = wp_get_current_user();
    $block_types = WP_Block_Type_Registry::get_instance()->get_all_registered();

    //Include all blocks registered by Advanced Custom Fields
    $acf_blocks = [];
    foreach($block_types as $key => $value) {
        if (stristr($key,'acf/')) {
            $acf_blocks[] = $key;
        }
    }

    //remove core blocks
    $core_blocks = [];

    //if editing or creating a new post, allow a few basic core blocks
    if (function_exists('get_current_screen') && get_current_screen()->post_type == 'post') {
        $core_blocks = [
            //'core/image',
            //'core/gallery',
            'core/paragraph',
            'core/heading',
            'core/list',
            'core/shortcode',
            //'core/embed',
            'core/table'
        ];
    } elseif (function_exists('get_current_screen') && get_current_screen()->post_type != 'post') {
        //remove blog-only blocks if not on a post
        if (($key = array_search('acf/responsive-image', $acf_blocks)) !== false) {
            unset($acf_blocks[$key]);
        }
        $core_blocks = [
            //'core/image',
            //'core/gallery',
            'core/paragraph',
            'core/heading',
            'core/list',
            'core/shortcode',
            //'core/embed'
        ];
    }

    //Individual embed blocks (YouTube, Vimeo, etc.) apparently can't be edited in PHP
    //See the allowlist in assets/js/admin/disable-embed-blocks.jpg
    /*if ( !in_array( 'administrator', (array) $user->roles ) ) {
        wp_enqueue_script(
            'disable-embed-blocks',
            get_template_directory_uri() . '/assets/js/admin/disable-embed-blocks.js',
            [ 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ]
        );
    }*/

    return array_merge($acf_blocks, $core_blocks);
}