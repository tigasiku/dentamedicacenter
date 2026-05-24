<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";

if (isset($_POST['submit'])){
	
		
	 $kode=$_POST['kode'];
	
	$jumlah_bayar=preg_replace("/[^0-9]/", "",$_POST['jumlah_bayar']);
	$tanggal_bayar=$_POST['tanggal_bayar'];
	$total=preg_replace("/[^0-9]/", "",$_POST['total']);
	 $nama_vendor=$_POST['customer'];
	
	$kas=$_POST['kas'];
	$keterangan=$_POST['keterangan'];	
		 $update= mysql_query("insert into bayar_hutang VALUES 
		('','".$kode."','".$tanggal_bayar."',
		'".$jumlah_bayar."',
		'".$keterangan."','".$kode."')");
	
	$subkategori=$_POST['filter_sub_kategori'];
		$qry_kategory=mysql_fetch_array(mysql_query("select kode_kategori_uang_keluar from sub_kategori_uang_keluar where kode_sub_kategori_uang_keluar='".$subkategori."'"));
		
		$kategori=$qry_kategory['kode_kategori_uang_keluar'];
	
	if(empty($keterangan)){
		$keterangan=$kode;
	}
	
        if(!empty($subkategori)){
	$jumlah_order=mysql_fetch_array(mysql_query("select kode_pengeluaran from pengeluaran order by tgl_input desc"));
		
		
		$int = preg_replace("/[^0-9]/","",$jumlah_order[0]);;
		$num=($int+1);
		echo $kode = "OUT-".$num;
	
 $insert_cash_in=mysql_query("insert into pengeluaran value('".$kode."', '".$kategori."','".$subkategori."','$nama_vendor','$tanggal_bayar','$jumlah_bayar','$keterangan','".$_SESSION["user_graha3"]."','".date("Y-m-d H:i:s")."')");
		}
	
 	$insert_alur_kas=mysql_query("insert into arus_kas value('','".$kas."','kredit','Hutang - $keterangan','$jumlah_bayar','".date("Y-m-d H:i:s")."','".$kode."')");
	

        if ($update){
		
			
			
					header("location:index.php?page=hutang&pesan=success");
			
		}else{
			header("location:index.php?page=hutang&pesan=error");}


}else{
	header("location:index.php?page=404");
}
?>