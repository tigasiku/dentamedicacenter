<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){
	
$persen=$_POST['persen'];



$update=mysql_query("update persen_affiliate set persen_affiliate='".$persen."'");

			if ($update){
			header("location:index.php?page=persen.affiliate&pesan=success");
			}else{
			header("location:index.php?page=persen.affiliate&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>