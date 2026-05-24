<?php
session_start();
date_default_timezone_set("Asia/Makassar");
 include "koneksi.php";

if(isset($_GET['no_beli'])){
$kode=$_GET['no_beli'];

$sql = "delete from pembelian where no_beli='$kode'";
mysql_query ($sql);
$sql2 = "delete from pembelian_detail where no_beli='$kode'";
mysql_query ($sql2);
	

//$sql3 = "delete from pengeluaran where keterangan='$kode'";
	
//mysql_query ($sql3);		
		$delete2=mysql_query("delete from arus_kas where kode='$kode'");
	$delete=mysql_query("delete from hutang where  keterangan='".$kode."'");
	
	if($delete){
		header("location:index.php?page=pembelian&pesan=Data Berhasil Terhapus");
	}else{
		header("location:index.php?page=pembelian&pesan=Data Gagal Terhapus");
	}
}else{
	header("location:index.php?page=404");
}

?>
