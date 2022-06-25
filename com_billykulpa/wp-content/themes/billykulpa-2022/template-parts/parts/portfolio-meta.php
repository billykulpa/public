<?php
// vars
$id = get_the_ID();
$client_name = get_field('client_name', $id);
$year = get_field('year', $id);
$portfolio_type = get_field('portfolio_type', $id);
$website = get_field('website', $id); ?>

<div class="meta-portfolio">
	<ul>
		<?php if(!empty($client_name)) : ?>
			<li>
				<div class="icon">
					<img alt="A user icon" height="14.4" src="/wp-content/uploads/icon-user.svg" width="14.4">
				</div>
				<div class="content-container"><span class="text-color-gray">Client:</span> <?php echo $client_name; ?>
			</li>
		<?php endif;
		if(!empty($year)) : ?>
			<li>
				<div class="icon">
					<img alt="A calendar icon" height="14.4" src="/wp-content/uploads/icon-calendar.svg" width="14.4">
				</div>
				<div class="content-container"><span class="text-color-gray">Year:</span> <?php echo $year; ?>
			</li>
		<?php endif;
		if(!empty($portfolio_type)) :
			$portfolio_type_counter = 0;
			$total_portfolio_type_count = count($portfolio_type);
			if($total_portfolio_type_count > 1) :
				$category_label = 'Categories:';
			else :
				$category_label = 'Category:';
			endif; ?>
			<li>
				<div class="icon">
					<img alt="A category icon" height="14.4" src="/wp-content/uploads/icon-category.svg" width="14.4">
				</div>
				<div class="content-container"><span class="text-color-gray"><?php echo $category_label; ?></span> <?php foreach($portfolio_type as $type) : echo $type['label']; if($portfolio_type_counter != $total_portfolio_type_count - 1) : echo ', '; endif; $portfolio_type_counter++; endforeach; ?></div>
			</li>
		<?php endif;
		if(is_singular('portfolio-item') && !empty($website)) : ?>
			<li>
				<div class="icon">
					<img alt="A website icon" height="14.4" src="/wp-content/uploads/icon-website.svg" width="14.4">
				</div>
				<div class="content-container"><span class="text-color-gray">Website:</span> <a href="<?php echo $website; ?>" target="_blank" title="The website of <?php echo $client_name; ?>"><?php echo $website; ?></a></div>
			</li>
		<?php endif; ?>
	</ul>
</div><!-- .meta-portfolio -->