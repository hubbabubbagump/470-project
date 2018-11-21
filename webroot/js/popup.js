function showPopup(msg) {
	$('<div class="popup">'+msg+'</div>').insertBefore('.header').delay(2000).fadeOut(600);
}