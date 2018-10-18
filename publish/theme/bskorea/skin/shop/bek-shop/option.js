$(function() {
	var itemGroup = $('form[name^="flist_"]');
	itemGroup.each(function() {
		$(this).find("select.it_option").on("change", function() {
			var $frm = $(this).closest("form");
			var $sel = $frm.find("select.it_option");
			var sel_count = $sel.length; // size( ) 3.0 이후부터 사라짐
			var idx = $sel.index($(this));
			var val = $(this).val();
			var it_id = $frm.find("input[name^='it_id']").val();
			console.log('idx :: ' + idx);

			// 선택값이 없을 경우 하위 옵션은 disabled
			if(val == "") {
				$frm.find("select.it_option:gt("+idx+")").val("").attr("disabled", true);
				return;
			}

			// 하위선택옵션로드
			if(sel_count > 1 && (idx + 1) < sel_count) {
				var opt_id = "";

				// 상위 옵션의 값을 읽어 옵션id 만듬
				if(idx > 0) {
					$frm.find("select.it_option:lt("+idx+")").each(function() {
						if(!opt_id)
							opt_id = $(this).val();
						else
							opt_id += chr(30)+$(this).val();
					});

					opt_id += chr(30)+val;
				} else if(idx == 0) {
					opt_id = val;
				}

				$.post(
					"./itemoption.php",
					{ it_id: it_id, opt_id: opt_id, idx: idx, sel_count: sel_count },
					function(data) {
						$sel.eq(idx+1).empty().html(data).attr("disabled", false);

						// select의 옵션이 변경됐을 경우 하위 옵션 disabled
						if(idx+1 < sel_count) {
							var idx2 = idx + 1;
							$frm.find("select.it_option:gt("+idx2+")").val("").attr("disabled", true);
						}
					}
				);
			} else if((idx + 1) == sel_count) { // 선택옵션처리
				if(val == "")
					return;

				var info = val.split(",");
				// 재고체크
				if(parseInt(info[2]) < 1) {
					alert("선택하신 선택옵션상품은 재고가 부족하여 구매할 수 없습니다.");
					return false;
				}
			}
		});

		// 장바구니 담기버튼
		$(this).find("button.btn_add_cart").click(function() {
			var $frm = $(this.form);

			$(this).closest('form')
			.find('.list_item_option')
			.find('input[id^="#sw_direct_"]').val(0);

			// 메세지 레이어 닫기
			cart_msg_layer();

			set_option_value($frm, $(this));
		});

		// 구매하기 버튼
		
		$(this).find("button.btn_add_buy").click(function() {
			var $frm = $(this.form);
			var $action = '/shop/orderform.php?sw_direct=1';
			$(this).closest('form')
			.find('.list_item_option')
			.find('input[id^="#sw_direct_"]').val(1);

			// var $frmName = $frm.attr('name');

			// $frm.attr('method', 'post');
			// $frm.attr('action', $action);
			// console.log($frm.attr('method'));
			// console.log($frm.attr('action'));
			// console.log($frmName);
			// //return false;
			// itemBuySubmit($frmName);

			// 메세지 레이어 닫기
			//cart_msg_layer();

			set_option_value($frm, $(this));
		});
		

		// 장바구니 레이어 닫기
		$(this).find("#cart_msg_close, #cart_msg_no").on("click", function() {
			cart_msg_layer();
		});

		// 장바구니 이동
		$(this).find("#cart_msg_yes").on("click", function() {
			document.location.href = g5_shop_url+"/cart.php";
		});
	});
});

function itemBuySubmit(v) {
	//$frm = 
	//var f = document.forms[v];
	var f = document.getElementById(v);
	console.log(f);
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
	/*
	jQuery.ajax({
		url: g5_shop_css_url+"/item.cartupdate.php",
		type: "post",
		data: {
			$frm.serialize(),
			btnType: btnType
		},
		dataType: "json",
		cache: false,
		timeout: 30000,
		success: function(json) {
			//
		},
		error: function(xhr, textStatus, errorThrown) {
			jQuery("div").html("<div>" + textStatus + " (HTTP-" + xhr.status + " / " + errorThrown + ")</div>" );
		}
	});
	*/
	$.post(
		g5_shop_css_url+"/item.cartupdate.php",
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
			} else if(btnType == 'buy') {
				bootbox.confirm({
					message: "<h6>바로주문</h6><h4>지금 확인하시겠습니까?</h4>",
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
							$(location).attr(href, 'https://www.google.com');
						}
					}
				});
			}
		}
	);
}

function cart_msg_layer()
{
	$("#cart_msg_layer").fadeOut(400, function() {
		$(this).remove();
	});
}

// php chr() 대응
function chr(code)
{
	return String.fromCharCode(code);
}