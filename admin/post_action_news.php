<?php
session_start();
ini_set("post_max_size", "64M");
    ini_set("upload_max_filesize", "64M");
    ini_set("memory_limit", "20000M"); 
	date_default_timezone_set("Asia/Makassar");
error_reporting(0);
require "../koneksi.php";

$id = $_POST['id'];
$judul = $_POST['judul'];
$text1=str_replace('<div>', '<p>',$_POST['isi_berita']);
$text1=str_replace('</div>', '</p>',$text1);
$text1=str_replace("'", '"',$text1);
$isi_berita =($text1);
switch($_GET['action']){
	case "input": // jika post_action.php?action=input >> form action dari tambah berita
	 
$tanggal=date("Y-m-d");
	$ins = "insert into news values('','$judul' , '$isi_berita','$tanggal', '".$_SESSION["user_graha"]."')"; // input data ke table berita
	$exe = mysql_query($ins); // jalankan perintah $ins
	// tampilkan pesan ketika $exe telah dijalankan
	
	
	
	
	
		header("location:index.php?page=post.news&action=newpost&pesan=success");
	
	break;
	
	case "update": // jika post_action.php?action=update >> form action dari edit berita
	$update = "update news set judul = '$judul' , isi_berita = '$isi_berita' where id = '$id'"; // update data yang ada di table berita
	$exe = mysql_query($update);
	
	header("location:index.php?page=post.news&action=update&pesan=success");
	break;
}
?>