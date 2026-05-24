<?php
session_start();
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){
	
	
	date_default_timezone_set("Asia/Makassar");
	$tgl_skrg=date("Y-m-d H:i:s");

	$tanggal=$_POST['tanggal'];
	$ket=$_POST['ket'];
	$gudang=$_POST['gudang'];
		$biaya_kerusakan=$_POST['biaya_kerusakan'];	
	foreach($_POST['pname'] as $key => $name){
	$kode=$_POST['kode'][$key];

	$satuan=$_POST['satuan'][$key];
	$pprice=$_POST['harga_jual'][$key];
	$h_beli=$_POST['harga_beli'][$key];
	$qty=$_POST['qty'][$key];
	$sub_total=$_POST['sub_total'][$key];
	$ket = $name.$_POST['ket'];
$insert_d=mysql_query("insert into stok_keluar  values('','$kode','$qty','$satuan','$h_beli','$pprice','$sub_total','$ket','$tanggal','$gudang')");
	if($biaya_kerusakan=="Ya"){
		 
		 $jumlah_order=mysql_fetch_array(mysql_query("select kode_pengeluaran from pengeluaran order by tgl_input desc,kode_pengeluaran desc"));
		
		
		$int = preg_replace("/[^0-9]/","",$jumlah_order[0]);;
		$num=($int+1);
		echo $kodeout = "OUT-".$num;
	 $update= mysql_query("INSERT INTO pengeluaran VALUES
		 ('".$kodeout."',
		 '43','51', 
			  '".$gudang."',
			 '".$tanggal."',
		 '".$sub_total."', 
		  '".$ket."',
		  '".$_SESSION["user_graha3"]."', 
		  '".date("Y-m-d H-i-s")."')");
				 
		  }
}
	
	
	
	if ( $insert_d){
	header("location:index.php?page=tambah.stok.keluar&pesan=success");
	}else{
	header("location:index.php?page=tambah.stok.keluar&pesan=error");
	}
}else{
	header("location:index.php?page=404");
}

?>