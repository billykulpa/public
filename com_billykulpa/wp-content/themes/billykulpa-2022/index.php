<?php
/**
 * The main template file *
 */

get_header();

    // Load posts loop
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
    else :
        get_template_part('template-parts/sections/404');
    endif;

get_footer();