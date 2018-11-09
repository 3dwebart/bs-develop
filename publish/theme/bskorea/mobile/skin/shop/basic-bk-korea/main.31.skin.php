<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>
<style>
.row.row-8 {}
.row.row-8 *[class^="col"] {
	padding: 0 8px;
}
.row.row-4 {}
.row.row-4 *[class^="col"] {
	padding: 0 4px;
}
.sct_wrap .row { margin-top: 10px; }
.sct_txt_wr { padding: 10px 0; }
.sct_txt_wr .sct_txt {
    width: 100%;
    padding: 0 5px;
    text-align: left;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.sct_txt_wr .sct_txt a { font-size: .8rem; font-weight: bold; line-height: 1.5rem; }
.sct_txt_wr .sct_cost { padding: 0 5px; line-height: 1.5rem; }
</style>
<script src="<?php echo G5_JS_URL ?>/jquery.fancylist.js"></script>
<?php if($config['cf_kakao_js_apikey']) { ?>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/kakaolink.js"></script>
<script>
	// 사용할 앱의 Javascript 키를 설정해 주세요.
	Kakao.init("<?php echo $config['cf_kakao_js_apikey']; ?>");
</script>
<?php } ?>
<!-- 메인상품진열 30 시작 { -->
<?php
/*
$it_type = 'it_type'.$this->type;
$tmp_sql = "SELECT count(it_id) AS tmp_cnt FROM {$g5['g5_shop_item_table']} WHERE {$it_type} = 1";
$tmp_row = sql_fetch($tmp_sql);
$cnt_total = $tmp_row['tmp_cnt'];

echo '<h1>total = '.$cnt_total.'</h1>';
*/
$li_width = intval(100 / $this->list_mod);
$li_width_style = ' style="width:'.$li_width.'%;"';

switch ($this->list_mod) {
	case 1:
		$list_grid_css = 'col-12';
		$grid_row = true;
		break;
	case 2:
		$list_grid_css = 'col-6';
		$grid_row = true;
		break;
	case 3:
		$list_grid_css = 'col-4';
		$grid_row = true;
		break;
	case 4:
		$list_grid_css = 'col-3';
		$grid_row = true;
		break;
	case 6:
		$list_grid_css = 'col-2';
		$grid_row = true;
		break;
	case 12:
		$list_grid_css = 'col-1';
		$grid_row = true;
		break;
	default:
		$list_grid_css = 'col';
		$grid_row = false;
		break;
}
$html = '';
$html .= '<div class="row row-4 ml-0 mr-0">';

for ($i=0; $row=sql_fetch_array($result); $i++) {
	$html .= '<div class="'.$list_grid_css.'">';


	if ($this->href) {
		$html .= "<div class=\"sct_img\"><a href=\"{$this->href}{$row['it_id']}\">\n";
	}

	if ($this->view_it_img) {
		$html .= get_it_image_responsive($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
	}

	if ($this->href) {
		$html .= "</a></div>\n";
	}

	$html .= "<div class=\"sct_txt_wr\">\n";

	if ($this->view_it_id) {
		$html .= "<div class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
	}

	if ($this->href) {
		$html .= "<div class=\"sct_txt\"><a href=\"{$this->href}{$row['it_id']}\" class=\"sct_a\">\n";
	}

	if ($this->view_it_name) {
		$html .= stripslashes($row['it_name'])."\n";
	}

	if ($this->href) {
		$html .= "</a></div>\n";
	}

	if ($this->view_it_price) {
		$html .= "<div class=\"sct_cost\">\n";
		$html .= display_price(get_price($row), $row['it_tel_inq'])."\n";
		$html .= "</div>\n";
	}


	$html .= '</div>';
	$html .= '</div>';
}
$html .= '</div>';

echo $html;
/*
for ($i=0; $row=sql_fetch_array($result); $i++) {
	echo '<span style="display: block">list_mod : '.$this->list_mod.'</span>';
	if ($i == 0) {
		//
	}
	if ($i == 0) {
		if ($this->css) {
			echo "<ul class=\"{$this->css}\">\n";
		} else {
			echo "<ul class=\"sct sct_30\">\n";
		}
	}

	if($i % $this->list_mod == 0) {
		$li_clear = ' sct_clear';
	} else {
		$li_clear = '';
	}

	echo "<li class=\"sct_li{$li_clear}\">\n";
	echo "<div class=\"li_wr\">\n";

	if ($this->href) {
		echo "<div class=\"sct_img\"><a href=\"{$this->href}{$row['it_id']}\">\n";
	}

	if ($this->view_it_img) {
		echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
	}

	if ($this->href) {
		echo "</a></div>\n";
	}

	echo "<div class=\"sct_txt_wr\">\n";

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

	if ($this->view_it_price) {
		echo "<div class=\"sct_cost\">\n";
		echo display_price(get_price($row), $row['it_tel_inq'])."\n";
		echo "</div>\n";
	}

	if ($this->view_sns) {
		$sns_top = $this->img_height + 10;
		$sns_url  = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
		$sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
		echo "<div class=\"sct_sns\" style=\"top:{$sns_top}px\">";
		echo get_sns_share_link('facebook', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/facebook.png');
		echo get_sns_share_link('twitter', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/twitter.png');
		echo get_sns_share_link('googleplus', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/gplus.png');
		echo get_sns_share_link('kakaotalk', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/sns_kakao.png');
		echo "</div>\n";
	}
	echo "</div>\n";

	echo "</div>\n";

	echo "</li>\n";
}

if ($i > 0) echo "</ul>\n";
*/

if($i == 0) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<!-- } 상품진열 30 끝 -->
