<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){
$jenis=$_POST['jenis'];
$update=mysql_query("INSERT INTO  jenis_obat value('','".$jenis."')");
			if ($update){
			header("location:index.php?page=jenis.obat&pesan=success");
			}else{
			header("location:index.php?page=jenis.obat&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>