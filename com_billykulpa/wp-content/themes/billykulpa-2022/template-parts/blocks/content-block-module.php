<?php

/**
 * Content Block Module Template.
 */

// general vars
$contentURL = content_url();
$webp_path = $contentURL . '/webp-express/webp-images/uploads/';
$title = get_the_title();
// content block vars
$content_block = get_field('content_block');
if(have_rows('content_block')) : while(have_rows('content_block')) : the_row();
	// 'content_block' vars
	$section_padding_bottom = $content_block['section_padding_bottom'];
	$section_padding_top = $content_block['section_padding_top'];
	$background_type = $content_block['background_type'];
	$background_image_sizes = [];
	if($background_type == 'image') :
		$background_image = $content_block['background_image'];
		// background image vars
		$background_image_alt = $background_image['alt'];
		$background_image_name = $background_image['name'];
		$background_image_url = $background_image['url'];
		$background_image_height = $background_image['height'];
		$background_image_width = $background_image['width'];
		//gets all the images and webp versions
		$background_image_sizes = imageSizes($background_image['sizes']);
		$background_image_filename = $background_image['filename'];
		$background_image_filename_no_extension = pathinfo($background_image_filename, PATHINFO_FILENAME);
		$background_image_file_type = pathinfo($background_image_filename);
		// background image tint vars
		$background_image_tint = $content_block['background_image_tint'];
		$background_image_tint_blend_mode = $content_block['background_image_tint_blend_mode'];
	elseif($background_type == 'color') :
		$background_color = $content_block['background_color'];
	endif;
	$section_text_align_mobile = $content_block['section_text_align_mobile'];
	$section_text_align_desktop = $content_block['section_text_align_desktop'];
	$text_color = $content_block['text_color'];
	$links_color = $content_block['links_color'];
	$block_id = $content_block['block_id'];
	$block_classes = $content_block['block_classes'];
	$section_kicker = $content_block['section_kicker'];
	$section_kicker_color = $content_block['section_kicker_color'];
	$section_kicker_icon = $content_block['section_kicker_icon'];
	if($section_kicker_icon) {
		$section_kicker_icon_alt = $section_kicker_icon['alt'];
		$section_kicker_icon_name = $section_kicker_icon['name'];
		$section_kicker_icon_url = $section_kicker_icon['url'];

		//gets all the possible image sizes and webp versions
		$section_kicker_icon_sizes = imageSizes($section_kicker_icon['sizes']);

		$section_kicker_icon_filename = $section_kicker_icon['filename'];
		if(strpos($section_kicker_icon_filename, '-scaled.') !== false) {
			$section_kicker_icon_scaled_check = true;
			$section_kicker_icon_filename = str_replace('-scaled', '', $section_kicker_icon_filename);
		}
		$section_kicker_icon_file_type_array = pathinfo($section_kicker_icon_filename);
			$section_kicker_icon_file_type = $section_kicker_icon_file_type_array['extension'];
		// check if speaker_image is an SVG
		$section_kicker_icon_is_svg = false;
		if($section_kicker_icon_file_type == 'svg') :
			$section_kicker_icon_is_svg = true;
		endif;
	}
	$section_floating_image = $content_block['section_floating_image'];
	$section_floating_image_size = $content_block['section_floating_image_size'];
	$section_floating_image_sizes = [];
	if($section_floating_image) {
		$section_floating_image_alt = $section_floating_image['alt'];
		$section_floating_image_name = $section_floating_image['name'];
		$section_floating_image_url = $section_floating_image['url'];
		$section_floating_image_height = $section_floating_image['height'];
		$section_floating_image_width = $section_floating_image['width'];
		$section_floating_rendered_height = '';
		$section_floating_rendered_width = '';
		//gets all the possible image sizes and webp versions
		$section_floating_image_sizes = imageSizes($section_floating_image['sizes']);
		$section_floating_image_filename = $section_floating_image['filename'];
		if(strpos($section_floating_image_filename, '-scaled.') !== false) {
			$section_floating_image_scaled_check = true;
			$section_floating_image_filename = str_replace('-scaled', '', $section_floating_image_filename);
		}
		$section_floating_image_file_type_array = pathinfo($section_floating_image_filename);
			$section_floating_image_file_type = $section_floating_image_file_type_array['extension'];
		// check if speaker_image is an SVG
		$section_floating_image_is_svg = false;
		if($section_floating_image_file_type == 'svg') :
			$section_floating_image_is_svg = true;
		endif;
		$section_floating_image_below_headline = get_sub_field('image_below_headline');
	}
	$section_floating_image_caption = $content_block['section_floating_image_caption'];
	$section_headline = $content_block['section_headline'];
	$section_headline_light_font = $content_block['section_headline_light_font'];
	$section_headline_hierarchy = $content_block['section_headline_hierarchy'];
	$section_headline_hierarchy_appearance = $content_block['section_headline_hierarchy_appearance'];
	$section_content = $content_block['section_content'];
	$section_shortcode = $content_block['section_shortcode'];
	$column_horizontal_justification = $content_block['column_horizontal_justification'];
	$column_vertical_justification = $content_block['column_vertical_justification'];
	$section_has_cta =  $content_block['section_has_cta'];
	$section_ctas_justification = $content_block['section_ctas_justification'];
	$section_ctas = $content_block['section_ctas'];
	$has_sidenav = $content_block['has_sidenav'];
	if(!empty($has_sidenav)) :
		$sidenav = $content_block['sidenav']; // repeater
	endif;
	$columns = $content_block['columns'];
	$brand_pattern = $content_block['brand_pattern'];
	$brand_pattern_shape_1 = $brand_pattern['brand_pattern_shape_1'];
	if($brand_pattern_shape_1) :
		$brand_pattern_shape_1_style = $brand_pattern['brand_pattern_shape_1_style'];
		$brand_pattern_shape_1_color = $brand_pattern['brand_pattern_shape_1_color'];
		$brand_pattern_shape_1_opacity = $brand_pattern['brand_pattern_shape_1_opacity'];
	endif;
	$brand_pattern_shape_2 = $brand_pattern['brand_pattern_shape_2'];
	if($brand_pattern_shape_2) :
		$brand_pattern_shape_2_style = $brand_pattern['brand_pattern_shape_2_style'];
		$brand_pattern_shape_2_color = $brand_pattern['brand_pattern_shape_2_color'];
		$brand_pattern_shape_2_opacity = $brand_pattern['brand_pattern_shape_2_opacity'];
	endif;
	$stripe_pattern_side = $content_block['stripe_pattern_side'];
	//$column_count = count($content_block['columns']);
	// loop through the repeater ('columns') ?>
	<section class="content-block-module<?php if($section_padding_bottom != 'default') : echo ' ' . $section_padding_bottom; endif; if($section_padding_top != 'default') : echo ' ' . $section_padding_top; endif; if($background_type == 'color' && $background_color != 'bg-color-none') : echo ' ' . $background_color; endif; if($background_type == 'image') : echo ' has-bg-image'; endif; echo ' ' . $text_color . ' ' . $links_color; if($block_classes) : echo ' ' . $block_classes; endif; echo ' ' . $section_text_align_mobile . ' ' . $section_text_align_desktop; if($section_has_cta && !empty($section_ctas)) : ?> has-section-ctas<?php endif; if($section_has_cta && !empty($section_ctas) && !empty($columns)) : ?> has-section-cta-columns<?php endif; ?>"<?php if($block_id) : ?> id="<?php echo $block_id; ?>"<?php endif; ?>>
		<div class="container">
			<div class="content<?php if(empty($section_headline) && empty($section_content) && empty($section_shortcode)) : ?> no-section-content<?php endif; ?>">
				<?php if(!empty($has_sidenav) && !empty($sidenav)) : ?>
					<div class="row justify-content-between">
						<div class="sidenav">
							<ul>
								<?php foreach($sidenav as $item) :
									// vars
									$label = $item['sidenav_label'];
									$active = $item['sidenav_active'];
									$url = $item['sidenav_url']; ?>
									<li<?php if(!empty($active)) : ?> class="active"<?php endif; ?>>
										<?php if(empty($active)) : ?><a href="<?php echo $url; ?>" target="_self" title="<?php echo $label; ?>"><?php else : ?><span><?php endif;
											if(!empty($active)) : ?>
												<div class="active-indicator">
													<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
														<defs>
															<style>.fill-color-none{fill:none;}.fill-color-1{fill:#a6ce39;}.fill-color-dark{fill:#0a0f0a;}</style>
														</defs>
														<g>
															<rect class="fill-color-none" width="100" height="100"></rect>
															<polygon class="fill-color-1" points="78.59 50 46.72 68.75 46.72 31.25 78.59 50"></polygon>
															<path class="fill-color-dark" d="M20.16,77.19V22.82L66.37,50Zm2.5-50V72.82L61.44,50Z"></path>
														</g>
													</svg>
												</div>
											<?php endif;
											echo $label;
										if(empty($active)) : ?></a><?php else : ?></span><?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						</div><!-- .sidenav -->
						<div class="main">
					<?php endif; ?>
					<div class="row <?php echo $column_horizontal_justification; ?>">
						<?php if(!empty($section_floating_image) || !empty($section_kicker) || !empty($section_headline) || !empty($section_content) || !empty($section_shortcode)) : ?>
						<div class="col-12 section-content">
						<?php endif;
							if($section_kicker) : ?>
								<div class="kicker-container<?php if(!empty($section_kicker_icon)): ?> has-icon<?php endif; ?>">
									<?php if(!empty($section_kicker_icon)): ?>
										<div class="icon kicker-icon"><img<?php if(!empty($section_kicker_icon_alt)) : ?> alt="<?php echo $section_kicker_icon_alt; ?>"<?php endif; ?> height="32" src="<?php echo $section_kicker_icon_url; ?>" width="32" /></div><!-- .icon.kicker-icon -->
									<?php endif; ?>
									<span class="kicker <?php echo $section_kicker_color; ?>"><?php echo $section_kicker; ?></span>
								</div><!-- .kicker-container -->
							<?php endif;
							if($section_headline) : ?>
								<div class="headline-container<?php if(!empty($section_headline_light_font)) : ?> headline-light<?php endif; ?>">
								<<?php echo $section_headline_hierarchy;  ?> class="<?php echo $section_headline_hierarchy_appearance; ?>"><?php echo $section_headline; ?></<?php echo $section_headline_hierarchy; ?>>
								</div><!-- .headline-container -->
							<?php endif;
							if(!empty($section_floating_image)) : ?>
								<div class="image-wrapper section-floating-image <?php echo $section_floating_image_size; ?>">
									<?php if(!empty($section_floating_image_caption)) : ?>
									<figure>
									<?php endif; ?>
										<picture>
										<?php if(!$section_floating_image_is_svg) :
											switch ($section_floating_image_size) :
												case 'float-half' :
													$section_floating_rendered_width = '601';
													if($section_floating_image_sizes['size_700']['webp']) : ?><source srcset="<?php echo $section_floating_image_sizes['size_700']['webp']; ?>" media="(min-width: 1200px)" type="image/webp"><?php endif; ?>
													<?php if($section_floating_image_sizes['size_600']['webp']) : ?><source srcset="<?php echo $section_floating_image_sizes['size_600']['webp']; ?>" media="(min-width: 992px)" type="image/webp"><?php endif; ?>
													<?php if($section_floating_image_sizes['size_500']['webp']) : ?><source srcset="<?php echo $section_floating_image_sizes['size_500']['webp']; ?>" media="(min-width: 768px)" type="image/webp"><?php endif; ?>
													<source srcset="<?php echo $section_floating_image_sizes['size_700']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $section_floating_image_file_type; ?>">
													<source srcset="<?php echo $section_floating_image_sizes['size_600']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $section_floating_image_file_type; ?>">
													<source srcset="<?php echo $section_floating_image_sizes['size_500']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $section_floating_image_file_type; ?>">
												<?php break;
												case 'float-40' :
													$section_floating_rendered_width = '476';
													if($section_floating_image_sizes['size_600']['webp']) : ?><source srcset="<?php echo $section_floating_image_sizes['size_600']['webp']; ?>" media="(min-width: 1400px)" type="image/webp"><?php endif; ?>
													<?php if($section_floating_image_sizes['size_500']['webp']) : ?><source srcset="<?php echo $section_floating_image_sizes['size_500']['webp']; ?>" media="(min-width: 1200px)" type="image/webp"><?php endif; ?>
													<?php if($section_floating_image_sizes['size_400']['webp']) : ?><source srcset="<?php echo $section_floating_image_sizes['size_400']['webp']; ?>" media="(min-width: 768px)" type="image/webp"><?php endif; ?>
													<source srcset="<?php echo $section_floating_image_sizes['size_600']['original']; ?>" media="(min-width: 1400px)" type="image/<?php echo $section_floating_image_file_type; ?>">
													<source srcset="<?php echo $section_floating_image_sizes['size_500']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $section_floating_image_file_type; ?>">
													<source srcset="<?php echo $section_floating_image_sizes['size_400']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $section_floating_image_file_type; ?>">
												<?php break;
												case 'float-third' :
													$section_floating_rendered_width = '393';
													if($section_floating_image_sizes['size_400']['webp']) : ?><source srcset="<?php echo $section_floating_image_sizes['size_400']['webp']; ?>" media="(min-width: 1200px)" type="image/webp"><?php endif; ?>
													<?php if($section_floating_image_sizes['size_300']['webp']) : ?><source srcset="<?php echo $section_floating_image_sizes['size_300']['webp']; ?>" media="(min-width: 768px)" type="image/webp"><?php endif; ?>
													<source srcset="<?php echo $section_floating_image_sizes['size_400']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $section_floating_image_file_type; ?>">
													<source srcset="<?php echo $section_floating_image_sizes['size_300']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $section_floating_image_file_type; ?>">
												<?php break;
												case 'float-quarter' :
													$section_floating_rendered_width = '289';
													if($section_floating_image_sizes['size_300']['webp']) : ?><source srcset="<?php echo $section_floating_image_sizes['size_300']['webp']; ?>" media="(min-width: 1200px)" type="image/webp"><?php endif; ?>
													<?php if($section_floating_image_sizes['size_200']['webp']) : ?><source srcset="<?php echo $section_floating_image_sizes['size_200']['webp']; ?>" media="(min-width: 768px)" type="image/webp"><?php endif; ?>
													<source srcset="<?php echo $section_floating_image_sizes['size_300']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $section_floating_image_file_type; ?>">
													<source srcset="<?php echo $section_floating_image_sizes['size_200']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $section_floating_image_file_type; ?>">
												<?php break; ?>
											<?php endswitch;
											// everything below 768 will be 50%
											if($section_floating_image_sizes['size_300']['webp']) : ?><source srcset="<?php echo $section_floating_image_sizes['size_300']['webp']; ?>" media="(min-width: 576px)" type="image/webp"><?php endif; ?>
											<source srcset="<?php echo $section_floating_image_sizes['size_300']['original']; ?>" media="(min-width: 576px)" type="image/<?php echo $section_floating_image_file_type; ?>">
											<?php // everything below 575 will be 100%
											if($section_floating_image_sizes['size_500']['webp']) : ?><source srcset="<?php echo $section_floating_image_sizes['size_500']['webp']; ?>" media="(max-width: 575px)" type="image/webp"><?php endif; ?>
											<source srcset="<?php echo $section_floating_image_sizes['size_500']['original']; ?>" media="(max-width: 575px)" type="image/<?php echo $section_floating_image_file_type; ?>">
										<?php endif;
										// set height if width is not empty
										if(!empty($section_floating_rendered_width)) :
											$section_floating_rendered_height = $section_floating_rendered_width * $section_floating_image_height / $section_floating_image_width;
										endif; ?>
										<img alt="<?php if(!empty($section_floating_image_alt)) : echo $section_floating_image_alt; else : echo $title; endif; ?>" height="<?php echo $section_floating_rendered_height; ?>" src="<?php echo $section_floating_image_url; ?>" width="<?php echo $section_floating_rendered_width; ?>" />
										</picture>
									<?php if(!empty($section_floating_image_caption)) : ?>
										<figcaption><?php echo $section_floating_image_caption; ?></figcaption>
									</figure>
								<?php endif; ?>
								</div><!-- .image-wrapper -->
							<?php endif;
							if($section_content) : ?>
								<div class="body-container"><?php echo $section_content; ?></div><!-- .body-container -->
							<?php endif;
							if(!empty($section_shortcode)) : ?>
								<div class="shortcode-container"><?php echo do_shortcode($section_shortcode); ?></div><!-- .shortcode-container -->
							<?php endif;
							if($section_has_cta && !empty($section_ctas)) : ?>
							<div class="cta <?php echo $section_text_align_desktop . ' ' . $section_text_align_mobile . ' ' . $section_ctas_justification; if(empty($section_headline) && empty($section_content)) : ?> cta-only<?php endif; ?>">
								<div class="btn-group">
								<?php foreach($section_ctas as $section_cta) :
									// vars
									$section_cta_disabled = $section_cta['section_cta_disabled'];
									$section_file_download = $section_cta['section_file_download'];
									$section_cta_text = $section_cta['section_cta_text'];
									$section_cta_color = $section_cta['section_cta_color'];
									$section_cta_size = $section_cta['section_cta_size'];
									$section_cta_title = $section_cta['section_cta_title'];
									$section_cta_target = $section_cta['section_cta_target'];
									$section_cta_url = $section_cta['section_cta_url']; ?>
									<a class="btn <?php echo $section_cta_size . ' ' . $section_cta_color; if($section_cta_disabled) : echo ' btn-disabled'; endif; ?>" <?php if(!$section_cta_disabled) : ?>href="<?php echo $section_cta_url; ?>" role="button" target="<?php if($section_cta_target) : echo $section_cta_target; else : echo '_self'; endif; ?>" title="<?php if($section_cta_title) : echo $section_cta_title; else : echo $section_cta_text; endif; ?>"<?php if(!empty($section_file_download)) : ?> download<?php endif; endif; ?>><?php echo $section_cta_text; ?></a>
								<?php endforeach; ?>
								</div><!-- .btn-group -->
							</div><!-- .cta -->
							<?php endif;
						if($section_kicker || $section_headline || $section_content) : ?>
						</div><!-- .col-12.section-content -->
						<?php endif;
						if(have_rows('columns')) :
							while(have_rows('columns')) : the_row();
								$column_id = get_sub_field('column_id');
								$column_classes = get_sub_field('column_classes');
								$column_margin_top = get_sub_field('column_margin_top');  
								$column_margin_bottom = get_sub_field('column_margin_bottom');  
								// width vars
								$responsive_column_widths = get_sub_field('responsive_column_widths');
								if($responsive_column_widths) :
									$column_width_xl = get_sub_field('column_width_xl');
									$column_width_lg = get_sub_field('column_width_lg');
									$column_width_md = get_sub_field('column_width_md');
									$column_width_sm = get_sub_field('column_width_sm');
									$column_width_xs = get_sub_field('column_width_xs');
									$column_widths = 'col ' . $column_width_xs . ' ' . $column_width_sm . ' ' . $column_width_md . ' ' . $column_width_lg . ' ' . $column_width_xl;
								else :
									$column_width_default = get_sub_field('column_width_default');
									$column_widths = 'col col-12 ' . $column_width_default;
								endif;
								// position vars
								$column_order_position = get_sub_field('column_order_position');
								$column_order_trigger = get_sub_field('column_order_trigger');
								if($column_order_position == 'first') :
									$column_order_position_formatted = ' order-' . $column_order_trigger . '-first';
								elseif($column_order_position == 'last') :
									$column_order_position_formatted = ' order-' . $column_order_trigger . '-last';
								else :
									$column_order_position_formatted = '';
								endif;
								// content vars
								$text_align = get_sub_field('text_align');
								$text_align_mobile = get_sub_field('text_align_mobile');
								$kicker = get_sub_field('kicker');
								$kicker_color = get_sub_field('kicker_color');
								$kicker_icon = get_sub_field('kicker_icon');
								if($kicker_icon) {
									$kicker_icon_alt = $kicker_icon['alt'];
									$kicker_icon_name = $kicker_icon['name'];
									$kicker_icon_url = $kicker_icon['url'];

									//gets all the possible image sizes and webp versions
									$kicker_icon_sizes = imageSizes($kicker_icon['sizes']);

									$kicker_icon_filename = $kicker_icon['filename'];
									if(strpos($kicker_icon_filename, '-scaled.') !== false) {
										$kicker_icon_scaled_check = true;
										$kicker_icon_filename = str_replace('-scaled', '', $kicker_icon_filename);
									}
									$kicker_icon_file_type_array = pathinfo($kicker_icon_filename);
										$kicker_icon_file_type = $kicker_icon_file_type_array['extension'];
									// check if speaker_image is an SVG
									$kicker_icon_is_svg = false;
									if($kicker_icon_file_type == 'svg') :
										$kicker_icon_is_svg = true;
									endif;
								}
								$headline = get_sub_field('headline');
								$headline_as_link = get_sub_field('headline_as_link');
								if($headline_as_link) :
									$headline_link_url = get_sub_field('headline_link_url');
									$headline_link_title = get_sub_field('headline_link_title');
									$headline_link_target = get_sub_field('headline_link_target');
								endif;
								$headline_hierarchy = get_sub_field('headline_hierarchy');
								$headline_hierarchy_appearance = get_sub_field('headline_hierarchy_appearance');
								$smaller_body_text = get_sub_field('smaller_body_text');
								$body = get_sub_field('body');
								$shortcode = get_sub_field('shortcode');
								$has_cta = get_sub_field('has_cta');
								$ctas_justification = get_sub_field('ctas_justification');
								$ctas = get_sub_field('ctas');
								$image = get_sub_field('image');
								$image_sizes = [];
								if($image) {
									$image_alt = $image['alt'];
									$image_name = $image['name'];
									$image_url = $image['url'];
									$image_height = $image['height'];
									$image_width = $image['width'];
									$rendered_height = '';
									$rendered_width = '';
									//gets all the possible image sizes and webp versions
									$image_sizes = imageSizes($image['sizes']);
									$image_filename = $image['filename'];
									if(strpos($image_filename, '-scaled.') !== false) {
										$image_scaled_check = true;
										$image_filename = str_replace('-scaled', '', $image_filename);
									}
									$image_file_type_array = pathinfo($image_filename);
										$image_file_type = $image_file_type_array['extension'];
									// check if speaker_image is an SVG
									$image_is_svg = false;
									if($image_file_type == 'svg') :
										$image_is_svg = true;
										// height / width calculations
										$raw_svg = simplexml_load_file($image_url);
										$raw_viewbox = $raw_svg['viewBox'];
										$exploded_viewbox = explode(' ', $raw_viewbox);
										$img_width = $exploded_viewbox[2]; // 3rd word in string
										$img_height = $exploded_viewbox[3]; // 4th word in string
									endif;
									$image_below_headline = get_sub_field('image_below_headline');
									// image links
									$image_as_link = get_sub_field('image_as_link');
									if($image_as_link) :
										$image_link_url = get_sub_field('image_link_url');
										$image_link_title = get_sub_field('image_link_title');
										$image_link_target = get_sub_field('image_link_target');
									endif;
									// rendered width sizes
									if(!$responsive_column_widths) :
										switch ($column_width_default) :
											case 'col-lg-12' :
												$rendered_width = '1250';
											break;
											case 'col-lg-11' :
												$rendered_width = '1143';
											break;
											case 'col-lg-10' :
												$rendered_width = '1032';
											break;
											case 'col-lg-9' :
												$rendered_width = '930';
											break;
											case 'col-lg-8' :
												$rendered_width = '823';
											break;
											case 'col-lg-7' :
												$rendered_width = '712';
											break;
											case 'col-lg-6' :
												$rendered_width = '610';
											break;
											case 'col-lg-5' :
												$rendered_width = '503';
											break;
											case 'col-lg-4' :
												$rendered_width = '392';
											break;
											case 'col-lg-3' :
												$rendered_width = '290';
											break;
											case 'col-lg-2' :
												$rendered_width = '183';
											break;
											case 'col-lg-1' :
												$rendered_width = '72';
											break;
										endswitch;
									else :
										switch ($column_width_xl) :
											case 'col-xl-12' :
												$rendered_width = '1250';
											break;
											case 'col-xl-11' :
												$rendered_width = '1143';
											break;
											case 'col-xl-10' :
												$rendered_width = '1032';
											break;
											case 'col-xl-9' :
												$rendered_width = '930';
											break;
											case 'col-xl-8' :
												$rendered_width = '823';
											break;
											case 'col-xl-7' :
												$rendered_width = '712';
											break;
											case 'col-xl-6' :
												$rendered_width = '610';
											break;
											case 'col-xl-5' :
												$rendered_width = '503';
											break;
											case 'col-xl-4' :
												$rendered_width = '392';
											break;
											case 'col-xl-3' :
												$rendered_width = '290';
											break;
											case 'col-xl-2' :
												$rendered_width = '183';
											break;
											case 'col-xl-1' :
												$rendered_width = '72';
											break;
										endswitch;

										switch ($column_width_lg) :
											case 'col-lg-12' :
												$rendered_width = '930';
											break;
											case 'col-lg-11' :
												$rendered_width = '850';
											break;
											case 'col-lg-10' :
												$rendered_width = '767';
											break;
											case 'col-lg-9' :
												$rendered_width = '690';
											break;
											case 'col-lg-8' :
												$rendered_width = '610';
											break;
											case 'col-lg-7' :
												$rendered_width = '527';
											break;
											case 'col-lg-6' :
												$rendered_width = '450';
											break;
											case 'col-lg-5' :
												$rendered_width = '370';
											break;
											case 'col-lg-4' :
												$rendered_width = '287';
											break;
											case 'col-lg-3' :
												$rendered_width = '210';
											break;
											case 'col-lg-2' :
												$rendered_width = '130';
											break;
											case 'col-lg-1' :
												$rendered_width = '47';
											break;
										endswitch;

										switch ($column_width_md) :
											case 'col-md-12' :
												$rendered_width = '690';
											break;
											case 'col-md-11' :
												$rendered_width = '630';
											break;
											case 'col-md-10' :
												$rendered_width = '568';
											break;
											case 'col-md-9' :
												$rendered_width = '510';
											break;
											case 'col-md-8' :
												$rendered_width = '450';
											break;
											case 'col-md-7' :
												$rendered_width = '388';
											break;
											case 'col-md-6' :
												$rendered_width = '330';
											break;
											case 'col-md-5' :
												$rendered_width = '270';
											break;
											case 'col-md-4' :
												$rendered_width = '208';
											break;
											case 'col-md-3' :
												$rendered_width = '150';
											break;
											case 'col-md-2' :
												$rendered_width = '90';
											break;
											case 'col-md-1' :
												$rendered_width = '28';
											break;
										endswitch;

										switch ($column_width_sm) :
											case 'col-sm-12' :
												$rendered_width = '510';
											break;
											case 'col-sm-11' :
												$rendered_width = '465';
											break;
											case 'col-sm-10' :
												$rendered_width = '419';
											break;
											case 'col-sm-9' :
												$rendered_width = '375';
											break;
											case 'col-sm-8' :
												$rendered_width = '330';
											break;
											case 'col-sm-7' :
												$rendered_width = '283';
											break;
											case 'col-sm-6' :
												$rendered_width = '240';
											break;
											case 'col-sm-5' :
												$rendered_width = '195';
											break;
											case 'col-sm-4' :
												$rendered_width = '148';
											break;
											case 'col-sm-3' :
												$rendered_width = '105';
											break;
											case 'col-sm-2' :
												$rendered_width = '60';
											break;
											case 'col-sm-1' :
												$rendered_width = '13';
											break;
										endswitch;

										switch ($column_width_xs) :
											case 'col-12' :
												$rendered_width = '530';
											break;
											case 'col-11' :
												$rendered_width = '483';
											break;
											case 'col-10' :
												$rendered_width = '435';
											break;
											case 'col-9' :
												$rendered_width = '390';
											break;
											case 'col-8' :
												$rendered_width = '343';
											break;
											case 'col-7' :
												$rendered_width = '295';
											break;
											case 'col-6' :
												$rendered_width = '250';
											break;
											case 'col-5' :
												$rendered_width = '203';
											break;
											case 'col-4' :
												$rendered_width = '155';
											break;
											case 'col-3' :
												$rendered_width = '110';
											break;
											case 'col-2' :
												$rendered_width = '63';
											break;
											case 'col-1' :
												$rendered_width = '15';
											break;
										endswitch;
									endif;
								}
								$image_highlight = get_sub_field('image_highlight');
								$image_caption = get_sub_field('image_caption');
								?>
							<div class="<?php echo $column_widths . $column_order_position_formatted; if($column_margin_top != 'none') : echo ' ' . $column_margin_top; endif; if($column_margin_bottom != 'none') : echo ' ' . $column_margin_bottom; endif; if($column_classes) : echo ' ' . $column_classes; endif; if($image && empty($kicker) && empty($headline) && empty($body)) : echo ' image-col'; endif; echo ' ' . $column_vertical_justification; ?>"<?php if($column_id) : ?> id="<?php echo $column_id; ?>"<?php endif; ?>>
								<div class="content-wrapper">
									<div class="column-content <?php echo $text_align . ' ' . $text_align_mobile; if($has_cta) : ?> has-cta<?php endif; if($image_below_headline) : ?> image-below-headline<?php endif; ?>">
										<?php if(!empty($image)) : ?>
											<div class="image-wrapper">
										<?php endif;
										if(!empty($image) && !empty($image_as_link) && !empty($image_link_url)) : ?>
											<a href="<?php echo $image_link_url; ?>" target="<?php echo $image_link_target; ?>" title="<?php if($image_link_title) : echo $image_link_title; else : echo $headline; endif; ?>">
										<?php endif;
										if(!empty($image)) : ?>
											<?php if(!empty($image_caption)) : ?>
											<figure>
											<?php endif; ?>
												<picture>

											<?php if(!$image_is_svg) :
												if(!$responsive_column_widths) :
													switch ($column_width_default) :
														case 'col-lg-12' :
															// srcset
															if($image_sizes['size_1400']['webp']) : ?><source srcset="<?php echo $image_sizes['size_1400']['webp']; ?>" media="(min-width: 1200px)" type="image/webp"><?php endif; ?>
															<?php if($image_sizes['size_1000']['webp']) : ?><source srcset="<?php echo $image_sizes['size_1000']['webp']; ?>" media="(min-width: 992px)" type="image/webp"><?php endif; ?>
															<source srcset="<?php echo $image_sizes['size_1400']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $image_file_type; ?>">
															<source srcset="<?php echo $image_sizes['size_1000']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
														<?php break;
														case 'col-lg-11' :
															// srcset
															if($image_sizes['size_1100']['webp']) : ?><source srcset="<?php echo $image_sizes['size_1100']['webp']; ?>" media="(min-width: 1200px)" type="image/webp"><?php endif; ?>
															<?php if($image_sizes['size_900']['webp']) : ?><source srcset="<?php echo $image_sizes['size_900']['webp']; ?>" media="(min-width: 992px)" type="image/webp"><?php endif; ?>
															<source srcset="<?php echo $image_sizes['size_1100']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $image_file_type; ?>">
															<source srcset="<?php echo $image_sizes['size_900']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
														<?php break;
														case 'col-lg-10' :
															// srcset
															if($image_sizes['size_1000']['webp']) : ?><source srcset="<?php echo $image_sizes['size_1000']['webp']; ?>" media="(min-width: 1200px)" type="image/webp"><?php endif; ?>
															<?php if($image_sizes['size_800']['webp']) : ?><source srcset="<?php echo $image_sizes['size_800']['webp']; ?>" media="(min-width: 992px)" type="image/webp"><?php endif; ?>
															<source srcset="<?php echo $image_sizes['size_1000']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $image_file_type; ?>">
															<source srcset="<?php echo $image_sizes['size_800']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
														<?php break;
														case 'col-lg-9' :
															// srcset
															if($image_sizes['size_900']['webp']) : ?><source srcset="<?php echo $image_sizes['size_900']['webp']; ?>" media="(min-width: 1200px)" type="image/webp"><?php endif; ?>
															<?php if($image_sizes['size_800']['webp']) : ?><source srcset="<?php echo $image_sizes['size_800']['webp']; ?>" media="(min-width: 992px)" type="image/webp"><?php endif; ?>
															<source srcset="<?php echo $image_sizes['size_900']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $image_file_type; ?>">
															<source srcset="<?php echo $image_sizes['size_800']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
														<?php break;
														case 'col-lg-8' :
															// srcset
															if($image_sizes['size_900']['webp']) : ?><source srcset="<?php echo $image_sizes['size_900']['webp']; ?>" media="(min-width: 1200px)" type="image/webp"><?php endif; ?>
															<?php if($image_sizes['size_800']['webp']) : ?><source srcset="<?php echo $image_sizes['size_800']['webp']; ?>" media="(min-width: 992px)" type="image/webp"><?php endif; ?>
															<source srcset="<?php echo $image_sizes['size_900']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $image_file_type; ?>">
															<source srcset="<?php echo $image_sizes['size_800']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
														<?php break;
														case 'col-lg-7' :
															// srcset
															if($image_sizes['size_800']['webp']) : ?><source srcset="<?php echo $image_sizes['size_800']['webp']; ?>" media="(min-width: 1200px)" type="image/webp"><?php endif; ?>
															<?php if($image_sizes['size_700']['webp']) : ?><source srcset="<?php echo $image_sizes['size_700']['webp']; ?>" media="(min-width: 992px)" type="image/webp"><?php endif; ?>
															<source srcset="<?php echo $image_sizes['size_800']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $image_file_type; ?>">
															<source srcset="<?php echo $image_sizes['size_700']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
														<?php break;
														case 'col-lg-6' :
															// srcset
															if($image_sizes['size_700']['webp']) : ?><source srcset="<?php echo $image_sizes['size_700']['webp']; ?>" media="(min-width: 1200px)" type="image/webp"><?php endif; ?>
															<?php if($image_sizes['size_600']['webp']) : ?><source srcset="<?php echo $image_sizes['size_600']['webp']; ?>" media="(min-width: 992px)" type="image/webp"><?php endif; ?>
															<source srcset="<?php echo $image_sizes['size_700']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $image_file_type; ?>">
															<source srcset="<?php echo $image_sizes['size_600']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
														<?php break;
														case 'col-lg-5' :
															// srcset
															if($image_sizes['size_600']['webp']) : ?><source srcset="<?php echo $image_sizes['size_600']['webp']; ?>" media="(min-width: 1200px)" type="image/webp"><?php endif; ?>
															<?php if($image_sizes['size_500']['webp']) : ?><source srcset="<?php echo $image_sizes['size_500']['webp']; ?>" media="(min-width: 992px)" type="image/webp"><?php endif; ?>
															<source srcset="<?php echo $image_sizes['size_600']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $image_file_type; ?>">
															<source srcset="<?php echo $image_sizes['size_500']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
														<?php break;
														case 'col-lg-4' :
															// srcset
															if($image_sizes['size_500']['webp']) : ?><source srcset="<?php echo $image_sizes['size_500']['webp']; ?>" media="(min-width: 992px)" type="image/webp"><?php endif; ?>
															<source srcset="<?php echo $image_sizes['size_400']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
														<?php break;
														case 'col-lg-3' :
															// srcset
															if($image_sizes['size_300']['webp']) : ?><source srcset="<?php echo $image_sizes['size_300']['webp']; ?>" media="(min-width: 992px)" type="image/webp"><?php endif; ?>
															<source srcset="<?php echo $image_sizes['size_300']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
														<?php break;
														case 'col-lg-2' :
															// srcset
															if($image_sizes['size_200']['webp']) : ?><source srcset="<?php echo $image_sizes['size_200']['webp']; ?>" media="(min-width: 992px)" type="image/webp"><?php endif; ?>
															<source srcset="<?php echo $image_sizes['size_200']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
														<?php break;
														case 'col-lg-1' :
															// srcset
															if($image_sizes['size_200']['webp']) : ?><source srcset="<?php echo $image_sizes['size_200']['webp']; ?>" media="(min-width: 992px)" type="image/webp"><?php endif; ?>
															<source srcset="<?php echo $image_sizes['size_200']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
														<?php break; ?>
													<?php endswitch; ?>
													<?php if($image_sizes['size_800']['webp']) : ?><source srcset="<?php echo $image_sizes['size_800']['webp']; ?>" media="(min-width: 768px)" type="image/webp"><?php endif; ?>
													<?php if($image_sizes['size_600']['webp']) : ?><source srcset="<?php echo $image_sizes['size_600']['webp']; ?>" media="(min-width: 516px)" type="image/webp"><?php endif; ?>
													<?php if($image_sizes['size_500']['webp']) : ?><source srcset="<?php echo $image_sizes['size_500']['webp']; ?>" media="(max-width: 515px)" type="image/webp"><?php endif; ?>
													<source srcset="<?php echo $image_sizes['size_800']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $image_file_type; ?>">
													<source srcset="<?php echo $image_sizes['size_600']['original']; ?>" media="(min-width: 516px)" type="image/<?php echo $image_file_type; ?>">
													<source srcset="<?php echo $image_sizes['size_500']['original']; ?>" media="(max-width: 515px)" type="image/<?php echo $image_file_type; ?>">
												<?php else : ?>
													<source srcset="<?php switch ($column_width_xl) :
														case 'col-xl-12' :
															if($image_sizes['size_1200']['webp']) :
																echo $image_sizes['size_1200']['webp'];
															endif;
														break;
														case 'col-xl-11' :
															if($image_sizes['size_1100']['webp']) :
																echo $image_sizes['size_1100']['webp'];
															endif;
														break;
														case 'col-xl-10' :
															if($image_sizes['size_1000']['webp']) :
																echo $image_sizes['size_1000']['webp'];
															endif;
														break;
														case 'col-xl-9' :
															if($image_sizes['size_900']['webp']) :
																echo $image_sizes['size_900']['webp'];
															endif;
														break;
														case 'col-xl-8' :
															if($image_sizes['size_800']['webp']) :
																echo $image_sizes['size_800']['webp'];
															endif;
														break;
														case 'col-xl-7' :
															if($image_sizes['size_700']['webp']) :
																echo $image_sizes['size_700']['webp'];
															endif;
														break;
														case 'col-xl-6' :
															if($image_sizes['size_600']['webp']) :
																echo $image_sizes['size_600']['webp'];
															endif;
														break;
														case 'col-xl-5' :
															if($image_sizes['size_500']['webp']) :
																echo $image_sizes['size_500']['webp'];
															endif;
														break;
														case 'col-xl-4' :
															if($image_sizes['size_400']['webp']) :
																echo $image_sizes['size_400']['webp'];
															endif;
														break;
														case 'col-xl-3' :
															if($image_sizes['size_300']['webp']) :
																echo $image_sizes['size_300']['webp'];
															endif;
														break;
														case 'col-xl-2' :
															if($image_sizes['size_200']['webp']) :
																echo $image_sizes['size_200']['webp'];
															endif;
														break;
														case 'col-xl-1' :
															if($image_sizes['size_200']['webp']) :
																echo $image_sizes['size_200']['webp'];
															endif;
														break;
													endswitch; ?>" media="(min-width: 1200px)" type="image/webp">
													<source srcset="<?php switch ($column_width_lg) :
														case 'col-lg-12' :
															if($image_sizes['size_1000']['webp']) :
																echo $image_sizes['size_1000']['webp'];
															endif;
														break;
														case 'col-lg-11' :
															if($image_sizes['size_900']['webp']) :
																echo $image_sizes['size_900']['webp'];
															endif;
														break;
														case 'col-lg-10' :
															if($image_sizes['size_800']['webp']) :
																echo $image_sizes['size_800']['webp'];
															endif;
														break;
														case 'col-lg-9' :
															if($image_sizes['size_800']['webp']) :
																echo $image_sizes['size_800']['webp'];
															endif;
														break;
														case 'col-lg-8' :
															if($image_sizes['size_700']['webp']) :
																echo $image_sizes['size_700']['webp'];
															endif;
														break;
														case 'col-lg-7' :
															if($image_sizes['size_600']['webp']) :
																echo $image_sizes['size_600']['webp'];
															endif;
														break;
														case 'col-lg-6' :
															if($image_sizes['size_500']['webp']) :
																echo $image_sizes['size_500']['webp'];
															endif;
														break;
														case 'col-lg-5' :
															if($image_sizes['size_400']['webp']) :
																echo $image_sizes['size_400']['webp'];
															endif;
														break;
														case 'col-lg-4' :
															if($image_sizes['size_400']['webp']) :
																echo $image_sizes['size_400']['webp'];
															endif;
														break;
														case 'col-lg-3' :
															if($image_sizes['size_300']['webp']) :
																echo $image_sizes['size_300']['webp'];
															endif;
														break;
														case 'col-lg-2' :
															if($image_sizes['size_200']['webp']) :
																echo $image_sizes['size_200']['webp'];
															endif;
														break;
														case 'col-lg-1' :
															if($image_sizes['size_200']['webp']) :
																echo $image_sizes['size_200']['webp'];
															endif;
														break;
													endswitch; ?>" media="(min-width: 992px)" type="image/webp">
													<source srcset="<?php switch ($column_width_md) :
														case 'col-md-12' :
															if($image_sizes['size_800']['webp']) :
																echo $image_sizes['size_800']['webp'];
															endif;
														break;
														case 'col-md-11' :
															if($image_sizes['size_700']['webp']) :
																echo $image_sizes['size_700']['webp'];
															endif;
														break;
														case 'col-md-10' :
															if($image_sizes['size_600']['webp']) :
																echo $image_sizes['size_600']['webp'];
															endif;
														break;
														case 'col-md-9' :
															if($image_sizes['size_600']['webp']) :
																echo $image_sizes['size_600']['webp'];
															endif;
														break;
														case 'col-md-8' :
															if($image_sizes['size_500']['webp']) :
																echo $image_sizes['size_500']['webp'];
															endif;
														break;
														case 'col-md-7' :
															if($image_sizes['size_500']['webp']) :
																echo $image_sizes['size_500']['webp'];
															endif;
														break;
														case 'col-md-6' :
															if($image_sizes['size_400']['webp']) :
																echo $image_sizes['size_400']['webp'];
															endif;
														break;
														case 'col-md-5' :
															if($image_sizes['size_300']['webp']) :
																echo $image_sizes['size_300']['webp'];
															endif;
														break;
														case 'col-md-4' :
															if($image_sizes['size_300']['webp']) :
																echo $image_sizes['size_300']['webp'];
															endif;
														break;
														case 'col-md-3' :
															if($image_sizes['size_200']['webp']) :
																echo $image_sizes['size_200']['webp'];
															endif;
														break;
														case 'col-md-2' :
															if($image_sizes['size_200']['webp']) :
																echo $image_sizes['size_200']['webp'];
															endif;
														break;
														case 'col-md-1' :
															if($image_sizes['size_200']['webp']) :
																echo $image_sizes['size_200']['webp'];
															endif;
														break;
													endswitch; ?>" media="(min-width: 768px)" type="image/webp">
													<source srcset="<?php switch ($column_width_sm) :
														case 'col-sm-12' :
															if($image_sizes['size_600']['webp']) :
																echo $image_sizes['size_600']['webp'];
															endif;
														break;
														case 'col-sm-11' :
															if($image_sizes['size_500']['webp']) :
																echo $image_sizes['size_500']['webp'];
															endif;
														break;
														case 'col-sm-10' :
															if($image_sizes['size_500']['webp']) :
																echo $image_sizes['size_500']['webp'];
															endif;
														break;
														case 'col-sm-9' :
															if($image_sizes['size_500']['webp']) :
																echo $image_sizes['size_500']['webp'];
															endif;
														break;
														case 'col-sm-8' :
															if($image_sizes['size_400']['webp']) :
																echo $image_sizes['size_400']['webp'];
															endif;
														break;
														case 'col-sm-7' :
															if($image_sizes['size_400']['webp']) :
																echo $image_sizes['size_400']['webp'];
															endif;
														break;
														case 'col-sm-6' :
															if($image_sizes['size_300']['webp']) :
																echo $image_sizes['size_300']['webp'];
															endif;
														break;
														case 'col-sm-5' :
															if($image_sizes['size_300']['webp']) :
																echo $image_sizes['size_300']['webp'];
															endif;
														break;
														case 'col-sm-4' :
															if($image_sizes['size_200']['webp']) :
																echo $image_sizes['size_200']['webp'];
															endif;
														break;
														case 'col-sm-3' :
															if($image_sizes['size_200']['webp']) :
																echo $image_sizes['size_200']['webp'];
															endif;
														break;
														case 'col-sm-2' :
															if($image_sizes['size_200']['webp']) :
																echo $image_sizes['size_200']['webp'];
															endif;
														break;
														case 'col-sm-1' :
															if($image_sizes['size_200']['webp']) :
																echo $image_sizes['size_200']['webp'];
															endif;
														break;
													endswitch; ?>" media="(min-width: 576px)" type="image/webp">
													<source srcset="<?php switch ($column_width_xs) :
														case 'col-12' :
															if($image_sizes['size_600']['webp']) :
																echo $image_sizes['size_600']['webp'];
															endif;
														break;
														case 'col-11' :
															if($image_sizes['size_600']['webp']) :
																echo $image_sizes['size_600']['webp'];
															endif;
														break;
														case 'col-10' :
															if($image_sizes['size_500']['webp']) :
																echo $image_sizes['size_500']['webp'];
															endif;
														break;
														case 'col-9' :
															if($image_sizes['size_500']['webp']) :
																echo $image_sizes['size_500']['webp'];
															endif;
														break;
														case 'col-8' :
															if($image_sizes['size_400']['webp']) :
																echo $image_sizes['size_400']['webp'];
															endif;
														break;
														case 'col-7' :
															if($image_sizes['size_400']['webp']) :
																echo $image_sizes['size_400']['webp'];
															endif;
														break;
														case 'col-6' :
															if($image_sizes['size_300']['webp']) :
																echo $image_sizes['size_300']['webp'];
															endif;
														break;
														case 'col-5' :
															if($image_sizes['size_300']['webp']) :
																echo $image_sizes['size_300']['webp'];
															endif;
														break;
														case 'col-4' :
															if($image_sizes['size_200']['webp']) :
																echo $image_sizes['size_200']['webp'];
															endif;
														break;
														case 'col-3' :
															if($image_sizes['size_200']['webp']) :
																echo $image_sizes['size_200']['webp'];
															endif;
														break;
														case 'col-2' :
															if($image_sizes['size_200']['webp']) :
																echo $image_sizes['size_200']['webp'];
															endif;
														break;
														case 'col-1' :
															if($image_sizes['size_200']['webp']) :
																echo $image_sizes['size_200']['webp'];
															endif;
														break;
													endswitch; ?>" media="(max-width: 575px)" type="image/webp">
													<source srcset="<?php switch ($column_width_xl) :
														case 'col-xl-12' :
															echo $image_sizes['size_1200']['original'];
														break;
														case 'col-xl-11' :
															echo $image_sizes['size_1100']['original'];
														break;
														case 'col-xl-10' :
															echo $image_sizes['size_1000']['original'];
														break;
														case 'col-xl-9' :
															echo $image_sizes['size_900']['original'];
														break;
														case 'col-xl-8' :
															echo $image_sizes['size_800']['original'];
														break;
														case 'col-xl-7' :
															echo $image_sizes['size_700']['original'];
														break;
														case 'col-xl-6' :
															echo $image_sizes['size_600']['original'];
														break;
														case 'col-xl-5' :
															echo $image_sizes['size_500']['original'];
														break;
														case 'col-xl-4' :
															echo $image_sizes['size_400']['original'];
														break;
														case 'col-xl-3' :
															echo $image_sizes['size_300']['original'];
														break;
														case 'col-xl-2' :
															echo $image_sizes['size_200']['original'];
														break;
														case 'col-xl-1' :
															echo $image_sizes['size_200']['original'];
														break;
													endswitch; ?>" media="(min-width: 1200px)" type="image/<?php echo $image_file_type; ?>">
													<source srcset="<?php switch ($column_width_lg) :
														case 'col-lg-12' :
															echo $image_sizes['size_1000']['original'];
														break;
														case 'col-lg-11' :
															echo $image_sizes['size_900']['original'];
														break;
														case 'col-lg-10' :
															echo $image_sizes['size_800']['original'];
														break;
														case 'col-lg-9' :
															echo $image_sizes['size_800']['original'];
														break;
														case 'col-lg-8' :
															echo $image_sizes['size_700']['original'];
														break;
														case 'col-lg-7' :
															echo $image_sizes['size_600']['original'];
														break;
														case 'col-lg-6' :
															echo $image_sizes['size_500']['original'];
														break;
														case 'col-lg-5' :
															echo $image_sizes['size_400']['original'];
														break;
														case 'col-lg-4' :
															echo $image_sizes['size_400']['original'];
														break;
														case 'col-lg-3' :
															echo $image_sizes['size_300']['original'];
														break;
														case 'col-lg-2' :
															echo $image_sizes['size_200']['original'];
														break;
														case 'col-lg-1' :
															echo $image_sizes['size_200']['original'];
														break;
													endswitch; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
													<source srcset="<?php switch ($column_width_md) :
														case 'col-md-12' :
															echo $image_sizes['size_800']['original'];
														break;
														case 'col-md-11' :
															echo $image_sizes['size_700']['original'];
														break;
														case 'col-md-10' :
															echo $image_sizes['size_600']['original'];
														break;
														case 'col-md-9' :
															echo $image_sizes['size_600']['original'];
														break;
														case 'col-md-8' :
															echo $image_sizes['size_500']['original'];
														break;
														case 'col-md-7' :
															echo $image_sizes['size_500']['original'];
														break;
														case 'col-md-6' :
															echo $image_sizes['size_400']['original'];
														break;
														case 'col-md-5' :
															echo $image_sizes['size_300']['original'];
														break;
														case 'col-md-4' :
															echo $image_sizes['size_300']['original'];
														break;
														case 'col-md-3' :
															echo $image_sizes['size_200']['original'];
														break;
														case 'col-md-2' :
															echo $image_sizes['size_200']['original'];
														break;
														case 'col-md-1' :
															echo $image_sizes['size_200']['original'];
														break;
													endswitch; ?>" media="(min-width: 768px)" type="image/<?php echo $image_file_type; ?>">
													<source srcset="<?php switch ($column_width_sm) :
														case 'col-sm-12' :
															echo $image_sizes['size_600']['original'];
														break;
														case 'col-sm-11' :
															echo $image_sizes['size_500']['original'];
														break;
														case 'col-sm-10' :
															echo $image_sizes['size_500']['original'];
														break;
														case 'col-sm-9' :
															echo $image_sizes['size_500']['original'];
														break;
														case 'col-sm-8' :
															echo $image_sizes['size_400']['original'];
														break;
														case 'col-sm-7' :
															echo $image_sizes['size_400']['original'];
														break;
														case 'col-sm-6' :
															echo $image_sizes['size_300']['original'];
														break;
														case 'col-sm-5' :
															echo $image_sizes['size_300']['original'];
														break;
														case 'col-sm-4' :
															echo $image_sizes['size_200']['original'];
														break;
														case 'col-sm-3' :
															echo $image_sizes['size_200']['original'];
														break;
														case 'col-sm-2' :
															echo $image_sizes['size_200']['original'];
														break;
														case 'col-sm-1' :
															echo $image_sizes['size_200']['original'];
														break;
													endswitch; ?>" media="(min-width: 576px)" type="image/<?php echo $image_file_type; ?>">
													<source srcset="<?php switch ($column_width_xs) :
														case 'col-12' :
															echo $image_sizes['size_600']['original'];
														break;
														case 'col-11' :
															echo $image_sizes['size_600']['original'];
														break;
														case 'col-10' :
															echo $image_sizes['size_500']['original'];
														break;
														case 'col-9' :
															echo $image_sizes['size_500']['original'];
														break;
														case 'col-8' :
															echo $image_sizes['size_400']['original'];
														break;
														case 'col-7' :
															echo $image_sizes['size_400']['original'];
														break;
														case 'col-6' :
															echo $image_sizes['size_300']['original'];
														break;
														case 'col-5' :
															echo $image_sizes['size_300']['original'];
														break;
														case 'col-4' :
															echo $image_sizes['size_200']['original'];
														break;
														case 'col-3' :
															echo $image_sizes['size_200']['original'];
														break;
														case 'col-2' :
															echo $image_sizes['size_200']['original'];
														break;
														case 'col-1' :
															echo $image_sizes['size_200']['original'];
														break;
													endswitch; ?>" media="(max-width: 575px)" type="image/<?php echo $image_file_type; ?>">
												<?php endif; // end responsive columns check?>
											<?php endif;
											// set height if width is not empty
											if(!empty($rendered_width)) :
												if(!empty($image_highlight)) :
													$highlight_width = $rendered_width - '64';
													$highlight_height = $highlight_width * $image_height / $image_width;
													$rendered_height = $highlight_height + '64';
												else :
													$rendered_height = $rendered_width * $image_height / $image_width;
												endif;
												$rendered_width = number_format($rendered_width, 2, '.', '');
												$rendered_height = number_format($rendered_height, 2, '.', '');
											endif; ?>
											<img loading="lazy"<?php if(!empty($image_highlight)) : ?> class="image-highlight shadow-soft"<?php endif; ?> height="<?php echo $rendered_height; ?>" width="<?php echo $rendered_width; ?>" src="<?php echo $image_url; ?>"<?php if($image_alt) : ?> alt="<?php echo $image_alt; ?>"<?php endif; ?>>
												</picture>
										<?php endif;
										if(!empty($image_caption)) : ?>
												<figcaption><?php echo $image_caption; ?></figcaption>
											</figure>
										<?php endif; ?>
										<?php if(!empty($image) && !empty($image_as_link) && !empty($image_link_url)) : ?>
											</a>
										<?php endif;
										if(!empty($image)) : ?>
											</div><!-- .image-wrapper -->
										<?php endif;
										if(!empty($kicker)) : ?>
											<div class="kicker-container<?php if(!empty($kicker_icon)): ?> has-icon<?php endif; ?>">
												<?php if(!empty($kicker_icon)): ?>
													<div class="icon kicker-icon"><img<?php if(!empty($kicker_icon_alt)) : ?> alt="<?php echo $kicker_icon_alt; ?>"<?php endif; ?> height="64" src="<?php echo $kicker_icon_url; ?>" width="64" /></div><!-- .icon.kicker-icon -->
												<?php endif; ?>
												<span class="kicker <?php echo $kicker_color; ?>"><?php echo $kicker; ?></span>
											</div><!-- .kicker-container -->
										<?php endif;
										if(!empty($headline)) : ?>
										<div class="headline-container">
										<<?php echo $headline_hierarchy; ?> class="<?php echo $headline_hierarchy_appearance; ?>"><?php if(!empty($headline_as_link) && !empty($headline_link_url)) : ?><a href="<?php echo $headline_link_url; ?>" target="<?php echo $headline_link_target; ?>" title="<?php if($headline_link_title) : echo $headline_link_title; else : echo $headline; endif; ?>"><?php endif; echo $headline; if(!empty($headline_as_link) && !empty($headline_link_url)) : ?></a><?php endif; ?></<?php echo $headline_hierarchy; ?>>
										</div><!-- .headline-container -->
										<?php endif;
										if(!empty($body)) : ?>
											<div class="body-container">
												<?php if(!empty($smaller_body_text)) : ?>
												<div class="smaller-text<?php if(!empty($has_drop_cap)) : ?> has-drop-cap<?php endif; ?>"><?php endif; echo $body; if(!empty($smaller_body_text)) : ?></div><!-- .smaller-text --><?php endif; ?>
											</div><!-- .body-container -->
										<?php endif;
										if(!empty($shortcode)) : ?>
											<div class="shortcode-container"><?php echo do_shortcode($shortcode); ?></div><!-- .shortcode-container -->
										<?php endif; ?>
									</div><!-- .column-content -->
									<?php if($has_cta && !empty($ctas)) : ?>
									<div class="cta <?php echo $text_align . ' ' . $text_align_mobile . ' ' . $ctas_justification; if(empty($headline) && empty($body)) : ?> cta-only<?php endif; ?>">
										<div class="btn-group">
										<?php foreach($ctas as $cta) :
											// vars
											$cta_disabled = $cta['cta_disabled'];
											$cta_file_download = $cta['cta_file_download'];
											$cta_text = $cta['cta_text'];
											$cta_color = $cta['cta_color'];
											$cta_size = $cta['cta_size'];
											$cta_title = $cta['cta_title'];
											$cta_target = $cta['cta_target'];
											$cta_url = $cta['cta_url']; ?>
											<a class="btn <?php echo $cta_size . ' ' . $cta_color; if($cta_disabled) : echo ' btn-disabled'; endif; ?>" <?php if(!$cta_disabled) : ?>href="<?php echo $cta_url; ?>" role="button" target="<?php if($cta_target) : echo $cta_target; else : echo '_self'; endif; ?>" title="<?php if($cta_title) : echo $cta_title; else : echo $cta_text; endif; ?>"<?php if(!empty($cta_file_download)) : ?> download<?php endif; endif; ?>><?php echo $cta_text; ?></a>
										<?php endforeach; ?>
										</div><!-- .btn-group -->
									</div><!-- .cta -->
									<?php endif; ?>
								</div><!-- .content-wrapper -->
							</div><!-- .column-size -->
							<?php endwhile;
						endif; ?>
					</div><!-- .row.justify-content-between -->
					<?php if(!empty($has_sidenav) && !empty($sidenav)) : ?>
					</div><!-- .main -->
				</div><!-- .row.justify-content-between -->
					<?php endif; ?>
			</div><!-- .content -->
		</div><!-- .container -->
		<?php if($background_type == 'image' || ($background_type == 'color' && $background_color != 'bg-color-none')) : ?>
		<div class="background-container">
			<div class="background<?php if($background_type == 'color') : echo ' ' . $background_color; endif; ?>">
				<?php if($background_type == 'image' && !empty($background_image)) : ?>
				<picture<?php if($background_image_tint_blend_mode == 'none') : ?> class="no-blend"<?php endif; ?>>
					<?php if($background_image_sizes['size_1400']['webp']) : ?><source srcset="<?php echo $background_image_sizes['size_1400']['webp']; ?>" media="(min-width: 1400px)" type="image/webp"><?php endif; ?>
					<?php if($background_image_sizes['size_1300']['webp']) : ?><source srcset="<?php echo $background_image_sizes['size_1300']['webp']; ?>" media="(min-width: 1200px)" type="image/webp"><?php endif; ?>
					<?php if($background_image_sizes['size_1200']['webp']) : ?><source srcset="<?php echo $background_image_sizes['size_1200']['webp']; ?>" media="(min-width: 992px)" type="image/webp"><?php endif; ?>
					<?php if($background_image_sizes['size_1000']['webp']) : ?><source srcset="<?php echo $background_image_sizes['size_1000']['webp']; ?>" media="(min-width: 768px)" type="image/webp"><?php endif; ?>
					<?php if($background_image_sizes['size_900']['webp']) : ?><source srcset="<?php echo $background_image_sizes['size_900']['webp']; ?>" media="(max-width: 767px)" type="image/webp"><?php endif; ?>
					<?php if($background_image_sizes['size_600']['webp']) : ?><source srcset="<?php echo $background_image_sizes['size_600']['webp']; ?>" media="(max-width: 450px)" type="image/webp"><?php endif; ?>
					<source srcset="<?php echo $background_image_sizes['size_1400']['original']; ?>" media="(min-width: 1400px)" type="image/<?php echo $image_file_type; ?>">
					<source srcset="<?php echo $background_image_sizes['size_1300']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $image_file_type; ?>">
					<source srcset="<?php echo $background_image_sizes['size_1200']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
					<source srcset="<?php echo $background_image_sizes['size_1000']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $image_file_type; ?>">
					<source srcset="<?php echo $background_image_sizes['size_900']['original']; ?>" media="(max-width: 767px)" type="image/<?php echo $image_file_type; ?>">
					<source srcset="<?php echo $background_image_sizes['size_600']['original']; ?>" media="(max-width: 450px)" type="image/<?php echo $image_file_type; ?>">
					<img loading="lazy" height="<?php echo $background_image_height; ?>" src="<?php echo $background_image_url; ?>"<?php if($background_image_alt) : ?> alt="<?php echo $background_image_alt; ?>"<?php else : ?> alt="A background image for Adeptia"<?php endif; ?> width="<?php echo $background_image_width; ?>" >
				</picture>
				<?php endif; ?>
				<?php if(!empty($background_image_tint) && $background_image_tint != 'bg-color-none') : ?>
				<div class="background-color <?php echo $background_image_tint; ?> <?php if(!empty($background_image_tint_blend_mode) && $background_image_tint_blend_mode != 'none') : echo $background_image_tint_blend_mode; endif; ?>"></div>
				<?php endif; ?>
			</div><!-- .background -->
		</div><!-- .background-container -->
		<?php endif; ?>
	</section><!-- .content-block-module -->
<?php endwhile; endif; ?>