<?php

function theme_billykulpa2022_scripts()
{
    // page vars
    $page = get_field('page');
    $minimize_header = $page['minimal_header'];
    $minimize_footer = $page['minimize_footer'];
    // remove jquery
    if(!is_admin()) : wp_deregister_script('jquery'); endif;
    // css
    wp_enqueue_style('billykulpa2022-custom.css', get_template_directory_uri() . '/assets/css/custom.css', array(), STYLE_VERSION);
    // js
    if(is_page(25)) : // 25 is portfolio page
        wp_enqueue_script('mixitup.min.js', get_template_directory_uri() . '/plugins/patrickkunka-mixitup-61dac05/dist/mixitup.min.js', '', STYLE_VERSION, true);
        wp_enqueue_script('mixitup-multifilter.min.js', get_template_directory_uri() . '/plugins/patrickkunka-mixitup-multifilter/dist/mixitup-multifilter.min.js', '', STYLE_VERSION, true);
        wp_enqueue_script('mixitup-initializer.js', get_template_directory_uri() . '/assets/js/mixitup-initializer.js', '', STYLE_VERSION, true);
    endif;
    wp_enqueue_script('bodyScrollLock.min.js', get_template_directory_uri() . '/plugins/body-scroll-lock-master/lib/bodyScrollLock.min.js', '', STYLE_VERSION, true);
    if(has_block('acf/faqs-module')) :
        wp_enqueue_script('billykulpa2022-faqs-module.js', get_template_directory_uri() . '/assets/js/faqs-module.js', '', STYLE_VERSION, true);
    endif;
    if(!$minimize_header) :
        wp_enqueue_script('billykulpa2022-header-has-nav.js', get_template_directory_uri() . '/assets/js/header-has-nav.js', '', STYLE_VERSION, true);
    else :
        wp_enqueue_script('billykulpa2022-smooth-scroll.js', get_template_directory_uri() . '/assets/js/smooth-scroll.js', '', STYLE_VERSION, true);
    endif;
}
add_action('wp_enqueue_scripts', 'theme_billykulpa2022_scripts');



// Enqueue admin panel stylesheet
function load_admin_style()
{
    wp_enqueue_style('billykulpa2022-admin.css', get_template_directory_uri() . '/assets/css/admin.css', array(), STYLE_VERSION);
}
add_action( 'admin_enqueue_scripts', 'load_admin_style' );



// Defer specific scripts
function billykulpa2022_defer_scripts( $tag, $handle, $src )
{
    $defer = array(
        'bodyScrollLock.min.js',
        'billykulpa2022-header-has-nav.js',
        'billykulpa2022-nav-search',
        'billykulpa2022-custom.js'
    );
    if ( in_array( $handle, $defer ) ) {
        return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
    }
    
    return $tag;
} 
add_filter( 'script_loader_tag', 'billykulpa2022_defer_scripts', 10, 3 );


// Inline critical CSS
function billykulpa2022_inline_critical_css()
{
    get_template_part('assets/css/critical-css-minified');
}
add_action('wp_head', 'billykulpa2022_inline_critical_css');


// Preload all CSS
function billykulpa2022_preload_css($html, $handle, $href, $media) {
    if (is_admin())
        return $html;

    $html = <<<EOT
<link rel='preload' as='style' onload="this.onload=null;this.rel='stylesheet'" id='$handle' href='$href' type='text/css' media='all' /><noscript><link rel='stylesheet' href='$href'></noscript>
EOT;
    return $html;
}
// add_filter( 'style_loader_tag', 'billykulpa2022_preload_css', 10, 4 );


// Remove Contact Form 7 *except* on specified pages
function billykulpa2022_deregister_javascript_css()
{
    if(!is_page([20])) { // 20 is contact
        wp_deregister_script('contact-form-7');
        wp_deregister_style('contact-form-7');
    }
}
add_action( 'wp_enqueue_scripts', 'billykulpa2022_deregister_javascript_css', 100 );



// Dequeue WordPress block library
function smartwp_remove_wp_block_library_css()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
}
if(!is_single()) {
    add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );
}



function wporg_block_wrapper( $block_content, $block )
{
    if ( $block['blockName'] === 'core/group' ) {
        // first get the 'attrs' array
        $attrs = $block['attrs'];
        // then start on the className key/value
        $className = 'section';
        if( !empty($attrs['className']) ) {
            $className .= ' ';
            $className .= $attrs['className'];
        }
        $content = '<section class="' . esc_attr($className) . '"><div class="container">';
//        $content .= var_dump($block);
        $content .= $block_content;
        $content .= '</div></section>';
        return $content;
    } elseif ( $block['blockName'] === 'core/heading' ) {
        $content .= $block_content;
        return $content;
    } elseif ( $block['blockName'] === 'core/image' ) {
        $content = '<div class="image-container">';
        $content .= $block_content;
        $content .= '</div>';
        return $content;
    } elseif ( $block['blockName'] === 'core/paragraph' ) {
        $content .= $block_content;
        return $content;
    } elseif ( $block['blockName'] === 'core/quote' ) {
        $content = $block_content;
        return $content;
    } elseif ( $block['blockName'] === 'core/list' ) {
        $content .= $block_content;
        return $content;
    }
    return $block_content;
}
 
add_filter( 'render_block', 'wporg_block_wrapper', 10, 2 );