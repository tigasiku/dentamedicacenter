<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){
$provinsi=$_POST['provinsi'];
$update=mysql_query("INSERT INTO provinsi value('','".$provinsi."')");
			if ($update){
			header("location:index.php?page=provinsi&pesan=success");
			}else{
			header("location:index.php?page=provinsi&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>