<?php
include_once('./_common.php');

if (G5_IS_MOBILE) {
	include_once(G5_THEME_MSHOP_PATH.'/index.php');
	return;
}

define("_INDEX_", TRUE);
include_once(G5_THEME_SHOP_PATH.'/shop.main.head.php');
?>
<style>
.row-8 {
	display: flex;
	margin-left: -8px;
	margin-right: -8px;
}
.row-8 *[class^="col-"] {
	padding-left: 8px;
	padding-right: 8px;
	box-sizing: border-box;
}
.partners-wrap {
	padding-top: 8px;
	padding-bottom: 8px;
}
.partners-wrap *[class^="col-"] > div {
	display: flex;
	align-items: center;
	justify-content: center;
	min-height: 150px;
}
</style>
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
  <a class="carousel-control-prev" href="#sc_slide" data-slide="prev">
	<span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#sc_slide" data-slide="next">
	<span class="carousel-control-next-icon"></span>
  </a>

</div>
<?php
//include_once(G5_THEME_SHOP_PATH.'/shop.main.side.php');
?>
<?php echo display_banner('메인', 'mainbanner.20.skin.php'); ?>
<div class="container">
<!-- 메인이미지 시작 { -->

<!-- } 메인이미지 끝 -->

<?php if($default['de_type1_list_use']) { ?>
<!-- 히트상품 시작 { -->
<section class="sct_wrap">
	<!--
	<header>
		<h2>
			<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1" class="lang-change"  data-first-upper="1">${hit} ${item}</a>
		</h2>
	</header>
	-->
	<header>
		<h2>
			<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1">MD 추천</a>
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
<div class="row-8">
	<div class="col-6">
		<?php if($default['de_type2_list_use']) { ?>
		<!-- 추천상품 시작 { -->
		<section class="sct_wrap">
			<header>
				<h2 class="title"><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">추천</a></h2>
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
	</div>
	<div class="col-6">
		<?php if($default['de_type3_list_use']) { ?>
		<!-- 최신상품 시작 { -->
		<section class="sct_wrap">
			<header>
				<h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=3">신상품</a></h2>
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
	</div>
</div>
<!--
<div class="row-8">
	<div class="col-6">
		<div class="border-box">sdfsdfsdf</div>
	</div>
	<div class="col-2">
		<div class="border-box">1111</div>
	</div>
	<div class="col-2">
		<div class="border-box">2222</div>
	</div>
	<div class="col-2">
		<div class="border-box">3333</div>
	</div>
</div>
-->
<?php if($default['de_type4_list_use']) { ?>
<!-- 히트상품 시작 { -->
<section class="sct_wrap">
	<!--
	<header>
		<h2>
			<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1" class="lang-change"  data-first-upper="1">${hit} ${item}</a>
		</h2>
	</header>
	-->
	<header>
		<h2>
			<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">Best 상품</a>
		</h2>
	</header>
	<?php
		$list = new item_list();
		$list->set_type(4);
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
<!-- BIGIN :: Partners -->
<section class="sct_wrap">
	<header>
		<h2>
			<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">Partnership</a>
		</h2>
	</header>
	<div class="row-8 partners-wrap">
		<div class="col-3">
			<div class="border-box">
				<a href="#">
					<img src="<?php echo(G5_IMG_URL); ?>/logo/barskorea-logo.png" alt="" />
				</a>
			</div>
		</div>
		<div class="col-3">
			<div class="border-box">
				<a href="#">
					<img src="<?php echo(G5_IMG_URL); ?>/logo/bek-logo.png" alt="" />
				</a>
			</div>
		</div>
		<div class="col-3">
			<div class="border-box">
				<a href="#">
					<img src="<?php echo(G5_IMG_URL); ?>/logo/barskorea-logo.png" alt="" />
				</a>
			</div>
		</div>
		<div class="col-3">
			<div class="border-box">
				<a href="#">
					<img src="<?php echo(G5_IMG_URL); ?>/logo/bek-logo.png" alt="" />
				</a>
			</div>
		</div>
	</div>
	<div class="row-8 partners-wrap">
		<div class="col-3">
			<div class="border-box">
				<a href="#">
					<img src="<?php echo(G5_IMG_URL); ?>/logo/barskorea-logo.png" alt="" />
				</a>
			</div>
		</div>
		<div class="col-3">
			<div class="border-box">
				<a href="#">
					<img src="<?php echo(G5_IMG_URL); ?>/logo/bek-logo.png" alt="" />
				</a>
			</div>
		</div>
		<div class="col-3">
			<div class="border-box">
				<a href="#">
					<img src="<?php echo(G5_IMG_URL); ?>/logo/barskorea-logo.png" alt="" />
				</a>
			</div>
		</div>
		<div class="col-3">
			<div class="border-box">
				<a href="#">
					<img src="<?php echo(G5_IMG_URL); ?>/logo/bek-logo.png" alt="" />
				</a>
			</div>
		</div>
	</div>
	<div class="row-8 partners-wrap">
		<div class="col-3">
			<div class="border-box">
				<a href="#">
					<img src="<?php echo(G5_IMG_URL); ?>/logo/barskorea-logo.png" alt="" />
				</a>
			</div>
		</div>
		<div class="col-3">
			<div class="border-box">
				<a href="#">
					<img src="<?php echo(G5_IMG_URL); ?>/logo/bek-logo.png" alt="" />
				</a>
			</div>
		</div>
		<div class="col-3">
			<div class="border-box">
				<a href="#">
					<img src="<?php echo(G5_IMG_URL); ?>/logo/barskorea-logo.png" alt="" />
				</a>
			</div>
		</div>
		<div class="col-3">
			<div class="border-box">
				<a href="#">
					<img src="<?php echo(G5_IMG_URL); ?>/logo/bek-logo.png" alt="" />
				</a>
			</div>
		</div>
	</div>
</section>
	
<!-- END :: Partners -->
<?php /*
<?php include_once(G5_SHOP_SKIN_PATH.'/boxevent.skin.php'); // 이벤트 ?>

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