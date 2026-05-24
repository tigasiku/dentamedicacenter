<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){
$kategori=$_POST['kategori'];
$id=$_POST['kode'];
$sub_kategori=$_POST['sub_kategori'];


$update=mysql_query("update sub_kategori_produk set kategori='".$kategori."',sub_kategori='".$sub_kategori."' where id='$id'");

			if ($update){
			header("location:index.php?page=sub.kategori&pesan=success");
			}else{
			header("location:index.php?page=sub.kategori&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>