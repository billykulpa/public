// general vars
let $theHeader = document.querySelector('header.the-header');
// SEARCH
// search icon variables
let $searchWrapper = document.querySelector('.nav-search-wrapper');
let $searchIcon = document.querySelector('.nav-search-wrapper img');
// search form variables
let $searchFields = document.querySelector('#search-fields-nav');
let $searchInput = document.querySelector('#search-fields-nav .search-input');
let $searchClose = document.querySelector('#search-fields-nav .search-close svg');

// Utility function for activating the search nav
function activateNavSearch()
{
	// do the thing
	if(!$searchFields.classList.contains('active')) {
		$searchFields.classList.add('active');
	}
	if(!$body.classList.contains('search-active')) {
		$body.classList.add('search-active');
	}
	$searchInput.focus();
}

// Utility function for clearing the search
function resetNavSearch()
{
	// do the thing
	if($searchFields.classList.contains('active')) {
		$searchFields.classList.remove('active');
	}
	if($body.classList.contains('search-active')) {
		$body.classList.remove('search-active');
	}
	$searchInput.value = '';

	// stop listening for user keyboard keyups
	document.removeEventListener('keyup', userTyping);
	// stop listening for clicks outside of header
	document.removeEventListener('click', clickedOutOfHeader);
}

// Utility function to see if the user is typing (and pushing escape)
function userTyping({key})
{
	// do the thing
	if(key === 'Escape') {
		// check if search is avtive
		if($body.classList.contains('search-active')) {
			resetNavSearch();
		}
	}
}

// Utility function for clearing the search via escape key
function typeEscapeNavSearch()
{
	// is search active?
	if($body.classList.contains('search-active')) {
		// check for key press
		document.addEventListener('keyup', userTyping);
	}
}

// Utility function to see if the user clicked outside of the header area
function clickedOutOfHeader(event)
{
	// nav search variables
	let isClickInsideHeader = $theHeader.contains(event.target);

	if (!isClickInsideHeader) {
		//the click was outside the header, do something
		resetNavSearch();
	}
}

// Utility function for clearing the panels if user clicks out of header.the-header
function clickEscapeNavSearch()
{
	// is search active?
	if($body.classList.contains('search-active')) {
		// I'm using "click" but it works with any event
		document.addEventListener('click', clickedOutOfHeader);
	}
}

// SEARCH
// Step 1: If the user clicks the search icon
$searchIcon.onclick = function()
{
	activateNavSearch();
	typeEscapeNavSearch();
	clickEscapeNavSearch();
}

// Step 2: If user clicks the close icon, shut it down
$searchClose.onclick = function()
{
	resetNavSearch();
}