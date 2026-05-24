<?php
set_time_limit(0);
session_start();
include "koneksi.php";

@$store=mysql_fetch_array(mysql_query("select * from stores"));	
$domain="http://".$store['website'];

		date_default_timezone_set("Asia/Makassar");
		$email = mysql_real_escape_string($_POST['your-email']);	
		$nama= mysql_real_escape_string($_POST['nama']);
		$hp= mysql_real_escape_string($_POST['hp']);
		$deskripsi= mysql_real_escape_string($_POST['deskripsi']);
		
		$tanggal=date("Y-m-d H:i:s");
			
		
        $query = mysql_query("INSERT INTO contact VALUES ('', '$nama', '$hp', '$email', '$deskripsi','$tanggal')") ;

	
	
		/*$imgSrc   = $domain.'/img/dentamedica.png';
		$google_play   = 'http://tigasiku.com/img/google-store2.png'; 
$apple_store   = 'http://tigasiku.com/img/apple-store2.png'; 
$imgDesc  = $store['store_name'];  
$imgTitle = $store['store_name']; 

$subjectParae0 ='<b>Nama : </b>'.$nama.'<br>
		<b>Email : </b>'.$email.'<br>
		<b>No Telp : </b>'.$hp.'<br>';	


$subjectParae4 = '<h3>Reason For Appointment</h3><br>'.$deskripsi; 

$message = '<!DOCTYPE HTML>'. 
'<head>'. 
'<meta http-equiv="content-type" content="text/html">'. 
'<title>Appointment | '.$store['store_name'].'</title>'. 
'</head>'. 
'<body bgcolor="#363637">'. 
'<div id="header" style="text-align: center;">'.
 '<img  width="496"  style="border-width:0" src="'.$imgSrc.'" alt="'.$imgDesc.'" title="'.$imgTitle.'">'. 
 '</div>'. 
 '<br>'.
'<div id="header" style="width: 80%;margin: 0 auto;padding: 10px;color: #333;text-align: center;background-color: #fff;font-family: Open Sans,Arial,sans-serif;border-radius: 5px 5px 5px 5px;
-moz-border-radius: 5px 5px 5px 5px;
-webkit-border-radius: 5px 5px 5px 5px;
border: 0px solid #000000;-webkit-box-shadow: 1px 1px 10px 0px rgba(168,168,168,1);
-moz-box-shadow: 1px 1px 10px 0px rgba(168,168,168,1);
box-shadow: 1px 1px 10px 0px rgba(168,168,168,1);">'. 
 '<h3>Appointment</h3>'.
 '<hr>'.

'<div id="outer" style="width: 80%;margin: 0 auto;margin-top: 10px;">'.  
   '<div id="inner" style="width: 94%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;font-size: 13px;font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px;text-align: left">'. 
    	
	   '<p>'.$subjectParae0.'</p>'. 
	   
      
	   
	   '<p>'.$subjectParae4.'</p>'. 
       
   '</div>'.   
'</div>'. 
'</div>'.
'<br>'.

'<div id="footer" style="height: 30px;text-align: center;padding: 10px;font-family: Verdena;color:#000">'. 
   'Copyright © TigaSiku. All Rights Reserved. '. 
'</div>'. 
'</body>'; 
	   
	  	$to      = $store['store_email'];              
		$subject = 'Appointment | '.$store['store_name'];  
		$from    = $_POST['your-email'];     
		                      
		$headers  = "From: " . $from . "\r\n";
		//$headers .= "Reply-To: ". $from . "\r\n"; 

		$headers .= "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
				
        $kirim  = mail($to, $subject, $message, $headers);	
	
	*/
		header("location:index.php?page=contact.us#contact&pesan=success");	

?>