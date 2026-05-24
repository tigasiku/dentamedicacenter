<?php
set_time_limit(50);
session_start();
include "koneksi.php";

	date_default_timezone_set("Asia/Makassar");

	
	
	$email = htmlspecialchars($_POST['email_newsletter']);
	if(!empty($email)) {
		$cek=mysql_num_rows(mysql_query("select id from email_newsletter where email ='".$email."'"));
			if($cek <= 0){
			$insert=mysql_query("insert into email_newsletter values('','".$email."','".date("Y-m-d H:i:s")."')");}
	}
	
	
?>