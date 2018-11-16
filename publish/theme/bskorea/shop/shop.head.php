<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if(G5_IS_MOBILE) {
	include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
	return;
}
include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_PATH.'/language/language-control.php');
$languagePack = G5_URL.'/language/frontend/common/top-search-logo/'.$_COOKIE['selLanguage'].'.php';
?>
<?php include_once('cate_nav.php'); ?>
<link rel="stylesheet" href="/css/magnific-popup.css" />
<script src="/js/jquery.magnific-popup.js"></script>
<link rel="stylesheet" href="/css/jquery.bxslider.min.css" />
<!-- <script src="/js/jquery.jquery.bxslider.min.js"></script> -->
<style class="js-control-nav">
.cate-main-nav > li > ul > li:first-child::after { top: 0px; }
</style>
<script>
$(function () {
	$(".btn_sidemenu_cl").on("click", function() {
		$(".side_menu_wr").toggle();
		$(".fa-outdent").toggleClass("fa-indent")
	});

	$(".btn_side_shop").on("click", function() {
		$(this).next(".op_area").slideToggle(300).siblings(".op_area").slideUp();
	});

	$('.select-language > a').on('mouseover', function() {
		$(this).parent().find('ul').addClass('active');
	});

	/*
		== Category menus ==
		subTop : 각 메뉴의 서브메뉴의 top 값
		subCnt(Sub menu count) : 서브메뉴(ul)가 있는지 확인 - 0이면 없음
	*/
	var mainNav = $('.cate-main-nav > li');
	var subTop = 0;
	var navPosCSS = '';
	var enter = '\n\r';

	var i = 0;
	var mainCnt = 0;
	mainNav.each(function() {
		subTop = (i * 38) * -1;
		subAfterTop = (i * 38);
		subCnt = $(this).find('ul').length;
		mainCnt = i + 1;

		if(subCnt > 0) {
			$(this).find('.cate-sub-nav').css({
				top: subTop
			});
			navPosCSS += '.cate-main-nav > li:nth-child(' + (i + 1) + ') > ul > li:first-child::after { top: ' + subAfterTop + 'px; }';
			// it at last style sheet do not enter key
			if(mainNav.length > mainCnt) {
				navPosCSS += enter;
			}
			
		}
		$('.js-control-nav').text(navPosCSS);
		i++;
	});

	$(document).on('keydown', function(e) {
		var key = e.keyCode;
		var target = $('.cate-nav');
		if(target.hasClass('on') == true) {
			if(key == 27) {
				target.removeClass('on');
			}
		}
	});
});
</script>
<!-- 상단 시작 { -->
<!-- BIGIN :: top -->
<input type="hidden" value="" class="lang">
<?php
/*
if(isset($_SESSION['ss_mb_id'])) {
	echo('TRUE');
} else {
	echo('FALSE');
}
*/
?>
<div id="hd">
	<h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

	<div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

	<?php
		if(defined('_INDEX_')) { // index에서만 실행
			include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
		}
	?>
	<div class="member-nav"></div>
	<script id="memberNav" type="text/x-jquery-tmpl">
	<div id="tnb">
		<div class="container">
			<h3>${memberMenu}</h3>
			<ul>
				<li>
					<div class="dropdown">
						<a class="btn btn-default dropdown-toggle current-language" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							${currentLanguage}
						</a>
						<div class="dropdown-menu language-nav" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="#" data-lang="ko">${langKor}</a>
							<a class="dropdown-item" href="#" data-lang="en">${langEng}</a>
							<a class="dropdown-item" href="#" data-lang="zh-Hans">${langZhh}</a>
						</div>
					</div>
				</li>
				<?php if(G5_COMMUNITY_USE) { ?>
				<li class="tnb_left tnb_shop"><a href="<?php echo G5_SHOP_URL; ?>/"><i class="fa fa-shopping-bag" aria-hidden="true"></i> ${shoppingMall}</a></li>
				<li class="tnb_left tnb_community"><a href="<?php echo G5_URL; ?>/"><i class="fa fa-home" aria-hidden="true"></i> ${community}</a></li>
				<?php } ?>
				<li class="tnb_cart"><a href="<?php echo G5_SHOP_URL; ?>/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ${shoppingBasket}</a></li>            
				<li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">${mypage}</a></li>
				<?php if ($is_member) { ?>

				<li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">${userEditInfo}</a></li>
				<li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop">${signout}</a></li>
				<?php if ($is_admin) {  ?>
				<li class="tnb_admin"><a href="<?php echo G5_ADMIN_URL; ?>/shop_admin/"><b>${administrator}</b></a></li>
				<?php }  ?>
				<?php } else { ?>
				<li><a href="<?php echo G5_BBS_URL; ?>/register.php">${signup}</a></li>
				<li><a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>"><b>${signin}</b></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	</script>
	<div id="logo" class="text-center">
		<a href="<?php echo G5_SHOP_URL; ?>/">
			<!-- <img src="<?php echo G5_DATA_URL; ?>/common/logo_img" alt="<?php echo $config['cf_title']; ?>"> -->
			<img src="<?php echo G5_URL; ?>/img/logo/sancheong_berry_logo.png" alt="<?php echo $config['cf_title']; ?>">
		</a>
	</div>
	<div class="search-logo"></div>
	<script id="searchLogo" type="text/x-jquery-tmpl">
	
	</script>
	<!-- *****
	<div id="hd_wrapper">
		<div class="container">
			<div class="search-logo"></div>
			<script id="searchLogo" type="text/x-jquery-tmpl">
			<div id="hd_sch">
				<h3>${shoppingMallSearch}</h3>
				<form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">

				<label for="sch_str" class="sound_only">${searchWord}<strong class="sound_only"> ${require}</strong></label>
				<input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" placeholder="${inputOfSearchWord}" required>
				<button type="submit" id="sch_submit"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">${search}</span></button>

				</form>
			</div>
			</script>
			<!- 쇼핑몰 배너 시작 { ->
			<?php //echo display_banner('왼쪽'); ?>
			<!- } 쇼핑몰 배너 끝 ->
		</div>
	</div>
	***** -->
	
	<div id="hd_menu">
	</div>
	<script id="hdMenu" type="text/x-jquery-tmpl">
		<div class="container">
			<ul>
				<li>
					<a href="#" class="open-cate-nav"><i class="fa fa-bars"></i></a>
				</li>
				<li>
					<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1">${hit}${item}</a>
				</li>
				<li>
					<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">${recommendation}${item}</a>
				</li>
				<li>
					<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=3">${newest}${item}</a>
				</li>
				<li>
					<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">${hot}${item}</a>
				</li>
				<li>
					<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">${sale}${item}</a>
				</li>
				<li class="hd_menu_right nav-in-search relative">
					<a href="#"><i class="fa fa-search"></i></a>
					<div id="hd_sch">
						<h3>${shoppingMallSearch}</h3>
						<form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
							<label for="sch_str" class="sound_only">${searchWord}<strong class="sound_only"> ${require}</strong></label>
							<input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" placeholder="${inputOfSearchWord}" required>
							<button type="submit" id="sch_submit"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">${search}</span></button>
						</form>
					</div>
				</li>
				<li class="hd_menu_right">
					<a href="<?php echo G5_BBS_URL; ?>/faq.php">${faq}</a>
				</li>
				<li class="hd_menu_right">
					<a href="<?php echo G5_BBS_URL; ?>/qalist.php">${oneToOneInquire}</a>
				</li>
				<li class="hd_menu_right">
					<a href="<?php echo G5_SHOP_URL; ?>/personalpay.php">${individualPayment}</a>
				</li>
				<li class="hd_menu_right">
					<a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php">${userReviews}</a>
				</li>
				<li class="hd_menu_right">
					<a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">${cooponZone}</a>
				</li>
			</ul>
		</div>
	</script>
</div>
<script>
function search_submit(f) {
	if (f.q.value.length < 0) {
		jQuery.ajax({
			url: "/language/lang_select.php",
			type: "post",
			data: {
				selLang: jQuery.cookie('selLanguage'),
				path1 : 'frontend',
				path2 : 'common',
				path3 : 'top-search-logo'
			},
			dataType: "json",
			cache: false,
			timeout: 30000,
			success: function(json) {
				//alert(json.searchWordTwoCharactor);
				bootbox.alert({
				    message: '<h6>' + json.searchWordTwoCharactor + '</h6>',
				    callback: function () {
				        //console.log('This was logged in the callback!');
				        return false;
				    }
				});
			},
			error: function(xhr, textStatus, errorThrown) {
				jQuery("div").html("<div>" + textStatus + " (HTTP-" + xhr.status + " / " + errorThrown + ")</div>" );
			}
		});
		//alert("<?php echo($topSearch['searchWordTwoCharactor']); ?>");
		f.q.select();
		f.q.focus();
		return false;
	}
	return true;
}
</script>
<!-- END :: top -->
<!-- BIGIN :: right show menu click is show -->
<div id="side_menu">
	<button type="button" id="btn_sidemenu" class="btn_sidemenu_cl">
		<i class="fa fa-outdent" aria-hidden="true"></i>
		<span class="sound_only">사이드메뉴버튼</span>
	</button>
	<div class="side_menu_wr">
		<?php echo outlogin('theme/shop_basic'); // 아웃로그인 ?>
		<div class="side_menu_shop">
			<button type="button" class="btn_side_shop">
				<span class="today">오늘본상품</span>
				<span class="count"><?php echo get_view_today_items_count(); ?></span>
			</button>
			<?php include(G5_SHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>
			<button type="button" class="btn_side_shop">
				<span class="shoppingBasket">장바구니</span>
				<span class="count"><?php echo get_boxcart_datas_count(); ?></span>
			</button>
			<?php include_once(G5_SHOP_SKIN_PATH.'/boxcart.skin.php'); // 장바구니 ?>
			<button type="button" class="btn_side_shop">
				<span class="wishList">위시리스트</span>
				<span class="count"><?php echo get_wishlist_datas_count(); ?></span>
			</button>
			<?php include_once(G5_SHOP_SKIN_PATH.'/boxwish.skin.php'); // 위시리스트 ?>
		</div>
		<?php include_once(G5_SHOP_SKIN_PATH.'/boxcommunity.skin.php'); // 커뮤니티 ?>
	</div>
</div>
<!-- END :: right show menu click is show -->
