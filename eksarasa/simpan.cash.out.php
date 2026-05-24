<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";

if (isset($_POST['submit'])){
	
		
	 	$jumlah_order=mysql_fetch_array(mysql_query("select kode_pengeluaran from pengeluaran order by tgl_input desc,kode_pengeluaran desc"));
		
		
		$int = preg_replace("/[^0-9]/","",$jumlah_order[0]);;
		$num=($int+1);
		echo $kode = "OUT-".$num;
	

		$subkategori=$_POST['filter_sub_kategori'];
		$qry_kategory=mysql_fetch_array(mysql_query("select kode_kategori_uang_keluar from sub_kategori_uang_keluar where kode_sub_kategori_uang_keluar='".$subkategori."'"));
		
		$kategori=$qry_kategory['kode_kategori_uang_keluar'];
		
		$jumlah=preg_replace("/[^0-9]/", "",$_POST['jumlah']);
	
		$tgl=$_POST['tgl'];
		$nama=$_POST['nama'];
		$keterangan=$_POST['keterangan'];
				$kas=$_POST['kas'];	
        $update= mysql_query("INSERT INTO pengeluaran VALUES
		 ('".$kode."',
		 '".$kategori."', 
	 '".$subkategori."', 
			  '".$nama."',
			 '".$tgl."',
		 '".$jumlah."', 
		  '".$keterangan."',
		  '".$_SESSION["user_graha3"]."', 
		  '".date("Y-m-d H-i-s")."')");
 
 	$insert_alur_kas=mysql_query("insert into arus_kas value('','".$kas."','kredit','Cash Out - $nama - $keterangan','$jumlah','".$tgl.date(" H:i:s")."','".$kode."')");
	
	
        if ($update){
			header("location:index.php?page=cash.out&pesan=success");
			}else{
			header("location:index.php?page=cash.out&pesan=error");}


}else{
	header("location:index.php?page=404");
}
?>