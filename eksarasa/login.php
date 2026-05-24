<?php
session_start();
date_default_timezone_set('Asia/Makassar');
include "koneksi.php";


function anti_injection($pass2){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($pass2,ENT_QUOTES))));
  return $filter;
}
$userid=anti_injection($_POST["username"]);
$passid=anti_injection(md5($_POST["password"]));



$page=$_POST["page"];
$sql="select * from admin where username='$userid' and pass='$passid' and status ='Y'";
$kueri=mysql_query($sql);
$jumlah=mysql_num_rows($kueri);
$data=mysql_fetch_array($kueri);
if ($jumlah==1 ){
	
	$_SESSION["user_graha3"] = $data["username"];
	$_SESSION["pass_graha3"] = $data["pass"];
	$_SESSION["loglevel_graha3"] = $data["level"];
	
$_SESSION["loglevel"] = $data["level"];
		
			$_SESSION['nama_graha'] =  $data['nama'];
			$_SESSION['id_fb'] =  $data['id_fb'];
			$_SESSION['jenis_kelamin'] =  $data['jenis_kelamin'];
			$_SESSION['photo'] =  $data['photo'];
			$_SESSION['email'] =  $data['email'];
		
		$_SESSION['loglevel_agung'] =  "Agung";
			$_SESSION['masuk_lagi'] =  "Aktif";
			$_SESSION['password_lagi'] =  "Aktif";
			$_SESSION['level_lagi'] =  "Aktif";
	
	setcookie("type",  $data["username"], time()+(10 * 365 * 24 * 60 * 60));
	
	
	mysql_query("update admin set last='".date("Y-m-d H:i:s")."' where username='$userid' and pass='$passid'");
}
header("Location:index.php?page=$page");

?>