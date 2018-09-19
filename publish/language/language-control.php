<script>
jQuery(document).ready(function() {
	String.prototype.capitalize = function() {
	    return this.charAt(0).toUpperCase() + this.slice(1);
	}

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

	function languageChange(e, n) {
		jQuery.cookie('selLanguage', e, { expires: 7, path: '/', secure: false });

		// BIGIN :: Auto control
		for (var i = 0; i < filePath.length; i++) {
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
					//console.log(json);
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
		// END :: Auto control
		jQuery.ajax({
			url: "/language/disable_auto.php",
			type: "post",
			data: {
				selLang: jQuery.cookie('selLanguage')
			},
			dataType: "json",
			cache: false,
			timeout: 30000,
			success: function(json) {
				$('#side_menu #btn_sidemenu span.sound_only').text(json.sideMenuButton);
				$('#side_menu .side_menu_wr .side_menu_shop .today').text(json.seeToday);
				$('#side_menu .side_menu_wr .side_menu_shop .shoppingBasket').text(json.shoppingBasket);
				$('#side_menu .side_menu_wr .side_menu_shop .wishList').text(json.wishList);
				var i = 0;

				$('.lang-change').each(function() {
					var firstUpperCase = $(this).data('first-upper');
					if(firstUpperCase != undefined) {
						//alert('nothing');
						var first = 1;
					}
					//alert(firstUpperCase);
					if(n == 0) {
						readLangCode = $(this).text();
						$(this).data('read-code', readLangCode);
					} else {
						readLangCode = $(this).data('read-code');
					}
					
					readLangCodeArr = readLangCode.split('$');
					var languageCode = '';
					var languageCodeJoin = '';
					for (var i = 1; i < readLangCodeArr.length; i++) {
						languageCode = readLangCodeArr[i].replace('{','').replace('}','');
						languageCodeJoin += eval('json.' + languageCode);
					}
					if(first == 1) {
						var tmpString = languageCodeJoin.capitalize();
						$(this).text(tmpString);
					} else {
						var tmpString = languageCodeJoin;
						$(this).text(tmpString);
					}
				});
			},
			error: function(xhr, textStatus, errorThrown) {
				jQuery("div").html("<div>" + textStatus + " (HTTP-" + xhr.status + " / " + errorThrown + ")</div>" );
			}
		});
	}
	var n = 0;
	languageChange(changeLang, n);
	$(document).on('click', '.language-nav a', function() {
		n = 1;
		var langCode = $(this).data('lang');
		jQuery('.lang').val(langCode);
		languageChange(langCode, n);
		return false;
	});
});
</script>