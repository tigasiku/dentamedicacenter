<?php
session_start();
date_default_timezone_set("Asia/Makassar");
include "koneksi.php";

if(isset($_GET['no_mutasi'])){
$kode=$_GET['no_mutasi'];

$sql = "delete from mutasi where no_mutasi='$kode'";
mysql_query ($sql);
$sql2 = "delete from mutasi_gudang where keterangan='$kode'";
	
mysql_query ($sql2);
	
		
	
	if($sql2){
		header("location:index.php?page=daftar.mutasi.stok&pesan=Data Berhasil Terhapus");
	}else{
		header("location:index.php?page=daftar.mutasi.stok&pesan=Data Gagal Terhapus");
	}
}else{
	header("location:index.php?page=404");
}

?>
