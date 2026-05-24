<?php

if(isset($_GET['id'])){
$username=$_GET['id'];
	
	
$delete=mysql_query("delete from sub_kategori_uang_keluar where kode_sub_kategori_uang_keluar='$username'");
	
	if($delete){
		include ("sub.kategori.out.php");
	}else{
		header("location:index.php?page=sub.kategori.out&pesan=Data Gagal Terhapus");
	}
	
}else{
	header("location:index.php?page=404");
}

?>