$(document).bind('mobileinit', function() {
	$.mobile.defaultPageTransition = 'slide';
});

$(document).bind('pageshow', function() {
	if($('.ui-page-active #slider').length) {
		$('.home-button:visible').hide();

		$('#slider').flexslider({
			animation: 'slide',
			slideshow: false,
			controlNav: false,
			prevText: '',
			nextText: '',
			keyboard: false
		})
	} else {
		$('.home-button:hidden').show();
	}

	if($('#portfolio').length) {
		$('#portfolio .container').flexslider({
			animation: 'slide',
			slideshow: false,
			prevText: '',
			nextText: '',
			keyboard: false
		})
	}

	if($('#project').length) {
		$('#project .slider').flexslider({
			animation: 'slide',
			slideshow: false,
			prevText: '',
			nextText: '',
			controlNav: false,
			keyboard: false
		})
	}
});