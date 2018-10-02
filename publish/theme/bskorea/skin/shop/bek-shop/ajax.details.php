<?php
$it_id = $_POST['id'];

$root = $_SERVER['DOCUMENT_ROOT'];

include_once($root.'/common.php');

$sql = "SELECT it_name, it_maker, it_origin, it_brand, it_model, it_cust_price, it_price, it_img1, it_img2, it_img3 FROM g5_shop_item WHERE it_id = $it_id";
$row = sql_fetch($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<style>
.detail-wrap {
	padding: 20px;
}
.title { color: #ffffff; }
div[class^="col-"] {
	color: #ffffff;
}
.large-img img,
.thumb-img img {
	min-width: 100%;
}

.thumb-img img {
	margin-top: 25%;
	transform: translateY(-50%);
}
.bold { font-weight: bold; }
.img-wrap {  }
.content-wrap { display: flex; flex-direction: column; justify-content: space-between; }
.content-wrap > .content > div { background-color: rgba(0, 0, 0, .5); padding: 10px 0; position: relative; border-bottom: 1px dotted #efefef; }
.content-wrap > .content > div:first-child { border-top: 2px solid #efefef; }
.content-wrap > .content > div:last-child { border-bottom: 2px solid #efefef; }
.content-wrap > .content > div > div:first-child:after { content: ''; position: absolute; border-left: 5px solid #ffffff; border-right: 0; border-top: 9px solid transparent; border-bottom: 9px solid transparent; right: 10px; }
.content-wrap > .buttons > div { justify-content: flex-end; }
</style>
<div class="detail-wrap">
	<h1 class="title"><?php echo($row['it_name']); ?></h1>
	<div class="row mt-4">
		<div class="col-7 img-wrap">
			<div class="large-img">
				<img src="<?php echo G5_DATA_URL ?>/item/<?php echo $row['it_img1']; ?>" alt="" class="img-fluid">
			</div>
			<div class="thumb-img mt-2 row active">
				<div class="col-4">
					<div>
						<a href="#">
							<img src="<?php echo G5_DATA_URL ?>/item/<?php echo $row['it_img1']; ?>" alt="" class="img-fluid" />
						</a>
					</div>
				</div>
				<div class="col-4">
					<div>
						<a href="#">
							<img src="<?php echo G5_DATA_URL ?>/item/<?php echo $row['it_img2']; ?>" alt="" class="img-fluid" />
						</a>
					</div>
				</div>
				<div class="col-4">
					<div>
						<a href="">
							<img src="<?php echo G5_DATA_URL ?>/item/<?php echo $row['it_img3']; ?>" alt="" class="img-fluid" />
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-5 content-wrap">
			<div class="content">
				<div class="row">
					<div class="col-5 bold">
						제조사
					</div>
					<div class="col-7">
						<?php echo($row['it_maker']); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-5 bold">
						원산지
					</div>
					<div class="col-7">
						<?php echo($row['it_origin']); ?>
					</div>
				</div>
				<?php if(!empty($row['it_brand'])) { ?>
				<div class="row">
					<div class="col-5 bold">
						브랜드
					</div>
					<div class="col-7">
						<?php echo($row['it_brand']); ?>
					</div>
				</div>
				<?php } ?>
				<?php if(!empty($row['it_model'])) { ?>
				<div class="row">
					<div class="col-5 bold">
						모델
					</div>
					<div class="col-7">
						<?php echo($row['it_model']); ?>
					</div>
				</div>
				<?php } ?>
				<?php if(!empty($row['it_cust_price'])) { ?>
				<div class="row">
					<div class="col-5 bold">
						시중가격
					</div>
					<div class="col-7">
						<span class="line-through"><?php echo($row['it_cust_price']); ?></span>
					</div>
				</div>
				<?php } ?>
				<div class="row">
					<div class="col-5 bold">
						판매가격
					</div>
					<div class="col-7">
						<?php echo($row['it_price']); ?>
					</div>
				</div>
				<div class="row">
					<!-- // BIGIN :: option -->
					<div class='option'>
						<div class='option-header'>
							<h3><?php echo $row['it_name']; ?></h3>
							<a href='#' class='list-payment-close'>
								<i class='fa fa-close'></i>
							</a>
						</div>
						<div class='option-body'>
						<!-- /* BIGIN :: option */ -->
<script src="<?php echo G5_SHOP_SKIN_URL; ?>/option.js"></script>
							<?php
							include_once(str_replace(G5_URL, G5_PATH, G5_SHOP_SKIN_URL).'/option.lib.php');
							// 상품 선택옵션
    $option_item = get_list_options($row['it_id'], $row['it_option_subject'], 1);

    // 상품품절체크
    $is_soldout = is_soldout($row['it_id']);

    // 주문가능체크
    $is_orderable = true;
    if(!$row['it_use'] || $row['it_tel_inq'] || $is_soldout)
        $is_orderable = false;
							if($is_orderable) {
								$item_ct_qty = 1;
								if($row['it_buy_min_qty'] > 1) {
									$item_ct_qty = $row['it_buy_min_qty'];
								}
							?>
							<div class="list_item_option">
								<input type="hidden" name="it_id[]" value="<?php echo $row['it_id']; ?>">
								<input type="hidden" name="it_name[]" value="<?php echo stripslashes($row['it_name']); ?>">
								<input type="hidden" name="it_price[]" value="<?php echo get_price($row); ?>">
								<input type="hidden" name="it_stock[]" value="<?php echo get_it_stock_qty($row['it_id']); ?>">
								<input type="hidden" name="io_type[<?php echo $row['it_id']; ?>][]" value="0">
								<input type="hidden" name="io_id[<?php echo $row['it_id']; ?>][]" value="">
								<input type="hidden" name="io_value[<?php echo $row['it_id']; ?>][]" value="">
								<input type="hidden" name="io_price[<?php echo $row['it_id']; ?>][]" value="">
								<input type="hidden" name="ct_qty[<?php echo $row['it_id']; ?>][]" value="<?php echo $item_ct_qty; ?>">
								<input type="hidden" name="sw_direct[<?php echo $row['it_id']; ?>][]" value="" id="sw_direct_<?php echo $row['it_id']; ?>">
								<table class="sit_ov_tbl">
									<colgroup>
										<col class="grid_2">
										<col>
									</colgroup>
									<tbody>
										<?php // 선택옵션
											echo $option_item;
										?>
									</tbody>
								</table>
							</div>
							<?php
								}
							?>
							<!-- /* END :: option */ -->
						</div>
					</div>
					<!-- // END :: option -->
				</div>
				<!--
				<div class="row">
					<div class="col-5 bold">
						배송비결제
					</div>
					<div class="col-7">
						//
					</div>
				</div>
				-->
			</div>
			<div class="buttons">
				<div class="input-group">
					<div class="btn-group">
						<button class="btn btn-success"><i class="fa fa-shopping-cart"></i> 장바구니</button>
						<button class="btn btn-primary"><i class="fa fa-credit-card"></i> 바로구매</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
(function($) {
	jQuery('.thumb-img > div[class^="col-"]').eq(0).find('a').addClass('active');
	jQuery(document).on('click', '.thumb-img a', function() {
		var imgName = jQuery(this).find('img').attr('src');
		jQuery(this).closest('div[class^="col-"]').siblings().find('a').removeClass('active');
		jQuery(this).addClass('active');
		jQuery('.large-img img').attr('src', imgName);
		return false;
	});
})(jQuery);
</script>
</body>
</html>
