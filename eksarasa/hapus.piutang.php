<?php
include "koneksi.php";
if(isset($_GET['id'])){
$username=$_GET['id'];
$delete=mysql_query("delete from piutang where kode_piutang='$username'");
	
	$cek_hutang=mysql_query("select * from bayar_piutang  kode_piutang='$username'");
	while($hutang=mysql_fetch_array($cek_hutang)){
			
			
	if(!empty($hutang['kode_cash_in'])){
		$delete3=mysql_query("delete from arus_kas where kode='".$hutang['kode_cash_in']."'");}
		//$delete4=mysql_query("delete from pemasukan where kode_pemasukan='".$hutang['kode_cash_in']."'");
		$delete2=mysql_query("delete from bayar_piutang where kode_bayar_piutang='".$hutang['kode_bayar_piutang']."'");
	}
	
	$delete5=mysql_query("delete from arus_kas where kode='".$username."'");
	
	if($delete){
		header("location:index.php?page=piutang&pesan=Data Berhasil Terhapus");
	}else{
		header("location:index.php?page=piutang&pesan=Data Gagal Terhapus");
	}
}else{
	header("location:index.php?page=404");
}

?>