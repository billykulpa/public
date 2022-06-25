<?php
// general vars
$uploads_path = '/wp-content/uploads/';
$uploads_path_webp = '/wp-content/webp-express/webp-images/uploads/';
// block vars
$selected_blogs = get_field('selected_blogs');
$headline = $selected_blogs['headline'];
$body = $selected_blogs['body'];
$background_color = $selected_blogs['background_color'];
$show_dates = $selected_blogs['show_dates'];
$blog_ids = array();
// blog vars
$blog_post_1 = $selected_blogs['blog_post_1'];
if(!empty($blog_post_1)) :
	$blog_ids[] = $blog_post_1->ID;
endif;
$blog_post_2 = $selected_blogs['blog_post_2'];
if(!empty($blog_post_2)) :
	$blog_ids[] = $blog_post_2->ID;
endif;
$blog_post_3 = $selected_blogs['blog_post_3'];
if(!empty($blog_post_3)) :
	$blog_ids[] = $blog_post_3->ID;
endif;
?>
<section class="<?php echo $background_color; ?>" id="selected-blogs">
	<div class="container">
		<?php if(!empty($headline) || !empty($body)) : ?>
			<div class="content-container">
		<?php endif;
		if(!empty($headline)) : ?>
			<div class="header-container">
				<h2 class="headline"><a href="/blog/" title="Read the Adeptia blog" target="_self"><?php echo $headline; ?></a></h2>
			</div><!-- .header-container -->
		<?php endif;
		if(!empty($body)) : ?>
			<div class="body-container"><?php echo $body; ?></div><!-- .body -->
		<?php endif;
		if(!empty($headline) || !empty($body)) : ?>
			</div><!-- .content-container -->
		<?php endif;
		if(!empty($blog_ids)) : ?>
			<div class="row justify-content-between">
				<?php $counter = 1;
				// WP_Query arguments
				$args = array (
					'post__in'			=>	$blog_ids, // IDs of the posts
					'posts_per_page'	=>	'3',
					'post_type'			=>	array('post'),
				);
				// The Query
				$query = new WP_Query( $args );
				// The Loop
				if($query->have_posts()) :
					while ( $query->have_posts() ) : $query->the_post(); // do something
						// vars
						$title = get_the_title();
						$date = get_the_date();
						$author = the_author_meta();
						$terms = get_the_terms(get_the_ID(), 'category');
						$categories = get_the_category();
						if(has_post_thumbnail()) :
							$featured_image_id = get_post_thumbnail_id();
							$featured_image_object = wp_get_attachment_metadata($featured_image_id);
							$featured_image_alt = $featured_image_object['alt'];
							$featured_image_height = $featured_image_object['height'];
							$featured_image_width = $featured_image_object['width'];
							$featured_image_file = $featured_image_object['file'];
							$featured_image_sizes = $featured_image_object['sizes'];
							$featured_image_file_type_array = pathinfo($featured_image_file);
								$featured_image_file_type = $featured_image_file_type_array['extension'];
							// check if image is an SVG
							$featured_image_is_svg = false;
							if($featured_image_file_type == 'svg') :
								$featured_image_is_svg = true;
							endif;
							// 700
							if($featured_image_sizes['size_700']) :
								$featured_image_size_700_object = $featured_image_sizes['size_700'];
								$featured_image_size_700_file = $featured_image_size_700_object['file'];
								$featured_image_size_700_height = $featured_image_size_700_object['height'];
								$featured_image_size_700_width = $featured_image_size_700_object['width'];
								// webp
								$featured_image_size_700_webp = $uploads_path_webp . pathinfo($featured_image_size_700_file, PATHINFO_FILENAME) . '.' . $featured_image_file_type . '.webp';
							endif;
							// 600
							if($featured_image_sizes['size_600']) :
								$featured_image_size_600_object = $featured_image_sizes['size_600'];
								$featured_image_size_600_file = $featured_image_size_600_object['file'];
								$featured_image_size_600_height = $featured_image_size_600_object['height'];
								$featured_image_size_600_width = $featured_image_size_600_object['width'];
								// webp
								$featured_image_size_600_webp = $uploads_path_webp . pathinfo($featured_image_size_600_file, PATHINFO_FILENAME) . '.' . $featured_image_file_type . '.webp';
							endif;
							// 500
							if($featured_image_sizes['size_500']) :
								$featured_image_size_500_object = $featured_image_sizes['size_500'];
								$featured_image_size_500_file = $featured_image_size_500_object['file'];
								$featured_image_size_500_height = $featured_image_size_500_object['height'];
								$featured_image_size_500_width = $featured_image_size_500_object['width'];
								// webp
								$featured_image_size_500_webp = $uploads_path_webp . pathinfo($featured_image_size_500_file, PATHINFO_FILENAME) . '.' . $featured_image_file_type . '.webp';
							endif;
							// 400
							if($featured_image_sizes['size_400']) :
								$featured_image_size_400_object = $featured_image_sizes['size_400'];
								$featured_image_size_400_file = $featured_image_size_400_object['file'];
								$featured_image_size_400_height = $featured_image_size_400_object['height'];
								$featured_image_size_400_width = $featured_image_size_400_object['width'];
								// webp
								$featured_image_size_400_webp = $uploads_path_webp . pathinfo($featured_image_size_400_file, PATHINFO_FILENAME) . '.' . $featured_image_file_type . '.webp';
							endif;
							// 300
							if($featured_image_sizes['size_300']) :
								$featured_image_size_300_object = $featured_image_sizes['size_300'];
								$featured_image_size_300_file = $featured_image_size_300_object['file'];
								$featured_image_size_300_height = $featured_image_size_300_object['height'];
								$featured_image_size_300_width = $featured_image_size_300_object['width'];
								// webp
								$featured_image_size_300_webp = $uploads_path_webp . pathinfo($featured_image_size_300_file, PATHINFO_FILENAME) . '.' . $featured_image_file_type . '.webp';
							endif;
						endif; ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('col-lg-4'); ?>>
							<div class="article-container">
								<div class="post-thumbnail-container image-wrapper">
									<a href="<?php echo get_the_permalink(); ?>" title="<?php echo $title; ?>" target="_self">
										<?php if(!empty($show_dates)) : ?>
										<div class="kicker-container">
											<span class="kicker text-color-light"><?php echo $date; ?></span>
										</div><!-- .kicker-container -->
										<?php endif;
										if(has_post_thumbnail()) :
											if(!$featured_image_is_svg) : ?>
											<picture>
												<?php if($featured_image_size_400_webp) : ?><source srcset="<?php echo $featured_image_size_400_webp; ?>" media="(min-width: 1200px)" type="image/webp"><?php endif;
												if($featured_image_size_300_webp) : ?><source srcset="<?php echo $featured_image_size_300_webp; ?>" media="(min-width: 992px)" type="image/webp"><?php endif;
												if($featured_image_size_700_webp) : ?><source srcset="<?php echo $featured_image_size_700_webp; ?>" media="(min-width: 768px)" type="image/webp"><?php endif;
												if($featured_image_size_600_webp) : ?><source srcset="<?php echo $featured_image_size_600_webp; ?>" media="(min-width: 576px)" type="image/webp"><?php endif;
												if($featured_image_size_500_webp) : ?><source srcset="<?php echo $featured_image_size_500_webp; ?>" media="(max-width: 575px)" type="image/webp"><?php endif; ?>
												<source srcset="/wp-content/uploads/<?php echo $featured_image_size_400_file; ?>" media="(min-width: 1200px)" type="image/<?php echo $featured_image_file_type; ?>">
												<source srcset="/wp-content/uploads/<?php echo $featured_image_size_300_file; ?>" media="(min-width: 992px)" type="image/<?php echo $featured_image_file_type; ?>">
												<source srcset="/wp-content/uploads/<?php echo $featured_image_size_700_file; ?>" media="(min-width: 768px)" type="image/<?php echo $featured_image_file_type; ?>">
												<source srcset="/wp-content/uploads/<?php echo $featured_image_size_600_file; ?>" media="(min-width: 576px)" type="image/<?php echo $featured_image_file_type; ?>">
												<source srcset="/wp-content/uploads/<?php echo $featured_image_size_500_file; ?>" media="(max-width: 575px)" type="image/<?php echo $featured_image_file_type; ?>">
												<img alt="<?php if($featured_image_alt) : echo $featured_image_alt; else : echo $title; endif; ?>" height="226" loading="lazy" src="/wp-content/uploads/<?php echo $featured_image_file; ?>" width="376" />
											</picture>
											<?php else : ?>
												<img alt="<?php echo $title; ?>" height="226" src="<?php echo $featured_image_file; ?>" width="376" />
											<?php endif; ?>
										<?php else : ?>
											<picture>
												<img alt="<?php echo get_the_title(); ?>" height="226" src="/wp-content/uploads/adeptia-blog-placeholder.svg" width="376" />
											</picture>
										<?php endif; ?>
									</a>
								</div><!-- .post-thumbnail-container -->
								<div class="content">
									<h3><a href="<?php echo get_the_permalink(); ?>" title="<?php echo $title; ?>" target="_self"><?php echo $title; ?></a></h3>
									<div class="body">
										<?php the_excerpt(); ?>
									</div><!-- .body -->
									<div class="btn-group">
										<a role="button" class="btn btn-color-1 btn-minimal" href="<?php echo get_the_permalink(); ?>" target="_self" title="<?php echo $title; ?>">Read Post</a>
									</div><!-- .home-blog-cta -->
								</div><!-- .content -->
							</div><!-- .article-container -->
						</article>
					<?php $counter++;
					endwhile;
					wp_reset_postdata(); // clean up after the query and pagination
				else:  ?>
				<article>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				</article>
				<?php endif; ?>
			</div><!-- .row.justify-content-between -->
		<?php endif; ?>
	</div><!-- .container -->
</section>