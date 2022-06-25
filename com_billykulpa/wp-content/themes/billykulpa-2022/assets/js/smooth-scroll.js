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