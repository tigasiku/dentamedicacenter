<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){


$kode = $_POST['kode'];
$nama = $_POST['nama'];

$sort_order = $_POST['sort_order'];


		

		
	 $ins = mysql_query("update divisi set divisi='".$nama."', sort_by='".$sort_order."' where id='".$kode."'"); 
		
	
 
			header("location:index.php?page=post.divisi&id=$kode&pesan=success");
			

}else{
	header("location:index.php?page=404");
}
?>