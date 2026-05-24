<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";

if (isset($_POST['submit'])){
	
		
	 $no_ref=$_POST['no_ref'];
	
	$jumlah_bayar=preg_replace("/[^0-9]/", "",$_POST['jumlah_bayar']);
	$tanggal_mutasi=$_POST['tanggal_mutasi']." ".date("H:i:s");
	
	 $dana_dari=$_POST['dana_dari'];
	
	$dana_tujuan=$_POST['dana_tujuan'];
	$keterangan=$_POST['keterangan'];	
	
	

 	$insert_alur_kas=mysql_query("insert into arus_kas value('','".$dana_dari."','kredit','$keterangan','$jumlah_bayar','".$tanggal_mutasi."','')");
	
	$insert_alur_kas2=mysql_query("insert into arus_kas value('','".$dana_tujuan."','debet','$keterangan','$jumlah_bayar','".$tanggal_mutasi."','')");
	
        if ($insert_alur_kas2){
		
			
			
					header("location:index.php?page=arus.kas&pesan=success");
			
		}else{
			header("location:index.php?page=arus.kas&pesan=error");}


}else{
	header("location:index.php?page=404");
}
?>