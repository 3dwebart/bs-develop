function ctQtyCalc(v, a) {
	var input = a.find('input[name^="ct_qty"]');
	var value = input.val();
	value = Number(value);
	if(v == 'minus') {
		if(value <= 1) {
			return false;
		} else {
			value--;
		}
	} else if(v == 'plus') {
		value++;
	} else {
		//
	}

	input.val(value);

	return totalPriceCalc(a);
}

function totalPriceCalc(area) {
	// 파라미터 : 갯수, 가격, 옵션가격, 해당 블록 영역, 옵션 생성시 배열 인덱스 번호
	// 배열에 추가/삭제 및 총합 계산
	/*
		갯수 : ea / 기본값 : 0
		가격 : price / 기본값 : 0
		옵션가격 : optPrice / 기본값 : 0
		영역 : area / 기본값 : ''
		배열 인덱스 : arrNo / 기본값 : 0
	*/
	var ea = area.find('input[name^="ct_qty"]').val();
	var price = area.find('input[name^="it_price"]').val();
	var optPrice = 0;
	var optLength = 0;
	var optValue = '';
	if(area.find('.option').length > 0) {
		optPrice = area.find('input[name^="io_price"]').val();
		optLength = area.find('.it_option').length - 1;
		optValue = area.find('.it_option').eq(optLength).val().split(',');
		optPrice = Number(optValue[1]);
	}
	ea = Number(ea);
	price = Number(price);
	optPrice = Number(optPrice);
	ea = typeof ea !== 'undefined' ? ea : 0;
	price = typeof price !== 'undefined' ? price : 0;
	optPrice = typeof optPrice !== 'undefined' ? optPrice : 0;
	area = typeof area !== 'undefined' ? area : '';
	//arrNo = typeof arrNo !== 'undefined' ? arrNo : 0;

	var calc = 0;

	var totCalc = 0;

	var it_price = 0;

	var io_price = 0;

	var ct_qty = 0;

	var totalVal = 0;

	calc = (price + optPrice) * ea;

	eachCalc(area);
}

function eachCalc(area) {
	area = area.closest('.list-payment');
	var totCalc = 0;

	area.find('.info').each(function() {
		it_price = jQuery(this).closest('.option').find('input[name^="it_price"]').val();
		io_price = jQuery(this).find('input[name^="io_price"]').val();
		ct_qty = jQuery(this).find('input[name^="ct_qty"]').val();
		it_price = Number(it_price);
		io_price = Number(io_price);
		ct_qty = Number(ct_qty);
		totCalc += (it_price + io_price) * ct_qty;
	});

	area.find('.list-tot-price .price').text(addComma(totCalc) + ' 원');
}

function addComma(num) {
  var regexp = /\B(?=(\d{3})+(?!\d))/g;
  return num.toString().replace(regexp, ',');
}

function onlyNumber(event) {
	//event = event || window.event;
	var keyID = (event.which) ? event.which : event.keyCode;
	if( ( keyID >=48 && keyID <= 57 ) || ( keyID >=96 && keyID <= 105 ) )
	{
		//alert(keyID);
	}
	else
	{
		return false;
	}
}