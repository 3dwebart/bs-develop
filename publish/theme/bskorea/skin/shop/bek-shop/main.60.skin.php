<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
/* error view
error_reporting(E_ALL);
ini_set("display_errors", 1);
*/
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);

// 리스트 옵션처리 라이브러리
include_once(str_replace(G5_URL, G5_PATH, G5_SHOP_SKIN_URL).'/option.lib.php');
?>
<script>
var g5_shop_url = "<?php echo G5_SHOP_URL; ?>";
var g5_shop_css_url = "<?php echo G5_SHOP_SKIN_URL; ?>";
</script>
<script src="<?php echo G5_SHOP_SKIN_URL; ?>/option.js"></script>

<!-- 상품진열 10 시작 { -->
<?php
for ($i=1; $row=sql_fetch_array($result); $i++) {
    // 상품 선택옵션
    $option_item = get_list_options($row['it_id'], $row['it_option_subject'], $i);

    // 상품품절체크
    $is_soldout = is_soldout($row['it_id']);

    // 주문가능체크
    $is_orderable = true;
    if(!$row['it_use'] || $row['it_tel_inq'] || $is_soldout)
        $is_orderable = false;

    if ($this->list_mod >= 2) { // 1줄 이미지 : 2개 이상
        if ($i%$this->list_mod == 0) $sct_last = 'sct_last'; // 줄 마지막
        else if ($i%$this->list_mod == 1) $sct_last = 'sct_clear'; // 줄 첫번째
        else $sct_last = '';
    } else { // 1줄 이미지 : 1개
        $sct_last = 'sct_clear';
    }

    if ($i == 1) {
        if ($this->css) {
            echo '<div class="row">'.PHP_EOL;
        } else {
            echo '<div class="row">'.PHP_EOL;
        }
    }

    echo '<div class="col-4">'.PHP_EOL; // BIGIN :: orogon : li

    echo '<form id="flist_'.$i.'" name="flist_'.$i.'" onsubmit="return false;">'.PHP_EOL; // BIGIN :: form

    echo '<div class="item-wrap">'.PHP_EOL; // BIGIN :: item-wrap

    if ($this->href) { // BIGIN :: image area
        echo "<div class='image'>";
    }

    if ($this->view_it_img) {
        echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
    }

    if ($this->href) {
        echo "</div>".PHP_EOL;
    } // END :: image area

    echo "<div class='mask'>".PHP_EOL; // BIGIN :: mask

    if ($this->view_it_id) { // 상품 아이디
        echo "<div class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
    }

    if ($this->href) { // BIGIN :: 상품이름 & 링크
        echo "<div class=\"sct_txt\"><a href=\"{$this->href}{$row['it_id']}\">\n";
    }

    if ($this->view_it_name) { // - 상품이름
        echo "<h5 class='product-title'>".stripslashes($row['it_name'])."</h5>".PHP_EOL;
    }

    if ($this->href) { // END :: 상품이름 & 링크
        echo "</a></div>\n";
    }

    if ($this->view_it_basic && $row['it_basic']) { // 상품 간략 설명
        echo "<div class=\"sct_basic\">".stripslashes($row['it_basic'])."</div>\n";
    }

    if ($this->view_it_cust_price || $this->view_it_price) {

        echo "<div class=\"sct_cost\">\n";

        if ($this->view_it_cust_price && $row['it_cust_price']) {
            echo "<span class=\"line-through sct_discount\">".display_price($row['it_cust_price'])."</span>\n";
        }

        if ($this->view_it_price) {
            echo "<span class='current-price'>".display_price(get_price($row), $row['it_tel_inq'])."</span>\n";
        }

        echo "</div>\n";

    }

    if ($this->view_it_icon) {
        echo "<div class=\"sct_icon\">".item_icon($row)."</div>\n";
    }

    if ($this->view_sns) {
        $sns_top = $this->img_height + 10;
        $sns_url  = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
        $sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
        echo "<div class=\"sct_sns\">";
        echo get_sns_share_link('facebook', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/facebook.png');
        echo get_sns_share_link('twitter', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/twitter.png');
        echo get_sns_share_link('googleplus', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/gplus.png');
        echo "</div>".PHP_EOL;
    }

    echo "<div class='cart-icons'>".PHP_EOL;

    echo "<a href='#' class='get-cart-payment'>".PHP_EOL;
    echo "<i class='fa fa-shopping-cart'></i>".PHP_EOL;
    echo "</a>".PHP_EOL;

    echo "<a href='".G5_SHOP_SKIN_URL."/ajax.details.php' class='simplicity-detail' data-id='".$row['it_id']."' ata-effect='mfp-zoom-in'>".PHP_EOL;
    echo "<i class='fa fa-eye'></i>".PHP_EOL;
    echo "</a>".PHP_EOL;

    echo "<a href='{$this->href}{$row['it_id']}'>".PHP_EOL;
    echo "<i class='fa fa-search'></i>".PHP_EOL;
    echo "</a>".PHP_EOL;

    echo "</div>".PHP_EOL; // END :: cart, payment, preview

    echo "</div>".PHP_EOL; // END :: mask

    echo "<div class='list-payment'>".PHP_EOL; // BIGIN :: list in basket and payment
    echo "<div class='form-group'>".PHP_EOL; // BIGIN :: form-group
    echo "<div class='option'>".PHP_EOL; // BIGIN :: option
    echo "<div class='option-header'>".PHP_EOL;
    echo "<h3>".$row['it_name']."</h3>".PHP_EOL;
    echo "<a href='#' class='list-payment-close'><i class='fa fa-close'></i></a>".PHP_EOL;
    echo "</div>".PHP_EOL;
    echo "<div class='option-body'>".PHP_EOL;

    /* BIGIN :: option */
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
                <!--
                <tr>
                    <td colspan="2"><button type="button" class="btn_add_cart">장바구니</button></td>
                </tr>
                -->
            </tbody>
        </table>
    </div>
<?php
    }
    /* END :: option */
    echo "</div>".PHP_EOL;
    echo "</div>".PHP_EOL; // END :: option
    echo "<div class='input-group pl-3 pr-3'>".PHP_EOL; // BIGIN :: buttons
    echo "<div class='btn-group'>".PHP_EOL;
    echo "<button type='button' class='btn btn-success btn_add_cart' data-btn-type='cart'><i class='fa fa-shopping-cart'></i> 장바구니</button>".PHP_EOL;
    echo "<button type='submit' class='btn btn-primary ml-2 btn_add_buy' data-btn-type='get' onclick=\"itemBuySubmit('flist_".$i."')\">".PHP_EOL;
    echo "<i class='fa fa-money'></i> 바로구매".PHP_EOL;
    echo "</button>".PHP_EOL;
    echo "</div>".PHP_EOL;
    echo "</div>".PHP_EOL; // END :: buttons
    echo "</div>".PHP_EOL; // END :: form-group
    echo "</div>".PHP_EOL; // END :: list in basket and payment

    echo "</div>".PHP_EOL; // END :: item-wrap

    echo "</form>".PHP_EOL; // END :: form
    
    echo "</div>".PHP_EOL; // END :: origin : li
}

if ($i > 1) echo "</div>".PHP_EOL; // origin : ul

if($i == 1) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>".PHP_EOL;
?>
<!-- } 상품진열 10 끝 -->
<script>
(function($) {
    jQuery('.simplicity-detail').each(function() {
        jQuery(this).magnificPopup({
            type: 'ajax',
            showCloseBtn: true,
            alignTop: true,
            overflowY: 'scroll',
            midClick: true,
            closeOnBgClick: false,
            closeMarkup: '<button title="%title%" class="mfp-close" style="position: absolute; top: 20px; right: 20px"><img src="<?php echo G5_IMG_URL ?>/magific-close-btn.png" alt="magific poup close button" /></button>',
            ajax: {
                settings: {
                    url: '<?php echo(G5_SHOP_SKIN_URL); ?>/ajax.details.php',
                    type: 'POST',
                    data: {
                        id: jQuery(this).data('id') // id : it_id
                    }
                }
            }
        });
    });
    jQuery(document).on('click', '.get-cart-payment', function() {
        jQuery(this).parent().parent().parent().find('.list-payment').addClass('on');
        return false;
    });
    jQuery(document).on('mouseleave', '.item-wrap', function() {
        jQuery(this).find('.list-payment').removeClass('on');
        jQuery(this).closest('form')[0].reset();
    });
    jQuery(document).on('click', '.list-payment-close', function() {
        jQuery(this).parent().parent().parent().parent().removeClass('on');
        jQuery(this).closest('form')[0].reset();
        return false;
    });
    jQuery(document).on('click touch', '.mfp-close', function(e) {
        e.preventDefault();
        $.magnificPopup.close();
    });
})(jQuery);
</script>