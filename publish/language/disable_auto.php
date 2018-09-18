<?php
	$selLang = $_POST['selLang'];
	$rootPath = $_SERVER['DOCUMENT_ROOT'];
	include_once($rootPath.'/language/frontend/common/disable-auto/'.$selLang.'.php');
	echo json_encode($disableAuto,JSON_UNESCAPED_UNICODE);
?>
