<?php
session_start();

require "../koneksi.php";
$id = $_POST['id'];
$pertanyaan = $_POST['pertanyaan'];

$text1=str_replace("'", '"',$_POST['jawaban']);
$jawaban = $text1;


switch($_GET['action']){
	case "input": // jika post_action.php?action=input >> form action dari tambah berita
	 

	$ins = "insert into faq values('','$pertanyaan' , '$jawaban')"; // input data ke table berita
	$exe = mysql_query($ins); // jalankan perintah $ins
	// tampilkan pesan ketika $exe telah dijalankan
	
	
	
	
	
		header("location:index.php?page=post.faq&action=newpost&pesan=success");
	
	break;
	
	case "update": // jika post_action.php?action=update >> form action dari edit berita
	
	$update = "UPDATE faq SET pertanyaan='$pertanyaan',jawaban='$jawaban' WHERE id = '$id'";
	$exe = mysql_query($update);
	
	header("location:index.php?page=post.faq&action=edit&id=$id&pesan=success");
	break;
}
?>