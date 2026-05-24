<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){
$kategori=$_POST['kategori'];
$id=$_POST['kode'];

$update=mysql_query("update kategori_produk set kategori='".$kategori."' where id='$id'");
			if ($update){
			header("location:index.php?page=edit.kategori&id=$id&pesan=success");
			}else{
			header("location:index.php?page=edit.kategori&id=$id&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>