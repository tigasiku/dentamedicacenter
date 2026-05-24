<?php
set_time_limit(0);
session_start();
include "koneksi.php";
koneksi_buka();

	date_default_timezone_set("Asia/Makassar");
	
$id=$_POST['id'];
      
		$kd_bank = ($_POST['trans_bank']);
	
		$bank=mysql_fetch_array(mysql_query("select * from  bank_perusahaan where kd_bank='$kd_bank'"));
		$namabank =$bank['nama_bank'];
			$no_rek =$bank['no_rek'];
			$atas_nama =$bank['atas_nama'];
		
		
		
		
        $update= mysql_query("UPDATE penjualan SET  
		kd_bank='".$kd_bank."',
		nama_bank='".$namabank."',
		no_rek='".$no_rek."',
		atas_nama_bank='".$atas_nama."' where kd_penjualan='$id'");

	
		if(	$update) {
		header('location:index.php?page=edit.orders&id='.$id.'&next=order.details'); }
		
koneksi_tutup();		
?>