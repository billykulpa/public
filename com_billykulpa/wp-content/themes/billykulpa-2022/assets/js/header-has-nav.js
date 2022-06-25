// variables we need to enable the bodyScrollLock plugin
let disableBodyScroll = bodyScrollLock.disableBodyScroll;
let enableBodyScroll = bodyScrollLock.enableBodyScroll;

// general vars
const $body = document.querySelector('body');
const $theHeader = document.querySelector('header.the-header');

// site is scrolled properties
let scrollPosition = window.scrollY;

// SMOOTH SCROLL LINK
document
.querySelectorAll('a[href^="#"]')
.forEach(trigger => {
	trigger.onclick = function(e) {
		e.preventDefault();
		let hero = document.querySelector('.hero');
		let heroHeight = hero.offsetHeight;
		let hash = this.getAttribute('href');
		let target = document.querySelector(hash);
		let headerOffset = 96; // header height + 1.000rem
		let elementPosition = target.offsetTop;
		let offsetPosition = elementPosition + heroHeight - headerOffset;

		// console.log(offsetPosition);
		window.scrollTo({
			top: offsetPosition,
			behavior: "smooth"
		});
	};
});

// nav hover
let $navLinks = document.querySelectorAll('ul.navigation-list li');
// do the work
Array.prototype.forEach.call($navLinks, $link => {
	$link.addEventListener('mouseover', e => {
		showNavMenus($link);
	});
	$link.addEventListener('mouseleave', e => {
		hideNavMenus($link);
	});
});

// functions
function showNavMenus($link) {
	$link.classList.add('active');
	// make a selection here for submenu, then use that to set the below properties
	let $submenu = $link.querySelector('.sub-menu');
	if($submenu) {
		$submenu.classList.add('active');
		$submenu.setAttribute('aria-expanded', 'true')
	}
}
function hideNavMenus($link) {
	$link.classList.remove('active');
	let $submenu = $link.querySelector('ul.sub-menu');
	if($submenu) {
		$submenu.classList.remove('active');
		$submenu.setAttribute('aria-expanded', 'false')
	}
}



// MOBILE NAVIGATION
// vars
let $slideoutMenu = document.getElementById('slideout-menu');
let $toggleButton = document.getElementById('nav-hamburger');
let $navigationWrapper = document.querySelector('.navigation-wrapper');
let $mobileNav = document.querySelector('ul.navigation-list');
let $mobileNavLinksWithChildren = document.querySelectorAll('ul.navigation-list li.menu-item-has-children > a');
let $mobileSubMenus = document.querySelectorAll('ul.navigation-list ul.sub-menu');

