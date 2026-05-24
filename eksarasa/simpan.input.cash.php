<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";

if (isset($_POST['submit'])){
	
		$tipe_kas=$_POST['tipe_kas'];
	$kd_kas=$_POST['kd_kas'];
		if($tipe_kas=="kredit"){
	 	$jumlah_order=mysql_fetch_array(mysql_query("select kode_pengeluaran from pengeluaran order by tgl_input desc"));
		
		
		$int = preg_replace("/[^0-9]/","",$jumlah_order[0]);;
		$num=($int+1);
		$kode = "OUT-".$num;
	
		
		$proyek=$_POST['proyek'];
	
		$subkategori=$_POST['kategori_out'];
		$qry_kategory=mysql_fetch_array(mysql_query("select kode_kategori_uang_keluar from sub_kategori_uang_keluar where kode_sub_kategori_uang_keluar='".$subkategori."'"));
		
		$kategori=$qry_kategory['kode_kategori_uang_keluar'];
		
		$jumlah=preg_replace("/[^0-9]/", "",$_POST['jumlah']);
	
		$tgl=$_POST['tgl'];
		$nama=$_POST['nama_ven'];
		$keterangan=$_POST['keterangan'];
				
        $update= mysql_query("INSERT INTO pengeluaran VALUES
		 ('".$kode."',
		 '".$proyek."', 
		 '".$kategori."', 
	 '".$subkategori."', 
			  '".$nama."',
			 '".$tgl."',
		 '".$jumlah."', 
		  '".$keterangan."',
		  '".$_SESSION["user_graha2"]."', 
		  '".date("Y-m-d H-i-s")."')");
 		}else{
			
			$jumlah_order=mysql_fetch_array(mysql_query("select kode_pemasukan from pemasukan order by tgl_input desc"));
		
		
		$int = preg_replace("/[^0-9]/","",$jumlah_order[0]);;
		$num=($int+1);
	 $kode = "IN-".$num;
	
		
		$proyek=$_POST['proyek'];
	$no_rumah=$_POST['no_rumah'];
		$kategori=$_POST['kategori'];
		
		$jumlah=preg_replace("/[^0-9]/", "",$_POST['jumlah']);
	
		$tgl=$_POST['tgl'];
		$nama=$_POST['nama'];
		$keterangan=$_POST['keterangan'];
				
        $update= mysql_query("INSERT INTO pemasukan VALUES
		 ('".$kode."',
		 '".$proyek."', 
		 '".$kategori."', 
	
		
			 
			  '".$nama."',
			   '".$no_rumah."', 
			 '".$tgl."',
		 '".$jumlah."', 
		  '".$keterangan ."',
		  '".$_SESSION["user_graha2"]."', 
		 
			  '".date("Y-m-d H-i-s")."')");
		}
	
 	 $update= mysql_query("INSERT INTO  input_kas_in VALUES
		 ('',
		 '".$kd_kas."', 
		 '".$kode."', 
	
		
			 
			  '".$tipe_kas."',
			  
			  '".date("Y-m-d H-i-s")."')");
	
       if($tipe_kas=="kredit"){
			
		   header("location:index.php?page=cash.out&pesan=success");
			
	   }else{
		   
		   header("location:index.php?page=cash.in&pesan=success");
	   }


}else{
	header("location:index.php?page=404");
}
?>