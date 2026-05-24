<?php
session_start();
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){
	
	
	date_default_timezone_set("Asia/Makassar");
	$tgl_skrg=date("Y-m-d H:i:s");
	$no_ref	= $_POST['no_ref'];
	$tanggal=$_POST['tanggal'];
	$ket=$_POST['ket'];
	$pembayaran=$_POST['pembayaran'];
	$nama_vendor=$_POST['nama_vendor'];
	$gudang=$_POST['gudang'];
	$sql2 = "delete from penjualan_detail where no_jual='$no_ref'";
	mysql_query ($sql2);
	foreach($_POST['pname'] as $key => $name){
	$kode=$_POST['kode'][$key];

	$satuan=$_POST['satuan'][$key];
	$pprice=$_POST['harga_jual'][$key];
		$h_beli=$_POST['harga_beli'][$key];
	$qty=$_POST['qty'][$key];
	$sub_total=$_POST['sub_total'][$key];
	
$insert_d=mysql_query("insert into penjualan_detail  values('','$no_ref','$kode','$qty','$satuan','$h_beli','$pprice','$sub_total','$gudang')");
			 $subbeli=$h_beli*$qty;	
		@$totalbeli=$subbeli+@$totalbeli;
}
	
	$grandtotal=$_POST['grandtotal'];

	$insert=mysql_query("update penjualan set tgl_jual='$tanggal',total='$grandtotal',ket='$ket',customer='".$nama_vendor."',pembayaran='".$pembayaran."' where no_jual='".$no_ref."'");
	
	$cek_piutang=mysql_fetch_array(mysql_query("select kode_piutang from piutang where keterangan='".$no_ref."'"));
	
	if(!empty($cek_piutang['kode_piutang'])){
	$delete_arus_piutang=mysql_query("delete from arus_kas where kode='".$cek_piutang['kode_piutang']."'");}
	
	
	$delete2=mysql_query("delete from arus_kas where kode='$no_ref'");
	
		$delete=mysql_query("delete from pemasukan where  keterangan='".$no_ref."'");
	$delete3=mysql_query("delete from piutang where  keterangan='".$no_ref."'");
	
	$sql4= "delete from pengeluaran where keterangan='$no_ref'";
	mysql_query ($sql4);	
	
	$jumlah_order=mysql_fetch_array(mysql_query("select kode_pemasukan from pemasukan order by tgl_input desc,kode_pemasukan desc"));
		
	
	
		$int = preg_replace("/[^0-9]/","",$jumlah_order[0]);;
		$num=($int+1);
		echo $kode = "IN-".$num;
	
	
	$jumlah_order2=mysql_fetch_array(mysql_query("select kode_pengeluaran from pengeluaran order by tgl_input desc,kode_pengeluaran desc"));
		
		
			$int2 = preg_replace("/[^0-9]/","",$jumlah_order2[0]);;
			$num2=($int2+1);
			echo $kode2= "OUT-".$num2;
	
$kas=$_POST['kas'];
	if($pembayaran=="Kredit"){
		
		$kode_piutang='P'.date("ymdHis");
		$jum_piutang=$grandtotal-$_POST['jumlah_bayar'];
		$tgl_jatuh_tempo=$_POST['tgl_jatuh_tempo'];
		
		
		$insert_piutang=mysql_query("insert into piutang value('$kode_piutang','1','$nama_vendor','$no_ref','$jum_piutang','$tanggal','$tgl_jatuh_tempo','Y')");
		
		if($_POST['jumlah_bayar']>0){
			$jumlah_bayar=$_POST['jumlah_bayar'];
			$insert_alur_kas=mysql_query("insert into arus_kas value('','".$kas."','debet','Penjualan - $nama_vendor','$jumlah_bayar','".$tanggal.date(" H:i:s")."','".$no_ref."')");
			$insert_cash_in=mysql_query("insert into pemasukan value('".$kode."','1','$nama_vendor','$tanggal','$jumlah_bayar','$no_ref','".$_SESSION["user_graha3"]."','".date("Y-m-d H:i:s")."')");
		}
		
	}elseif($pembayaran=="Cash"){
		$insert_cash_in=mysql_query("insert into pemasukan value('".$kode."','1','$nama_vendor','$tanggal','$grandtotal','$no_ref','".$_SESSION["user_graha3"]."','".date("Y-m-d H:i:s")."')");
		$insert_alur_kas=mysql_query("insert into arus_kas value('','".$kas."','debet','Penjualan - $nama_vendor','$grandtotal','".$tanggal.date(" H:i:s")."','".$no_ref."')");
	}
		
	$insert_cash_out=mysql_query("insert into pengeluaran value('".$kode2."','7','10','$nama_vendor','$tanggal','$totalbeli','$no_ref','".$_SESSION["user_graha3"]."','".date("Y-m-d H:i:s")."')");

	if ($insert and $insert_d){
	header("location:index.php?page=edit.penjualan&no_jual=$no_ref&pesan=success");
	}else{
	header("location:index.php?page=edit.penjualan&no_jual=$no_ref&pesan=error");
	}
}else{
	header("location:index.php?page=404");
}

?>