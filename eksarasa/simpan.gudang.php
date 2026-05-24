<?php
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){

$bank=$_POST['bank'];
$no_rek=$_POST['no_rek'];
$sort_by=$_POST['sort_by'];
$status=$_POST['status'];

	
$update=mysql_query("INSERT INTO gudang values('$bank','".$no_rek."','".$status."','','$sort_by')");
	
	
	
			if ($update){
			header("location:index.php?page=gudang&pesan=success");
			}else{
			header("location:index.php?page=rek.perusahaan&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}

?>