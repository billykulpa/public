<?php
/**
 * Template part for displaying search
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package billykulpa2022
 */

?>
<div id="search-field">
	<form role="search" method="get" class="search-form" action="<?php bloginfo('url'); ?>" >
		<fieldset>
			<input class="search-input" type="text" name="s" value="<?php if ( is_search() ) : ?><?php the_search_query(); ?><?php endif; ?>" placeholder="Search Term(s)" maxlength="" />
			<button class="search-button" type="submit">Search</button>
			<input type="hidden" name="" value="">
			<!--<input type="hidden" name="post_type" value="">-->
		</fieldset>
	</form>
</div>