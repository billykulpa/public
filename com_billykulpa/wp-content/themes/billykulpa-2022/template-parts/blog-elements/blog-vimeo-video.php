<?php
// general vars
$uploads_path = '/wp-content/uploads/';
$uploads_path_webp = '/wp-content/webp-express/webp-images/uploads/';
// acf vars
$vimeo_video = get_field('vimeo_video');
$vimeo_video_id = $vimeo_video['vimeo_video_id'];
$aspect_ratio = $vimeo_video['aspect_ratio'];
?>
<?php if(!empty($vimeo_video_id)) : ?>
<div class="vimeo-video">
	<div class="video-wrapper-outer">
		<div class="video-wrapper<?php if($aspect_ratio == 'standard') : ?> standard<?php elseif($aspect_ratio == 'classic-adeptia') : ?> classic-adeptia<?php endif; ?>">
			<iframe allow="autoplay; fullscreen; picture-in-picture" allowfullscreen frameborder="0" src="https://player.vimeo.com/video/<?php echo $vimeo_video_id; ?>?h=00941bf856&title=0&byline=0&portrait=0"></iframe>
		</div><!-- .video-wrapper -->
	</div><!-- .video-wrapper-outer -->
	<script src="https://player.vimeo.com/api/player.js"></script>
</div><!-- .content -->
<?php endif; ?>