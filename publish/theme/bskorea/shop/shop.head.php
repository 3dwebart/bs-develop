<?php
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
include_once(G5_PATH.'/Language/language-control.php');
$languagePack = $_SERVER['DOCUMENT_ROOT'].'/language/frontend/common/top-search-logo/'.$_COOKIE['selLanguage'].'.php';
?>
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
});
</script>
<!-- 상단 시작 { -->
<!-- BIGIN :: top -->
<input type="hidden" value="" class="lang">


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
		<h3>${memberMenu}</h3>
		<ul>
			<li>
				<div class="dropdown">
					<a class="btn btn-default dropdown-toggle current-language" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
	</script>
	<div id="hd_wrapper">
		<div id="logo">
			<a href="<?php echo G5_SHOP_URL; ?>/">
				<!-- <img src="<?php echo G5_DATA_URL; ?>/common/logo_img" alt="<?php echo $config['cf_title']; ?>"> -->
				<img src="<?php echo G5_URL; ?>/img/logo/bek-logo.png" alt="<?php echo $config['cf_title']; ?>">
			</a>
		</div>
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
		<!-- 쇼핑몰 배너 시작 { -->
		<?php echo display_banner('왼쪽'); ?>
		<!-- } 쇼핑몰 배너 끝 -->
	</div>
	
	<div id="hd_menu">
		
	</div>
	<script id="hdMenu" type="text/x-jquery-tmpl">
		<ul>
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
	</script>
</div>
<script>
function search_submit(f) {
	if (f.q.value.length < 2) {
		jQuery.ajax({
			url: "/language/search_and_logo.php",
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
				console.log('data :: ' + json);
				alert(json.searchWordTwoCharactor);
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
<div id="side_menu">
	<button type="button" id="btn_sidemenu" class="btn_sidemenu_cl"><i class="fa fa-outdent" aria-hidden="true"></i><span class="sound_only">사이드메뉴버튼</span></button>
	<div class="side_menu_wr">
		<?php echo outlogin('theme/shop_basic'); // 아웃로그인 ?>
		<div class="side_menu_shop">
			<button type="button" class="btn_side_shop">오늘본상품<span class="count"><?php echo get_view_today_items_count(); ?></span></button>
			<?php include(G5_SHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>
			<button type="button" class="btn_side_shop">장바구니<span class="count"><?php echo get_boxcart_datas_count(); ?></span></button>
			<?php include_once(G5_SHOP_SKIN_PATH.'/boxcart.skin.php'); // 장바구니 ?>
			<button type="button" class="btn_side_shop">위시리스트<span class="count"><?php echo get_wishlist_datas_count(); ?></span></button>
			<?php include_once(G5_SHOP_SKIN_PATH.'/boxwish.skin.php'); // 위시리스트 ?>
		</div>
		<?php include_once(G5_SHOP_SKIN_PATH.'/boxcommunity.skin.php'); // 커뮤니티 ?>

	</div>
</div>

<div id="wrapper">

	<div id="aside">

		<?php include_once(G5_SHOP_SKIN_PATH.'/boxcategory.skin.php'); // 상품분류 ?>
		<?php include_once(G5_THEME_SHOP_PATH.'/category.php'); // 분류 ?>
		<?php if($default['de_type4_list_use']) { ?>
		<!-- 인기상품 시작 { -->
		<section class="sale_prd">
			<h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">인기상품</a></h2>
			<?php
			$list = new item_list();
			$list->set_type(4);
			$list->set_view('it_id', false);
			$list->set_view('it_name', true);
			$list->set_view('it_basic', false);
			$list->set_view('it_cust_price', false);
			$list->set_view('it_price', true);
			$list->set_view('it_icon', false);
			$list->set_view('sns', false);
			echo $list->run();
			?>
		</section>
		<!-- } 인기상품 끝 -->
		<?php } ?>

		<!-- 커뮤니티 최신글 시작 { -->
		<section id="sidx_lat">
			<h2>커뮤니티 최신글</h2>
			<?php echo latest('theme/shop_basic', 'notice', 5, 30); ?>
		</section>
		<!-- } 커뮤니티 최신글 끝 -->

		<?php echo poll('theme/shop_basic'); // 설문조사 ?>

		<?php echo visit('theme/shop_basic'); // 접속자 ?>
	</div>
<!-- } 상단 끝 -->

	<!-- 콘텐츠 시작 { -->
	<div id="container">
		<?php if ((!$bo_table || $w == 's' ) && !defined('_INDEX_')) { ?><div id="wrapper_title"><?php echo $g5['title'] ?></div><?php } ?>
		<!-- 글자크기 조정 display:none 되어 있음 시작 { -->
		<div id="text_size">
			<button class="no_text_resize" onclick="font_resize('container', 'decrease');">작게</button>
			<button class="no_text_resize" onclick="font_default('container');">기본</button>
			<button class="no_text_resize" onclick="font_resize('container', 'increase');">크게</button>
		</div>
		<!-- } 글자크기 조정 display:none 되어 있음 끝 -->