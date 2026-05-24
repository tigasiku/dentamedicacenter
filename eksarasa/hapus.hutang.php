<?php
include "koneksi.php";
if(isset($_GET['id'])){
$username=$_GET['id'];
	
$delete=mysql_query("delete from hutang where kode_hutang='$username'");
	
	$cek_hutang=mysql_query("select * from bayar_hutang  kode_hutang='$username'");
	while($hutang=mysql_fetch_array($cek_hutang)){
			
			
	if(!empty($hutang['kode_cash_out'])){
		$delete3=mysql_query("delete from arus_kas where kode='".$hutang['kode_cash_out']."'");}
		//$delete4=mysql_query("delete from pengeluaran where kode_pengeluaran='".$hutang['kode_cash_out']."'");
		$delete2=mysql_query("delete from bayar_hutang where kode_bayar_hutang='".$hutang['kode_bayar_hutang']."'");
	}
	
	$delete5=mysql_query("delete from arus_kas where kode='".$username."'");
	if($delete){
		header("location:index.php?page=hutang&pesan=Data Berhasil Terhapus");
	}else{
		header("location:index.php?page=hutang&pesan=Data Gagal Terhapus");
	}
}else{
	header("location:index.php?page=404");
}

?>