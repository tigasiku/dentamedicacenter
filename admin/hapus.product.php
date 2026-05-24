<?php
error_reporting(0);
require "../koneksi.php";

	$get = "delete from produk where id = '".$_GET['id']."'"; 	
	$del = mysql_query($get); 	
	unlink("../img/portfolio/full/".$_GET['gambar']."");
	unlink("../img/portfolio/thumb/".$_GET['gambar']."");
	
	
	
	
	
	// tampilkan pesan ketika $del telah dijalankan
	if($del){
		header("location:index.php?page=product&pesan=$_GET[id]");
	}
	else{
	header("location:index.php?page=product");
	}
	
?>
	
            

