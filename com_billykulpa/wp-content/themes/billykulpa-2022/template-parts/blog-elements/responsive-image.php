<?php
// general vars
$uploads_path = '/wp-content/uploads/';
$uploads_path_webp = '/wp-content/webp-express/webp-images/uploads/';
// post vars
$title = get_the_title();
// acf vars
$responsive_image = get_field('responsive_image'); // group field
$image = $responsive_image['image'];
if(!empty($image)) :
	$image_alt = $image['alt'];
	$image_name = $image['name'];
	$image_url = $image['url'];
	$image_height = $image['height'];
	$image_width = $image['width'];
	if($image_width > '823.33') :
		$rendered_width = '823.33';
		$rendered_height = $rendered_width * $image_height / $image_width;
	else :
		$rendered_width = $image_width;
		$rendered_height = $image_height;
	endif;
	//gets all the possible image sizes and webp versions
	$image_sizes = imageSizes($image['sizes']);
	$image_filename = $image['filename'];
	$image_file_type_array = pathinfo($image_filename);
		$image_file_type = $image_file_type_array['extension'];
	// check if speaker_image is an SVG
	$image_is_svg = false;
	if($image_file_type == 'svg') :
		$image_is_svg = true;
	endif;
endif;
$display_caption = $responsive_image['display_caption'];
if(!empty($display_caption)) :
	$caption = $responsive_image['caption'];
endif;
$force_full_image_width = $responsive_image['display_full_width'];
if(empty($force_full_image_width)) :
	$float_image = $responsive_image['float_image'];
	if(!empty($float_image)) :
		$float_width = $responsive_image['float_width'];
	endif;
