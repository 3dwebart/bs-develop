document.documentElement.setAttribute("lang", "en");
document.documentElement.removeAttribute("class");

axe.run( function(err, results) {
  console.log( results.violations );
});

$(document).on('click', '.mfp-close', function() {
	$.magnificPopup.close();
});