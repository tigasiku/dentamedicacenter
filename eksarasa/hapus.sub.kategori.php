<?php
include "koneksi.php";
if(isset($_GET['id'])){
$username=$_GET['id'];
	
$delete=mysql_query("delete from sub_kategori_barang where id='$username'");
	

	
	
	if($delete){
			include ("sub.kategori.php");
	}else{
		header("location:index.php?page=sub.kategori&pesan=Data Gagal Terhapus");
	}
}else{
	header("location:index.php?page=404");
}

?>