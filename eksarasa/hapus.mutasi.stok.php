<?php
include "koneksi.php";

if(isset($_GET['id'])){
$kode_barang=$_GET['id'];
	
	

$delete=mysql_query("delete from mutasi_gudang where kode_mutasi_gudang='$kode_barang'");
	
	
	
	if($delete){
		header("location:index.php?page=arus.stok&kd_bank=$kode_barang&pesan=Data Berhasil Terhapus");
	}else{
		header("location:index.php?page=arus.stok&kd_bank=$kode_barang&pesan=Data Gagal Terhapus");
	}
}else{
	header("location:index.php?page=404");
}

?>