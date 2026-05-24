<?php
include "koneksi.php";
if(isset($_GET['id'])){
$username=$_GET['id'];
$kode_piutang=$_GET['kode_piutang'];

		$delete2=mysql_query("delete from bayar_piutang where kode_bayar_piutang='".$username."'");

	
		$delete5=mysql_query("delete from arus_kas where kode='".$kode_piutang."'");
	
	if($delete2){
		header("location:list_pembayaran_piutang.php?id=$kode_piutangpesan=Data Berhasil Terhapus");
	}else{
		header("location:list_pembayaran_piutang.php?id=$kode_piutangpesan=Data Gagal Terhapus");
	}
}else{
	header("location:index.php?page=404");
}

?>