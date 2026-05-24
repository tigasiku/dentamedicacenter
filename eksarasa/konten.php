<?php
if(!isset($_GET['page'])){
	include "home.php";
}else{
	$page=$_GET['page'];
	$filename = $page.'.php';
	if (file_exists($filename)) {
		include "$page.php";
	} else {
		include "404.php";
	}
}
?>