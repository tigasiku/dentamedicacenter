<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){


$kode = $_POST['kode'];
$title = $_POST['title'];
$profesi = $_POST['profesi'];
$sort_order = $_POST['sort_order'];
$text1=str_replace('<div>', '<p>',$_POST['isi']);
$text1=str_replace('</div>', '</p>',$text1);

$text1=str_replace("'", '"',$text1);
$isi_berita =($text1);

		
	 $ins = mysql_query("insert into testimoni values('','".$title."','".$profesi."','".$isi_berita."','".$sort_order."')"); 
		
		
 
			header("location:index.php?page=tambah.testimoni&pesan=success");
			

}else{
	header("location:index.php?page=404");
}
?>