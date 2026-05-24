<?php
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){

$bank=$_POST['bank'];
$no_rek=$_POST['no_rek'];
$sort_by=$_POST['sort_by'];
$status=$_POST['status'];
$kode=$_POST['kode'];
	
$update=mysql_query("update gudang set kd_gudang='$bank',gudang='".$no_rek."',status='".$status."',sort_by='$sort_by' where kd_gudang='".$kode."'");
	
	
	
			if ($update){
			header("location:index.php?page=gudang&pesan=success");
			}else{
			header("location:index.php?page=gudang&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}

?>