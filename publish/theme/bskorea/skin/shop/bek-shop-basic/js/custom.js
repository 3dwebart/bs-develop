document.documentElement.setAttribute("lang", "en");
document.documentElement.removeAttribute("class");

axe.run( function(err, results) {
  console.log( results.violations );
});

$(document).on('click', '.mfp-close', function() {
	$.magnificPopup.close();
});

(function($) {
	var i = 0;
	$(window).scroll(function() {
		i++;
		console.log('TEST :: ' + i);
	});
})(jQuery);