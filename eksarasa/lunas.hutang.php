<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";

if (isset($_GET['id'])){
	
		
	 $kode=$_GET['id'];
	
	
 $insert_cash_in=mysql_query("UPDATE hutang SET status='N' WHERE kode_hutang='".$kode."'");
 	
        if ($insert_cash_in){
		
			
			
					header("location:index.php?page=hutang&pesan=success");
			
		}else{
			header("location:index.php?page=hutang&pesan=error");}


}else{
	header("location:index.php?page=404");
}
?>