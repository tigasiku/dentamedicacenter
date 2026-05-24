<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";

if (isset($_POST['submit'])){
	
		
	 	$jumlah_order=mysql_fetch_array(mysql_query("select kode_pemasukan from pemasukan order by tgl_input desc"));
		
		
		$int = preg_replace("/[^0-9]/","",$jumlah_order[0]);;
		$num=($int+1);
		echo $kode = "IN-".$num;
	
		
		$kategori=$_POST['kategori'];
		
		$jumlah=preg_replace("/[^0-9]/", "",$_POST['jumlah']);
	
		$tgl=$_POST['tgl'];
		$nama=$_POST['nama'];
		$keterangan=$_POST['keterangan'];
					$kas=$_POST['kas'];
        $update= mysql_query("INSERT INTO pemasukan VALUES
		 ('".$kode."',
		 '".$kategori."', 
	
		
			 
			  '".$nama."', 
			 '".$tgl."',
		 '".$jumlah."', 
		  '".$keterangan ."',
		  '".$_SESSION["user_graha3"]."', 
		 
			  '".date("Y-m-d H-i-s")."')");
 $insert_alur_kas=mysql_query("insert into arus_kas value('','".$kas."','debet','Cash In - $nama - $keterangan','$jumlah','".$tgl.date(" H:i:s")."','".$kode."')");
 	
        if ($update){
			header("location:index.php?page=cash.in&pesan=success");
			}else{
			header("location:index.php?page=cash.in&pesan=error");}


}else{
	header("location:index.php?page=404");
}
?>