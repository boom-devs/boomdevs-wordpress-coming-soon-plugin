(function($) {
	"use strict";

	var scene = document.getElementById('scene');
	var circle = document.getElementById('circle');
	var square = document.getElementById('polygon');
	var triangle = document.getElementById('triangle');
	var line = document.getElementById('line');
	var star = document.getElementById('star');
	var parallaxInstance = new Parallax(scene);
	var parallaxInstance2 = new Parallax(circle);
	var parallaxInstance3 = new Parallax(polygon);
	var parallaxInstance4 = new Parallax(triangle);
	var parallaxInstance5 = new Parallax(line);
	var parallaxInstance6 = new Parallax(star);

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
	
})($);