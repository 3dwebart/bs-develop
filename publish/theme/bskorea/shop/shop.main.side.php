<div id="wrapper" class="mt-0">
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
				$list->set_view('it_star_score', true); // 별점 보이기
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