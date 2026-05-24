<?php
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){
$kode=$_POST['kode'];	
$kota=$_POST['kota'];


 $query = mysql_query("INSERT INTO distributor VALUES ('".$kode."', '".$kota."')") ;
 
			if ($query){
			header("location:index.php?page=distributor&pesan=success");
			}else{
			header("location:index.php?page=distributor&pesan=error");}

}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>