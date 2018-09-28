<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style2.css">', 0);

// 리스트 옵션처리 라이브러리
include_once(str_replace(G5_URL, G5_PATH, G5_SHOP_CSS_URL).'/option.lib.php');
?>

<script>
var g5_shop_url = "<?php echo G5_SHOP_URL; ?>";
var g5_shop_css_url = "<?php echo G5_SHOP_CSS_URL; ?>";
</script>
<script src="<?php echo G5_SHOP_CSS_URL; ?>/option.js"></script>

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
        if ($i%$this->list_mod == 0) $sct_last = ' sct_last'; // 줄 마지막
        else if ($i%$this->list_mod == 1) $sct_last = ' sct_clear'; // 줄 첫번째
        else $sct_last = '';
    } else { // 1줄 이미지 : 1개
        $sct_last = ' sct_clear';
    }

    if ($i == 1) {
        if ($this->css) {
            echo "<ul class=\"{$this->css}\">\n";
        } else {
            echo "<ul class=\"sct sct_10\">\n";
        }
    }

    echo "<li class=\"sct_li{$sct_last}\" style=\"width:{$this->img_width}px\">\n";

    if ($this->href) {
        echo "<div class=\"sct_img\"><a href=\"{$this->href}{$row['it_id']}\" class=\"sct_a\">\n";
    }

    if ($this->view_it_img) {
        echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
    }

    if ($this->href) {
        echo "</a></div>\n";
    }

    if ($this->view_it_icon) {
        echo "<div class=\"sct_icon\">".item_icon($row)."</div>\n";
    }

    if ($this->view_it_id) {
        echo "<div class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
    }

    if ($this->href) {
        echo "<div class=\"sct_txt\"><a href=\"{$this->href}{$row['it_id']}\" class=\"sct_a\">\n";
    }

    if ($this->view_it_name) {
        echo stripslashes($row['it_name'])."\n";
    }

    if ($this->href) {
        echo "</a></div>\n";
    }

    if ($this->view_it_basic && $row['it_basic']) {
        echo "<div class=\"sct_basic\">".stripslashes($row['it_basic'])."</div>\n";
    }

    if ($this->view_it_cust_price || $this->view_it_price) {

        echo "<div class=\"sct_cost\">\n";

        if ($this->view_it_cust_price && $row['it_cust_price']) {
            echo "<strike>".display_price($row['it_cust_price'])."</strike>\n";
        }

        if ($this->view_it_price) {
            echo display_price(get_price($row), $row['it_tel_inq'])."\n";
        }

        echo "</div>\n";

    }

    if($is_orderable) {
        $item_ct_qty = 1;
        if($row['it_buy_min_qty'] > 1)
            $item_ct_qty = $row['it_buy_min_qty'];
    ?>
    <div class="list_item_option">
        <form name="flist_<?php echo $i; ?>" onsubmit="return false;">
        <input type="hidden" name="it_id[]" value="<?php echo $row['it_id']; ?>">
        <input type="hidden" name="it_name[]" value="<?php echo stripslashes($row['it_name']); ?>">
        <input type="hidden" name="it_price[]" value="<?php echo get_price($row); ?>">
        <input type="hidden" name="it_stock[]" value="<?php echo get_it_stock_qty($row['it_id']); ?>">
        <input type="hidden" name="io_type[<?php echo $row['it_id']; ?>][]" value="0">
        <input type="hidden" name="io_id[<?php echo $row['it_id']; ?>][]" value="">
        <input type="hidden" name="io_value[<?php echo $row['it_id']; ?>][]" value="">
        <input type="hidden" name="io_price[<?php echo $row['it_id']; ?>][]" value="">
        <input type="hidden" name="ct_qty[<?php echo $row['it_id']; ?>][]" value="<?php echo $item_ct_qty; ?>">
        <table class="sit_ov_tbl">
        <colgroup>
            <col class="grid_2">
            <col>
        </colgroup>
        <tbody>
        <?php // 선택옵션
        echo $option_item;
        ?>
        <tr>
            <td colspan="2"><button type="button" class="btn_add_cart">장바구니</button></td>
        </tr>
        </tbody>
        </table>
        </form>
    </div>

    <?php
    }

    if ($this->view_sns) {
        $sns_top = $this->img_height + 10;
        $sns_url  = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
        $sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
        echo "<div class=\"sct_sns\" style=\"top:{$sns_top}px\">";
        echo get_sns_share_link('facebook', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/sns_fb_s.png');
        echo get_sns_share_link('twitter', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/sns_twt_s.png');
        echo get_sns_share_link('googleplus', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/sns_goo_s.png');
        echo "</div>\n";
    }

    echo "</li>\n";
}

if ($i > 1) echo "</ul>\n";

if($i == 1) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<!-- } 상품진열 10 끝 -->