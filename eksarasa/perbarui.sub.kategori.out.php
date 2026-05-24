<?php
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){
$kategori=$_POST['kategori'];
$id=$_POST['kode'];
$sub_kategori=$_POST['sub_kategori'];


$nomor=$_POST['nomor'];
$update=mysql_query("update sub_kategori_uang_keluar set kode_kategori_uang_keluar='".$kategori."',sub_kategori_uang_keluar='".$sub_kategori."',nomor_akun_sub='".$nomor."' where kode_sub_kategori_uang_keluar='$id'");

			if ($update){
			header("location:index.php?page=sub.kategori.out&pesan=success");
			}else{
			header("location:index.php?page=sub.kategori.out&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}

?>