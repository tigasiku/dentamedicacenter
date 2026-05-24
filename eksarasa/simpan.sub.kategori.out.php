<?php
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){
$kategori=$_POST['kategori'];
	$sub_kategori=$_POST['sub_kategori'];
	
$nomor=$_POST['nomor'];
$update=mysql_query("insert into sub_kategori_uang_keluar value('','".$sub_kategori."','".$kategori."','".$nomor."')");
			if ($update){
			header("location:index.php?page=sub.kategori.out&pesan=success");
			}else{
			header("location:index.php?page=sub.kategori.out&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}
?>