<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_GET['idKota'])){

$idKota=$_GET['idKota'];
$provinsi=$_GET['idProvinsi'];
	$update=mysql_query("update kota set ibuKota='Y' where idKota='".$idKota."'");
			if ($update){
			header("location:index.php?page=kota&provinsi=$provinsi&pesan=success");
			}else{
			header("location:index.php?page=kota&provinsi=$provinsi&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>