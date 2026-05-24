<?php
include "koneksi.php";
if(isset($_GET['id'])){
$username=$_GET['id'];
	
$delete=mysql_query("delete from kategori_uang_masuk where kode_kategori_uang_masuk='$username'");
	
	
	if($delete){
		include ("kategori.in.php");
	}else{
		header("location:index.php?page=kategori.in&pesan=Data Gagal Terhapus");
	}
}else{
	header("location:index.php?page=404");
}

?>