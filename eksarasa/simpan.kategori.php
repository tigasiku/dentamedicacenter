<?php
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){
$kategori=$_POST['kategori'];
$update=mysql_query("INSERT INTO kategori_barang value('','".$kategori."','Admin')");

			if ($update){
			header("location:index.php?page=kategori&pesan=success");
			}else{
			header("location:index.php?page=kategori&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>