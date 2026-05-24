<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){



$text1=str_replace('<div>', '<p>',$_POST['isi']);
$text1=str_replace('</div>', '</p>',$text1);

$text1=str_replace("'", '"',$text1);
$isi_berita =($text1);

		
	 $ins = mysql_query("update footer set footer='".$isi_berita."'"); 
		
		
 
			header("location:index.php?page=footer&pesan=success");
			

}else{
	header("location:index.php?page=404");
}
?>