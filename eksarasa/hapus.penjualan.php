<?php
session_start();
date_default_timezone_set("Asia/Makassar");
include "koneksi.php";

if(isset($_GET['no_jual'])){
$kode=$_GET['no_jual'];

$sql = "delete from penjualan where no_jual='$kode'";
mysql_query ($sql);
$sql2 = "delete from penjualan_detail where no_jual='$kode'";
	
mysql_query ($sql2);
	
		
$sql3 = "delete from pemasukan where keterangan='$kode'";
mysql_query ($sql3);	
	
	$delete2=mysql_query("delete from arus_kas where kode='$kode'");
	$delete3=mysql_query("delete from piutang where  keterangan='".$kode."'");
	$sql4= "delete from pengeluaran where keterangan='$kode'";
	mysql_query ($sql4);	
	
	if($delete3){
		header("location:index.php?page=penjualan&pesan=Data Berhasil Terhapus");
	}else{
		header("location:index.php?page=penjualan&pesan=Data Gagal Terhapus");
	}
}else{
	header("location:index.php?page=404");
}

?>
