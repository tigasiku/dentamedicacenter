<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){
	
$store_name=$_POST['store_name'];
$store_tagline=$_POST['store_tagline'];
$store_address=$_POST['store_address'];
$store_geocode=$_POST['store_geocode'];
$store_email=$_POST['store_email'];
$store_telp=$_POST['store_telp'];
$store_fax=$_POST['store_fax'];
$store_name=$_POST['store_name'];
$website=$_POST['website'];

$update=mysql_query("update stores set 	store_tagline='".$store_tagline."',store_address='".$store_address."',store_geocode='".$store_geocode."',store_email='".$store_email."' ,store_telp='".$store_telp."' ,website='".$website."' ,store_fax='".$store_fax."'  where store_name='".$store_name."'");

			if ($update){
			header("location:index.php?page=store.location&pesan=success");
			}else{
			header("location:index.php?page=store.location&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>