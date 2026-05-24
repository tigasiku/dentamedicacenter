<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){
$provinsi=$_POST['provinsi'];
$kota=$_POST['kota'];

$cek=mysql_num_rows(mysql_query(("select namaKota from kota where idProvinsi='".$provinsi."' and  namaKota='".$kota."'")));
if($cek > 0){
	header("location:index.php?page=kota&provinsi=$provinsi&kota=$kota&pesan=error");
	}else{
	$update=mysql_query("INSERT INTO kota value('','".$kota."','".$provinsi."','')");
			if ($update){
			header("location:index.php?page=kota&provinsi=$provinsi&pesan=success");
			}else{
			header("location:index.php?page=kota&provinsi=$provinsi&pesan=error");}
	}
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>