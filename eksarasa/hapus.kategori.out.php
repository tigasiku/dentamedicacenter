<?php
include "koneksi.php";
if(isset($_GET['id'])){
$username=$_GET['id'];
	
$delete=mysql_query("delete from kategori_uang_keluar where kode_kategori_uang_keluar='$username'");
	
	
$delete=mysql_query("delete from sub_kategori_uang_keluar where kode_kategori_uang_keluar='$username'");
	
	if($delete){
			include ("kategori.out.php");
	}else{
		header("location:index.php?page=kategori.out&pesan=Data Gagal Terhapus");
	}
}else{
	header("location:index.php?page=404");
}

?>