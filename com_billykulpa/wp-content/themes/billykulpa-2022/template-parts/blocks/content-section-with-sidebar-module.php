<?php
// general vars
$uploads_path = '/wp-content/uploads/';
$uploads_path_webp = '/wp-content/webp-express/webp-images/uploads/';
$title = get_the_title(get_the_ID());
// acf vars
$content_section = get_field('content_section');
	$block_classes = $content_section['block_classes'];
	$block_id = $content_section['block_id'];
	$section_padding_top = $content_section['section_padding_top'];
	$section_padding_bottom = $content_section['section_padding_bottom'];
	$background_color = $content_section['background_color'];
	$text_color = $content_section['text_color'];
	$links_color = $content_section['links_color'];
	$stripe_pattern_side = $content_section['stripe_pattern_side'];
	$brand_pattern = $content_section['brand_pattern'];
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
	// sidenav
	$has_sidenav = $content_section['has_sidenav'];
	if(!empty($has_sidenav)) :
		$sidenav = $content_section['sidenav']; // repeater
	endif;
	// mainbar group
	$mainbar = $content_section['mainbar'];
		$mainbar_section = $mainbar['mainbar_section'];
	// sidebar group
	$sidebar = $content_section['sidebar'];
		$sidebar_text_align_mobile = $sidebar['sidebar_text_align_mobile'];
		$sidebar_text_align_desktop = $sidebar['sidebar_text_align_desktop'];
		$sidebar_kicker = $sidebar['sidebar_kicker'];
		$sidebar_kicker_color = $sidebar['sidebar_kicker_color'];
		$sidebar_kicker_icon = $sidebar['sidebar_kicker_icon'];
		if(!empty($sidebar_kicker_icon)) :
			$sidebar_kicker_icon_alt = $sidebar_kicker_icon['alt'];
			$sidebar_kicker_icon_name = $sidebar_kicker_icon['name'];
			$sidebar_kicker_icon_url = $sidebar_kicker_icon['url'];
			// gets all the possible image sizes and webp versions
			$sidebar_kicker_icon_sizes = imageSizes($sidebar_kicker_icon['sizes']);
			$sidebar_kicker_icon_filename = $sidebar_kicker_icon['filename'];
			if(strpos($sidebar_kicker_icon_filename, '-scaled.') !== false) {
				$sidebar_kicker_icon_scaled_check = true;
				$sidebar_kicker_icon_filename = str_replace('-scaled', '', $sidebar_kicker_icon_filename);
			}
			$sidebar_kicker_icon_file_type_array = pathinfo($sidebar_kicker_icon_filename);
				$sidebar_kicker_icon_file_type = $sidebar_kicker_icon_file_type_array['extension'];
			// check if kicker_icon is an SVG, which is required but things happen
			$sidebar_kicker_icon_is_svg = false;
			if($sidebar_kicker_icon_file_type == 'svg') :
				$sidebar_kicker_icon_is_svg = true;
			endif;
		endif;
		$sidebar_headline_hierarchy = $sidebar['sidebar_headline_hierarchy'];
		$sidebar_headline_hierarchy_appearance = $sidebar['sidebar_headline_hierarchy_appearance'];
		$sidebar_headline = $sidebar['sidebar_headline'];
		$sidebar_headline_add_topper_class = $sidebar['add_topper_class'];
		$sidebar_image = $sidebar['sidebar_image'];
		if($sidebar_image) :
			$sidebar_image_alt = $isidebar_mage['alt'];
			$sidebar_image_name = $sidebar_image['name'];
			$sidebar_image_url = $sidebar_image['url'];
			$sidebar_image_height = $sidebar_image['height'];
			$sidebar_image_width = $sidebar_image['width'];
			$sidebar_image_rendered_width = '290';
			$sidebar_image_rendered_height = $sidebar_image_rendered_width * $sidebar_image_height / $sidebar_image_width;
			// gets all the possible image sizes and webp versions
			$sidebar_image_sizes = imageSizes($sidebar_image['sizes']);
			$sidebar_image_filename = $sidebar_image['filename'];
			if(strpos($sidebar_image_filename, '-scaled.') !== false) {
				$sidebar_image_scaled_check = true;
				$sidebar_image_filename = str_replace('-scaled', '', $sidebar_image_filename);
			}
			$sidebar_image_file_type_array = pathinfo($sidebar_image_filename);
				$sidebar_image_file_type = $sidebar_image_file_type_array['extension'];
			// check if $image is an SVG
			$sidebar_image_is_svg = false;
			if($sidebar_image_file_type == 'svg') :
				$sidebar_image_is_svg = true;
			endif;
		endif;
		$sidebar_body = $sidebar['sidebar_body'];
		$sidebar_shortcode = $sidebar['sidebar_shortcode'];
		$sidebar_has_cta = $sidebar['sidebar_has_cta'];
		$sidebar_ctas_justification = $sidebar['sidebar_ctas_justification'];
		$sidebar_ctas = $sidebar['sidebar_ctas'];
