<?php
session_start();
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){
	
	
	date_default_timezone_set("Asia/Makassar");
	$tgl_skrg=date("Y-m-d H:i:s");
	$no_ref	= $_POST['no_ref'];
	$tanggal=$_POST['tanggal'];
	$ket=mysql_escape_string($_POST['ket']);
	$nama_vendor=mysql_escape_string($_POST['nama_vendor']);
	$pembayaran=$_POST['pembayaran'];
	
	$gudang=$_POST['gudang'];
	foreach($_POST['pname'] as $key => $name){
	$kode=$_POST['kode'][$key];
		
	$satuan=$_POST['satuan'][$key];
		
	$pprice=$_POST['harga_jual'][$key];
		
		
		$h_beli=$_POST['harga_beli'][$key];
		
		if($h_beli > $pprice){
			
			$update=mysql_query("update barang set harga_beli='".$h_beli."' where kode_barang='".$kode."'");
		}
		
	$qty=$_POST['qty'][$key];
	$sub_total=$_POST['sub_total'][$key];
	
$insert_d=mysql_query("insert into pembelian_detail  values('','$no_ref','$kode','$qty','$satuan','$h_beli','$sub_total','$gudang')");

}
	
	$grandtotal=$_POST['grandtotal'];

	$insert=mysql_query("insert into pembelian value('$no_ref','$tanggal','$nama_vendor','$pembayaran','$grandtotal','$ket')");
	
	$jumlah_order=mysql_fetch_array(mysql_query("select kode_pengeluaran from pengeluaran order by tgl_input desc"));
		
		
		$int = preg_replace("/[^0-9]/","",$jumlah_order[0]);;
		$num=($int+1);
		echo $kode = "OUT-".$num;
	$kas=$_POST['kas'];
	if($pembayaran=="Kredit"){
		
		$kode_piutang='H'.date("ymdHis");
		$jum_piutang=$grandtotal-$_POST['jumlah_bayar'];
		$tgl_jatuh_tempo=$_POST['tgl_jatuh_tempo'];
		
		
		$insert_piutang=mysql_query("insert into hutang value('$kode_piutang','1','$nama_vendor','$no_ref','$jum_piutang','$tanggal','$tgl_jatuh_tempo','Y')");
		
		if($_POST['jumlah_bayar']>0){
			
			$jumlah_bayar=$_POST['jumlah_bayar'];
			
			
			$insert_alur_kas=mysql_query("insert into arus_kas value('','".$kas."','kredit','Pembelian - $nama_vendor','$jumlah_bayar','".$tanggal.date(" H:i:s")."','".$no_ref."')");
			//$insert_cash_out=mysql_query("insert into pengeluaran value('".$kode."','7','10','$nama_vendor','$tanggal','$jumlah_bayar','$no_ref','".$_SESSION["user_graha3"]."','".date("Y-m-d H:i:s")."')");
		}
		
	}else{
		$insert_alur_kas=mysql_query("insert into arus_kas value('','".$kas."','kredit','Pembelian - $nama_vendor','$grandtotal','".$tanggal.date(" H:i:s")."','".$no_ref."')");
		//$insert_cash_out=mysql_query("insert into pengeluaran value('".$kode."','7','10','$nama_vendor','$tanggal','$grandtotal','$no_ref','".$_SESSION["user_graha3"]."','".date("Y-m-d H:i:s")."')");
	}
		
	
	
	
	if ($insert and $insert_d){
	header("location:index.php?page=tambah.pembelian&pesan=success");
	}else{
	header("location:index.php?page=tambah.pembelian&pesan=error");
	}
}else{
	header("location:index.php?page=404");
}

?>