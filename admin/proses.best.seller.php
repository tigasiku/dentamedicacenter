<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_GET['id'])){
	

$id=$_GET['id'];

 
$cek=mysql_query("select id from produk_best");
$num=mysql_num_rows($cek);
if($num >= 6) {
			header("location:index.php?page=product&pesan=Best Seller Sudah Cukup 8");
}else{
	
	$cek2=mysql_query("select id from produk_best where id='".$id."'");
	$num2=mysql_num_rows($cek2);
	if($num2 > 0) {
		header("location:index.php?page=product&pesan=Yang ini sudah.");
	}else{
	$update=mysql_query("INSERT INTO produk_best value('','".$id."')");
			header("location:index.php?page=product&pesan=success");
	}
}
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>