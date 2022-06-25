<?php
	// define attributes and their defaults
	extract( shortcode_atts( array (
        'video_id' => '',
		'aspect_ratio' => '',
	), $atts ) );
	// define query parameters based on attributes
	$options = array(
		'video_id' => $video_id,
		'aspect_ratio' => $aspect_ratio,
	);
if(!empty($video_id)) : ?>
<div class="video-wrapper-outer vimeo-video">
	<div class="video-wrapper<?php if($aspect_ratio == 'standard') : ?> standard<?php elseif($aspect_ratio == 'classic-adeptia') : ?> classic-adeptia<?php endif; ?>">
		<iframe allow="autoplay; fullscreen; picture-in-picture" allowfullscreen frameborder="0" src="https://player.vimeo.com/video/<?php echo $video_id; ?>?h=00941bf856&title=0&byline=0&portrait=0"></iframe>
	</div><!-- .video-wrapper -->
</div><!-- .video-wrapper-outer -->
<script src="https://player.vimeo.com/api/player.js"></script>
<?php else : ?>
	<p>Missing video ID</p>
<?php endif; ?>