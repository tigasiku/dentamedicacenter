<?php
include "koneksi.php";
if(isset($_GET['id'])){
$username=$_GET['id'];
$delete=mysql_query("delete from pengeluaran where kode_pengeluaran='$username'");
	
	
	
	$delete2=mysql_query("delete from arus_kas where kode='$username'");
	if($delete){
		header("location:index.php?page=cash.out&pesan=Data Berhasil Terhapus");
	}else{
		header("location:index.php?page=cash.out&pesan=Data Gagal Terhapus");
	}
}else{
	header("location:index.php?page=404");
}

?>