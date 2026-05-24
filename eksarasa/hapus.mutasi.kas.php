<?php
session_start();
set_time_limit(0);
include "koneksi.php";

if(isset($_GET['id'])){
$id=$_GET['id'];
	
$delete=mysql_query("delete from arus_kas where kd_arus_kas='$id'");
	
	if($delete){
		header("location:index.php?page=arus.kas&pesan=success");
	}else{
		header("location:index.php?page=arus.kas&pesan=Data Gagal Terhapus");
	}
}else{
	header("location:index.php?page=404");
}

?>