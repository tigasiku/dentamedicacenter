<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){
	

$nama=$_POST['nama'];
$posisi=$_POST['posisi'];
 $fileName  = $_FILES['file']['name'];
 $fileSize  = $_FILES['file']['size'];
 $fileError  = $_FILES['file']['error'];
 $fileType  = $_FILES['file']['type'];


$filename =  $fileName;


if(!empty($_FILES['file']['name'])){
unlink("../iklan_footer/".$_POST['old']."");
}
$move = move_uploaded_file($_FILES['file']['tmp_name'], '../iklan_footer/'.$filename);

$update=mysql_query("update iklan_footer set gambar='".$filename."',id='".$_GET['id_produk']."' where posisi='".$posisi."'");
			if ($update){
			header("location:index.php?page=iklan.footer&pesan=success");
			}else{
			header("location:index.php?page=iklan.footer&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>