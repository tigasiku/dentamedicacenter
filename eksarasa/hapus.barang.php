<?php
include "koneksi.php";

if(isset($_GET['kode_barang'])){
$kode_barang=$_GET['kode_barang'];
	
	
	$qry=mysql_query("select  * from barang where kode_barang='".$kode_barang."'");
$row=mysql_fetch_array($qry);
	
		unlink("photo_barang/".$row['gambar']."");
	
$delete=mysql_query("delete from barang where kode_barang='$kode_barang'");
	
	
	
	if($delete){
		header("location:index.php?page=barang&pesan=Data Berhasil Terhapus");
	}else{
		header("location:index.php?page=barang&pesan=Data Gagal Terhapus");
	}
}else{
	header("location:index.php?page=404");
}

?>