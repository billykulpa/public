<?php

/* Set theme support */
add_theme_support('menus');
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_post_type_support('page','excerpt');

// make sure wordpress isn't overcompressing images
add_filter('jpeg_quality', function($arg){return 100;});

// Add custom image sizes
if (function_exists('add_image_size')) {
	add_image_size('size_1920', 1920, 9999, false); // 1920 pixels wide by proportional pixels tall, soft proportional crop mode
	add_image_size('size_1600', 1600, 9999, false); // 1600 pixels wide by proportional pixels tall, soft proportional crop mode
	add_image_size('size_1500', 1500, 9999, false); // 1500 pixels wide by proportional pixels tall, soft proportional crop mode
	add_image_size('size_1400', 1400, 9999, false); // 1400 pixels wide by proportional pixels tall, soft proportional crop mode
	add_image_size('size_1300', 1300, 9999, false); // 1300 pixels wide by proportional pixels tall, soft proportional crop mode
	add_image_size('size_1200', 1200, 9999, false); // 1200 pixels wide by proportional pixels tall, soft proportional crop mode
	add_image_size('size_1100', 1100, 9999, false); // 1100 pixels wide by proportional pixels tall, soft proportional crop mode
	add_image_size('size_1000', 1000, 9999, false); // 1000 pixels wide by proportional pixels tall, soft proportional crop mode
	add_image_size('size_900', 900, 9999, false); // 900 pixels wide by proportional pixels tall, soft proportional crop mode
	add_image_size('size_800', 800, 9999, false); // 800 pixels wide by proportional pixels tall, soft proportional crop mode
	add_image_size('size_700', 700, 9999, false); // 700 pixels wide by proportional pixels tall, soft proportional crop mode
	add_image_size('size_600', 600, 9999, false); // 600 pixels wide by proportional pixels tall, soft proportional crop mode
	add_image_size('size_500', 500, 9999, false); // 500 pixels wide by proportional pixels tall, soft proportional crop mode
	add_image_size('size_400', 400, 9999, false); // 400 pixels wide by proportional pixels tall, soft proportional crop mode
	add_image_size('size_300', 300, 9999, false); // 300 pixels wide by proportional pixels tall, soft proportional crop mode
	add_image_size('size_200', 200, 9999, false); // 200 pixels wide by proportional pixels tall, soft proportional crop mode
	add_image_size('size_800_square', 800, 800, array('center', 'center')); // 800 pixels wide by 800 pixels tall, hard centered crop
	add_image_size('size_700_square', 700, 700, array('center', 'center')); // 700 pixels wide by 700 pixels tall, hard centered crop
	add_image_size('size_600_square', 600, 600, array('center', 'center')); // 600 pixels wide by 600 pixels tall, hard centered crop
	add_image_size('size_500_square', 500, 500, array('center', 'center')); // 500 pixels wide by 500 pixels tall, hard centered crop
	add_image_size('size_400_square', 400, 400, array('center', 'center')); // 400 pixels wide by 400 pixels tall, hard centered crop
	add_image_size('size_300_square', 300, 300, array('center', 'center')); // 300 pixels wide by 300 pixels tall, hard centered crop
	add_image_size('size_200_square', 200, 200, array('center', 'center')); // 200 pixels wide by 200 pixels tall, hard centered crop
	add_image_size('size_100_square', 100, 100, array('center', 'center')); // 100 pixels wide by 100 pixels tall, hard centered crop
	add_image_size('size_768_512', 768, 512, array('center', 'center')); // crop
}

// SEO friendly URLs
// result: SEO Frinedly URL out by replacing spaces and special characters with slash(/)
function slugify($text)
{
	// begin by removing single quotes
	$text = str_replace("'", "", $text);
	// replace non letter or digits by -
	$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	// trim
	$text = trim($text, '-');
	// lowercase
	$text = strtolower($text);
	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);
	if (empty($text))
	{
		return 'n-a';
	}
	return $text;
}


