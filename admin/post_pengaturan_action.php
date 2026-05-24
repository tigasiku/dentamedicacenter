<?php
session_start();
ini_set("post_max_size", "64M");
    ini_set("upload_max_filesize", "64M");
    ini_set("memory_limit", "20000M"); 
	date_default_timezone_set("Asia/Makassar");
error_reporting(0);
require "../koneksi.php";

$id = $_POST['id'];

$isi_berita = $_POST['isi_berita'];

	
switch($_GET['action']){
	case "input": // jika post_action.php?action=input >> form action dari tambah berita

	
	break;
	
	case "update": // jika post_action.php?action=update >> form action dari edit berita
	$update = "update pengaturan set isi = '$isi_berita' where kode = '$id'"; // update data yang ada di table berita
	$exe = mysql_query($update);
	
	header("location:index.php?page=post.pengaturan&action=edit&id=$id&pesan=success");
	break;
}
?>