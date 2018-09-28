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
.large-img img {
	min-width: 100%;
}
</style>
<div class="detail-wrap">
	<h1 class="title"><?php echo($row['it_name']); ?></h1>
	<div class="row">
		<div class="col-7">
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
		<div class="col-5">
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
	</div>
</div>
<script>
(function($) {
	jQuery(document).on('click', '.thumb-img a', function() {
		var imgName = jQuery(this).find('img').attr('src');
		jQuery(this).closest('.thumb-img').siblings().find('a').removeClass('active');
		jQuery(this).addClass('active');
		jQuery('.large-img img').attr('src', imgName);
		return false;
	});
})(jQuery);
</script>
</body>
</html>
