v<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){


$kode = date('ymdHis');
$nama = $_POST['nama'];

$sort_order = $_POST['sort_order'];


		

		
	 $ins = mysql_query("insert into divisi value ('".$kode."','".$nama."','".$sort_order."')"); 
		
	
 
			header("location:index.php?page=tambah.divisi&pesan=success");
			

}else{
	header("location:index.php?page=404");
}
?>