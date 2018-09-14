<script>
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

	var changeLang = jQuery('.lang').val();
	var filePath = [
		{
			'file' : 'top_member_menu',
			'tmplID' : '#memberNav',
			'tmplClass' : '.member-nav',
			'path1' : 'frontend',
			'path2' : 'common',
			'path3' : 'member-menu'
		},
		{
			'file' : 'search_and_logo',
			'tmplID' : '#searchLogo',
			'tmplClass' : '.search-logo',
			'path1' : 'frontend',
			'path2' : 'common',
			'path3' : 'top-search-logo'
		},
		{
			'file' : 'search_and_logo',
			'tmplID' : '#hdMenu',
			'tmplClass' : '#hd_menu',
			'path1' : 'frontend',
			'path2' : 'common',
			'path3' : 'top-hd-menu'
		}
	];
	// alert(filePath[1].q1);
	// Language code is in cookie
	console.log(filePath);
	console.log('cnt :: ' + filePath.length);

	function languageChange(e) {
		jQuery.cookie('selLanguage', e, { expires: 7, path: '/', secure: false });

		for (var i = 0; i < filePath.length; i++) {
			//console.log('file' + i + ' :: ' + filePath[i].tmplClass);
			tmplClass = filePath[i].tmplClass;
			tmplID = filePath[i].tmplClass;
			jQuery.ajax({
				url: "/language/" + filePath[i].file + ".php",
				type: "post",
				data: {
					selLang: jQuery.cookie('selLanguage'),
					path1: filePath[i].path1,
					path2: filePath[i].path2,
					path3: filePath[i].path3,
					tmplClass: filePath[i].tmplClass,
					tmplID: filePath[i].tmplID
				},
				dataType: "json",
				cache: false,
				timeout: 30000,
				success: function(json) {
					console.log(json);
					jQuery(json.tmplClass).html('');
					jQuery(json.tmplID).tmpl(json).appendTo(json.tmplClass);
					var tmp = [json.searchWordTwoCharactor];
					//alert(tmp[0]);
				},
				error: function(xhr, textStatus, errorThrown) {
					jQuery("div").html("<div>" + textStatus + " (HTTP-" + xhr.status + " / " + errorThrown + ")</div>" );
				}
			});
		}
	}
	languageChange(changeLang);
	$(document).on('click', '.language-nav a', function() {
		var langCode = $(this).data('lang');
		jQuery('.lang').val(langCode);
		languageChange(langCode);
		return false;
	});
});
</script>