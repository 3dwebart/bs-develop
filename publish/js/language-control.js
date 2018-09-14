jQuery(document).ready(function() {
	var protocol = window.location.protocol;
	var host = window.location.host;
	var rootUrl = protocol + '//' + host;
	//alert(rootUrl);
	if(jQuery.cookie('selLanguage') == 'en') {
		jQuery('.lang').val('en');
	} else if(jQuery.cookie('selLanguage') == 'ko') {
		jQuery('.lang').val('ko');
	} else {
		jQuery('.lang').val('ko');
	}

	// Language code is in cookie
	jQuery.cookie('selLanguage', jQuery('.lang').val(), { expires: 7, path: '/', secure: false });

	jQuery.ajax({
		url: rootUrl + "/language/lang_select.php",
		type: "post",
		data: {
			selLang: jQuery.cookie('selLanguage')
		},
		dataType: "json",
		cache: false,
		timeout: 30000,
		success: function(json) {
			console.log(json);
			/*
			jQuery('.hrader-top-bar').html('');
			jQuery("#headerTopBar").tmpl(json).appendTo(".hrader-top-bar");
			*/
		},
		error: function(xhr, textStatus, errorThrown) {
			jQuery("div").html("<div>" + textStatus + " (HTTP-" + xhr.status + " / " + errorThrown + ")</div>" );
		}
	});
});