<?php
include_once('./_common.php');
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_PATH.'/Language/language-control.php');
//$languagePack = $_SERVER['DOCUMENT_ROOT'].'/language/frontend/common/top-search-logo/'.$_COOKIE['selLanguage'].'.php';

?>
<style>
.box {
	margin: 20px;
	width: 120px;
	height: 120px;
	background-color: #dedede;
	border: 1px solid #0000ff;
	display: flex;
	justify-content: center;
	align-items: center;
	position: relative;
}
.box:after {
	content: '';
	display: block;
	width: 2px;
	height: 2px;
	position: absolute;
	top: -2px;
	left: -2px;
	background-color: #ffaaaa;
	animation-duration: 4s;
	animation-name: borderAninate;
	animation-iteration-count: infinite;
}

@keyframes borderAninate {
	12.5% {
		width: calc(100% + 2px);
		height: 2px;
		top: -2px;
		left: -2px;
	}
	25% {
		width: 2px;
		height: 2px;
		top: -2px;
		left: 118px;
	}
	37.5% {
		width: 2px;
		height: calc(100% + 2px);
		left: 118px;
		top: -2px;
	}
	50% {
		width: 2px;
		height: 2px;
		left: 118px;
		top: 118px;
	}
	62.5% {
		width: calc(100% + 2px);
		height: 2px;
		left: -2px;
		top: 118px;
	}
	75% {
		width: 2px;
		height: 2px;
		left: -2px;
		top: 118px;
	}
	87.5% {
		width: 2px;
		height: calc(100% + 2px);
		left: -2px;
		top: -2px;
	}
	100% {
		width: 2px;
		height: 2px;
		left: -2px;
		top: -2px;
	}
}
</style>
<div class="box">
	<span>BOX</span>
</div>