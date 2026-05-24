<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_GET['id'])){
$username=$_GET['id'];
$update=mysql_query("delete from bank_perusahaan where kd_bank='".$username."'");
			if ($update){
			header("location:index.php?page=rek.perusahaan&pesan=success");
			}else{
			header("location:index.php?page=rek.perusahaan&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>