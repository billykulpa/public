<?php
// general vars
$uploads_path = '/wp-content/uploads/';
$uploads_path_webp = '/wp-content/webp-express/webp-images/uploads/';
// acf vars
$faqs = get_field('faqs');
	$block_classes = $faqs['block_classes'];
	$block_id = $faqs['block_id'];
	$background_color = $faqs['background_color'];
	$headline = $faqs['headline'];
	$topics = $faqs['topics']; // repeater
	$questions = $faqs['questions']; // repeater
	$stripe_pattern_side = $faqs['stripe_pattern_side'];
?>

<section class="frequently-asked-questions <?php echo $background_color; if(!empty($block_classes)) : echo ' ' . $block_classes; endif; ?>"<?php if(!empty($block_id)) : ?> id="<?php echo $block_id; ?>"<?php endif; ?>>
	<div class="container">
		<div class="faq-wrapper">
			<div class="toc-wrapper">
				<div id="faq-table-of-contents">
					<h3 class="toc-header">Table of Contents</h3>
					<div class="options">
						<label class="toggle" for="toc_subtopics">
							<input type="checkbox" class="toggle__input" id="toc_subtopics" />
							<span class="toggle-track">
								<span class="toggle-indicator">
									<span class="checkMark">
										<svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
											<path d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z"></path>
										</svg>
									</span>
								</span>
							</span>
						Hide Subtopics
						</label>
					</div><!-- .options -->
					<ul>
						<?php foreach($topics as $toc_topic) :
							// vars
							$toc_topic_header = $toc_topic['topic'];
							$toc_all_questions = $toc_topic['questions']; // repeater ?>
							<li><a href="#<?php echo slugify($toc_topic_header); ?>" target="_self" title="<?php echo $toc_topic_header; ?>"><?php echo $toc_topic_header; ?></a></li>
							<?php if(!empty($toc_all_questions)) : ?>
								<ul class="subtopics">
									<?php foreach($toc_all_questions as $toc_question) :
										// vars
										$toc_single_question = $toc_question['question'];
										$toc_single_answer = $toc_question['answer']; ?>
										<li><a href="#<?php echo slugify($toc_single_question); ?>" target="_self" title="<?php echo $toc_single_question; ?>"><?php echo $toc_single_question; ?></a></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				</div><!-- .table-of-contents -->
			</div><!-- .toc-wrapper -->
			<div class="content-wrapper">
				<div class="headline">
					<h2><?php echo $headline; ?></h2>
				</div><!-- .col-md -->
				<div class="questions">
					<?php foreach($topics as $faq_topic) :
						// vars
						$faq_topic_header = $faq_topic['topic'];
						$faq_all_questions = $faq_topic['questions']; // repeater ?>
						<?php if(!empty($faq_topic_header)) : ?>
							<h2 class="h3" id="<?php echo slugify($faq_topic_header); ?>"><?php echo $faq_topic_header; ?></h2>
							<?php foreach($faq_all_questions as $faq_question) :
								// vars
								$faq_single_question = $faq_question['question'];
								$faq_single_answer = $faq_question['answer']; ?>
								<div class="question" id="<?php echo slugify($faq_single_question); ?>">
									<h3 class="h4"><?php echo $faq_single_question; ?></h3>
									<?php echo $faq_single_answer; ?>
									<div class="anchor-top"><p><a href="#faq-table-of-contents" target="_self" title="Back to the top of these FAQs">Back to Top</a></p></div><!-- .anchor-top -->
								</div><!-- .question -->
							<?php endforeach;
						endif;
					endforeach; ?>
				</div><!-- .questions -->
			</div><!-- .content-wrapper -->
		</div><!-- .faq-wrapper -->
	</div><!-- .container -->
	<?php if($stripe_pattern_side != 'stripe-side-none') : ?>
		<div class="stripe-pattern <?php echo $stripe_pattern_side; ?>"></div><!-- .stripe-pattern -->
	<?php endif; ?>
</section>