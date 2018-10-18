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
.content-wrap form { display: flex; flex-direction: column; justify-content: space-between; height: 100%; }
.content-wrap .content > div { background-color: rgba(0, 0, 0, .5); padding: 10px 0; position: relative; border-bottom: 1px dotted #efefef; }
.content-wrap .content > div:first-child { border-top: 2px solid #efefef; }
.content-wrap .content > div:last-child { border-bottom: 2px solid #efefef; }
.content-wrap .content > div > div { font-size: 1.125rem; }
.content-wrap .content > div > div.arrow-right:after { content: ''; position: absolute; border-left: 5px solid #ffffff; border-right: 0; border-top: 9px solid transparent; border-bottom: 9px solid transparent; right: 10px; }
/*.content-wrap .buttons > div { justify-content: flex-end; }*/
</style>
<script src="<?php echo G5_JS_URL ?>/bootbox.js"></script>
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
				<?php if(!empty($row['it_img2'])) { ?>
				<div class="col-4">
					<div>
						<a href="#">
							<img src="<?php echo G5_DATA_URL ?>/item/<?php echo $row['it_img2']; ?>" alt="" class="img-fluid" />
						</a>
					</div>
				</div>
				<?php } ?>
				<?php if(!empty($row['it_img3'])) { ?>
				<div class="col-4">
					<div>
						<a href="">
							<img src="<?php echo G5_DATA_URL ?>/item/<?php echo $row['it_img3']; ?>" alt="" class="img-fluid" />
						</a>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="col-5 content-wrap">
			<form id="flist_<?php echo $row['it_id']; ?>" name="flist_<?php echo $row['it_id']; ?>" class="ajax-detail-form">
				<input type="hidden" name="it_id[]" value="<?php echo $row['it_id']; ?>">
				<input type="hidden" name="it_name[]" value="<?php echo stripslashes($row['it_name']); ?>">
				<input type="hidden" name="it_price[]" value="<?php echo get_price($row); ?>">
				<input type="hidden" name="it_stock[]" value="<?php echo get_it_stock_qty($row['it_id']); ?>">
				<input type="hidden" name="sw_direct_item[]" value="" id="sw_direct_item" />
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
								<!-- <script src="<?php echo G5_SHOP_SKIN_URL; ?>/option.js"></script> -->
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
					<?php
						}
					?>
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
							<button type="button" class="btn btn-success btn_add_cart2" data-btn-type="cart">
								<i class="fa fa-shopping-cart"></i> 장바구니
							</button>
							<button type='submit' class='btn btn-primary ml-2 btn_add_buy2' data-btn-type='get'>
								<i class="fa fa-credit-card"></i> 바로구매
							</button>
							<!-- onclick="itemBuySubmit('flist_<?php echo $row["it_id"]; ?>')"-->
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
$sql2 = "SELECT count(io_id) AS cnt
		FROM g5_shop_item_option 
		WHERE it_id = '$it_id'"; // 1537433559
$row2 = sql_fetch($sql2);
$cnt = $row2['cnt'];
?>
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
	/* BIGIN :: 건체 가격 및 갯수 */
	/*  */
	// 장바구니 담기버튼
	/*

	jQuery('.ajax-detail-form .buttons button').on('click', function() {
		var btnType = jQuery(this).data('btn-type');
		var cartUrl = '<?php echo(G5_SHOP_SKIN_URL); ?>/item.cartupdate.php';
		if(btnType == 'cart') {
			jQuery(this).closest('form').find('input[id^="sw_direct_"]').val(0);
			jQuery(this).closest('form').attr('action', cartUrl);
		} else if(btnType == 'get') {
			jQuery(this).closest('form').find('input[id^="sw_direct_"]').val(1);
			jQuery(this).closest('form').attr('action', '/shop/orderform.php');
		}
		jQuery(this).closest('form').attr('method', 'post');
		jQuery(this).closest('form').submit();
	});
	*/
	// 장바구니 담기버튼
	jQuery('button.btn_add_cart2').on('click', function() {
		var $frm = $(this.form);

		jQuery(this).closest('form')
		.find('.list_item_option')
		.find('input[id^="#sw_direct_"]').val(0);
		jQuery(this).closest('form')
		.find('input[id^="sw_direct_item"]').val(0);

		$frm.attr('method', 'post');
		$frm.attr('action', g5_shop_css_url+"/item.cartupdate.preview.php");
		$frm.submit();

		// 메세지 레이어 닫기
		//cart_msg_layer();
		//set_option_value($frm, $(this));

		return false;
	});
	$("button.btn_add_buy2").click(function() {
		var $frm = $(this.form);
		var $action = '/shop/orderform.php?sw_direct=1';
		$(this).closest('form')
		.find('.list_item_option')
		.find('input[id^="#sw_direct_"]').val(1);
		jQuery(this).closest('form')
		.find('input[id^="sw_direct_item"]').val(1);

		$frm.attr('method', 'post');
		$frm.attr('action', g5_shop_css_url+"/item.cartupdate.preview.php");
		$frm.submit();

		//set_option_value($frm, $(this));
	});
	function itemBuySubmit2(v) {
		//$frm = 
		//var f = document.forms[v];
		var f = document.getElementById(v);
		//f.url.value = '/shop/orderform.php?sw_direct=1';
		f.action = '/shop/orderform.php';
		f.method = 'post';
		f.submit();
		//document.forms[v].submit();
		//document.getElementById(v).submit();
		return true;
	}

	function set_option_value($frm, $btn)
	{
		var $sel = $frm.find("select.it_option");
		var it_name = $frm.find("input[name^=it_name]").val();
		var it_price = parseInt($frm.find("input[name^=it_price]").val());
		var id = "";
		var value, info, sel_opt, item, price, stock, run_error = false;
		var option = sep = "";
		var btnType = $btn.data('btn-type');
		// if(btnType == 'cart') {
		// 	$('#sw_direct').val(0);
		// } else if(btnType == 'buy') {
		// 	$('#sw_direct').val(1);
		// }

		if($sel.length > 0) { // size( ) 3.0 이후부터 사라짐
			info = $frm.find("select.it_option:last").val().split(",");

			$sel.each(function(index) {
				value = $(this).val();
				item = $(this).closest("tr").find("th label").text();

				if(!value) {
					run_error = true;
					return false;
				}

				// 옵션선택정보
				sel_opt = value.split(",")[0];

				if(id == "") {
					id = sel_opt;
				} else {
					id += chr(30)+sel_opt;
					sep = " / ";
				}

				option += sep + item + ":" + sel_opt;
			});

			if(run_error) {
				alert(it_name+"의 "+item+"을(를) 선택해 주십시오.");
				return false;
			}

			price = info[1];
			stock = info[2];
		} else {
			price = 0;
			stock = $frm.find("input[name^=it_stock]").val();
			option = it_name;
		}

		// 금액 음수 체크
		if(it_price + parseInt(price) < 0) {
			alert("구매금액이 음수인 상품은 구매할 수 없습니다.");
			return false;
		}

		// 옵션 선택정보 적용
		$frm.find("input[name^=io_id]").val(id);
		$frm.find("input[name^=io_value]").val(option);
		$frm.find("input[name^=io_price]").val(price);
		// 장바구니 담기

		//*
		$.post(
			g5_shop_css_url+"/item.cartupdate.preview.php",
			$frm.serialize(),
			function(error) {
				if(error != "OK") {
					alert(error.replace(/\\n/g, "\n"));
					return false;
				}

				if(btnType == 'cart') {
					bootbox.confirm({
						message: "<h6>상품이 장바구니에 담겼습니다.</h6><h4>지금 확인하시겠습니까?</h4>",
						buttons: {
							confirm: {
								label: 'Yes',
								className: 'btn-success'
							},
							cancel: {
								label: 'No',
								className: 'btn-danger'
							}
						},
						callback: function (result) {
							console.log('This was logged in the callback: ' + result);
							if(result == true) {
								$(location).attr('href', g5_shop_url + "/cart.php");
							}
						}
					});
				} else if(btnType == 'get') {
					//$(location).attr('href', g5_shop_url + "/orderform.php");
					alert('get button click');
					bootbox.confirm({
						message: "<h6>바로주문</h6><h4>바로구매를 진행 하시겠습니까?</h4>",
						buttons: {
							confirm: {
								label: 'Yes',
								className: 'btn-success'
							},
							cancel: {
								label: 'No',
								className: 'btn-danger'
							}
						},
						callback: function (result) {
							console.log('This was logged in the callback: ' + result);
							if(result == true) {
								//$(location).attr('href', g5_shop_url + "/cart.php");
							}
						}
					});
				}
			}
		);
		//*/
	}
	var optLength = 0;
	var onChgOpt = 0;
	var it_name = '<?php echo($row["it_name"]); ?>';
	var it_id = Number('<?php echo($row["it_id"]); ?>');
	var item_ct_qty = Number('<?php echo($item_ct_qty); ?>');
	var it_price = Number('<?php echo($row["it_price"]); ?>');
	var cnt = Number('<?php echo $cnt; ?>');

	//it_name = jQuery(this).find('.option-header h3').text();
	//it_id = jQuery(this).find('input[id^="it_id_"]').val();
	//it_price = Number(jQuery(this).find('input[id^="it_price_"]').val());
	//item_ct_qty = Number(jQuery(this).find('input[name^="tmp_ct_qty"]').val());
	if(item_ct_qty == 0) {
		item_ct_qty = 1;
	}

	optLength = cnt;
	if(optLength == 0) {
		priceWrap = '';
		priceWrap += '<div class="info-wrap">';
		priceWrap += '<div class="info row">';
		priceWrap += '<div class="col-7">';
		priceWrap += it_name;
		priceWrap += '</div>';
		priceWrap += '<div class="col-5">';
		priceWrap += '<div class="Increase-Decrease">';
		priceWrap += '<div class="input-group">';
		priceWrap += '<span class="input-group-btn">';
		priceWrap += '<button type="button" class="btn btn-danger minus">';
		priceWrap += '<i class="fa fa-minus"></i>';
		priceWrap += '</button>';
		priceWrap += '</span>';
		priceWrap += '<input type="text" name="ct_qty[' + it_id + '][]" value="' + item_ct_qty + '" class="form-control ct_qty" id="ct_qty_' + it_id + '" />';
		//priceWrap += '<input type="text" class="form-control" />';
		priceWrap += '<span class="input-group-btn">';
		priceWrap += '<button type="button" class="btn btn-info plus">';
		priceWrap += '<i class="fa fa-plus"></i>';
		priceWrap += '</button>';
		priceWrap += '</span>';
		priceWrap += '</div>'; // END :: input-group
		priceWrap += '</div>'; // END :: Increase-Decrease
		priceWrap += '</div>'; // END :: col-*
		priceWrap += '</div>'; // END :: info/row
		priceWrap +=  '<div class="list-ea-price text-left row">';
		priceWrap +=  '<div class="col-6">';
		priceWrap +=  '<span>단가 : </span>';
		priceWrap +=  '</div>';
		priceWrap +=  '<div class="col-6 text-right">';
		priceWrap +=  '<span class="ea-price">' + addComma(it_price) + '원</span>';
		priceWrap +=  '</div>';
		priceWrap +=  '</div>';
		priceWrap +=  '<div class="list-tot-price text-left row">';
		priceWrap +=  '<div class="col-6">';
		priceWrap +=  '<span>TOTAL : </span>';
		priceWrap +=  '</div>';
		priceWrap +=  '<div class="col-6 text-right">';
		priceWrap +=  '<span class="price">10,000</span>';
		priceWrap +=  '</div>';
		priceWrap +=  '</div>';
		priceWrap +=  '</div>';
		jQuery('.content-wrap .content').append(priceWrap);
	} else { // option 이 있을  때
		//optionLength = jQuery(this).find('.it_option').length;
		optionLength = jQuery('.detail-wrap select.it_option').length;
		jQuery('.option').addClass('list-on');
		jQuery('.it_option').eq(optionLength - 1).on('change', function() {
			j = 0;
			it_id = jQuery(this).closest('.option').find('input[name^="it_id"]').val();
			io_type = jQuery(this).closest('.option').find('input[name^="io_type"]').val();
			io_id = '';
			io_price = jQuery(this).closest('.option').find('input[name^="io_price"]').val();
			io_stock = 0;
			priceWrap = '';
			if(onChgOpt == 0) {
				priceWrap += '<div class="info-wrap">';
			}
			priceWrap += '<div class="row info">';
			priceWrap += '<div class="col-7 opt-cfgration">';
			optionName = '';
			optionLength = jQuery(this).closest('.option-body').find('.it_option').length;
			jQuery(this).closest('.option-body').find('.it_option').each(function() {
				OptionLabelName = jQuery(this).closest('tr').find('label').text();
				io_val = jQuery(this).val().split(',');
				if(j != 0) {
					optionName += ' / ';
					io_id += chr(30);
				}
				io_id += io_val[0];
				optionName += OptionLabelName + ': ';
				if((j + 1) == optionLength) { // Last option selection
					tmpVal = jQuery(this).val().split(',');
					// 0 : option name / 1 : option price / 2 : everything ea
					optionName += tmpVal[0];
					optionPrice = tmpVal[1];
					io_price = tmpVal[1];
					io_stock = tmpVal[2];
				} else {
					optionName += jQuery(this).val();
				}
				j++;
			});
			//alert(optionName);
			//priceWrap += it_name;
			priceWrap += optionName;
			priceWrap += '</div>';

			priceWrap += '<div class="col-5">';
			priceWrap += '<div class="Increase-Decrease">';
			priceWrap += '<div class="input-group">';
			priceWrap += '<span class="input-group-btn">';
			priceWrap += '<button type="button" class="btn btn-danger minus">';
			priceWrap += '<i class="fa fa-minus"></i>';
			priceWrap += '</button>';
			priceWrap += '</span>';
			priceWrap += '<input type="hidden" name="io_type[' + it_id + '][]" value="' + io_type + '">';
			priceWrap += '<input type="hidden" name="io_id[' + it_id + '][]" value="' + io_id + '">';
			priceWrap += '<input type="hidden" name="io_value[' + it_id + '][]" value="' + optionName + '">';
			priceWrap += '<input type="hidden" name="io_price[' + it_id + '][]" class="io_price" value="' + io_price + '">';
			priceWrap += '<input type="hidden" class="io_stock" value="' + io_stock + '">';
			priceWrap += '<input type="hidden" name="listCartOpt[' + it_id + '][]" value="1">';
			/**/
			priceWrap += '<input type="hidden" name="list_io_type[' + it_id + '][]" value="' + io_type + '">';
			priceWrap += '<input type="hidden" name="list_io_id[' + it_id + '][]" value="' + io_id + '">';
			priceWrap += '<input type="hidden" name="list_io_value[' + it_id + '][]" value="' + optionName + '">';
			priceWrap += '<input type="hidden" name="list_io_price[' + it_id + '][]" value="' + io_price + '">';
			priceWrap += '<input type="hidden" class="list_io_stock" value="' + io_stock + '">';
			priceWrap += '<input type="hidden" name="listCartOpt[' + it_id + '][]" value="1">';
			/**/
			priceWrap += '<input type="text" name="ct_qty[' + it_id + '][]" value="' + item_ct_qty + '" class="form-control ct_qty" id="ct_qty_' + it_id + '_' + onChgOpt + '" />';
			priceWrap += '<span class="input-group-btn">';
			priceWrap += '<button type="button" class="btn btn-info plus">';
			priceWrap += '<i class="fa fa-plus"></i>';
			priceWrap += '</button>';
			priceWrap += '<button class="btn btn-dark info-close"><i class="fa fa-close"></i></button>';
			priceWrap += '</span>';
			priceWrap += '</div>'; // END :: input-group
			priceWrap += '</div>'; // END :: Increase-Decrease
			priceWrap += '</div>'; // END :: col-*
			priceWrap += '</div>'; // END :: info/row
			if (onChgOpt == 0) {
				priceWrap += '</div>'; // END :: info-wrap
				priceWrap +=  '<div class="list-tot-price text-left row">';
				priceWrap +=  '<div class="col-6">';
				priceWrap +=  '<span>TOTAL : </span>';
				priceWrap +=  '</div>';
				priceWrap +=  '<div class="col-6 text-right">';
				priceWrap +=  '<span class="price">10,000</span>';
				priceWrap +=  '</div>';
				priceWrap +=  '</div>';
				jQuery(this).closest('.option-body').append(priceWrap);
			} else {
				jQuery(this).closest('.option-body').find('.info-wrap').append(priceWrap);
			}

			var tmpEa = 0;
			var tmpPrice = 0;
			var tmpOptPrice = 0;
			var tmpArea = '';
			tmpEa = $(this).closest('.option-body').find('input[name^=ct_qty]').val();
			tmpPrice = $(this).closest('.option-body').find('input[id^="it_price_"]').val();
			tmpOptPrice = optionPrice;
			tmpArea = $(this).closest('.list-payment');
			tmpEa = Number(tmpEa);
			tmpPrice = Number(tmpPrice);
			tmpOptPrice = Number(tmpOptPrice);
			arrNo = onChgOpt;
			totalPriceCalc(tmpArea, arrNo);

			onChgOpt++;
		});
		jQuery(document).on('click', '.info-close', function() {
			jQuery(this).closest('.info').remove();
		});
	}
	/* END :: 건체 가격 및 갯수 */
})(jQuery);
</script>
