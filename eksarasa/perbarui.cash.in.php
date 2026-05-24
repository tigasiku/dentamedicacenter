<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";

if (isset($_POST['submit'])){
	
	
	
		$kode = $_POST['kode'];
		$kategori=$_POST['kategori'];
		
		
			$delete2=mysql_query("delete from arus_kas where kode='$kode'");
		$jumlah=preg_replace("/[^0-9]/", "",$_POST['jumlah']);
	
		$tgl=$_POST['tgl'];
		
		$nama=$_POST['nama'];
		$keterangan=$_POST['keterangan'];
				$kas=$_POST['kas'];
        $update= mysql_query("UPDATE pemasukan SET 
		
		kode_kategori_uang_masuk='".$kategori."', 
		nama_user='".$nama."',
			tanggal='".$tgl."',
				jumlah='".$jumlah."',
				keterangan='".$keterangan."'
		 where kode_pemasukan='$kode'");
 
 	$insert_alur_kas=mysql_query("insert into arus_kas value('','".$kas."','debet','Cash In - $nama - $keterangan','$jumlah','".$tgl.date(" H:i:s")."','".$kode."')");
	
        if ($update){
			header("location:index.php?page=cash.in&pesan=success");
			}else{
			header("location:index.php?page=cash.in&pesan=error");}


}else{
	header("location:index.php?page=404");
}
?>