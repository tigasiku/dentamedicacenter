<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_GET['username'])){
$status=$_GET['status'];	
$username=$_GET['username'];
$update=mysql_query("update agen set status_agen='".$status."' where username='".$username."'");
		header("location:index.php?page=agen");	
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>