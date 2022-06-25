<?php

//[blogroll cat="" post_type="" tag="" home=""]
add_shortcode('blogroll', 'blogroll_function');
function blogroll_function($atts) {
    ob_start();
    include(get_template_directory() . '/functions/shortcodes/blogroll.php');
    return ob_get_clean();
};

//[portfolio home=""]
add_shortcode('portfolio', 'portfolio_function');
function portfolio_function($atts) {
    ob_start();
    include(get_template_directory() . '/functions/shortcodes/portfolio.php');
    return ob_get_clean();
};

//[posts_sidebar post_type=""]
add_shortcode('posts_sidebar', 'posts_sidebar_function');
function posts_sidebar_function($atts) {
    ob_start();
    include(get_template_directory() . '/functions/shortcodes/posts-sidebar.php');
    return ob_get_clean();
};

//[vimeo_video video_id="" aspect_ratio=""] // widescreen, standard, classic-adeptia
add_shortcode('vimeo_video', 'vimeo_video_function');
function vimeo_video_function($atts) {
    ob_start();
    include(get_template_directory() . '/functions/shortcodes/vimeo-video.php');
    return ob_get_clean();
};