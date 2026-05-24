<?php
set_time_limit(0);
session_start();
include "koneksi.php";
koneksi_buka();

	date_default_timezone_set("Asia/Makassar");
	
$id=$_POST['id'];
      
		$kota_origin=$_POST['kota_origin'];
		$kota_destination=$_POST['kota_destination'];
	
		
		$weightnya=$_POST['weightnya'];
		
		$service_jne=$_POST['service_jne'];
		$ongkir_jne=$_POST['ongkir_jne'];	
		$est_jne=$_POST['est_jne'];	
		
		
		
        $update= mysql_query("UPDATE penjualan SET  
		shipping='JNE',
		servicenya='".$service_jne."',
		weight='".$weightnya."',
		cost='".$ongkir_jne."',
		keterangan='".$est_jne."' where kd_penjualan='$id'");

	
		if(	$update) {
		header('location:index.php?page=edit.orders&id='.$id.'&next=payment.method'); }
		
koneksi_tutup();		
?>