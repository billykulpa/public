<?php
/**
 * The template for displaying search results pages
 */

$searchQuery = get_search_query();

get_header(); ?>

<section class="search-field-wrapper">
    <div class="container">
        <?php get_template_part('template-parts/parts/searchform'); ?>
        <h3 class="title"><?php /* translators: Search query. */ printf(__('Search Results for: %s', 'billykulpa2022'), '<span>' . get_search_query() . '</span>'); ?></h3>
    </div><!-- .container -->
</section><!-- .search-field-wrapper -->

<?php if (have_posts()) : ?>
<section class="search-results">
    <div class="container">
        <?php while (have_posts()) : the_post();
            // vars
            $post_type = get_post_type();
            $post_type_object = get_post_type_object($post_type);
            $post_type_label = $post_type_object->labels->singular_name; ?>
            <div class="search-result">
                <span class="search-post-type">Post Type: <strong><?php echo $post_type_label; ?></strong></span>
                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <div class="content">
                    <?php if('post' == get_post_type()) : ?>
                    <?php else :
                        if(has_excerpt()) : ?>
                            <p><?php echo get_the_excerpt(); ?></p>
                        <?php endif;
                    endif; ?>
                </div>
            </div><!-- .search-result -->
            <?php endwhile; ?>
        <?php the_posts_pagination(array('screen_reader_text' => ' ')); ?>
    </div>
</section>
<?php else : ?>
<section class="page-not-found">
    <div class="container">
        <h2><?php _e('Nothing Found', 'billykulpa2022'); ?></h2>
        <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'billykulpa2022'); ?></p>
    </div><!-- .container -->
</section>
<?php endif;

get_footer();