<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_GET['id'])){
	

$id=$_GET['id'];

 
$update=mysql_query("delete from produk_best where id='".$id."'");
			if ($update){
			header("location:index.php?page=product.best&pesan=success");
			}else{
			header("location:index.php?page=product.best&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>