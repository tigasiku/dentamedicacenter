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
	
	$keterangan=$_POST['keterangan'];	
	
	$tipe = $_POST['tipe'];

 	$insert_alur_kas=mysql_query("insert into arus_kas value('','".$dana_dari."','".$tipe."','$keterangan','$jumlah_bayar','".$tanggal_mutasi."','')");
	
	
        if ($insert_alur_kas){
		
			
			
					header("location:index.php?page=arus.kas&pesan=success&kd_bank=$dana_dari");
			
		}else{
			header("location:index.php?page=arus.kas&pesan=success&kd_bank=$dana_dari");}


}else{
	header("location:index.php?page=404");
}
?>