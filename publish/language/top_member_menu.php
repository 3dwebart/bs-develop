<?php
	$selLang = $_POST['selLang'];
	$path1 = $_POST['path1'];
	$path2 = $_POST['path2'];
	$path3 = $_POST['path3'];
	$tmplClass = $_POST['tmplClass'];
	$tmplID = $_POST['tmplID'];
	$rootPath = $_SERVER['DOCUMENT_ROOT'];
	include_once($rootPath.'/language/'.$path1.'/'.$path2.'/'.$path3.'/'.$selLang.'.php');
	//array_push($memberMenu, 'tmplID' => $tmplID, 'tmplClass' => $tmplClass);
	echo json_encode($memberMenu,JSON_UNESCAPED_UNICODE);
?>