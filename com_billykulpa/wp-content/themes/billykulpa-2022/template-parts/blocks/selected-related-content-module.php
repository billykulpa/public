<?php
// general vars
$uploads_path = '/wp-content/uploads/';
$uploads_path_webp = '/wp-content/webp-express/webp-images/uploads/';
// block vars
$selected_related_content = get_field('selected_related_content');
$headline = $selected_related_content['headline'];
$body = $selected_related_content['body'];
$background_color = $selected_related_content['background_color'];
$post_ids = array();
$post_types = array();
// post vars
$related_content = $selected_related_content['related_content']; // repeater field
$count_related_content = count($related_content);
?>
<section class="<?php echo $background_color; ?>" id="selected-related-content">
	<div class="container">
		<?php if(!empty($headline) || !empty($body)) : ?>
			<div class="content-container">
		<?php endif;
		if(!empty($headline)) : ?>
			<div class="header-container">
				<h2 class="headline"><?php echo $headline; ?></h2>
			</div><!-- .header-container -->
		<?php endif;
		if(!empty($body)) : ?>
			<div class="body"><?php echo $body; ?></div><!-- .body -->
		<?php endif;
		if(!empty($headline) || !empty($body)) : ?>
			</div><!-- .content-container -->
		<?php endif;
		if(!empty($related_content)) :
			// vars
			foreach($related_content as $related_post) :
				$post_ids[] = $related_post['content']->ID;
				$post_types[] = $related_post['content']->post_type;
			endforeach;

			// WP_Query arguments
			$args = array (
				'orderby'		=>	'none',
				'post__in'		=>	$post_ids, // IDs of the posts
				'post_type'		=>	$post_types, // types of posts
			);
			// The Query
			$query = new WP_Query( $args );
			// The Loop
			if($query->have_posts()) : ?>
				<div class="row justify-content-between">
					<?php while ( $query->have_posts() ) : $query->the_post(); // do something
						// vars
						$title = get_the_title();
						$post_type = get_post_type();
						$post_type_obj = get_post_type_object($post_type);
						$post_type_label = $post_type_obj->labels->singular_name;
						$date = get_the_date();
						$author = the_author_meta();
						$terms = get_the_terms(get_the_ID(), 'category');
						$categories = get_the_category();
						if(has_post_thumbnail()) :
							// vars
							$thumbnail_id = get_post_thumbnail_id(get_the_ID());
							$thumbnail_alt = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
							$thumbnail_image = wp_get_attachment_image_url($thumbnail_id,'defaultSize');
							$thumbnail_meta = wp_get_attachment_metadata($thumbnail_id);
								// storing height and width
								$size_300_height = $thumbnail_meta['sizes']['size_300']['height'];
								$size_300_width = $thumbnail_meta['sizes']['size_300']['width'];
							$thumbnail_filename = $thumbnail_meta['file'];
							$thumbnail_file_type_array = pathinfo($thumbnail_filename);
							$thumbnail_file_type = $thumbnail_file_type_array['extension'];
							$image_sizes = [];
							//gets image sizes and all the image paths for jpg and webp images
							foreach(wp_get_registered_image_subsizes() as $size=>$data) {
								$image_sizes[$size] = get_the_post_thumbnail_url(get_the_ID(),$size);
							}
							$thumbnail_image_sizes = imageSizes(($image_sizes));
						endif;
						// post_classes
						switch($count_related_content) :
							case '4':
								$post_classes = 'col-lg-3';
								$rendered_width = '272';
								$rendered_height = '153';
							break;
							case '3':
								$post_classes = 'col-lg-4';
								$rendered_width = '374';
								$rendered_height = '211';
							break;
							case '2':
								$post_classes = 'col-lg-6 two-posts';
								$rendered_width = '226';
								$rendered_height = '127';
							break;
						endswitch;
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
							<div class="post-type-container">
								<div class="post-type-icon">
									<!-- post, page, case study, chart, connector, datasheet, ebook, news-article, tutorial, video, webinar, white-paper -->
									<?php switch($post_type) :
										case 'post': ?>
											<img alt="An icon for posts." height="40" src="/wp-content/uploads/icon_post.svg" width="40" />
										<?php break;
										case 'page': ?>
											<img alt="An icon for pages." height="40" src="/wp-content/uploads/icon_page.svg" width="40" />
										<?php break;
										case 'case-study': ?>
											<img alt="An icon for case studies." height="40" src="/wp-content/uploads/icon_case-study.svg" width="40" />
										<?php break;
										case 'charts': ?>
											<img alt="An icon for charts." height="40" src="/wp-content/uploads/icon_chart.svg" width="40" />
										<?php break;
										case 'connector': ?>
											<img alt="An icon for connectors." height="40" src="/wp-content/uploads/icon_connector.svg" width="40" />
										<?php break;
										case 'datasheets': ?>
											<img alt="An icon for datasheets." height="40" src="/wp-content/uploads/icon_datasheet.svg" width="40" />
										<?php break;
										case 'ebooks': ?>
											<img alt="An icon for eBooks." height="40" src="/wp-content/uploads/icon_ebook.svg" width="40" />
										<?php break;
										case 'news': ?>
											<img alt="An icon for news." height="40" src="/wp-content/uploads/icon_news.svg" width="40" />
										<?php break;
										case 'tutorials': ?>
											<img alt="An icon for tutorials." height="40" src="/wp-content/uploads/icon_tutorial.svg" width="40" />
										<?php break;
										case 'videos': ?>
											<img alt="An icon for videos." height="40" src="/wp-content/uploads/icon_video.svg" width="40" />
										<?php break;
										case 'webinars': ?>
											<img alt="An icon for webinars." height="40" src="/wp-content/uploads/icon_webinar.svg" width="40" />
										<?php break;
										case 'white-papers': ?>
											<img alt="An icon for white papers." height="40" src="/wp-content/uploads/icon_white-paper.svg" width="40" />
										<?php break;
									endswitch; ?>
								</div><!-- .post-type-icon -->
								<div class="post-type"><?php echo $post_type_label; ?></div><!-- .post-type -->
							</div><!-- .post-type-container -->
							<div class="article-container">
								<div class="post-thumbnail-container image-wrapper">
									<a href="<?php echo get_the_permalink(); ?>" title="<?php echo $title; ?>" target="_self">
										<?php if(has_post_thumbnail()) :
											if(!$featured_image_is_svg) : ?>
												<picture>
													<?php switch($count_related_content) :
														case '4' : ?>
															<source srcset="<?php echo $thumbnail_image_sizes['size_300']['webp']; ?>" media="(min-width: 992px)" type="image/webp">
															<source srcset="<?php echo $thumbnail_image_sizes['size_700']['webp']; ?>" media="(min-width: 768px)" type="image/webp">
															<source srcset="<?php echo $thumbnail_image_sizes['size_500']['webp']; ?>" media="(max-width: 767px)" type="image/webp">
															<source srcset="<?php echo $thumbnail_image_sizes['size_300']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $thumbnail_file_type; ?>">
															<source srcset="<?php echo $thumbnail_image_sizes['size_700']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $thumbnail_file_type; ?>">
															<source srcset="<?php echo $thumbnail_image_sizes['size_500']['original']; ?>" media="(max-width: 767px)" type="image/<?php echo $thumbnail_file_type; ?>">
														<?php break;
														case '3' : ?>
															<source srcset="<?php echo $thumbnail_image_sizes['size_400']['webp']; ?>" media="(min-width: 1200px)" type="image/webp">
															<source srcset="<?php echo $thumbnail_image_sizes['size_300']['webp']; ?>" media="(min-width: 992px)" type="image/webp">
															<source srcset="<?php echo $thumbnail_image_sizes['size_700']['webp']; ?>" media="(min-width: 768px)" type="image/webp">
															<source srcset="<?php echo $thumbnail_image_sizes['size_500']['webp']; ?>" media="(max-width: 767px)" type="image/webp">
															<source srcset="<?php echo $thumbnail_image_sizes['size_400']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $thumbnail_file_type; ?>">
															<source srcset="<?php echo $thumbnail_image_sizes['size_300']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $thumbnail_file_type; ?>">
															<source srcset="<?php echo $thumbnail_image_sizes['size_700']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $thumbnail_file_type; ?>">
															<source srcset="<?php echo $thumbnail_image_sizes['size_500']['original']; ?>" media="(max-width: 767px)" type="image/<?php echo $thumbnail_file_type; ?>">
														<?php break;
														case '2' : ?>
															<source srcset="<?php echo $thumbnail_image_sizes['size_300']['webp']; ?>" media="(min-width: 1400px)" type="image/webp">
															<source srcset="<?php echo $thumbnail_image_sizes['size_200']['webp']; ?>" media="(min-width: 1200px)" type="image/webp">
															<source srcset="<?php echo $thumbnail_image_sizes['size_500']['webp']; ?>" media="(min-width: 992px)" type="image/webp">
															<source srcset="<?php echo $thumbnail_image_sizes['size_700']['webp']; ?>" media="(min-width: 768px)" type="image/webp">
															<source srcset="<?php echo $thumbnail_image_sizes['size_500']['webp']; ?>" media="(max-width: 767px)" type="image/webp">
															<source srcset="<?php echo $thumbnail_image_sizes['size_300']['original']; ?>" media="(min-width: 1400px)" type="image/<?php echo $thumbnail_file_type; ?>">
															<source srcset="<?php echo $thumbnail_image_sizes['size_200']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $thumbnail_file_type; ?>">
															<source srcset="<?php echo $thumbnail_image_sizes['size_500']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $thumbnail_file_type; ?>">
															<source srcset="<?php echo $thumbnail_image_sizes['size_700']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $thumbnail_file_type; ?>">
															<source srcset="<?php echo $thumbnail_image_sizes['size_500']['original']; ?>" media="(max-width: 767px)" type="image/<?php echo $thumbnail_file_type; ?>">
														<?php break;
													endswitch; ?>
													<img loading="lazy" alt="<?php if($thumbnail_alt) : echo $thumbnail_alt; else : echo $title; endif; ?>" height="<?php echo $rendered_height; ?>" src="<?php echo $thumbnail_image; ?>" width="<?php echo $rendered_width; ?>" />
												</picture>
											<?php else : ?>
												<img alt="<?php echo $title; ?>" height="<?php echo $rendered_height; ?>" src="<?php echo $featured_image_file; ?>" width="<?php echo $rendered_width; ?>" />
											<?php endif; ?>
										<?php else : ?>
											<picture>
												<img alt="<?php echo get_the_title(); ?>" height="<?php echo $rendered_height; ?>" src="/wp-content/uploads/adeptia-blog-placeholder.svg" width="<?php echo $rendered_width; ?>" />
											</picture>
										<?php endif; ?>
									</a>
								</div><!-- .post-thumbnail-container -->
								<div class="content">
									<h3><a href="<?php echo get_the_permalink(); ?>" title="<?php echo $title; ?>" target="_self"><?php echo $title; ?></a></h3>
									<?php if($count_related_content == '2') : ?>
										<div class="body">
											<?php echo get_the_excerpt(); ?>
										</div><!-- .body -->
									<?php endif; ?>
									<div class="btn-group">
										<a role="button" class="btn btn-color-1 btn-minimal" href="<?php echo get_the_permalink(); ?>" target="_self" title="<?php echo $title; ?>">Read More</a>
									</div><!-- .home-blog-cta -->
								</div><!-- .content -->
							</div><!-- .article-container -->
						</article>
					<?php $counter++;
					endwhile;
					wp_reset_postdata(); // clean up after the query and pagination ?>
				</div><!-- .row.justify-content-between -->
			<?php else:  ?>
			<article>
				<p><?php _e( 'Sorry, there are no related posts.' ); ?></p>
			</article>
			<?php endif;
		endif; ?>
	</div><!-- .container -->
</section>