// Custom excerpts!
function bac_manual_auto_excerpt($text, $length='25') {
    global $post;
    $raw_excerpt = $text;
    if('' == $text) {
        $text = get_the_content('');
        $text = strip_shortcodes($text);
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);
    }    
    //$text = strip_tags($text);
    $headlines = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
    $replacement_headlines = 'p';
    $text = str_replace($headlines, $replacement_headlines, $text);
    /*** Change the excerpt words length. If you like. ***/
    $excerpt_word_count = $length;
    $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count); 
    $tokens = array();
    $excerptOutput = '';
    $count = 0;

    // Divide the string into tokens; HTML tags, or words, followed by any whitespace
    preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $text, $tokens);

    foreach($tokens[0] as $token) { 
        if($count >= $excerpt_word_count && preg_match('/[\?\.\!]\s*$/uS', $token)) { 
            // Limit reached, continue until , ; ? . or ! occur at the end
            $excerptOutput .= trim($token);
            break;
        }
        // Add words to complete sentence
        $count++;
        // Append what's left of the token
        $excerptOutput .= $token;
    }

    /*** Change the Excerpt ending. If you like. ***/
    $excerpt_end = ''; 
    $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);

    $text = trim(force_balance_tags($excerptOutput));
        $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end); 
        $text .= $excerpt_end; /*Add read more in new paragraph */

    return $text;   
}
add_filter('get_the_excerpt', 'bac_manual_auto_excerpt', 5);


/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
 	}

	return $urls;
}

/**
 * Remove WordPress duotone SVGs
 */
function remove_svg_global_styles() {
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
	remove_action( 'in_admin_header', 'wp_global_styles_render_svg_filters' );
}
add_action('after_setup_theme', 'remove_svg_global_styles', 10, 0);

// Add all ancestries to body class for parents
add_filter('body_class', 'billykulpa2022_parent_body_class');
function billykulpa2022_parent_body_class($classes) {
	global $post;
	if(is_page()):
		// vars
		$ancestors = get_post_ancestors($post);
		if(in_array(2218,$ancestors)) :
			$classes[] = 'industry-page';
		endif;
	endif;
	return $classes;
}

// Add Custom Types to category links
function billykulpa2022_cpt_in_categories( $query ){
    if(!is_admin()
        && $query->is_category()
        && $query->is_main_query() ) {
            $query->set('post_type', array('post', 'portfolio'));
        }
}
add_action( 'pre_get_posts', 'billykulpa2022_cpt_in_categories' );

// Menus
function billykulpa2022_menus()
{
	$locations = array(
		'primary' => __('Main Menu', 'billykulpa2022'),
		'footer' => __('Footer', 'billykulpa2022'),
	);
	register_nav_menus($locations);
}
add_action('init', 'billykulpa2022_menus');

function get_primary_menu_items()
{
	$menu_name = 'primary';
	$locations = get_nav_menu_locations();
	$menu_items = wp_get_nav_menu_items($locations[$menu_name]);
	$menu = [];

	foreach ($menu_items as $menu_item) {
		$item = [
			'title' => $menu_item->title,
			'url' => $menu_item->url,
			'description' => $menu_item->description,
			'classes' => $menu_item->classes,
			'attr_title' => $menu_item->attr_title,
			'target' => $menu_item->target,
		];

		if($menu_item->menu_item_parent) {
			$menu[$menu_item->menu_item_parent]['sub-items'][$menu_item->ID] = $item;
			continue;
		}

		$menu[$menu_item->ID] = $item;
	}
	return $menu;
}

function get_footer_menu_items()
{
	$menu_name = 'footer';
	$locations = get_nav_menu_locations();
	$menu_items = wp_get_nav_menu_items($locations[$menu_name]);
	$menu = [];

	foreach ($menu_items as $menu_item) {

		$item = [
			'title' => $menu_item->title,
			'url' => $menu_item->url,
			'description' => $menu_item->description,
			'classes' => $menu_item->classes,
			'attr_title' => $menu_item->attr_title,
			'target' => $menu_item->target,
		];

		if ($menu_item->menu_item_parent) {
			$menu[$menu_item->menu_item_parent]['sub-items'][$menu_item->ID] = $item;
			continue;
		}

		$menu[$menu_item->ID] = $item;
	}
	return $menu;
}

