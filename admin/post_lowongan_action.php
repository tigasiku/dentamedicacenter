<?php
session_start();
	ini_set("post_max_size", "64M");
    ini_set("upload_max_filesize", "64M");
    ini_set("memory_limit", "20000M"); 
	date_default_timezone_set("Asia/Makassar");
error_reporting(0);
require "../koneksi.php";

$id = $_POST['id'];
$perusahaan = $_POST['perusahaan'];
$judul = $_POST['judul'];


$text1=str_replace('<div>', '<p>',$_POST['job']);
$text1=str_replace('</div>', '</p>',$text1);
$text2=str_replace('<div>', '<p>',$_POST['requirements']);
$text2=str_replace('</div>', '</p>',$text2);

$text1=str_replace("'", '"',$text1);
$text2=str_replace("'", '"',$text2);
 $job =($text1);
 $requirements = ($text2);


$tanggal = date("Y-m-d");

	
switch($_GET['action']){
	case "input": // jika post_action.php?action=input >> form action dari tambah berita
	 

	$ins = "insert into lowongan_kerja values('','$perusahaan' , '$judul', '$requirements','$job','$tanggal')"; // input data ke table berita
	$exe = mysql_query($ins); // jalankan perintah $ins
	// tampilkan pesan ketika $exe telah dijalankan
	
	
	
	
	
		header("location:index.php?page=post.lowongan&action=newpost&pesan=success");
	
	break;
	
	case "update": // jika post_action.php?action=update >> form action dari edit berita
	$update = "update   lowongan_kerja set kd_perusahaan = '$perusahaan'  ,requirements = '$requirements' ,job='$job' , judul_lowongan='$judul' where kd_lowongan = '$id'"; // update data yang ada di table berita
	$exe = mysql_query($update);
	
	header("location:index.php?page=post.lowongan&action=edit&id=$id&pesan=success");
	break;
}
?>