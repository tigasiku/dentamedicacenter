<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_GET['username'])){
$username=$_GET['username'];
$update=mysql_query("delete from member_user where username='".$username."'");
			if ($update){
			header("location:index.php?page=member&pesan=success");
			}else{
			header("location:index.php?page=member&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>