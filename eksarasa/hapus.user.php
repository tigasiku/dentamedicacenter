<?php
include "koneksi.php";
	
if(isset($_GET['username'])){
$username=$_GET['username'];
$delete=mysql_query("delete from admin where username='$username'");
	if($delete){
		header("location:index.php?page=management.user&pesan=Data Berhasil Terhapus");
	}else{
		header("location:index.php?page=management.user&pesan=Data Gagal Terhapus");
	}
}else{
	header("location:index.php?page=404");
}

?>