endif;
?>
<?php if(!empty($responsive_image)) : ?>
	<figure class="responsive-image<?php if(!empty($display_caption) && !empty($caption)) : ?> has-caption<?php endif; if(!empty($force_full_image_width)) : ?> full-width<?php endif; if(empty($force_full_image_width) && !empty($float_image)) : ?> image-float <?php echo $float_width; endif; ?>">
		<picture>
			<?php if(empty($float_image)) :
				if($image_file_type != 'gif') : ?>
					<source srcset="<?php echo $image_sizes['size_900']['webp']; ?>" media="(min-width: 1400px)" type="image/webp">
					<source srcset="<?php echo $image_sizes['size_800']['webp']; ?>" media="(min-width: 1200px)" type="image/webp">
					<source srcset="<?php echo $image_sizes['size_700']['webp']; ?>" media="(min-width: 768px)" type="image/webp">
					<source srcset="<?php echo $image_sizes['size_600']['webp']; ?>" media="(min-width: 551px)" type="image/webp">
					<source srcset="<?php echo $image_sizes['size_500']['webp']; ?>" media="(max-width: 550px)" type="image/webp">
				<?php endif; ?>
				<source srcset="<?php echo $image_sizes['size_900']['original']; ?>" media="(min-width: 1400px)" type="image/<?php echo $image_file_type; ?>">
				<source srcset="<?php echo $image_sizes['size_800']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $image_file_type; ?>">
				<source srcset="<?php echo $image_sizes['size_700']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $image_file_type; ?>">
				<source srcset="<?php echo $image_sizes['size_600']['original']; ?>" media="(min-width: 551px)" type="image/<?php echo $image_file_type; ?>">
				<source srcset="<?php echo $image_sizes['size_500']['original']; ?>" media="(max-width: 550px)" type="image/<?php echo $image_file_type; ?>">
			<?php else : // floating image responsive widths
				switch($float_width) :
					case 'float-two-thirds' :
						$rendered_width = '543.39';
						if($image_file_type != 'gif') : ?>
							<source srcset="<?php echo $image_sizes['size_600']['webp']; ?>" media="(min-width: 1400px)" type="image/webp">
							<source srcset="<?php echo $image_sizes['size_500']['webp']; ?>" media="(min-width: 1200px)" type="image/webp">
							<source srcset="<?php echo $image_sizes['size_400']['webp']; ?>" media="(min-width: 992px)" type="image/webp">
							<source srcset="<?php echo $image_sizes['size_500']['webp']; ?>" media="(min-width: 768px)" type="image/webp">
							<source srcset="<?php echo $image_sizes['size_400']['webp']; ?>" media="(min-width: 551px)" type="image/webp">
							<source srcset="<?php echo $image_sizes['size_500']['webp']; ?>" media="(max-width: 550px)" type="image/webp">
						<?php endif; ?>
						<source srcset="<?php echo $image_sizes['size_600']['original']; ?>" media="(min-width: 1400px)" type="image/<?php echo $image_file_type; ?>">
						<source srcset="<?php echo $image_sizes['size_500']['original']; ?>" media="(min-width: 1200px)" type="image/<?php echo $image_file_type; ?>">
						<source srcset="<?php echo $image_sizes['size_400']['original']; ?>" media="(min-width: 992px)" type="image/<?php echo $image_file_type; ?>">
						<source srcset="<?php echo $image_sizes['size_500']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $image_file_type; ?>">
						<source srcset="<?php echo $image_sizes['size_400']['original']; ?>" media="(min-width: 551px)" type="image/<?php echo $image_file_type; ?>">
						<source srcset="<?php echo $image_sizes['size_500']['original']; ?>" media="(max-width: 550px)" type="image/<?php echo $image_file_type; ?>">
					<?php break;
					case 'float-half' :
						$rendered_width = '411.66';
						if($image_file_type != 'gif') : ?>
							<source srcset="<?php echo $image_sizes['size_500']['webp']; ?>" media="(min-width: 1400px)" type="image/webp">
							<source srcset="<?php echo $image_sizes['size_400']['webp']; ?>" media="(min-width: 768px)" type="image/webp">
							<source srcset="<?php echo $image_sizes['size_300']['webp']; ?>" media="(min-width: 551px)" type="image/webp">
							<source srcset="<?php echo $image_sizes['size_500']['webp']; ?>" media="(max-width: 550px)" type="image/webp">
						<?php endif; ?>
						<source srcset="<?php echo $image_sizes['size_500']['original']; ?>" media="(min-width: 1400px)" type="image/<?php echo $image_file_type; ?>">
						<source srcset="<?php echo $image_sizes['size_400']['original']; ?>" media="(min-width: 768px)" type="image/<?php echo $image_file_type; ?>">
						<source srcset="<?php echo $image_sizes['size_300']['original']; ?>" media="(min-width: 551px)" type="image/<?php echo $image_file_type; ?>">
						<source srcset="<?php echo $image_sizes['size_500']['original']; ?>" media="(max-width: 550px)" type="image/<?php echo $image_file_type; ?>">
					<?php break;
					case 'float-third' :
						$rendered_width = '271.69';
					case 'float-quarter' :
						$rendered_width = '205.83';
						if($image_file_type != 'gif') : ?>
							<source srcset="<?php echo $image_sizes['size_300']['webp']; ?>" media="(min-width: 551px)" type="image/webp">
							<source srcset="<?php echo $image_sizes['size_500']['webp']; ?>" media="(max-width: 550px)" type="image/webp">
						<?php endif; ?>
						<source srcset="<?php echo $image_sizes['size_300']['original']; ?>" media="(min-width: 551px)" type="image/<?php echo $image_file_type; ?>">
						<source srcset="<?php echo $image_sizes['size_500']['original']; ?>" media="(max-width: 550px)" type="image/<?php echo $image_file_type; ?>">
					<?php break;
				endswitch;
				// store rendered height for floated images
				$rendered_height = $rendered_width * $image_height / $image_width;
			endif;
			// rendered height and width
			if($force_full_image_width) :
				$rendered_width = '823.33';
				$rendered_height = $rendered_width * $image_height / $image_width;
			endif; ?>
			<img loading="lazy" alt="<?php if($image_alt) : echo $image_alt; else : echo $title; endif; ?>" height="<?php echo $rendered_height; ?>" src="<?php echo $image_url; ?>" width="<?php echo $rendered_width; ?>">
		</picture>
		<?php if(!empty($display_caption) && !empty($caption)) : ?> <figcaption><?php echo $caption; ?></figcaption><?php endif; ?>
	</figure>
<?php endif; ?>