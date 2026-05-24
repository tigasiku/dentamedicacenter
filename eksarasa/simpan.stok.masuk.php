<?php
session_start();
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){
	
	
	date_default_timezone_set("Asia/Makassar");
	$tgl_skrg=date("Y-m-d H:i:s");

	$tanggal=$_POST['tanggal'];
	$ket=$_POST['ket'];
	$gudang=$_POST['gudang'];
	foreach($_POST['pname'] as $key => $name){
	$kode=$_POST['kode'][$key];

	$satuan=$_POST['satuan'][$key];
	$pprice=$_POST['harga_jual'][$key];
		$h_beli=$_POST['harga_beli'][$key];
		
	$qty=$_POST['qty'][$key];
	$sub_total=$_POST['sub_total'][$key];
	
$insert_d=mysql_query("insert into stok_masuk  values('','$kode','$qty','$satuan','$h_beli','$pprice','$sub_total','$ket','$tanggal','$gudang')");

}
	
	
	
	if ( $insert_d){
	header("location:index.php?page=tambah.stok.masuk&pesan=success");
	}else{
	header("location:index.php?page=tambah.stok.masuk&pesan=error");
	}
}else{
	header("location:index.php?page=404");
}

?>