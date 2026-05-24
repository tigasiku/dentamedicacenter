<?php
session_start();
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){
$old=md5($_POST['old']);
$new=$_POST['new'];
$rnew=$_POST['rnew'];

if ($old==$_SESSION["pass_graha"]){
	if ($new==$rnew){
		mysql_query("update admin set password=md5('$new'),pass='$new' where username='".$_SESSION["user_graha"]."' and level='".$_SESSION["loglevel_graha"]."'");
		header("location:index.php?page=ganti.pass&pesan=success");
	} else {
		header("location:index.php?page=ganti.pass&pesan=failed");
	}
}else {
	header("location:index.php?page=ganti.pass&pesan=failed");
}
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>