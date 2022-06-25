<?php
// general vars
$uploads_path = '/wp-content/uploads/';
$uploads_path_webp = '/wp-content/webp-express/webp-images/uploads/';
// block vars
$latest_blogs = get_field('latest_blogs');
$headline = $latest_blogs['headline'];
$body = $latest_blogs['body'];
$background_color = $latest_blogs['background_color'];

?>
<section class="<?php echo $background_color; ?>" id="latest-blogs">
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

		$postCount = 0;
		$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
		$counter = 1;

		// WP_Query arguments
		$args = array (
			'order'						=>	'DESC',
			'paged'						=>	$paged,
			'pagination'				=>	true,
			'posts_per_page'			=>	3,
			'post_status'				=>	'publish',
			'post_type'					=>	array( 'post' )
		);

		// The Query
		$query = new WP_Query( $args );

		// The Loop
		if($query->have_posts()) : ?>
			<div class="row justify-content-between">
				<?php while ( $query->have_posts() ) : $query->the_post(); // do something
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
						$rendered_height = '';
						$rendered_width = '';
						$featured_image_file = $featured_image_object['file'];
						$featured_image_file_url = $uploads_path . $featured_image_file;
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
									<div class="kicker-container">
										<span class="kicker text-color-light"><?php echo $date; ?></span>
									</div><!-- .kicker-container -->
									<?php if(has_post_thumbnail()) :
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
											<img alt="<?php if($featured_image_alt) : echo $featured_image_alt; else : echo $title; endif; ?>" height="224" loading="lazy" src="/wp-content/uploads/<?php echo $featured_image_file; ?>" width="376">
										</picture>
										<?php else : ?>
											<img alt="<?php echo $title; ?>" height="224" src="<?php echo $featured_image_file; ?>" width="376" />
										<?php endif; ?>
									<?php else : ?>
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 850 400">
											<defs>
												<style>.fill-color-2{fill:#cdc5bb;}.fill-color-dark{fill:#0a0f0a;}.fill-color-1{fill:#a6ce39;}</style>
											</defs>
											<g>
												<rect class="fill-color-2 blend-soft-light" width="850" height="400"/>
												<polygon class="fill-color-2 blend-soft-light" points="850 0 253.59 0 253.59 0 484.53 400 850 400 850 0"/>
												<polygon class="fill-color-dark" points="590 332.89 425 47.11 425 47.11 425 47.11 490.16 249.12 590 332.89"/>
												<polygon class="fill-color-1" points="490.16 249.12 382.47 288.32 590 332.89 490.16 249.12"/>
												<polygon class="fill-color-1" points="425 47.11 260 332.89 402.37 175.45 402.37 175.45 490.16 249.12 490.16 249.12 425 47.11"/>
												<polygon class="fill-color-dark" points="382.47 288.32 402.37 175.45 260 332.89 590 332.89 382.47 288.32"/>
												<polygon class="fill-color-2 blend-soft-light" points="850 0 253.59 0 253.59 0 383.56 400 850 400 850 0"/>
											</g>
										</svg>
									<?php endif; ?>
								</a>
							</div><!-- .post-thumbnail-container -->
							<div class="content">
								<h3><a href="<?php echo get_the_permalink(); ?>" title="<?php echo $title; ?>" target="_self"><?php echo $title; ?></a></h3>
								<div class="body">
									<?php echo get_the_excerpt(); ?>
								</div><!-- .body -->
								<div class="btn-group">
									<a role="button" class="btn btn-color-1 btn-minimal" href="<?php echo get_the_permalink(); ?>" target="_self" title="<?php echo $title; ?>">Read Post</a>
								</div><!-- .home-blog-cta -->
							</div><!-- .content -->
						</div><!-- .article-container -->
					</article>
				<?php $counter++;
			endwhile; ?>
			</div><!-- .row.justify-content-between -->

			<?php wp_reset_postdata(); // clean up after the query and pagination ?>

			<?php else:  ?>
			<article>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			</article>
		</div><!-- .row.justify-content-between -->
		<?php endif; ?>
	</div><!-- .container -->
</section>