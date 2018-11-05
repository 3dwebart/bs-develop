<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$str = '';
$exists = false;

$ca_main_id = substr($ca_id, 0, 2);

$ca_id_len = strlen($ca_id);

$len2 = $ca_id_len + 2;
$len4 = $ca_id_len + 4;

if($ca_main_id == $ca_id) {
	$main_chk = 1;
} else {
	$main_chk = 0;
}

$sql = " SELECT ca_id, ca_name FROM {$g5['g5_shop_category_table']} WHERE ca_id = substring('$ca_id', 1, 2) ";
$row = sql_fetch($sql);
$cate_title = $row['ca_name'];

$sql = " SELECT ca_id, ca_name FROM {$g5['g5_shop_category_table']} WHERE ca_id LIKE '$ca_main_id%' AND length(ca_id) = 4 AND ca_use = '1' ORDER BY ca_order, ca_id ";
//$sql = " SELECT ca_id, ca_name FROM {$g5['g5_shop_category_table']} WHERE ca_id LIKE '$ca_id%' AND length(ca_id) = $len2 AND ca_use = '1' ORDER BY ca_order, ca_id ";
$result = sql_query($sql);

while ($row=sql_fetch_array($result)) {

	$row2 = sql_fetch(" SELECT count(*) AS cnt FROM {$g5['g5_shop_item_table']} WHERE (ca_id LIKE '{$row['ca_id']}%' OR ca_id2 LIKE '{$row['ca_id']}%' OR ca_id3 LIKE '{$row['ca_id']}%') AND it_use = '1'  ");
	if($ca_id == $row['ca_id']) {
		$activeClass = ' class="active"';
	} else {
		$activeClass = '';
	}

	$str .= '<li'.$activeClass.'><a href="./list.php?ca_id='.$row['ca_id'].'">'.$row['ca_name'].' ('.$row2['cnt'].')</a></li>';
	$exists = true;
}

if ($exists) {

	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);
?>

<!-- 상품분류 1 시작 { -->
<aside id="sct_ct_1" class="sct_ct">
	<h2>현재 상품 분류와 관련된 분류</h2>
	<div class="cate-nav-wrap">
		<div class="container">
			<ul>
				<li class="cate-main">
					<a href="./list.php?ca_id=<?php echo $ca_main_id; ?>" data-link="<?php echo($main_chk); ?>">
						<?php echo $cate_title ?>
					</a>
				</li>
				<?php echo $str; ?>
			</ul>
		</div>
	</div>
</aside>
<!-- } 상품분류 1 끝 -->

<?php } ?>

<script>
(function($) {
	$(document).on('click', '#sct_ct_1 ul li a', function() {
		if($(this).data('link') == 1 || $(this).parent().hasClass('active') == true) {
			return false;
		} else {
			return true;
		}
	});
	var sct_location = $('#sct_location').html();
	$('#sct_location').remove();
	$('#sct_ct_1 .cate-nav-wrap > div').append('<div id="sct_location">' + sct_location + '</div>');
})(jQuery);
</script>