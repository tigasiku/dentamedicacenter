<?php
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){

$id=$_POST['id'];	
$bank=$_POST['bank'];
$no_rek=$_POST['no_rek'];
$atas_nama=$_POST['atas_nama'];

$warna=$_POST['warna'];
	$status=$_POST['status'];
	$sort_by=$_POST['sort_by'];
$jumlah=preg_replace("/[^0-9]/", "",$_POST['jumlah']);
			$delete2=mysql_query("delete from arus_kas where kode='$id' ");
	
$update=mysql_query("update bank_perusahaan set nama_bank='".$bank."',no_rek='".$no_rek."',atas_nama='".$atas_nama."',color='".$warna."',sort_by='".$sort_by."',status='".$status."' where kd_bank='".$id."'");
	
	$insert_alur_kas=mysql_query("insert into arus_kas value('','".$id."','debet','Saldo Awal','$jumlah','".date("Y-m-d H:i:s")."','".$id."')");
	
			if ($update){
			header("location:index.php?page=rek.perusahaan&pesan=success");
			}else{
			header("location:index.php?page=rek.perusahaan&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}

?>