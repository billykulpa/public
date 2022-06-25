<?php

// Author Variables
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));

// Category Variables
$currentCategory = single_cat_title('', false);

// Content Option Variables
$content_options = get_field('content_options');
$hide_breadcrumbs = $content_options['hide_breadcrumbs'];
$breadcrumb_override = $content_options['breadcrumb_override'];

/* The Breadcrumbs */ ?>
<section id="breadcrumbs" class="">
	<div class="container">
		<ul class="breadcrumbs">
			<li class="home">
				<div class="icon-container">
					<img alt="An icon for home" height="14.4" loading="lazy" src="/wp-content/uploads/icon-home.svg" width="14.4" />
				</div>
				<a href="<?php echo get_option('home'); ?>" title="<?php echo get_bloginfo( 'name' ); ?>" target="_self">Home</a>
			</li>
			<?php // Manual breadcrumb insert
			if(is_page(array(100000000))) : ?>
				<li><a href="/url-goes-here/" title="Forced page title name here" target="_self">Page Title Here</a></li>
			<?php endif;

			if(!is_home()) : ?>
				<?php if(is_singular('post')) : ?><li><a href="/blog/" title="From the Blog" target="_self">Blog</a></li>
				<?php elseif(is_singular('portfolio-item')) : ?><li><a href="/portfolio/" title="View Billy's portfolio" target="_self">Portfolio</a></li>
				<?php elseif( is_category() ) : ?><li>Category: <?php echo $currentCategory; ?></li>
				<?php elseif( is_tag() ) : ?><li>Tag: <?php single_tag_title(); ?></li>
				<?php elseif( is_day() ) : ?><li>Archive for <?php the_time('F jS, Y'); ?></li>
				<?php elseif( is_month() ) : ?><li>Archive for <?php the_time('F, Y'); ?></li>
				<?php elseif( is_year() ) : ?><li>Archive for <?php the_time('Y'); ?></li>
				<?php elseif( is_author() ) : ?><li>Author Archive for <?php echo $curauth->display_name; ?></li>
				<?php elseif( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) : ?><li>Archives</li>
				<?php elseif( is_search() ) : ?><li>Search Results</li>
				<?php endif;
			endif;
			// Check for parents structure
				global $post; 

				/* Get an array of Ancestors and Parents if they exist */
                if(!empty($post->ID)) {
                    $parents = get_post_ancestors($post->ID);
                    foreach(array_reverse($parents) as $parent) {
                   		$breadcrumb_override = get_field('page_breadcrumb_override', $parent);
                        echo '<li><a href="' . get_the_permalink($parent) . '" title="' . get_the_title($parent) . '" target="_self">';
                        if(!empty($breadcrumb_override)) : echo $breadcrumb_override; else : echo get_the_title($parent); endif;
                        echo '</a></li>';
                    }
				}
			 if(is_front_page() && is_home()) :
			// Default homepage
			elseif(is_front_page()) :
				// Static homepage ?>
				<li><?php echo the_title(); ?></li>
			<?php elseif(is_singular('post')) : ?><li>Blog Post</li>
			<?php elseif(is_404()) : ?>
				<li>This is an error page</li>
			<?php else :// Everything else
				if(!is_tag() && !is_search() && !is_author() && !is_category()) : ?>
					<li><?php if(!empty($breadcrumb_override)) : echo $breadcrumb_override; else : echo the_title(); endif; ?></li>
				<?php endif;
			endif; ?>
		</ul>
	</div><!-- .container -->
</section>