<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/custom-style.css">', 0);
$countItem = $_POST['countItem'];
?>
<style>
.carousel-control-prev,
.carousel-control-next {
	font-size: 3rem;
}
.close-info { position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); display: inline-block; padding: 20px 30px; background-color: rgba(255,255,255,.6); font-size: 1.5rem; font-weight: bold; transition: all .5s ease; opacity: 1; text-shadow: 2px 2px 2px rgba(255,255,255,.5); }
.close-info.hide { transition: all .5s ease; opacity: 0; }
</style>
<div id="sit_pvi_nw" class="new_win">
	<h1 id="win_title">[<?php echo $row['it_name']; ?>] 이미지 새창 보기</h1>

	<div id="sit_pvi_nwbig">
		<h1>countItem ::: <?php echo $countItem; ?></h1>
		<?php
		$slideImages = '';
		if($countItem > 1) {
			$slideImages .= '<div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">';

			$thumbnails = array();
			$largeImage = array();
			/* BIGIN :: Slides */
			$slideImages .= '<div class="carousel-inner" role="listbox">';
			for($i = 1; $i <= 10; $i++) {
				if(!$row['it_img'.$i]) {
					continue;
				}

				$file = G5_DATA_PATH.'/item/'.$row['it_img'.$i];
				if(is_file($file)) {
					echo '<span class="test">'.$file.'</span>';
					// 썸네일
					$thumb = get_it_thumbnail($row['it_img'.$i], 60, 60);
					$thumbnails[$i] = $thumb;
					$imageurl = G5_DATA_URL.'/item/'.$row['it_img'.$i];
					$largeImage[$i] = $imageurl;
					$slideImages .= '<div class="carousel-item';
					if($no == $i) {
						$slideImages .= ' active';
					}
					$slideImages .= '">';
					$slideImages .= '<img src="'.$largeImage[$i].'" alt="'.$row['it_name'].'" id="largeimage_'.$i.'">'; //  width="'.$size[0].'" height="'.$size[1].'"
					$slideImages .= '</div>';
	    
					/*
					?>
					<span>
						<a href="#">
							<img src="<?php echo $imageurl; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>" alt="<?php echo $row['it_name']; ?>" id="largeimage_<?php echo $i; ?>">
						</a>
					</span>
					<?php
					*/
				}
			}
			$slideImages .= '</div>';
			echo $slideImages;
	    	/* END :: Slides */

				//$slideImages .= '</div>';
				/*
			?>
			<a href="#">
				<img src="<?php echo G5_DATA_URL.'/item/'.$row['it_img'.$no]; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>" alt="<?php echo $row['it_name']; ?>" id="largeimage_<?php echo $no; ?>" class="detail-large-image img-fluid" />
			</a>

			<?php  
			*/  
		} else if($countItem == 1) {
		?>
		<a href="#">
			<img src="<?php echo G5_DATA_URL.'/item/'.$row['it_img'.$no]; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>" alt="<?php echo $row['it_name']; ?>" id="largeimage_<?php echo $no; ?>" class="detail-large-image img-fluid" />
		</a>
		<div class="temp" style="color: #fff;">Count item == 1 :: <?php echo $countItem; ?></div>
		<?php
		}
		?>
	<div class="close-info">
		우측상단의 [X] 버튼을 클릭하거나, <br />
		[ESC] 키를 누르면 이 창이 닫힙니다.
	</div>

	<?php
		$total_count = count($thumbnails);
		$thumb_count = 0;
		$x = 0;
		$slideId = 0;
		$thumbBtn = '';

		if($total_count > 1) {
			//echo '<ul>';
			/* BIGIN :: Controls */
	    	$thumbBtn .= '<a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">';
	        $thumbBtn .= '<i class="fa fa-chevron-left" aria-hidden="true"></i>';
	        $thumbBtn .= '<span class="sr-only">Previous</span>';
	    	$thumbBtn .= '</a>';
	    	$thumbBtn .= '<a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">';
	        $thumbBtn .= '<i class="fa fa-chevron-right" aria-hidden="true"></i>';
	        $thumbBtn .= '<span class="sr-only">Next</span>';
	    	$thumbBtn .= '</a>';
	    	/* END :: Controls */
			$thumbBtn .= '<ol class="carousel-indicators">';
			foreach($thumbnails as $key=>$val) {
				$x++;
				//$slideId = $slideId - $x;
				//echo '<li>';
				//echo '<a href="'.G5_SHOP_URL.'/largeimage.php?it_id='.$it_id.'&amp;no='.$key.'" class="img_thumb" data-large-image="'.$largeImage[$x].'">'.$val.'</a>';
				//echo '<a href="#" class="img_thumb" data-large-image="'.$largeImage[$x].'">'.$val.'</a>';
				//echo '</li>';
				$thumbBtn .= '<li data-target="#carousel-thumb" data-slide-to="'.$slideId.'" class="';
				if($no == $x) {$thumbBtn .= ' active';}
				$thumbBtn .= '">';
				$thumbBtn .= $val;
				//$thumbBtn .= '<img src="'.$largeImage[$x].'" alt="'.$row['it_name'].'" id="largeimage_'.$x.'">';
				$thumbBtn .= '</li>';
				$slideId++;
			}
			//echo '</ul>';
	    	$thumbBtn .= '</ol>';
			$thumbBtn .= '</div>';
			echo $thumbBtn;
		}
	?>
	</div>

	<!-- <div class="win_btn">
		<button type="button" onclick="javascript:window.close();" class="btn_close">창닫기</button>
	</div> -->
</div>

<script>
// 창 사이즈 조절
$(window).on("load", function() {
	var w = <?php echo $size[0]; ?> + 50;
	var h = $("#sit_pvi_nw").outerHeight(true) + $("#sit_pvi_nw h1").outerHeight(true);
	window.resizeTo(w, h);
});

$(function(){
	/* BIGIN :: esc 키 안내 */
	setTimeout(function() {
		$('.close-info').addClass('hide');
	}, 3000);
	setTimeout(function() {
		$('.close-info').remove();
	}, 3500);
	/* END :: esc 키 안내 */
	$("#sit_pvi_nwbig span:eq("+<?php echo ($no - 1); ?>+")").addClass("visible");
	// 이미지 미리보기
	$(".img_thumb").bind("mouseover focus", function(){
		var ImageIwillSee = $(this).data('large-image');
		$('.detail-large-image').attr('src', ImageIwillSee);
	});

	$(".detail-large-image, .img_thumb").bind("click", function(){
		return false;
	});

	$('.carousel').carousel({
		interval: 2000
    });
});
</script>