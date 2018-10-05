<?php
$it_id = $_POST['id'];

$root = $_SERVER['DOCUMENT_ROOT'];

include_once($root.'/common.php');

$sql = "SELECT 
			ca_id, ca_id2, ca_id3, it_skin, it_mobile_skin, 
			it_id, it_name, it_maker, it_origin, it_brand, 
			it_model, it_option_subject, it_supply_subject, it_type1, 
			it_type2, it_type3, it_type4, it_type5, it_basic, 
			it_explan, it_explan2, it_mobile_explan, it_cust_price, it_price, 
			it_point, it_point_type, it_supply_point, it_notax, it_sell_email, 
			it_use, it_nocoupon, it_soldout, it_stock_qty, it_stock_sms, 
			it_noti_qty, it_sc_type, it_sc_method, it_sc_price, it_sc_minimum, 
			it_sc_qty, it_buy_min_qty, it_buy_max_qty, it_head_html, it_tail_html, 
			it_mobile_head_html, it_mobile_tail_html, it_hit, it_time, it_update_time, 
			it_ip, it_order, it_tel_inq, it_info_gubun, it_info_value, 
			it_sum_qty, it_use_cnt, it_use_avg, it_shop_memo, ec_mall_pid, 
			it_img1, it_img2, it_img3, it_img4, it_img5, 
			it_img6, it_img7, it_img8, it_img9, it_img10, 
			it_1_subj, it_2_subj, it_3_subj, it_4_subj, it_5_subj, 
			it_6_subj, it_7_subj, it_8_subj, it_9_subj, it_10_subj, 
			it_1, it_2, it_3, it_4, it_5, 
			it_6, it_7, it_8, it_9, it_10 
	FROM g5_shop_item 
	WHERE it_id = $it_id";
$row = sql_fetch($sql);
?>
<style>
.detail-wrap { padding: 20px; }
.title { color: #ffffff; }
div[class^="col-"] { color: #ffffff; }
.large-img img,
.thumb-img img { min-width: 100%; }
.thumb-img img { margin-top: 25%; transform: translateY(-50%); }
.bold { font-weight: bold; }
.img-wrap {  }
.content-wrap { display: flex; flex-direction: column; justify-content: space-between; }
.content-wrap .content > div { background-color: rgba(0, 0, 0, .5); padding: 10px 0; position: relative; border-bottom: 1px dotted #efefef; }
.content-wrap .content > div:first-child { border-top: 2px solid #efefef; }
.content-wrap .content > div:last-child { border-bottom: 2px solid #efefef; }
.content-wrap .content > div > div { font-size: 1.125rem; }
.content-wrap .content > div > div.arrow-right:after { content: ''; position: absolute; border-left: 5px solid #ffffff; border-right: 0; border-top: 9px solid transparent; border-bottom: 9px solid transparent; right: 10px; }
.content-wrap .buttons > div { justify-content: flex-end; }
</style>
<div class="detail-wrap">
	<h1 class="title"><?php echo($row['it_name']); ?></h1>
	<div class="row mt-4">
		<div class="col-7 img-wrap">
			<div class="large-img">
				<img src="<?php echo G5_DATA_URL ?>/item/<?php echo $row['it_img1']; ?>" alt="" class="img-fluid" />
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
			<form id="flist_<?php echo $row['it_id']; ?>" name="flist_<?php echo $row['it_id']; ?>" onsubmit="return false;">
				<div class="content">
					<div class="row">
						<div class="col-5 bold arrow-right">
							제조사
						</div>
						<div class="col-7">
							<?php echo($row['it_maker']); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-5 bold arrow-right">
							원산지
						</div>
						<div class="col-7">
							<?php echo($row['it_origin']); ?>
						</div>
					</div>
					<?php if(!empty($row['it_brand'])) { ?>
					<div class="row">
						<div class="col-5 bold arrow-right">
							브랜드
						</div>
						<div class="col-7">
							<?php echo($row['it_brand']); ?>
						</div>
					</div>
					<?php } ?>
					<?php if(!empty($row['it_model'])) { ?>
					<div class="row">
						<div class="col-5 bold arrow-right">
							모델
						</div>
						<div class="col-7">
							<?php echo($row['it_model']); ?>
						</div>
					</div>
					<?php } ?>
					<?php if(!empty($row['it_cust_price'])) { ?>
					<div class="row">
						<div class="col-5 bold arrow-right">
							시중가격
						</div>
						<div class="col-7">
							<span class="line-through"><?php echo($row['it_cust_price']); ?></span>
						</div>
					</div>
					<?php } ?>
					<div class="row">
						<div class="col-5 bold arrow-right">
							판매가격
						</div>
						<div class="col-7">
							<?php echo($row['it_price']); ?>
						</div>
					</div>
					<?php if(!empty($row['it_option_subject'])) { ?>
					<div class="row">
						<!-- // BIGIN :: option -->
						<div class='option'>
							<div class='option-body'>
								<!-- /* BIGIN :: option */ -->
								<script src="<?php echo G5_SHOP_SKIN_URL; ?>/option.js"></script>
								<?php
								include_once(str_replace(G5_URL, G5_PATH, G5_SHOP_SKIN_URL).'/option.lib.php');
								// 상품 선택옵션
	    						$option_item = get_list_options($row['it_id'], $row['it_option_subject'], $row['it_id']);

							    // 상품품절체크
							    $is_soldout = is_soldout($row['it_id']);

							    // 주문가능체크
							    $is_orderable = true;
							    if(!$row['it_use'] || $row['it_tel_inq'] || $is_soldout) {
							        $is_orderable = false;
							    }
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

						        <!-- 총 구매액 -->
						        <div id="sit_tot_price"></div>
								<?php
									}
								?>
								<!-- /* END :: option */ -->
							</div>
						</div>
						<!-- // END :: option -->
					</div>
					<?php } ?>
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
							<button class="btn btn-success btn_add_cart" data-btn-type="cart"><i class="fa fa-shopping-cart"></i> 장바구니</button>
							<button class="btn btn-primary btn_add_buy" data-btn-type="get"><i class="fa fa-credit-card"></i> 바로구매</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
(function($) {
	/* BIGIN :: 하단 이미지 버튼의 첫번째 항목에 active */
	jQuery('.thumb-img > div[class^="col-"]').eq(0).find('a').addClass('active');
	/* END :: 하단 이미지 버튼의 첫번째 항목에 active */
	/* BIGIN :: 클릭한 버튼 항목에 add class active / 그 외 버튼은 remove class active */
	jQuery(document).on('click', '.thumb-img a', function() {
		var imgName = jQuery(this).find('img').attr('src');
		jQuery(this).closest('div[class^="col-"]').siblings().find('a').removeClass('active');
		jQuery(this).addClass('active');
		jQuery('.large-img img').attr('src', imgName);
		return false;
	});
	/* END :: 클릭한 버튼 항목에 add class active / 그 외 버튼은 remove class active */
	jQuery('.content-wrap .option').addClass('col-12 p-0');
	jQuery('.content-wrap .option .list_item_option table.sit_ov_tbl colgroup col').eq(0).attr('width', '41.666667%');
	jQuery('.content-wrap .option .list_item_option table.sit_ov_tbl colgroup col').eq(1).attr('width', '58.333333%');
})(jQuery);
</script>
