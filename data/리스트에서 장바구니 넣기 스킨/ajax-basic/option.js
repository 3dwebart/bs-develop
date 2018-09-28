$(function() {
    $("select.it_option").live("change", function() {
        var $frm = $(this).closest("form");
        var $sel = $frm.find("select.it_option");
        var sel_count = $sel.size();
        var idx = $sel.index($(this));
        var val = $(this).val();
        var it_id = $frm.find("input[name='it_id[]']").val();

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
    $("button.btn_add_cart").click(function() {
        var $frm = $(this.form);

        // 메세지 레이어 닫기
        cart_msg_layer();

        set_option_value($frm, $(this));
    });

    // 장바구니 레이어 닫기
    $("#cart_msg_close, #cart_msg_no").live("click", function() {
        cart_msg_layer();
    });

    // 장바구니 이동
    $("#cart_msg_yes").live("click", function() {
        document.location.href = g5_shop_url+"/cart.php";
    });
});

function set_option_value($frm, $btn)
{
    var $sel = $frm.find("select.it_option");
    var it_name = $frm.find("input[name^=it_name]").val();
    var it_price = parseInt($frm.find("input[name^=it_price]").val());
    var id = "";
    var value, info, sel_opt, item, price, stock, run_error = false;
    var option = sep = "";

    if($sel.size() > 0) {
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
    $.post(
        g5_shop_css_url+"/item.cartupdate.php",
        $frm.serialize(),
        function(error) {
            if(error != "OK") {
                alert(error.replace(/\\n/g, "\n"));
                return false;
            }

            var cart_msg_layer = "";
            cart_msg_layer += "<div id=\"cart_msg_layer\">";
            cart_msg_layer += "<h3>장바구니 보기</h3>";
            cart_msg_layer += "<button type=\"button\" id=\"cart_msg_close\"><span></span>닫기</button>";
            cart_msg_layer += "<p>상품이 장바구니에 담겼습니다.<br><strong>지금 확인하시겠습니까?</strong></p>";
            cart_msg_layer += "<div>";
            cart_msg_layer += "<button type=\"button\" id=\"cart_msg_yes\"><img src=\""+g5_shop_css_url+"/img/pop_msg_yes.gif\" alt=\"예\"></button>";
            cart_msg_layer += "<button type=\"button\" id=\"cart_msg_no\"><img src=\""+g5_shop_css_url+"/img/pop_msg_no.gif\" alt=\"아니오\"></button>";
            cart_msg_layer += "</div>";
            cart_msg_layer += "</div>";

            var pos = $btn.position();
            var top = pos.top + $btn.height() + 10;

            $frm.closest("div").append(cart_msg_layer);
            $("#cart_msg_layer").css("top", top+"px");
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