<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){


$kode = $_POST['kode'];
$title = $_POST['title'];
$sort_order = $_POST['sort_order'];
$text1=str_replace('<div>', '<p>',$_POST['isi']);
$text1=str_replace('</div>', '</p>',$text1);

$text1=str_replace("'", '"',$text1);
$isi_berita =($text1);

		
	 $ins = mysql_query("update riwayat set judul='".$title."',sort_by='".$sort_order."',isi='".$isi_berita."' where id='".$kode."'"); 
		
		
 
			header("location:index.php?page=post.riwayat&id=$kode&pesan=success");
			

}else{
	header("location:index.php?page=404");
}
?>