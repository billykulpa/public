<div id="mix-it-up-controls">
	<form>
		<div class="filters-wrapper">
			<div class="filters filters-filtering">
				<span class="kicker">Filters</span>
				<?php
				// WP_Query arguments
				$filter_args = array (
					'pagination'				=>	false,
					'posts_per_page'			=>	-1,
					'post_status'				=>	'publish',
					'post_type'					=>	array('portfolio-item')
				);
				// The Query
				$filter_query = new WP_Query( $filter_args );
				// The Loop
				if($filter_query->have_posts() ) : while ( $filter_query->have_posts() ) : $filter_query->the_post(); // do something
					// vars
					$post_ID = get_the_ID();
					$client_name = get_field('client_name',$post_ID);
					$year = get_field('year',$post_ID);
					$portfolio_type = get_field('portfolio_type',$post_ID);
					$all_clients[] = $client_name;
					$all_years[] = $year;
					foreach($portfolio_type as $type) :
						$all_portfolio_types[] = $type['label'];
					endforeach;
					?>
					<?php endwhile;
					wp_reset_postdata(); // clean up after the query and pagination
					// vars -- make array uniques
					$unique_clients = array_unique($all_clients);
					$unique_years = array_unique($all_years);
					$unique_portfolio_types = array_unique($all_portfolio_types);
					asort($unique_clients);
					arsort($unique_years);
					asort($unique_portfolio_types);
					?>
				<?php endif; ?>
				<div class="sort-controls-wrapper filtering">
					<div class="sort-controls-row location-filter">
						<div class="sort-controls" data-filter-group data-logic="and">
							<div class="filter-select select-container" id="select-client">
								<select>
									<option value="">Client</option>
									<?php foreach($unique_clients as $unique_client) : ?>
									<option value=".client-<?php echo slugify($unique_client); ?>"><?php echo $unique_client ?></option>
									<?php endforeach; ?>
								</select>
							</div><!-- .filter-select.select-container -->
						</div><!-- .sort-controls -->
						<div class="sort-controls" data-filter-group data-logic="and">
							<div class="filter-select select-container" id="select-year">
								<select>
									<option value="">Year</option>
									<?php foreach($unique_years as $unique_year) : ?>
									<option value=".year-<?php echo slugify($unique_year); ?>"><?php echo $unique_year; ?></option>
									<?php endforeach; ?>
								</select>
							</div><!-- .filter-select.select-container -->
						</div><!-- .sort-controls -->
						<div class="sort-controls" data-filter-group data-logic="and">
							<div class="filter-select select-container" id="select-portfolio-type">
								<select>
									<option value="">Type</option>
									<?php foreach($unique_portfolio_types as $unique_portfolio_type) : ?>
									<option value=".portfolio-type-<?php echo slugify($unique_portfolio_type); ?>"><?php echo $unique_portfolio_type ?></option>
									<?php endforeach; ?>
								</select>
							</div><!-- .filter-select.select-container -->
						</div><!-- .sort-controls -->
					</div><!-- .sort-controls-row -->
					<div class="sort-controls reset-filter">
						<button class="filter" data-filter="all" id="filter-reset" onclick="enableAllOptions()" type="reset">
							<img alt="A refresh icon" height="32" src="/wp-content/uploads/icon-refresh-light.svg" width="32"/>
						</button>
					</div><!-- .sort-controls -->
				</div><!-- .sort-controls-wrapper -->
			</div><!-- .filters -->
		</div><!-- .filters-wrapper -->
	</form>
</div>