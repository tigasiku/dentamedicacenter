<?php
error_reporting(0);
require "../koneksi.php";

	$get = "delete from penjualan where kd_penjualan = '".$_GET['id']."'"; 
	$del = mysql_query($get); 
	;
	$get2 = "delete from penjualan_detail where kd_penjualan = '".$_GET['id']."'"; 
	$del2 = mysql_query($get2); 
	;
	
	
	
	
	// tampilkan pesan ketika $del telah dijalankan
	if($del){
		header("location:index.php?page=orders&pesan=$_GET[id]");
	}
	else{
	header("location:index.php?page=orders&pesan=$_GET[id]");
	}
	
?>
	
            

