(function($) {
	"use strict";

	/*=================== Countdown ===================*/
	$('[data-countdown]').each(function () {
	    var $this = $(this),
	    finalDate = $(this).data('countdown');
	    $this.countdown(finalDate, function (event) {
	        $this.html(event.strftime('<div class="countdown-container"><div class="countdown-box day"><span>Day%!d</span><div class="box-r"><div class="countdown-content"><div class="number">%-D</div></div></div></div>' + '<div class="countdown-box hour"><span>Hours</span><div class="box-r"><div class="countdown-content"><div class="number">%H</div></div></div></div>' + '<div class="countdown-box min"><div class="box-r"><div class="countdown-content"><div class="number">%M</div></div></div><span>Minutes</span></div>' + '<div class="countdown-box sec"><div class="box-r"><div class="countdown-content"><div class="number">%S</div></div></div><span>Seconds</span></div>'));
	    });
	});

	/*=================== One Page Scrolling ===================*/
	$(".navbar-nav a.nav-link").click(function(){ 
		var $anchor = $(this);
	    $anchor.parent().addClass("active").siblings().removeClass("active");
	    $($anchor.attr('href')).addClass("show").siblings().removeClass("show");
	});

	$(".overlay-btn a").click(function() {
		$(".single-blog-popup-wrapper").addClass('active');
	});

	$(".close-button").click(function(){
		alert();
		$(".single-blog-popup-wrapper").removeClass('active');
	});

	/*=================== Load image ===================*/
	$('[data-bg]').each(function () {
		var imgUrl = $(this).data('bg');
		$(this).css({
			'background': 'url("' + imgUrl + '")'
		});
	});

	
})(jQuery);