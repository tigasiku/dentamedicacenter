<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";

if (isset($_GET['id'])){
	
		
	 $kode=$_GET['id'];
	
	$nama=$_GET['nama'];
	if(isset($_GET['sisa'])){
		$sisa=$_GET['sisa'];
		if($sisa <= 0) { 
		 $insert_cash_in=mysql_query("UPDATE piutang SET status='N' WHERE nama='".$nama."'");
		}
	}else{
 $insert_cash_in=mysql_query("UPDATE piutang SET status='N' WHERE kode_piutang='".$kode."'");
	}
        if ($insert_cash_in){
		
			
			
					header("location:index.php?page=piutang&pesan=success");
			
		}else{
			header("location:index.php?page=piutang&pesan=error");}


}else{
	header("location:index.php?page=404");
}
?>