<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){
	
$store_name=$_POST['store_name'];
$store_fb=$_POST['store_fb'];
$store_twitter=$_POST['store_twitter'];
$store_instagram=$_POST['store_instagram'];
$store_google_plus=$_POST['store_google_plus'];
$store_pinterest=$_POST['store_pinterest'];
$store_linkedin=$_POST['store_linkedin'];


$update=mysql_query("update stores set store_fb='".$store_fb."',store_twitter='".$store_twitter."',store_instagram='".$store_instagram."',store_instagram='".$store_instagram."',store_pinterest='".$store_pinterest."',store_linkedin='".$store_linkedin."'  where store_name='".$store_name."'");

			if ($update){
			header("location:index.php?page=sosial.media&pesan=success");
			}else{
			header("location:index.php?page=sosial.media&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>