<?php
session_start();
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){
	
	
	date_default_timezone_set("Asia/Makassar");
	$tgl_skrg=date("Y-m-d H:i:s");
	$jumlah=preg_replace("/[^0-9]/", "",$_POST['jumlah']);
	
		$tgl=$_POST['tgl'];
		$nama=$_POST['nama'];
		$keterangan=$_POST['keterangan'];
		
			$tanggal=$_POST['tanggal'];
		
	
		$kas=$_POST['kas'];
		
		$kode_piutang='H'.date("ymdHis");
	
		$kategori=$_POST['kategori'];
		
		$insert_piutang=mysql_query("insert into hutang value('$kode_piutang','$kategori','$nama','$keterangan','$jumlah','$tanggal','$tgl','Y')");
		if(!empty($kas)){
		$insert_alur_kas=mysql_query("insert into arus_kas value('','".$kas."','debet','Hutang - $keterangan','$jumlah','".date("Y-m-d H:i:s")."','".$kode_piutang."')");}

	if ($insert_piutang){
	header("location:index.php?page=tambah.hutang&pesan=success");
	}else{
	header("location:index.php?page=tambah.hutang&pesan=error");
	}
}else{
	header("location:index.php?page=404");
}

?>