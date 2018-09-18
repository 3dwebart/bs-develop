<?php
include_once('./_common.php');
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_PATH.'/Language/language-control.php');
//$languagePack = $_SERVER['DOCUMENT_ROOT'].'/language/frontend/common/top-search-logo/'.$_COOKIE['selLanguage'].'.php';

?>
<table border="1">
	<thead>
		<tr>
			<?php

			$sql = "DESC g5_languageSet";

			$result = sql_query($sql);

			while ($row = sql_fetch_array($result)) {
				if($row['Field'] != 'id') {
					echo('<th>'.$row['Field'].'</th>');
				}
			}

			?>
		</tr>
	</thead>
	<tbody>
		<?php

		$sql = "SELECT * FROM g5_languageSet";

		$result = sql_query($sql);

		while ($row = sql_fetch_array($result)) {
			echo('<tr>');
			//echo('<td>'.$row['id'].'</td>');
			echo('<td>'.$row['languageCode'].'</td>');
			echo('<td>'.$row['currentLanguage'].'</td>');
			echo('<td>'.$row['langKor'].'</td>');
			echo('<td>'.$row['langEng'].'</td>');
			echo('<td>'.$row['langZhh'].'</td>');
			echo('<tr>');
		}
		?>
	</tbody>
</table>

