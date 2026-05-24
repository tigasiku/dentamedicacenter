<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){
$area=$_POST['area'];
$kota=$_POST['kota'];
$cek=mysql_num_rows(mysql_query(("select namaArea from area where idKota='".$kota."' and  namaArea='".$area."'")));
if($cek > 0){
	header("location:index.php?page=area&area=$area&kota=$kota&pesan=error");
	}else{
$update=mysql_query("INSERT INTO area value('','".$area."','".$kota."')");
			if ($update){
			header("location:index.php?page=area&kota=$kota&pesan=success");
			}else{
			header("location:index.php?page=area&kota=$kota&pesan=error");}
	}
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>