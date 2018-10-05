<?php
include_once('./_common.php');

if (G5_IS_MOBILE) {
	include_once(G5_THEME_MSHOP_PATH.'/index.php');
	return;
}

define("_INDEX_", TRUE);
include_once(G5_THEME_SHOP_PATH.'/shop.main.head.php');
?>
<script>
(function($) {
	var fullWidth = 0;
	var calc = 0;
	function carouselSize() {
		fullWidth = $(window).width();
		calc = (fullWidth / 35) * 12;
		$('.carousel-item').height(calc);
	}
	carouselSize();
	$(window).resize(function() {
		carouselSize();
	});
})(jQuery);
</script>
<script src="<?php echo(G5_URL); ?>/js/shop.js"></script>
<div id="sc_slide" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
	<li data-target="#sc_slide" data-slide-to="0" class="active"></li>
	<li data-target="#sc_slide" data-slide-to="1"></li>
	<li data-target="#sc_slide" data-slide-to="2"></li>
	<li data-target="#sc_slide" data-slide-to="3"></li>
	<li data-target="#sc_slide" data-slide-to="4"></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
	<div class="carousel-item active">
	  <img src="/img/main-slide/01.jpg" alt="slide1">
	</div>
	<div class="carousel-item">
	  <img src="/img/main-slide/02.jpg" alt="slide2">
	</div>
	<div class="carousel-item">
	  <img src="/img/main-slide/03.jpg" alt="slide3">
	</div>
	<div class="carousel-item">
	  <img src="/img/main-slide/04.jpg" alt="slide4">
	</div>
	<div class="carousel-item">
	  <img src="/img/main-slide/05.jpg" alt="slide5">
	</div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
	<span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
	<span class="carousel-control-next-icon"></span>
  </a>

</div>
<?php
//include_once(G5_THEME_SHOP_PATH.'/shop.main.side.php');
?>
<div class="container">
<!-- 메인이미지 시작 { -->
<?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>
<!-- } 메인이미지 끝 -->

<?php if($default['de_type1_list_use']) { ?>
<!-- 히트상품 시작 { -->
<section class="sct_wrap">
	<header>
		<h2>
			<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1" class="lang-change"  data-first-upper="1">${hit} ${item}</a>
		</h2>
	</header>
	<?php
	$list = new item_list();
	$list->set_type(1);
	$list->set_view('it_img', true);
	$list->set_view('it_id', false);
	$list->set_view('it_name', true);
	$list->set_view('it_basic', true);
	$list->set_view('it_cust_price', true);
	$list->set_view('it_price', true);
	$list->set_view('it_icon', true);
	$list->set_view('sns', true);
	$list->set_view('it_star_score', true); // 별점 보이기
	echo $list->run();
	?>
</section>
<!-- } 히트상품 끝 -->
<?php } ?>
<?php /*
<?php if($default['de_type2_list_use']) { ?>
<!-- 추천상품 시작 { -->
<section class="sct_wrap">
	<header>
		<h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2" class="lang-change" data-first-upper="1">${recommendation}${item}</a></h2>
	</header>
	<?php
	$list = new item_list();
	$list->set_type(2);
	$list->set_view('it_id', false);
	$list->set_view('it_name', true);
	$list->set_view('it_basic', true);
	$list->set_view('it_cust_price', true);
	$list->set_view('it_price', true);
	$list->set_view('it_icon', true);
	$list->set_view('sns', true);
	echo $list->run();
	?>
</section>
<!-- } 추천상품 끝 -->
<?php } ?>

<?php include_once(G5_SHOP_SKIN_PATH.'/boxevent.skin.php'); // 이벤트 ?>

<?php if($default['de_type3_list_use']) { ?>
<!-- 최신상품 시작 { -->
<section class="sct_wrap">
	<header>
		<h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=3" class="lang-change"  data-first-upper="1">${newest}${item}</a></h2>
	</header>
	<?php
	$list = new item_list();
	$list->set_type(3);
	$list->set_view('it_id', false);
	$list->set_view('it_name', true);
	$list->set_view('it_basic', true);
	$list->set_view('it_cust_price', true);
	$list->set_view('it_price', true);
	$list->set_view('it_icon', true);
	$list->set_view('sns', true);
	echo $list->run();
	?>
</section>
<!-- } 최신상품 끝 -->
<?php } ?>

<?php if($default['de_type5_list_use']) { ?>
<!-- 할인상품 시작 { -->
<section class="sct_wrap">
	<header>
		<h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5" class="lang-change"  data-first-upper="1">${sale}${item}</a></h2>
	</header>
	<?php
	$list = new item_list();
	$list->set_type(5);
	$list->set_view('it_id', false);
	$list->set_view('it_name', true);
	$list->set_view('it_basic', true);
	$list->set_view('it_cust_price', true);
	$list->set_view('it_price', true);
	$list->set_view('it_icon', true);
	$list->set_view('sns', true);
	echo $list->run();
	?>
</section>
<!-- } 할인상품 끝 -->
<?php } ?>
*/ ?>


<?php
include_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
?>