<?php
	// default var
	$post_type = array('post');
	// define attributes and their defaults
	extract(shortcode_atts(array(
		'post_type' => '',
		'cat'	=> '',
	), $atts));
	// define query parameters based on attributes
	$options = array(
		'post_type' => $post_type,
		'cat' => $cat
	);
	// vars
	$page_permalink = get_the_permalink(get_the_ID());
?>
<div class="sidebar posts-sidebar">
	<h2 class="topper"><?php if($post_type == 'post') : ?>Latest Posts<?php else : ?>The Latest<?php endif; ?></h2>
	<?php
		$counter = 1;
		// WP_Query arguments
		$posts_sidebar_args = array (
			'category_name'		=>	$cat,
			'order'				=>	'DESC',
			'pagination'		=>	false,
			'posts_per_page'	=>	'5',
			'post_type'			=>	$post_type,
		);
		// The Query
		$posts_sidebar_query = new WP_Query($posts_sidebar_args);
		// The Loop
		if($posts_sidebar_query->have_posts()) :
			while($posts_sidebar_query->have_posts() ) : $posts_sidebar_query->the_post();
				// vars
				$title = get_the_title(get_the_id());
				$permalink = get_the_permalink(get_the_id());
				$is_current = false;
				if($page_permalink == $permalink) :
					$is_current = true;
				endif; ?>
				<article class="content-wrapper<?php if($is_current == true) : ?> active<?php endif; ?>">
					<div class="date-container">
						<p><?php echo get_the_date(); ?></p>
					</div><!-- .date-container -->
					<div class="headline">
						<h3><?php if(!$is_current) : ?><a href="<?php echo $permalink; ?>" title="<?php echo $title; ?>"><?php endif;  echo $title; if(!$is_current) : ?></a><?php endif; ?></h3>
					</div><!-- .headline -->
				</article>
			<?php endwhile;
			wp_reset_postdata(); // clean up after the query and pagination
		endif;
	?>
	<?php if($post_type == 'post') : ?>
		<a role="button" class="btn btn-minimal btn-color-dark" href="/blog" target="_self" title="Read all blogs">All Posts</a>
	<?php endif; ?>
</div><!-- .sidebar -->