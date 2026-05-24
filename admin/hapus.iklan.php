<?php
error_reporting(0);
require "../koneksi.php";

	$get = "delete from pasang_iklan where id_iklan = '$_GET[id]'"; 
	$del = mysql_query($get); 
	unlink("../img/iklan_gratis/full/".$_GET['gambar']."");
	unlink("../img/iklan_gratis/thumb/".$_GET['gambar']."");
	
	unlink("../img/iklan_gratis/full/".$_GET['gambar2']."");
	unlink("../img/iklan_gratis/thumb/".$_GET['gambar2']."");
	
	unlink("../img/iklan_gratis/full/".$_GET['gambar3']."");
	unlink("../img/iklan_gratis/thumb/".$_GET['gambar3']."");
	
	
	
	
	// tampilkan pesan ketika $del telah dijalankan
	if($del){
		header("location:index.php?page=iklan&pesan=Data $_GET[id] berhasil dihapus");
	}
	else{
	header("location:index.php?page=iklan&pesan=error");
	}
	
?>
	
            

