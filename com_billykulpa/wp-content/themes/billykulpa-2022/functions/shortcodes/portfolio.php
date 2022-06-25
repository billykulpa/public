<?php
	// define attributes and their defaults
	extract( shortcode_atts( array (
        'home' => '',
	), $atts ) );
	// define query parameters based on attributes
	$options = array(
		'home' => $home,
	);
	if(empty($home)) : get_template_part('template-parts/parts/portfolio-filter'); endif;
?>
<div class="portfolio the-posts">
	<?php
	$postCount = 0;
	if(empty($home)) :
		$posts_per_page = -1;
	else :
		$posts_per_page = 3;
	endif;
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

	// WP_Query arguments
	$args = array (
		'meta_key'			=>	'year',
		'orderby'			=>	'meta_value',
		'order'				=>	'DESC',
		'paged'				=>	$paged,
		'pagination'		=>	false,
		'posts_per_page'	=>	$posts_per_page,
		'post_status'		=>	'publish',
		'post_type'			=>	array('portfolio-item')
	);

	// The Query
	$query = new WP_Query( $args );

	// The Loop
	if($query->have_posts()) :
		$counter = 1; ?>
		<div class="filters-content">
			<div class="row justify-content-start">
				<?php while ( $query->have_posts() ) : $query->the_post(); // do something
					// vars
					$post_ID = get_the_ID();
					$post_permalink = get_the_permalink();
					$client_name = get_field('client_name', $post_ID);
					$year = get_field('year', $post_ID);
					$portfolio_type = get_field('portfolio_type', $post_ID);
					$portfolio_page_logo_size = get_field('portfolio_page_logo_size', $post_ID);
					$post_class = 'col-lg-4 col-md-6 fadeInUp mix grid-item client-' . slugify($client_name) . ' year-' . $year;
					foreach($portfolio_type as $filter_portfolio_type) :
						$post_class .= ' portfolio-type-' . slugify($filter_portfolio_type['label']);
					endforeach;?>
					<article <?php post_class($post_class); ?> data-client="client-<?php echo slugify($client_name); ?>" data-year="year-<?php echo slugify($year); ?>" data-portfolio-type="<?php foreach($portfolio_type as $data_filter_portfolio_type) : ?> portfolio-type-<?php echo slugify($data_filter_portfolio_type['label']); endforeach; ?>" data-filters="client-<?php echo slugify($client_name); ?> year-<?php echo slugify($year); foreach($portfolio_type as $data_filters_portfolio_type) : ?> portfolio-type-<?php echo slugify($data_filters_portfolio_type['label']); endforeach; ?>" id="post-<?php the_ID(); ?>">
						<a class="shadow-soft" href="<?php echo $post_permalink; ?>" target="_self" title="See the <?php echo $client_name; ?> portfolio item">
							<?php if(has_post_thumbnail()) : 
								// vars
								$thumbnail_id = get_post_thumbnail_id(get_the_ID());
								$thumbnail_alt = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
								$thumbnail_caption = get_the_post_thumbnail_caption();
								$thumbnail_url = wp_get_attachment_image_url($thumbnail_id,'defaultSize');
								$thumbnail_meta = wp_get_attachment_metadata($thumbnail_id);
								$thumbnail_width = $thumbnail_meta['width'];
								$thumbnail_height = $thumbnail_meta['height'];
								$thumbnail_filename = $thumbnail_meta['file'];
								$thumbnail_file_type_array = pathinfo($thumbnail_filename);
								$thumbnail_file_type = $thumbnail_file_type_array['extension'];
								$thumbnail_is_svg = false;
								if($thumbnail_file_type == 'svg') :
									$thumbnail_is_svg = true;
									// height / width calculations
									$raw_svg = simplexml_load_file($thumbnail_url);
									$raw_viewbox = $raw_svg['viewBox'];
									$exploded_viewbox = explode(' ', $raw_viewbox);
									$thumbnail_width = $exploded_viewbox[2]; // 3rd word in string
									$thumbnail_height = $exploded_viewbox[3]; // 4th word in string
									$rendered_width = '328.4';
									$rendered_height = $rendered_width * $thumbnail_height / $thumbnail_width;
									$rendered_height  = number_format($rendered_height, 2, '.', '');
								endif;
								$image_sizes = [];
								//gets image sizes and all the image paths for jpg and webp images
								foreach(wp_get_registered_image_subsizes() as $size=>$data) {
									$image_sizes[$size] = get_the_post_thumbnail_url(get_the_ID(),$size);
								}
								$thumbnail_image_sizes = imageSizes(($image_sizes)); ?>
								<div class="post-thumbnail-container<?php if($thumbnail_is_svg) : ?> is-svg<?php endif; ?>">
									<figure>
										<picture<?php if($portfolio_page_logo_size != '100') : ?> class="logo-size-<?php echo $portfolio_page_logo_size; ?>"<?php endif; ?> >
											<?php if(!$thumbnail_is_svg) : ?>
												<source srcset="<?php echo $thumbnail_image_sizes['size_900']['webp']; ?>" media="(min-width: 1200px)" type="image/webp">
												<source srcset="<?php echo $thumbnail_image_sizes['size_800']['webp']; ?>" media="(min-width: 768px)" type="image/webp">
												<source srcset="<?php echo $thumbnail_image_sizes['size_600']['webp']; ?>" media="(min-width: 541px)" type="image/webp">
												<source srcset="<?php echo $thumbnail_image_sizes['size_500']['webp']; ?>" media="(max-width: 540px)" type="image/webp">
												<source srcset="<?php echo $thumbnail_image_sizes['size_900']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $thumbnail_file_type; ?>">
												<source srcset="<?php echo $thumbnail_image_sizes['size_800']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $thumbnail_file_type; ?>">
												<source srcset="<?php echo $thumbnail_image_sizes['size_600']['original']; ?>" media="(min-width: 541px)" type="image/<?php echo $thumbnail_file_type; ?>">
												<source srcset="<?php echo $thumbnail_image_sizes['size_500']['original']; ?>" media="(max-width: 540px)" type="image/<?php echo $thumbnail_file_type; ?>">
											<?php endif; ?>
											<img loading="<?php if($counter > 6) : ?>lazy<?php endif; ?>" alt="<?php if($thumbnail_alt) : echo $thumbnail_alt; else : echo $title; endif; ?>" height="<?php echo $rendered_height; ?>" src="<?php echo $thumbnail_url; ?>" width="<?php echo $rendered_width; ?>">
										</picture>
									</figure>
								</div><!-- .post-thumbnail-container -->
							<?php endif; ?>
						</a>
						<h2><?php echo get_the_title(); ?></h2>
						<?php if(empty($home)) : get_template_part('template-parts/parts/portfolio-meta'); endif; ?>
					</article>
					<?php $counter++;
				endwhile;
				wp_reset_postdata(); // clean up after the query and pagination ?>
			</div><!-- .row.justify-content-start -->
		</div><!-- .filters-content -->
	<?php else : ?>
		<p>I'm sorry, but there are no portfolio items at this time.</p>
	<?php endif; ?>
</div><!-- .portfolio -->