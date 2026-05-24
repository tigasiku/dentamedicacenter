<?php
session_start();
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){
	
	$no_ref	= date("YmdHis");
	date_default_timezone_set("Asia/Makassar");
	$tgl_skrg=date("Y-m-d H:i:s");
$gudang_dari=$_POST['gudang_dari'];
		$gudang_tujuan=$_POST['gudang_tujuan'];
	$tanggal=$_POST['tanggal'];
	$ket=$_POST['ket'];
	foreach($_POST['pname'] as $key => $name){
	$kode=$_POST['kode'][$key];

	$satuan=$_POST['satuan'][$key];
	$pprice=$_POST['harga_jual'][$key];
		$h_beli=$_POST['harga_beli'][$key];
	$qty=$_POST['qty'][$key];
	$sub_total=$_POST['sub_total'][$key];
	
	$insert=mysql_query("insert into mutasi value('$no_ref','$tanggal','$gudang_dari','$gudang_tujuan','$grandtotal','$ket')");
		
$insert_d=mysql_query("insert into mutasi_gudang  values('','keluar','$kode','$qty','$satuan','$h_beli','$pprice','$sub_total','$no_ref','$tanggal','$gudang_dari')");

		
$insert_2=mysql_query("insert into mutasi_gudang  values('','masuk','$kode','$qty','$satuan','$h_beli','$pprice','$sub_total','$no_ref','$tanggal','$gudang_tujuan')");	
		
}
	
	
	
	if ( $insert_d){
	header("location:index.php?page=daftar.mutasi.stok&pesan=success");
	}else{
	header("location:index.php?page=daftar.mutasi.stok&pesan=error");
	}
}else{
	header("location:index.php?page=404");
}

?>