<?php
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
session_start();
if (isset($_POST['submit'])){

$alamat=$_POST['alamat'];
$telp=$_POST['no_telp'];
$hp=$_POST['no_hp'];


$update = mysql_query("update cabang set alamat = '".$alamat."', no_telp = '".$telp."', no_hp = '".$hp."' where kd_cabang = '".$_SESSION["kd_cabang"]."'");
			if ($update){
			header("location:index.php?page=info.cabang&pesan=success");
			}else{
			header("location:index.php?page=info.cabang&pesan=error");}

}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>