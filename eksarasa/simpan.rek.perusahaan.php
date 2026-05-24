<?php
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){
	$kode_b="AK".date("ymdHis");
$bank=$_POST['bank'];
$no_rek=$_POST['no_rek'];
$atas_nama=$_POST['atas_nama'];
$warna=$_POST['warna'];

$jumlah=preg_replace("/[^0-9]/", "",$_POST['jumlah']);
	$sort_by=$_POST['sort_by'];
$update=mysql_query("INSERT INTO bank_perusahaan values('$kode_b','".$bank."','".$no_rek."','".$atas_nama."','','$warna','$sort_by','Y')");
	
		
	
		$insert_alur_kas=mysql_query("insert into arus_kas value('','".$kode_b."','debet','Saldo Awal','$jumlah','".date("Y-m-d H:i:s")."','".$kode_b."')");
	
	
			if ($update){
			header("location:index.php?page=rek.perusahaan&pesan=success");
			}else{
			header("location:index.php?page=rek.perusahaan&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}

?>