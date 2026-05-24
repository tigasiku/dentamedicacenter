<?php
set_time_limit(0);
session_start();
include "koneksi.php";
koneksi_buka();

	date_default_timezone_set("Asia/Makassar");
	
	$id=$_POST['id'];
	
	$status=$_POST['status'];
	$no_tracking=$_POST['no_tracking'];
	$tgl_tracking=$_POST['tgl_tracking'];
	
	
$update= mysql_query("UPDATE penjualan SET  
	
		status='".$status."'
		 where kd_penjualan='$id'");
			
	
	$konfirmasi=mysql_query("INSERT INTO confirm_logistik VALUES ('','".$id."','".$_SESSION["user_graha2"]."','".$_SESSION['nama_graha']."','".$no_tracking."','".$tgl_tracking."')");
	
		if(	$konfirmasi) {
			
			
				header('location:index.php?page=orders.logistik&id='.$id.'&pesan=success'); 
			
		}
		
koneksi_tutup();		
?>