<?php
session_start();
date_default_timezone_set("Asia/Makassar");
include "../koneksi.php";
$id=$_POST['id'];
$cek=mysql_fetch_array(mysql_query("select file from fasilitas_detail where id='".$id."'"));
unlink("img/fasilitas/full/".$cek['file']."");
unlink("img/fasilitas/thumb/".$cek['file']."");

$sql = "delete from fasilitas_detail where id='$id'";
mysql_query ($sql);

?>
