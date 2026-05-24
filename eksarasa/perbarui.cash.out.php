<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";

if (isset($_POST['submit'])){
	
	
		$proyek=$_POST['proyek'];
		$kode = $_POST['kode'];
		$delete2=mysql_query("delete from arus_kas where kode='$kode'");
		$subkategori=$_POST['kategori'];
		$qry_kategory=mysql_fetch_array(mysql_query("select kode_kategori_uang_keluar from sub_kategori_uang_keluar where kode_sub_kategori_uang_keluar='".$subkategori."'"));
		
		$kategori=$qry_kategory['kode_kategori_uang_keluar'];
		
		$jumlah=preg_replace("/[^0-9]/", "",$_POST['jumlah']);
	
		$tgl=$_POST['tgl'];
		$nama=$_POST['nama'];
		$keterangan=$_POST['keterangan'];
				$kas=$_POST['kas'];
        $update= mysql_query("UPDATE pengeluaran SET 
		kode_kategori_uang_keluar='".$kategori."',
		kode_sub_kategori_uang_keluar='".$subkategori."',
		nama_vendor='".$nama."',
			tanggal='".$tgl."',
				jumlah='".$jumlah."',
				keterangan='".$keterangan."'
		 where kode_pengeluaran='$kode'");
 
 		$insert_alur_kas=mysql_query("insert into arus_kas value('','".$kas."','kredit','Cash Out - $nama - $keterangan','$jumlah','".$tgl.date(" H:i:s")."','".$kode."')");
        if ($update){
			header("location:index.php?page=cash.out&pesan=success");
			}else{
			header("location:index.php?page=cash.out&pesan=error");}


}else{
	header("location:index.php?page=404");
}
?>