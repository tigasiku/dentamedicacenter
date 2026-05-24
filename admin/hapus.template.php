<?php
error_reporting(0);
require "../koneksi.php";

	$get = "delete from theme_website where kd_theme = '$_GET[id]'"; 
	$del = mysql_query($get); 
	unlink("../img/theme_website/".$_GET['gambar']."");
	
	
	
	
	// tampilkan pesan ketika $del telah dijalankan
	if($del){
		header("location:index.php?page=template&pesan=Data $_GET[id] berhasil dihapus");
	}
	else{
	header("location:index.php?page=iklan&pesan=error");
	}
	
?>
	
            

