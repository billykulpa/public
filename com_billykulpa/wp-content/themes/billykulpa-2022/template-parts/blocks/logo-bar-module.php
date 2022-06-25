<?php
// general vars
$uploads_path = '/wp-content/uploads/';
$uploads_path_webp = '/wp-content/webp-express/webp-images/uploads/';
// acf vars
$logo_bar = get_field('logo_bar');
?>
<section class="logo-bar">
	<div class="container">
		<div class="logos-container">
			<?php foreach($logo_bar as $logo_object) :
				// vars
				$logo = $logo_object['logo'];
				$logo_width = $logo_object['logo_width'];
				// only SVG accepted
				if(!empty($logo)) :
					// image vars
					$image_alt = $logo['alt'];
					$image_name = $logo['name'];
					$image_url = $logo['url'];
					$image_height = $logo['height'];
					$image_width = $logo['width'];
					$image_filename = $logo['filename'];
					if(strpos($image_filename, '-scaled.') !== false) {
						$image_scaled_check = true;
						$image_filename = str_replace('-scaled', '', $image_filename);
					}
					$image_file_type_array = pathinfo($image_filename);
						$image_file_type = $image_file_type_array['extension'];
					// check if image is an SVG
					$image_is_svg = false;
					if($image_file_type == 'svg') :
						$image_is_svg = true;
					endif;
					// height / width calculations
					// temporary disable
						$rendered_svg = simplexml_load_file($image_url);
						$rendered_viewbox = $rendered_svg['viewBox'];
						$exploded_viewbox = explode(' ', $rendered_viewbox);
						$svg_width = $exploded_viewbox[2]; // 3rd word in string
						$svg_height = $exploded_viewbox[3]; // 4th word in string
						$rendered_width = 129.99 * $logo_width / 100; // convert $logo_width to percentage
						$rendered_height = $rendered_width * $svg_height / $svg_width;
						$rounded_rendered_width = number_format($rendered_width, 2, '.', '');
						$rounded_rendered_height = number_format($rendered_height, 2, '.', '');
					// $rounded_rendered_height = '100%';
					// $rounded_rendered_width = '100%';
					?>
					<div class="logo"><?php echo $total_width; ?>
						<img loading="lazy"<?php if(!empty($image_alt)) : ?> alt="<?php echo $image_alt; ?>"<?php endif; if(!empty($exploded_viewbox)) : ?> height="<?php echo $rounded_rendered_height; ?>"<?php endif; ?> src="<?php echo $image_url; ?>" style="width:<?php echo $logo_width; ?>%;"<?php if(!empty($rendered_width)) : ?> width="<?php echo $rounded_rendered_width; ?>"<?php endif; ?>/>
					</div><!-- .logo -->
				<?php endif; 
			endforeach; ?>
		</div><!-- .logos-container -->
	</div><!-- .container -->
</section>