<?php
set_time_limit(50);
session_start();
include "koneksi.php";

date_default_timezone_set("Asia/Makassar");

	
	$id = ($_GET['id']);
	
	
	
	
	$hapus=mysql_query("delete from keranjang where id ='".$id."'");
header("location:index.php?page=keranjang");
?>