// Add featured image to posts admin
/**
 * Add featured image column to WP admin panel - posts AND pages
 * See: https://bloggerpilot.com/featured-image-admin/
 */

// Set thumbnail size
add_image_size( 'billykulpa2022_admin-featured-image', 60, 60, false );

// Add the posts and pages columns filter. Same function for both.
add_filter('manage_posts_columns', 'billykulpa2022_add_thumbnail_column', 2);
// add_filter('manage_pages_columns', 'billykulpa2022_add_thumbnail_column', 2);
function billykulpa2022_add_thumbnail_column($billykulpa2022_columns){
	$billykulpa2022_columns['billykulpa2022_thumb'] = __('Image');
	return $billykulpa2022_columns;
}

// Add featured image thumbnail to the WP Admin table.
add_action('manage_posts_custom_column', 'billykulpa2022_show_thumbnail_column', 5, 2);
// add_action('manage_pages_custom_column', 'billykulpa2022_show_thumbnail_column', 5, 2);
function billykulpa2022_show_thumbnail_column($billykulpa2022_columns, $j0e_id){
	switch($billykulpa2022_columns) {
		case 'billykulpa2022_thumb':
			if( function_exists('the_post_thumbnail') )
			echo the_post_thumbnail( 'billykulpa2022_admin-featured-image' );
		break;
	}
}

// Move the new column before the comments
add_filter('manage_posts_columns', 'billykulpa2022_column_order');
function billykulpa2022_column_order($columns) {
	$n_columns = array();
	$move = 'billykulpa2022_thumb'; // which column to move
	$before = 'date'; // move before this column

	foreach($columns as $key => $value) {
		if ($key==$before){
			$n_columns[$move] = $move;
		}
		$n_columns[$key] = $value;
	}
	return $n_columns;
}

// Sidebars
function sidebarWidgetsInit() {
	register_sidebar(array(
		'name'  =>  'Page Sidebar',
		'id'    =>  'sidebar',
	));
}
add_action('widgets_init','sidebarWidgetsInit');

// Modify search results to remove pages with checked box
function excluded_acf_flagged_posts( $query ) {
	if ($query->is_search()) {
		// in case for some reason there's already a meta query set from other plugin
		$meta_query = $query->get('meta_query')? : [];

		// append yours
		$meta_query[] = [
			'relation' => 'OR',
			[
				'key' => 'page_remove_from_wordpress_search',
				'compare' => 'NOT EXISTS'
			],
			[
				'key' => 'page_remove_from_wordpress_search',
				'value' => '1',
				'compare' => '!='
			],
		];

		$query->set('meta_query', $meta_query);
	}
}
add_action( 'pre_get_posts', 'excluded_acf_flagged_posts' );

// Remove <p> and <br/> from Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * takes the array of wordpress images and returns an array of image and webp image paths by size
 * @param $wpImageArray
 * @return array
 */
function imageSizes($wpImageArray): array
{
	$imageSizes = [];

	//loop over wordpress image sizes and create array of imagesizes and their file path
	if(is_array($wpImageArray)) {
		foreach($wpImageArray as $sizeKey=>$imageUrl) {
			if(!preg_match("/-height|-width/", $sizeKey)) {
				//replace the domain with the cdn if it exists
				$imageSizes[$sizeKey]['original']  = preg_replace("/^.*\/wp-content/", $contentURL . '/wp-content', $imageUrl);
				//more complicated, replace the domain and add webp to the end of the image path (replace stuff in the middle basically)
				$imageSizes[$sizeKey]['webp'] = preg_replace('/^.*\/uploads\/(.*)$/', $contentURL . '/wp-content/webp-express/webp-images/uploads/$1.webp', $imageUrl);
			}
		}
	}
	return $imageSizes;
}