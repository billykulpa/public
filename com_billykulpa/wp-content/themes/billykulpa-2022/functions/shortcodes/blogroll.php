<?php
// default var
$post_type = array('post');
// define attributes and their defaults
extract(shortcode_atts(array(
	'post_type' => '',
	'home' => '',
), $atts));
// define query parameters based on attributes
$options = array(
	'post_type' => $post_type,
	'home' => $home,
);
if(!empty($post_type)) : ?>
	<div class="blogroll the-posts">
		<?php
		$postCount = 0;
		if(empty($home)) :
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$pagination = true;
			$posts_per_page = 10;
		else :
			$paged = false;
			$pagination = false;
			$posts_per_page = 1;
		endif;

		// WP_Query arguments
		$blogroll_args = array (
			'order'				=>	'DESC',
			'paged'				=>	$paged,
			'pagination'		=>	$pagination,
			'posts_per_page'	=>	$posts_per_page,
			'post_status'		=>	'publish',
			'post_type'			=>	array($post_type)
		);

		// The Query
		$query = new WP_Query($blogroll_args);

		// The Loop
		if($query->have_posts()) : ?>
			<?php while($query->have_posts()) : $query->the_post(); // do something
				get_template_part('template-parts/parts/content-post', null, array( 
					'class' => '',
					'preview_mode'  => true,
				));
			endwhile;
			if(empty($home)) : ?>
				<div class="nav-links">
				<?php
				$big = 999999999;
				echo paginate_links( array(
					'base'			=>	str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'		=>	'?paged=%#%',
					'current'		=>	max( 1, $paged ),
					'end_size'		=>	1,
					'mid_size'		=>	1,
					'total'			=>	$query->max_num_pages,
					'prev_text'		=>	__('« Prev'),
					'next_text'		=>	__('Next »')
				) ); ?>
				</div>
			<?php endif;
			wp_reset_postdata(); // clean up after the query and pagination
		else : ?>
			<p>We're sorry, but there are no blog posts at this time.</p>
		<?php endif; ?>
	</div><!-- .blogroll -->
<?php endif; ?>