<?php
include "koneksi.php";
if(isset($_GET['id'])){
$username=$_GET['id'];
	
$delete=mysql_query("delete from kategori_barang where kode_kategori_barang='$username'");
	
		$delete2=mysql_query("delete from sub_kategori_barang where id='$username'");
	
	if($delete){
		include ("kategori.php");
	}else{
		header("location:index.php?page=kategori&pesan=Data Gagal Terhapus");
	}
}else{
	header("location:index.php?page=404");
}

?>