const containerEl = document.querySelector('.filters-content');
const mixer = mixitup(containerEl, {
	animation: {
		duration: 300,
		// effects: 'fade translateY(-100px)',
	},
	callbacks: {
		onMixStart: function(state, futureState) {
			//console.log('Starting operation...');
			enableAllOptions();
		},
		onMixEnd: function(state, futureState) {
			checkActiveFilters();
		}
	},
	multifilter: {
		enable: true, // enable the multifilter extension for the mixer,
		logicBetweenGroups: 'and',
	}
});

// vars
const $reset = document.getElementById('filter-reset');
const $filterAll = document.querySelector('.sort-controls .filter[data-filter="all"]');
// const $filterDesc = document.querySelector('.sort-controls .filter[data-sort="order-1:desc"]');
// const $filterAsc = document.querySelector('.sort-controls .filter[data-sort="order-1:asc"]');
// filter vars
const clientSelect = document.querySelector('#select-client select');
const yearSelect = document.querySelector('#select-year select');
const portfolioTypeSelect = document.querySelector('#select-portfolio-type select');
const anySelect = document.querySelectorAll('.select-container select');
// empty array vars
let articleClientArray = [];
let articleYearArray = [];
let articlePortfolioTypeArray = [];

// function to check for .mixitup-control-active class
function checkActiveFilters()
{
	// empty array vars
	let articleClientArray = [];
	let articleYearArray = [];
	let articlePortfolioTypeArray = [];
	// just the selected option vars
	let clientOptionActive = clientSelect.options[clientSelect.selectedIndex].value;
	let yearOptionActive = yearSelect.options[yearSelect.selectedIndex].value;
	let portfolioTypeOptionActive = portfolioTypeSelect.options[portfolioTypeSelect.selectedIndex].value;
	// schools vars
	let unfilteredItems = document.querySelectorAll('.filters-content article');
	let visibleItems = document.querySelectorAll('.filters-content article:not([style="display: none;"])');
	// make an array of data filters attributes from visible articles
	Array.prototype.forEach.call(visibleItems, function(el) {
		// Do stuff here
		articleClientArray.push(el.dataset.client);
		articleYearArray.push(el.dataset.year);
		articlePortfolioTypeArray.push(el.dataset.portfolioType);
	});

	if(clientOptionActive !== '') {
		disableImpossibleYearOptions();
		disableImpossiblePortfolioTypeOptions();
	}
	if(yearOptionActive !== '') {
		disableImpossibleClientOptions();
		disableImpossiblePortfolioTypeOptions();
	}
	if(portfolioTypeOptionActive !== '') {
		disableImpossibleClientOptions();
		disableImpossibleYearOptions();
	}

	function disableImpossibleClientOptions()
	{
		// cities
		Array.from(clientSelect.options).forEach(function(clientOptionElement) {
			// vars
			let clientOptionValue = clientOptionElement.value.substring(1);
			// do the work
			if(articleClientArray.includes(clientOptionValue)) {
				//
			} else {
				if(clientOptionValue != '') {
					clientOptionElement.setAttribute('disabled','true');
				}
			};
		});
	}
	function disableImpossibleYearOptions()
	{
		// states
		Array.from(yearSelect.options).forEach(function(yearOptionElement) {
			// vars
			let yearOptionValue = yearOptionElement.value.substring(1);
			// do the work
			if(articleYearArray.includes(yearOptionValue)) {
				//
			} else {
				if(yearOptionValue != '') {
					yearOptionElement.setAttribute('disabled','true');
				}
			};
		});
	}
	function disableImpossiblePortfolioTypeOptions()
	{
		// countries
		Array.from(portfolioTypeSelect.options).forEach(function(portfolioTypeOptionElement) {
			// vars
			let portfolioTypeOptionValue = portfolioTypeOptionElement.value.substring(1);
			// do the work
			// must be a foreach because 'portfolio type' can have multiple values
			Array.from(articlePortfolioTypeArray).forEach(function(arrayElement) {
				if(arrayElement.includes(portfolioTypeOptionValue)) {
					//
				} else {
					if(portfolioTypeOptionValue != '') {
						portfolioTypeOptionElement.setAttribute('disabled','true');
					}
				};
			});
		});
	}
}

// function to set all select options to enabled
function enableAllOptions()
{
// cities
	Array.from(clientSelect.options).forEach(function(clientOptionElement) {
		// do the work
		clientOptionElement.disabled = false;
	});
// states
	Array.from(yearSelect.options).forEach(function(yearOptionElement) {
		// do the work
		yearOptionElement.disabled = false;
	});
// countries
	Array.from(portfolioTypeSelect.options).forEach(function(portfolioTypeOptionElement) {
		// do the work
		portfolioTypeOptionElement.disabled = false;
	});
}

function enableAllClientOptions()
{
// cities
	Array.from(clientSelect.options).forEach(function(clientOptionElement) {
		// do the work
		clientOptionElement.disabled = false;
	});
}

function enableAllYearOptions()
{
// states
	Array.from(yearSelect.options).forEach(function(yearOptionElement) {
		// do the work
		yearOptionElement.disabled = false;
	});
}

function enableAllPortfolioTypeOptions()
{
// countries
	Array.from(portfolioTypeSelect.options).forEach(function(portfolioTypeOptionElement) {
		// do the work
		portfolioTypeOptionElement.disabled = false;
	});
}
// standard filters
if($filterAll.classList.contains('mixitup-control-active')) {
	$filterAll.closest('.sort-controls').classList.remove('filter-active');
} else {
	$filterAll.closest('.sort-controls').classList.add('filter-active');
}