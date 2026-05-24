<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){
	
$bank=$_POST['bank'];
$no_rek=$_POST['no_rek'];
$atas_nama=$_POST['atas_nama'];

$nama_bank=mysql_fetch_array(mysql_query("select nama_bank from bank where kd_bank='".$bank."'"));

$update=mysql_query("INSERT INTO bank_perusahaan values('".$bank."','".$nama_bank['nama_bank']."','".$no_rek."','".$atas_nama."','')");
			
			if ($update){
			header("location:index.php?page=rek.perusahaan&pesan=success");
			}else{
			header("location:index.php?page=rek.perusahaan&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>