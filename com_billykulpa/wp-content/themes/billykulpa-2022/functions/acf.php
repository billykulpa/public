<?php

if(function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'capability'    => 'edit_posts',
		'icon_url'      => 'dashicons-admin-site-alt3',
		'menu_slug'     => 'theme-settings',
		'menu_title'    => __('Theme Settings', 'billykulpa2022'),
		'page_title' 	=> __('Theme Settings', 'billykulpa2022'),
		'redirect'		=> false
	));
}

/* Add category for new blocks */
function custom_blocks_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'billykulpa2022-blog-elements',
				'title' => __( 'Blog Elements', 'billykulpa2022' ),
			),
			array(
				'slug' => 'billykulpa2022-key-blocks',
				'title' => __( 'Key Blocks', 'billykulpa2022' ),
			),
			array(
				'slug' => 'billykulpa2022-blocks',
				'title' => __( 'Blocks', 'billykulpa2022' ),
			),
		)
	);
}
add_filter( 'block_categories', 'custom_blocks_category', 10, 2);

function register_acf_block_types() {
	acf_register_block_type(array(
		'name'              => 'blog-vimeo-video',
		'title'             => __('Blog Vimeo Video', 'billykulpa2022'),
		'description'       => __('A responsive Vimeo video container for blog posts.', 'billykulpa2022'),
		'render_template'   => 'template-parts/blog-elements/blog-vimeo-video.php',
		'category'          => 'billykulpa2022-blog-elements',
		'icon'              => 'format-video',
		'keywords'          => array('video', 'blog video', 'vimeo'),
		'mode'				=> 'edit'
	));
	acf_register_block_type(array(
		'name'              => 'blog-youtube-video',
		'title'             => __('Blog YouTube Video', 'billykulpa2022'),
		'description'       => __('A responsive YouTube video container for blog posts.', 'billykulpa2022'),
		'render_template'   => 'template-parts/blog-elements/blog-youtube-video.php',
		'category'          => 'billykulpa2022-blog-elements',
		'icon'              => 'format-video',
		'keywords'          => array('video', 'blog video', 'youtube'),
		'mode'				=> 'edit'
	));
	acf_register_block_type(array(
		'name'              => 'content-block-module',
		'title'             => __('Content Block Module', 'billykulpa2022'),
		'description'       => __('A variable column content block.', 'billykulpa2022'),
		'render_template'   => 'template-parts/blocks/content-block-module.php',
		'category'          => 'billykulpa2022-key-blocks',
		'icon'              => 'schedule',
		'keywords'          => array('content block', 'two column'),
		'mode'				=> 'edit'
	));
	acf_register_block_type(array(
		'name'              => 'content-section-with-sidebar-module',
		'title'             => __('Content Section with Sidebar Module', 'billykulpa2022'),
		'description'       => __('A content section with a sidebar and optinoal photo.', 'billykulpa2022'),
		'render_template'   => 'template-parts/blocks/content-section-with-sidebar-module.php',
		'category'          => 'billykulpa2022-key-blocks',
		'icon'              => 'align-left',
		'keywords'          => array('content section with sidebar', 'content', 'sidebar'),
		'mode'				=> 'edit'
	));
	acf_register_block_type(array(
		'name'              => 'faqs-module',
		'title'             => __('Frequently Asked Questions', 'billykulpa2022'),
		'description'       => __('A frequently asked questions module.', 'billykulpa2022'),
		'render_template'   => 'template-parts/blocks/faqs-module.php',
		'category'          => 'billykulpa2022-blocks',
		'icon'              => 'format-chat',
		'keywords'          => array('faqs', 'faq', 'frequently asked question', 'frequently asked questions'),
		'mode'				=> 'edit'
	));
	acf_register_block_type(array(
		'name'              => 'hero-module',
		'title'             => __('Hero', 'billykulpa2022'),
		'description'       => __('A hero block for interior pages.', 'billykulpa2022'),
		'render_template'   => 'template-parts/blocks/hero-module.php',
		'category'          => 'billykulpa2022-key-blocks',
		'icon'              => 'superhero',
		'keywords'          => array('hero'),
		'mode'				=> 'edit'
	));
	acf_register_block_type(array(
		'name'              => 'hero-home-module',
		'title'             => __('Hero Home', 'billykulpa2022'),
		'description'       => __('A hero block for the home page.', 'billykulpa2022'),
		'render_template'   => 'template-parts/blocks/hero-home-module.php',
		'category'          => 'billykulpa2022-blocks',
		'icon'              => 'superhero',
		'keywords'          => array('hero', 'hero home'),
		'mode'				=> 'edit'
	));
	acf_register_block_type(array(
		'name'              => 'icon-block-module',
		'title'             => __('Icon Block Module', 'billykulpa2022'),
		'description'       => __('A variable column block for displaying text and icons.', 'billykulpa2022'),
		'render_template'   => 'template-parts/blocks/icon-block-module.php',
		'category'          => 'billykulpa2022-key-blocks',
		'icon'              => 'schedule',
		'keywords'          => array('icon block', 'icon', 'icons', 'columns'),
		'mode'				=> 'edit'
	));
	acf_register_block_type(array(
		'name'              => 'latest-blogs-module',
		'title'             => __('Latest Blogs', 'billykulpa2022'),
		'description'       => __('A section for displaying three blog posts.', 'billykulpa2022'),
		'render_template'   => 'template-parts/blocks/latest-blogs-module.php',
		'category'          => 'billykulpa2022-blocks',
		'icon'              => 'laptop',
		'keywords'          => array('blog', 'latest blog', 'blogs', 'latest blogs'),
		'mode'				=> 'edit'
	));
	acf_register_block_type(array(
		'name'              => 'logo-bar-module',
		'title'             => __('Logo Bar', 'billykulpa2022'),
		'description'       => __('A hero block for the home page.', 'billykulpa2022'),
		'render_template'   => 'template-parts/blocks/logo-bar-module.php',
		'category'          => 'billykulpa2022-blocks',
		'icon'              => 'smiley',
		'keywords'          => array('logo', 'logos', 'logo bar'),
		'mode'				=> 'edit'
	));
	acf_register_block_type(array(
		'name'              => 'responsive-image',
		'title'             => __('Responsive Image', 'billykulpa2022'),
		'description'       => __('A responsive image for blog posts.', 'billykulpa2022'),
		'render_template'   => 'template-parts/blog-elements/responsive-image.php',
		'category'          => 'billykulpa2022-blog-elements',
		'icon'              => 'format-image',
		'keywords'          => array('image', 'responsive image'),
		'mode'				=> 'edit'
	));
	acf_register_block_type(array(
		'name'              => 'resume-module',
		'title'             => __('Resume Module', 'billykulpa2022'),
		'description'       => __('A section for displaying my resume.', 'billykulpa2022'),
		'render_template'   => 'template-parts/blocks/resume-module.php',
		'category'          => 'billykulpa2022-blocks',
		'icon'              => 'id-alt',
		'keywords'          => array('resume'),
		'mode'				=> 'edit'
	));
	acf_register_block_type(array(
		'name'              => 'selected-blogs-module',
		'title'             => __('Selected Blogs Module', 'billykulpa2022'),
		'description'       => __('A section for displaying selected blog posts.', 'billykulpa2022'),
		'render_template'   => 'template-parts/blocks/selected-blogs-module.php',
		'category'          => 'billykulpa2022-blocks',
		'icon'              => 'laptop',
		'keywords'          => array('blogs', 'blog', 'selected blogs', 'selected blog'),
		'mode'				=> 'edit'
	));
	acf_register_block_type(array(
		'name'              => 'selected-related-content-module',
		'title'             => __('Selected Related Content Module', 'billykulpa2022'),
		'description'       => __('A section for displaying selected related pieces of content.', 'billykulpa2022'),
		'render_template'   => 'template-parts/blocks/selected-related-content-module.php',
		'category'          => 'billykulpa2022-blocks',
		'icon'              => 'open-folder',
		'keywords'          => array('related content', 'selected related content', 'related'),
		'mode'				=> 'edit'
	));
	acf_register_block_type(array(
		'name'              => 'single-video-module',
		'title'             => __('Single Video', 'billykulpa2022'),
		'description'       => __('A section for displaying a video content block.', 'billykulpa2022'),
		'render_template'   => 'template-parts/blocks/single-video-module.php',
		'category'          => 'billykulpa2022-blocks',
		'icon'              => 'format-video',
		'keywords'          => array('video', 'videos', 'video block', 'video module'),
		'mode'				=> 'edit'
	));
}

// Check if function exists and hook into setup.
if(function_exists('acf_register_block_type')) {
	add_action('acf/init', 'register_acf_block_types');
}