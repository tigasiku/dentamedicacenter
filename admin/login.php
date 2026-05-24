<?php
session_start();
date_default_timezone_set('Asia/Makassar');
include "../koneksi.php";

function anti_injection($pass2){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($pass2,ENT_QUOTES))));
  return $filter;
}
$userid=($_POST["username"]);
$passid=(md5($_POST["password"]));
$sql="select * from admin where username='$userid' and pass='$passid' and status ='Y'";
$kueri=mysql_query($sql);
$jumlah=mysql_num_rows($kueri);
$data=mysql_fetch_array($kueri);
if ($jumlah==1 ){
	
	$_SESSION["user_graha2"] = $data["username"];
	$_SESSION["pass_graha2"] = $data["pass"];
	$_SESSION["loglevel_graha"] = $data["level"];
	

		
	echo 		$_SESSION['nama_graha'] =  $data['nama'];
					$_SESSION['id_fb'] =  $data['id_fb'];
			$_SESSION['jenis_kelamin'] =  $data['jenis_kelamin'];
			$_SESSION['photo'] =  $data['photo'];
			

			unset($_SESSION['pesan_user_login']);
		
	
	mysql_query("update admin set last='".date("Y-m-d H:i:s")."' where username='$userid' and pass='$passid'");
}else{
	$_SESSION['pesan_user_login'] =  "Username atau Password salah";
}
header("Location:index.php");

?>