<?php
include "koneksi.php";
if(isset($_GET['id'])){
$username=$_GET['id'];
	
$delete=mysql_query("delete from gudang where kd_gudang='$username'");
	

	
	
	if($delete){
			include ("gudang.php");
	}else{
		header("location:index.php?page=gudang&pesan=Data Gagal Terhapus");
	}
}else{
	header("location:index.php?page=404");
}

?>