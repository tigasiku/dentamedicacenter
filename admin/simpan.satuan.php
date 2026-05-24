<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){
$satuan=$_POST['satuan'];
$update=mysql_query("INSERT INTO satuan value('','".$satuan."')");
			if ($update){
			header("location:index.php?page=satuan&pesan=success");
			}else{
			header("location:index.php?page=satuan&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>