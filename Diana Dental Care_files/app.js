$("#hamburger").on("click", function() {
	$("#nav-mobile").slideToggle();
});

$("#about-link").on("click", function() {
	$("#mega-menu-treatment").slideUp();
	$("#mega-menu-location").slideUp();
	$("#mega-menu-team").slideToggle();
	event.stopPropagation();
});

$("#treatment-link").on("click", function() {
	$("#mega-menu-team").slideUp();
	$("#mega-menu-location").slideUp();
	$("#mega-menu-treatment").slideToggle();
	event.stopPropagation();
});

$("#location-link").on("click", function() {
	$("#mega-menu-team").slideUp();
	$("#mega-menu-treatment").slideUp();
	$("#mega-menu-location").slideToggle();
	event.stopPropagation();
});

$("body").on("click", function() {
	$(".mega-menu").slideUp();
});