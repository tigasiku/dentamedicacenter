<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";

if (isset($_POST['submit'])){
	
		
	 $kode=$_POST['kode'];
	
	$jumlah_bayar=preg_replace("/[^0-9]/", "",$_POST['jumlah_bayar']);
	$tanggal_mutasi=$_POST['tanggal_mutasi']." ".date("H:i:s");
	
	 $dana_dari=$_POST['dana_dari'];
	
	$keterangan=$_POST['keterangan'];	
	$tipe_kas=$_POST['tipe_kas'];
	

 	$insert_alur_kas=mysql_query("update arus_kas set kd_bank='".$dana_dari."',tipe_kas='".$tipe_kas."',keterangan='$keterangan',nilai='$jumlah_bayar',tanggal='".$tanggal_mutasi."' where kd_arus_kas='".$kode."'");
	
	
        if ($insert_alur_kas){
		
			
			
					header("location:index.php?page=arus.kas&pesan=success");
			
		}else{
			header("location:index.php?page=arus.kas&pesan=error");}


}else{
	header("location:index.php?page=404");
}
?>