<?php
/**
 * The template for displaying the footer
 */

// page vars
$page = get_field('page');
$minimal_footer = $page['minimal_footer'];
// get page slug
global $wp;
$current_url = home_url( add_query_arg( array(), $wp->request ) ) . '/';
$source_markup = array(':', '/');
$replace_markup = array('%3A', '%2F');
$formal_current_url = str_replace($source_markup, $replace_markup, $current_url); ?>

<footer id="site-footer">
	<section id="footer">
		<div class="content-container">
			<div class="container">
				<div class="fine-print">
					<div class="left-side">
						<?php if(empty($minimal_footer)) : ?>
							<div class="logo">
								<a href="/" target="_self" title="Visit Billy Kulpa's home page"><img alt="The logo of billykulpa.com" height="27.26" loading="lazy" src="/wp-content/uploads/logo-billy-kulpa-light.svg" width="160" /></a>
							</div>
						<?php endif; ?>
						<ul>
							<li><a href="https://pagespeed.web.dev/report?url=<?php echo $formal_current_url; ?>" target="_blank" title="How fast is this page on Google PageSpeed Insights?">How fast is this page?</a></li>
							<li class="order-md-first">&copy;<?php echo date('Y'); ?> Billy Kulpa. All Rights Reserved.</li>
						</ul>
					</div><!-- .left-side -->
					<?php if(empty($minimal_footer)) : ?>
						<div class="right-side">
							<div id="footer-social">
								<div class="social-icon twitter">
									<a href="https://twitter.com/billykulpa" target="_blank" title="Find Billy Kulpa on Twitter">
										<img alt="An icon for Twitter" height="28" src="/wp-content/uploads/icon-twitter-light.svg" width="28" />
									</a>
								</div><!-- .social-icon.twitter -->
								<div class="social-icon linkedin">
									<a href="https://www.linkedin.com/in/billykulpa" target="_blank" title="Find Billy Kulpa on LinkedIn">
										<img alt="An icon for LinkedIn" height="28" src="/wp-content/uploads/icon-linkedin-light.svg" width="28" />
									</a>
								</div><!-- .social-icon.linkedin -->
								<div class="social-icon youtube">
									<a href="https://www.youtube.com/c/BillyKulpa-Rockford" target="_blank" title="Find Billy Kulpa on YouTube">
										<img alt="An icon for YouTube" height="28" src="/wp-content/uploads/icon-youtube-light.svg" width="28" />
									</a>
								</div><!-- .social-icon.youtube -->
							</div><!-- #footer-social -->
						</div><!-- .right-side -->
					<?php endif; ?>
				</div>
			</div><!-- .container -->
		</div><!-- .content-container -->
	</section>
</footer><!-- #site-footer -->
<?php wp_footer(); ?>
</div><!-- #site-wrapper -->
</body>
</html>