?>
<section class="contact-section-with-sidebar<?php if($section_padding_bottom != 'default') : echo ' ' . $section_padding_bottom; endif; if($section_padding_top != 'default') : echo ' ' . $section_padding_top; endif; echo ' ' . $background_color; if(!empty($block_classes)) : echo ' ' . $block_classes; endif; ?>"<?php if(!empty($block_id)) : ?> id="<?php echo $block_id; ?>"<?php endif; ?>>
	<div class="container">
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
			<div class="row justify-content-between">
				<div class="col-lg-8 mainbar">
					<?php if(!empty($mainbar_section)) :
						foreach($mainbar_section as $section) :
							$text_align_mobile = $section['text_align_mobile'];
							$text_align_desktop = $section['text_align_desktop'];
							$kicker = $section['kicker'];
							$kicker_color = $section['kicker_color'];
							$kicker_icon = $section['kicker_icon'];
							if(!empty($kicker_icon)) :
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
								// check if kicker_icon is an SVG, which is required but things happen
								$kicker_icon_is_svg = false;
								if($kicker_icon_file_type == 'svg') :
									$kicker_icon_is_svg = true;
								endif;
							endif;
							$headline_hierarchy = $section['headline_hierarchy'];
							$headline_hierarchy_appearance = $section['headline_hierarchy_appearance'];
							$headline = $section['headline'];
							$image = $section['image'];
							if($image) :
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
								// check if $image is an SVG
								$image_is_svg = false;
								if($image_file_type == 'svg') :
									$image_is_svg = true;
								endif;
								$image_position = $section['image_position'];
								if($image_position == 'floated') :
									$image_float_width = $section['image_float_width'];
								endif;
							endif;
							$body = $section['body'];
							$shortcode = $section['shortcode'];
							$has_cta = $section['has_cta'];
							$ctas_justification = $section['ctas_justification'];
							$ctas = $section['ctas']; ?>
							<div class="content <?php echo $text_align_mobile; ?> <?php echo $text_align_desktop; ?>">
								<?php if(!empty($kicker)) : ?>
									<div class="kicker-container<?php if(!empty($kicker_icon)): ?> has-icon<?php endif; ?>">
										<?php if(!empty($kicker_icon)): ?>
											<div class="icon kicker-icon"><img<?php if(!empty($kicker_icon_alt)) : ?> alt="<?php echo $kicker_icon_alt; ?>"<?php endif; ?> height="64" src="<?php echo $kicker_icon_url; ?>" width="64" /></div><!-- .icon.kicker-icon -->
										<?php endif; ?>
										<span class="kicker <?php echo $kicker_color; ?>"><?php echo $kicker; ?></span>
									</div><!-- .kicker-container -->
								<?php endif;
								if(!empty($headline)) : ?>
									<div class="headline">
										<<?php echo $headline_hierarchy; ?> class="<?php echo $headline_hierarchy_appearance; ?>"><?php echo $headline; ?></<?php echo $headline_hierarchy; ?>>
									</div><!-- .headline -->
								<?php endif;
								if(!empty($image)) : ?>
									<div class="image-wrapper<?php if($image_position == 'floated') : ?> float-image <?php echo $image_float_width; endif; ?>">
										<picture>
											<?php if($image_position != 'floated') :
												$rendered_width = '823'; ?>
												<source srcset="<?php echo $image_sizes['size_900']['webp']; ?>" media="(min-width: 1400px)" type="image/webp">
												<source srcset="<?php echo $image_sizes['size_800']['webp']; ?>" media="(min-width: 1200px)" type="image/webp">
												<source srcset="<?php echo $image_sizes['size_700']['webp']; ?>" media="(min-width: 768px)" type="image/webp">
												<source srcset="<?php echo $image_sizes['size_600']['webp']; ?>" media="(min-width: 551px)" type="image/webp">
												<source srcset="<?php echo $image_sizes['size_500']['webp']; ?>" media="(max-width: 550px)" type="image/webp">
												<source srcset="<?php echo $image_sizes['size_900']['original']; ?>" media="(min-width: 1400px)" type="image/<?php echo $image_file_type; ?>">
												<source srcset="<?php echo $image_sizes['size_800']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $image_file_type; ?>">
												<source srcset="<?php echo $image_sizes['size_700']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $image_file_type; ?>">
												<source srcset="<?php echo $image_sizes['size_600']['original']; ?>" media="(min-width: 551px)" type="image/<?php echo $image_file_type; ?>">
												<source srcset="<?php echo $image_sizes['size_500']['original']; ?>" media="(max-width: 550px)" type="image/<?php echo $image_file_type; ?>">
											<?php else :
												switch ($image_float_width) : // half, third, quarter
													case 'half' :
														$rendered_width = '388'; ?>
														<source srcset="<?php echo $image_sizes['size_400']['webp']; ?>" media="(min-width: 1200px)" type="image/webp">
														<source srcset="<?php echo $image_sizes['size_300']['webp']; ?>" media="(min-width: 992px)" type="image/webp">
														<source srcset="<?php echo $image_sizes['size_400']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $image_file_type; ?>">
														<source srcset="<?php echo $image_sizes['size_300']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
													<?php break;
													case 'third' :
														$rendered_width = '250'; ?>
														<source srcset="<?php echo $image_sizes['size_300']['webp']; ?>" media="(min-width: 1200px)" type="image/webp">
														<source srcset="<?php echo $image_sizes['size_200']['webp']; ?>" media="(min-width: 992px)" type="image/webp">
														<source srcset="<?php echo $image_sizes['size_300']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $image_file_type; ?>">
														<source srcset="<?php echo $image_sizes['size_200']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
													<?php break;
													case 'quarter' :
														$rendered_width = '182'; ?>
														<source srcset="<?php echo $image_sizes['size_200']['webp']; ?>" media="(min-width: 992px)" type="image/webp">
														<source srcset="<?php echo $image_sizes['size_200']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
													<?php break;
												endswitch; // below 992, all sizes stop floating and go full-width ?>
												<source srcset="<?php echo $image_sizes['size_700']['webp']; ?>" media="(min-width: 768px)" type="image/webp">
												<source srcset="<?php echo $image_sizes['size_600']['webp']; ?>" media="(min-width: 551px)" type="image/webp">
												<source srcset="<?php echo $image_sizes['size_500']['webp']; ?>" media="(max-width: 550px)" type="image/webp">
												<source srcset="<?php echo $image_sizes['size_700']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $image_file_type; ?>">
												<source srcset="<?php echo $image_sizes['size_600']['original']; ?>" media="(min-width: 551px)" type="image/<?php echo $image_file_type; ?>">
												<source srcset="<?php echo $image_sizes['size_500']['original']; ?>" media="(max-width: 550px)" type="image/<?php echo $image_file_type; ?>">
											<?php endif;
											// set height if width is not empty
											if(!empty($rendered_width)) :
												$rendered_height = $rendered_width * $image_height / $image_width;
											endif; ?>
											<img alt="<?php if(!empty($image_alt)) : echo $image_alt; else : echo $title; endif; ?>" height="<?php echo $rendered_height; ?>" loading="lazy" src="<?php echo $image_url; ?>" width="<?php echo $rendered_width; ?>">
										</picture>
									</div><!-- .image-wrapper -->
								<?php endif;
								if(!empty($body)) : ?>
									<div class="body">
										<?php echo $body; ?>
									</div><!-- .body -->
								<?php endif;
								if(!empty($shortcode)) : ?>
									<div class="shortcode-container">
										<?php echo $shortcode; ?>
									</div><!-- .shortcode-container -->
								<?php endif;
								if($has_cta && !empty($ctas)) : ?>
								<div class="cta <?php echo $text_align . ' ' . $text_align_mobile . ' ' . $ctas_justification; ?>">
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
							</div><!-- .content -->
						<?php endforeach;
					endif; ?>
				</div><!-- .col-lg-8 mainbar -->
				<div class="col-lg-3 sidebar">
					<div class="content <?php echo $sidebar_text_align_mobile; ?> <?php echo $sidebar_text_align_desktop; ?>">
						<?php if(!empty($sidebar_kicker)) : ?>
							<div class="kicker-container<?php if(!empty($sidebar_kicker_icon)): ?> has-icon<?php endif; ?>">
								<?php if(!empty($sidebar_kicker_icon)): ?>
									<div class="icon kicker-icon"><img<?php if(!empty($sidebar_kicker_icon_alt)) : ?> alt="<?php echo $sidebar_kicker_icon_alt; ?>"<?php endif; ?> height="64" src="<?php echo $sidebar_kicker_icon_url; ?>" width="64" /></div><!-- .icon.kicker-icon -->
								<?php endif; ?>
								<span class="kicker <?php echo $sidebar_kicker_color; ?>"><?php echo $sidebar_kicker; ?></span>
							</div><!-- .kicker-container -->
						<?php endif;
						if(!empty($sidebar_headline)) : ?>
							<div class="headline">
								<<?php echo $sidebar_headline_hierarchy; ?> class="<?php echo $sidebar_headline_hierarchy_appearance; if(!empty($sidebar_headline_add_topper_class)) : ?> topper<?php endif; ?>"><?php echo $sidebar_headline; ?></<?php echo $sidebar_headline_hierarchy; ?>>
							</div><!-- .headline -->
						<?php endif;
						if(!empty($sidebar_image)) : ?>
							<div class="image-wrapper">
								<picture>
									<source srcset="<?php echo $sidebar_image_sizes['size_400']['webp']; ?>" media="(min-width: 1400px)" type="image/webp">
									<source srcset="<?php echo $sidebar_image_sizes['size_300']['webp']; ?>" media="(min-width: 992px)" type="image/webp">
									<source srcset="<?php echo $sidebar_image_sizes['size_700']['webp']; ?>" media="(min-width: 768px)" type="image/webp">
									<source srcset="<?php echo $sidebar_image_sizes['size_600']['webp']; ?>" media="(min-width: 551px)" type="image/webp">
									<source srcset="<?php echo $sidebar_image_sizes['size_500']['webp']; ?>" media="(max-width: 550px)" type="image/webp">
									<source srcset="<?php echo $sidebar_image_sizes['size_400']['original']; ?>" media="(min-width: 1400px)" type="image/<?php echo $sidebar_image_file_type; ?>">
									<source srcset="<?php echo $sidebar_image_sizes['size_300']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $sidebar_image_file_type; ?>">
									<source srcset="<?php echo $sidebar_image_sizes['size_700']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $sidebar_image_file_type; ?>">
									<source srcset="<?php echo $sidebar_image_sizes['size_600']['original']; ?>" media="(min-width: 551px)" type="image/<?php echo $sidebar_image_file_type; ?>">
									<source srcset="<?php echo $sidebar_image_sizes['size_500']['original']; ?>" media="(max-width: 550px)" type="image/<?php echo $sidebar_image_file_type; ?>">
									<img alt="<?php if(!empty($sidebar_image_alt)) : echo $sidebar_image_alt; else : echo $title; endif; ?>" height="<?php echo $sidebar_image_rendered_height; ?>" loading="lazy" src="<?php echo $sidebar_image_url; ?>" width="<?php echo $sidebar_image_rendered_width; ?>">
								</picture>
							</div><!-- .image-wrapper -->
						<?php endif;
						if(!empty($sidebar_body) || !empty($sidebar_shortcode)) : ?>
							<div class="body">
								<?php echo $sidebar_body;
								echo $sidebar_shortcode; ?>
							</div><!-- .body -->
						<?php endif;
						if($sidebar_has_cta && !empty($sidebar_ctas)) : ?>
						<div class="cta <?php echo $text_align . ' ' . $text_align_mobile . ' ' . $sidebar_ctas_justification; ?>">
							<div class="btn-group">
							<?php foreach($sidebar_ctas as $sidebar_cta) :
								// vars
								$sidebar_cta_disabled = $sidebar_cta['sidebar_cta_disabled'];
								$sidebar_cta_file_download = $cta['sidebar_cta_file_download'];
								$sidebar_cta_text = $sidebar_cta['sidebar_cta_text'];
								$sidebar_cta_color = $sidebar_cta['sidebar_cta_color'];
								$sidebar_cta_size = $sidebar_cta['sidebar_cta_size'];
								$sidebar_cta_title = $sidebar_cta['sidebar_cta_title'];
								$sidebar_cta_target = $sidebar_cta['sidebar_cta_target'];
								$sidebar_cta_url = $sidebar_cta['sidebar_cta_url']; ?>
								<a class="btn <?php echo $sidebar_cta_size . ' ' . $sidebar_cta_color; if($sidebar_cta_disabled) : echo ' btn-disabled'; endif; ?>" <?php if(!$sidebar_cta_disabled) : ?>href="<?php echo $sidebar_cta_url; ?>" role="button" target="<?php if($sidebar_cta_target) : echo $sidebar_cta_target; else : echo '_self'; endif; ?>" title="<?php if($sidebar_cta_title) : echo $sidebar_cta_title; else : echo $sidebar_cta_text; endif; ?>"<?php if(!empty($sidebar_cta_file_download)) : ?> download<?php endif; endif; ?>><?php echo $sidebar_cta_text; ?></a>
							<?php endforeach; ?>
							</div><!-- .btn-group -->
						</div><!-- .cta -->
						<?php endif; ?>
					</div><!-- .content -->
				</div><!-- .col-lg-3 sidebar -->
			</div><!-- .row.justify-content-between -->
		<?php if(!empty($has_sidenav) && !empty($sidenav)) : ?>
				</div><!-- main -->
			</div><!-- .row.justify-content-between -->
		<?php endif; ?>
	</div><!-- .container -->
	<?php if(!empty($brand_pattern_shape_1) || !empty($brand_pattern_shape_2)) : ?>
	<div class="background-pattern">
		<?php if($brand_pattern_shape_1) : ?>
			<div class="background-pattern-shape-1 <?php echo $brand_pattern_shape_1_style; ?> opacity-<?php echo $brand_pattern_shape_1_opacity; ?>">
				<?php if($brand_pattern_shape_1_style == 'style-1') : ?>
					<svg class="style-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 484.53 400" preserveAspectRatio="xMaxYMax slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_1_color; ?>" points="0 400 484.53 400 253.59 0 0 0 0 400"/>	
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_1_style == 'style-2') : ?>
					<svg class="style-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 470 1080" preserveAspectRatio="xMinYMid slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_1_color; ?>" points="190.33 0 0 1079.41 470 1080 470 0 190.33 0"/>
						</g>
					</svg> 
				<?php endif;
				if($brand_pattern_shape_1_style == 'style-3') : ?>
					<svg class="style-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 476.7 400" preserveAspectRatio="xMinYMid slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_1_color; ?>" points="476.7 400 476.7 0 0 0 476.7 400"/>
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_1_style == 'style-4') : ?>
					<svg class="style-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 400" preserveAspectRatio="xMinYMin slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_1_color; ?>" points="230.94 0 230.94 0 0 400 230.94 400 461.88 400 600 400 600 0 230.94 0"/>
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_1_style == 'style-5') : ?>
					<svg class="style-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 850 400" preserveAspectRatio="xMidYMax slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_1_color; ?>" points="850 350.91 0 170.24 0 400 850 400 850 350.91"/>
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_1_style == 'style-6') : ?>
					<svg class="style-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 850 266.2" preserveAspectRatio="xMidYMax slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_1_color; ?>" points="0 141.53 0 266.2 580.49 266.2 0 141.53"/>
						</g>
					</svg>
				<?php endif; ?>
			</div><!-- .background-pattern-shape-1 -->
		<?php endif;
		if($brand_pattern_shape_2) : ?>
			<div class="background-pattern-shape-2 <?php echo $brand_pattern_shape_2_style; ?> opacity-<?php echo $brand_pattern_shape_2_opacity; ?>">
				<?php if($brand_pattern_shape_2_style == 'style-1') : ?>
					<svg class="style-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 484.53 400" preserveAspectRatio="xMaxYMax slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_2_color; ?>" points="0 0 0 400 383.56 400 253.59 0 0 0"/>
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_2_style == 'style-2') : ?>
					<svg class="style-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 970 1080" preserveAspectRatio="xMinYMid slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_2_color; ?>" points="970 0 0 1080 970 1080 970 0"/>
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_2_style == 'style-3') : ?>
					<svg class="style-3"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 476.7 400" preserveAspectRatio="xMinYMid slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_2_color; ?>" points="245.76 0 476.7 400 476.7 0 245.76 0"/>
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_2_style == 'style-4') : ?>
					<svg class="style-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 400" preserveAspectRatio="xMinYMin slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_2_color; ?>" points="230.94 0 0 400 461.88 400 230.94 0"/>
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_2_style == 'style-5') : ?>
					<svg class="style-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 850 400" preserveAspectRatio="xMidYMax slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_2_color; ?>" points="619.06 400 850 400 850 0 619.06 400"/>
						</g>
					</svg>
				<?php endif;
				if($brand_pattern_shape_2_style == 'style-6') : ?>
					<svg class="style-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 850 266.2" preserveAspectRatio="xMidYMax slice">
						<g>
							<polygon class="<?php echo $brand_pattern_shape_2_color; ?>" points="850 0 118.61 266.2 850 266.2 850 0"/>
						</g>
					</svg>
				<?php endif; ?>
			</div><!-- .background-pattern-shape-2 -->
		<?php endif; ?>
	</div><!-- .background-pattern -->
	<?php endif;
	if($stripe_pattern_side != 'stripe_pattern_none') : ?>
		<div class="stripe-pattern <?php echo $stripe_pattern_side; ?>"></div><!-- .stripe-pattern -->
	<?php endif; ?>
</section>