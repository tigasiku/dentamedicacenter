<?php
set_time_limit(0);
session_start();
include "../koneksi.php";
$store=mysql_fetch_array(mysql_query("select * from stores"));
	date_default_timezone_set("Asia/Makassar");
	$email = ($_POST['email']);	
	

		$domain="http://".$store['website'];
		define('ROOT', 'http://'.$store['website'].'/verf/');
		
     
		$subject=$_POST['subject'];
	
		$isi_berita=$_POST['isi_berita'];
		
		
		
        $query = mysql_query("INSERT INTO broadcast_mail VALUES ('','$subject','$isi_berita','".date("Y-m-d H:i:s")."')") ;
		

		$_SESSION["user_graha"] = $email;
		$_SESSION["pass_graha"] = $password;
		$_SESSION['nama_graha'] =  $nama;
	
		$imgSrc   = ''.$domain.'/img/LOGO_EMAIL.png';
				
$imgDesc  = $store['website'];  
$imgTitle = $store['store_name']; 

$subjectPara1 = $isi_berita;

$message = '<!DOCTYPE HTML>'. 
'<head>'. 
'<meta http-equiv="content-type" content="text/html">'. 
'<title>'.$subject.' | '.$store['store_name'].'</title>'. 
'</head>'. 
'<body bgcolor="#f1f1f1">'. 

'<div id="header" style="width: 80%;margin: 0 auto;padding: 10px;color: #333;text-align: center;background-color: #fff;font-family: Open Sans,Arial,sans-serif;border-radius: 5px 5px 5px 5px;
-moz-border-radius: 5px 5px 5px 5px;
-webkit-border-radius: 5px 5px 5px 5px;
border: 0px solid #000000;-webkit-box-shadow: 1px 1px 10px 0px rgba(168,168,168,1);
-moz-box-shadow: 1px 1px 10px 0px rgba(168,168,168,1);
box-shadow: 1px 1px 10px 0px rgba(168,168,168,1);">'. 


'<div id="header" style="text-align: center;">'.
 '<img  width="350"  style="border-width:0" src="'.$imgSrc.'" alt="'.$imgDesc.'" title="'.$imgTitle.'">'. 
 '</div>'.
  '<hr>'. 
 '<br>'.
  '<h2>'.$subject.',</h2>'.
'<div id="outer" style="width: 100%;margin: 0 auto;margin-top: 10px;">'.  
   '<div id="inner" style="width: 94%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;font-size: 13px;font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px;text-align: left">'. 
    	
       '<p>'.$subjectPara1.'</p>'. 
      
       
   '</div>'.   
'</div>'. 
'</div>'.
'<br>'.

'<div id="footer" style="height: 30px;text-align: center;padding: 10px;font-family: Verdena;color:#000">'. 
   'Copyright © <strong>tigasiku.com</strong>. All Rights Reserved. '. 
'</div>'. 
'</body>'; 
	   
	  	$to      = "andiagungadrian@gmail.com";              
		$subject = ''.$subject.' | '.$store['store_name'].'';  
		$from    = $store['store_email'];     
		                      
		$headers  = "From: " . $from . "\r\n";
		//$headers .= "Reply-To: ". $from . "\r\n";   
		$headers .= "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
				
        $kirim  = mail($to, $subject, $message, $headers);
	
	
		header("location:index.php?page=broadcast&pesan=success");	

?>