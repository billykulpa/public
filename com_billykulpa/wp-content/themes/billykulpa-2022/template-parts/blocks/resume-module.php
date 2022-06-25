<?php
// general vars
$uploads_path = '/wp-content/uploads/';
$uploads_path_webp = '/wp-content/webp-express/webp-images/uploads/';
// acf vars
$resume = get_field('resume'); // group
$experience = $resume['experience']; // repeater
$education = $resume['education']; // repeater
$volunteerism = $resume['volunteerism']; // repeater
$skills = $resume['skills']; // repeater
if((!empty($experience)|| !empty($volunteerism)) && (!empty($education) || !empty($skills))) :
	$resume_sidebar = true;
endif;
?>
<section class="resume-module">
	<div class="container">
		<?php if(!empty($resume_sidebar)) : ?>
			<div class="resume-content-block resume-column-wrapper">
				<div class="resume-column resume-column-mainbar">
		<?php endif; 
		if(!empty($experience)) : ?>
			<div class="resume-content-block resume-experience">
				<h2>Experience</h2>
				<?php foreach($experience as $job) :
					// vars
					$still_active = $job['still_active'];
					$title = $job['title'];
					$company = $job['company'];
					$website = $job['website'];
					$location = $job['location'];
					$date_start = $job['date_start'];
					if(empty($still_active)) :
						$date_end = $job['date_end'];
					else :
						$date_end = 'Present';
					endif;
					$description = $job['description']; ?>
					<div class="content">
						<?php if(!empty($title) || !empty($date_start) || !empty($date_end)) : ?><div class="header"><?php endif;
							if(!empty($title)) : ?><h3 class="title"><?php echo $title; ?></h3><?php endif;
							if(!empty($date_start) || !empty($date_end)) : ?><p class="dates"><?php endif; if(!empty($date_start)) : echo $date_start; endif; if(!empty($still_active) || !empty($date_end)) : ?> &mdash; <?php endif; if(!empty($still_active)) : ?>Present<?php else : if(!empty($date_end)) : echo $date_end; endif; endif; if(!empty($date_start) || !empty($date_end)) : ?></p><?php endif;
						if(!empty($title) || !empty($date_start) || !empty($date_end)) : ?></div><!-- .header --><?php endif;
						if(!empty($company)) : ?><p class="company"><?php if(!empty($website)) : ?><a href="<?php echo $website; ?>" target="_blank"<?php if(!empty($company)) : ?> title="The website of <?php echo $company; ?>"<?php endif; ?>><?php endif; echo $company; if(!empty($website)) : ?></a><?php endif; ?></p><?php endif;
						if(!empty($location)) : ?><p class="location"><?php echo $location; ?></p><?php endif;
						if(!empty($description)) : ?><div class="description"><?php echo $description; ?></div><!-- .description --><?php endif; ?>
					</div><!-- .content -->
				<?php endforeach; ?>
			</div><!-- .resume-experience -->
		<?php endif;
		if(!empty($volunteerism)) : ?>
			<div class="resume-content-block resume-volunteerism">
				<h2>Volunteerism</h2>
				<?php foreach($volunteerism as $volunteer_item) :
					// vars
					$still_active = $volunteer_item['still_active'];
					$title = $volunteer_item['title'];
					$organization = $volunteer_item['organization'];
					$website = $volunteer_item['website'];
					$location = $volunteer_item['location'];
					$date_start = $volunteer_item['date_start'];
					if(empty($still_active)) :
						$date_end = $volunteer_item['date_end'];
					else :
						$date_end = 'Present';
					endif;
					$description = $volunteer_item['description']; ?>
					<div class="content">
						<?php if(!empty($title) || !empty($date_start) || !empty($date_end)) : ?><div class="header"><?php endif;
							if(!empty($title)) : ?><h3 class="title"><?php echo $title; ?></h3><?php endif;
							if(!empty($date_start) || !empty($date_end)) : ?><p class="dates"><?php endif; if(!empty($date_start)) : echo $date_start; endif; if(!empty($still_active) || !empty($date_end)) : ?> &mdash; <?php endif; if(!empty($still_active)) : ?>Present<?php else : if(!empty($date_end)) : echo $date_end; endif; endif; if(!empty($date_start) || !empty($date_end)) : ?></p><?php endif;
						if(!empty($title) || !empty($date_start) || !empty($date_end)) : ?></div><!-- .header --><?php endif;
						if(!empty($organization)) : ?><p class="company"><?php if(!empty($website)) : ?><a href="<?php echo $website; ?>" target="_blank"<?php if(!empty($organization)) : ?> title="The website of <?php echo $organization; ?>"<?php endif; ?>><?php endif; echo $organization; if(!empty($website)) : ?></a><?php endif; ?></p><?php endif;
						if(!empty($location)) : ?><p class="location"><?php echo $location; ?></p><?php endif;
						if(!empty($description)) : ?><div class="description"><?php echo $description; ?></div><!-- .description --><?php endif; ?>
					</div><!-- .content -->
				<?php endforeach; ?>
			</div><!-- .resume-experience -->
		<?php endif;
		if(!empty($resume_sidebar)) : ?>
				</div><!-- .resume-column.resume-column-mainbar -->
				<div class="resume-column resume-column-sidebar">
		<?php endif;
		if(!empty($education)) : ?>
			<div class="resume-content-block resume-education">
				<h2>Education</h2>
				<?php foreach($education as $education_item) :
					// vars
					$still_active = $education_item['still_active'];
					$school = $education_item['school'];
					$degree = $education_item['degree'];
					$website = $education_item['website'];
					$location = $education_item['location'];
					$date_start = $education_item['date_start'];
					if(empty($still_active)) :
						$date_end = $education_item['date_end'];
					else :
						$date_end = 'Present';
					endif;
					$description = $education_item['description']; ?>
					<div class="content">
						<?php if(!empty($school) || !empty($date_start) || !empty($date_end)) : ?><div class="header"><?php endif;
							if(!empty($school)) : ?><h3 class="title"><?php if(!empty($website)) : ?><a href="<?php echo $website; ?>" target="_blank"<?php if(!empty($school)) : ?> title="The website of <?php echo $school; ?>"<?php endif; endif; ?>><?php echo $school; if(!empty($website)) : ?></a><?php endif; ?></h3><?php endif;
							if(!empty($date_start) || !empty($date_end)) : ?><p class="dates"><?php endif; if(!empty($date_start)) : echo $date_start; endif; if(!empty($still_active) || !empty($date_end)) : ?> &mdash; <?php endif; if(!empty($still_active)) : ?>Present<?php else : if(!empty($date_end)) : echo $date_end; endif; endif; if(!empty($date_start) || !empty($date_end)) : ?></p><?php endif;
						if(!empty($school) || !empty($date_start) || !empty($date_end)) : ?></div><!-- .header --><?php endif;
						if(!empty($degree)) : ?><p class="degree"><?php echo $degree; ?></p><?php endif;
						if(!empty($location)) : ?><p class="location"><?php echo $location; ?></p><?php endif;
						if(!empty($description)) : ?><p class="description"><?php echo $description; ?></p><?php endif; ?>
					</div><!-- .content -->
				<?php endforeach; ?>
			</div><!-- .resume-education -->
		<?php endif;
		if(!empty($skills)) : ?>
			<div class="resume-content-blockresume-skills">
				<h2>Skills</h2>
				<div class="content">
					<ul>
						<?php foreach($skills as $skill_item) :
							// vars
							$skill = $skill_item['skill']; ?>
							<li><?php echo $skill; ?></li>
						<?php endforeach; ?>
					</ul>
				</div><!-- .content -->
			</div><!-- .resume-skills -->
		<?php endif; ?>
		<div class="resume-content-block resume-references">
			<h2>References</h2>
			<div class="content">
				<p>Available on request, of course.</p>
			</div><!-- .content -->
		</div><!-- .resume-references -->
		<?php if(!empty($resume_sidebar)) : ?>
				</div><!-- .resume-column.resume-column-sidebar -->
			</div><!-- .resume-column-wrapper -->
		<?php endif; ?>
	</div><!-- .container -->
</section>