// INNER MOBILE NAV
// Generic function for inserting HTML
function insertAfter(referenceNode, newNode)
{
	referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

// make a span element after each li a with a child
Array.prototype.forEach.call($mobileNavLinksWithChildren, $link => {
	// vars
	let $mobileNavSpan = document.createElement('span');
	$mobileNavSpan.innerHTML = '&#187;';
	$mobileNavSpan.classList.add('next-level');
	// do the work (insert the span)
	insertAfter($link, $mobileNavSpan);
});

// make a span element before each mobile sub-menu
Array.prototype.forEach.call($mobileSubMenus, $link => {
	// vars
	let $mobileSubMenuSpan = document.createElement('span');
	$mobileSubMenuSpan.innerHTML = '<span class="chevron">&#171;</span><span class="text">Back<span>';
	$mobileSubMenuSpan.classList.add('prev-level');
	// Insert the new node after the last element in the parent node
	$link.prepend($mobileSubMenuSpan);
});

// vars
let $mobileNavSpansNextLevel = document.querySelectorAll('ul.navigation-list span.next-level');
let $mobileNavSpansPrevLevel = document.querySelectorAll('ul.navigation-list span.prev-level');

// utility function to position the submenus
function positionSubMenus()
{
	// vars
	let mobileNavPositionTop = $mobileNav.getBoundingClientRect().top;
	// do the work
	Array.prototype.forEach.call($mobileSubMenus, $link => {
		// need the 'top' style value to be the difference between real top and top of ul.navigation-list.mobile
		let mobileSubMenuPositionTop = $link.getBoundingClientRect().top;
		let mobileSubMenuParentPositionTop = $link.parentNode.getBoundingClientRect().top;

		// set the top value
		let closestUlSubMenu = $link.parentNode.closest('#slideout-menu ul.sub-menu');
		// if the ul.sub-menu has a parent ul.sub-menu ...
		if(closestUlSubMenu !== null) {
			$link.style.top = 0 - mobileSubMenuPositionTop + closestUlSubMenu.getBoundingClientRect().top + 'px';
		} else {
			$link.style.top = mobileNavPositionTop - mobileSubMenuPositionTop + 'px';
		}
	});
}
// utility function for to remove position of sub menus
function resetPositionSubMenus()
{
	Array.prototype.forEach.call($mobileSubMenus, $link => {
		$link.style.top = '';
	});	
}
// utility function for activating mobile slide menu
function activateMobileSubMenus($link)
{
	$link.classList.add('active');
}

// utility function for deactivating mobile slide menu
function deactivateMobileSubMenus()
{
	Array.prototype.forEach.call($mobileNavSpansNextLevel, $link => {
		$link.classList.remove('active');
	});
}

// utility function for deactivating mobile slide menu
function deactivateThisMobileSubMenu($link)
{
	let $parentSubMenu = $link.parentNode;
	let $activatedNextLevel = $parentSubMenu.previousElementSibling;
	// console.log($activatedNextLevel);
	$activatedNextLevel.classList.remove('active');
}

// do the work
// run through the span.next-levels and check if they're clicked
Array.prototype.forEach.call($mobileNavSpansNextLevel, $link => {
	$link.addEventListener('click', e => {
		activateMobileSubMenus($link);
	});
});
// run through the span.prev-levels and check if they're clicked
Array.prototype.forEach.call($mobileNavSpansPrevLevel, $link => {
	$link.addEventListener('click', e => {
		deactivateThisMobileSubMenu($link);
	});
});

// OUTER MOBILE NAV
// Utility function for activating the slideout menu and enabling body scroll lock
function activateSlideoutMenu()
{
	// do the thing
	if(!$slideoutMenu.classList.contains('is-open')) {
		$slideoutMenu.classList.add('is-open');
		$body.classList.add('slideout-menu-is-open');
		// lock the page from scrolling
		disableBodyScroll($slideoutMenu);
	}
}

// Utility function for closing the slideout menu and removing body scroll lock
function resetSlideoutMenu()
{
	// do the thing
	if($slideoutMenu.classList.contains('is-open')) {
		$slideoutMenu.classList.remove('is-open');
		$body.classList.remove('slideout-menu-is-open');
		// remove lock the page from scrolling
		enableBodyScroll($slideoutMenu);
		// reset menus to home
		deactivateMobileSubMenus();
		// remove position of sub-menus
		resetPositionSubMenus();
	}
	// stop listening for clicks outside of header
	document.removeEventListener('click', clickedOutOfSlideoutMenu);
}

// Utility function to see if the user clicked outside of the slideout menu
function clickedOutOfSlideoutMenu(event)
{
	// nav search variables
	let isClickInsideMobileMenu = $navigationWrapper.contains(event.target);

	if(!isClickInsideMobileMenu) {
		//the click was outside the header, do something
		resetSlideoutMenu();
	}
}

// Utility function for clearing the panels if user clicks out of header.the-header
function clickEscapeSlideoutMenu()
{
	// is search active?
	if($body.classList.contains('slideout-menu-is-open')) {
		// I'm using "click" but it works with any event
		document.addEventListener('click', clickedOutOfSlideoutMenu);
	}
}
// SLIDEOUT MENU
// Step 1: If the user clicks the hamburger icon
$toggleButton.onclick = function()
{
	positionSubMenus();
	activateSlideoutMenu();
	clickEscapeSlideoutMenu();
}

// SEARCH
// search icon variables
let $searchWrapper = document.querySelector('.nav-search-wrapper');
let $searchIcon = document.querySelector('.nav-search-wrapper img');
// search form variables
let $searchFields = document.querySelector('#search-fields-nav');
let $searchInput = document.querySelector('#search-fields-nav .search-input');
let $searchClose = document.querySelector('#search-fields-nav .search-close img');

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