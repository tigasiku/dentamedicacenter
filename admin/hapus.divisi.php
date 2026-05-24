<?php
error_reporting(0);
require "../koneksi.php";

	$get = "delete from divisi where id = '".$_GET['id']."'"; 	
	$del = mysql_query($get); 	
	
	
	
	
	// tampilkan pesan ketika $del telah dijalankan
	if($del){
		header("location:index.php?page=divisi&pesan=$_GET[id]");
	}
	else{
	header("location:index.php?page=divisi");
	}
	
?>
	
            

