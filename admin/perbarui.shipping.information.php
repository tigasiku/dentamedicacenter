<?php
set_time_limit(0);
session_start();
include "koneksi.php";
koneksi_buka();

	date_default_timezone_set("Asia/Makassar");
	

      
		$id=$_POST['id'];
		$nama=$_POST['nama'];
		$telp=$_POST['telp'];
	
		
		$cmbProvinsi=$_POST['cmbProvinsi'];
		
		$address=$_POST['address'];
		$kode_kota=$_POST['kode'];	
		$kota=$_POST['city'];	
		$postcode=$_POST['postcode'];
		
		
		
        $update= mysql_query("UPDATE penjualan SET  
		si_nama='".$nama."',
		si_provinsi='".$cmbProvinsi."',
		si_kode_kota='".$kode_kota."',
		si_kota='".$kota."',
		si_alamat='".$address."',
		si_kode_pos='".$postcode."',				
		si_telp='".$telp."' where kd_penjualan='$id'");

	
		if(	$update) {
		header('location:index.php?page=edit.orders&id='.$id.'&next=shipping.method'); }
		
koneksi_tutup();		
?>