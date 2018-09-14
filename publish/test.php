<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_PATH.'/Language/language-control.php');
//$languagePack = $_SERVER['DOCUMENT_ROOT'].'/language/frontend/common/top-search-logo/'.$_COOKIE['selLanguage'].'.php';


$sql = "SELECT * FROM g5_languageSet";

$result = sql_query($sql);

while ($row = sql_fetch_array($result)) {
	echo('<h1>111</h1>');
}
?>