<?php
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){
	
$kategori=$_POST['kategori'];
$sub_kategori=ucwords(strtolower($_POST['sub_kategori']));
	
$update=mysql_query("INSERT INTO sub_kategori_barang value('','".$kategori."','".$sub_kategori."')");
			if ($update){
			header("location:index.php?page=sub.kategori&kategori=$kategori&pesan=success");
			}else{
			header("location:index.php?page=sub.kategori&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>