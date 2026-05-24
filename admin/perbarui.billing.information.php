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
		bi_nama='".$nama."',
		bi_provinsi='".$cmbProvinsi."',
		bi_kode_kota='".$kode_kota."',
		bi_kota='".$kota."',
		bi_alamat='".$address."',
		bi_kode_pos='".$postcode."',
		
		
		bi_telp='".$telp."' where kd_penjualan='$id'");

	
		if(	$update) {
		header('location:index.php?page=edit.orders&id='.$id.'&next=shipping.information'); }
		
koneksi_tutup();		
?>