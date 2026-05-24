
<?php
session_start();
	ini_set("post_max_size", "64M");
    ini_set("upload_max_filesize", "64M");
    ini_set("memory_limit", "20000M"); 
	date_default_timezone_set("Asia/Makassar");
error_reporting(0);
require "../koneksi.php";

$id = $_GET['id'];
$qry=mysql_query("select * from berita where id='".$id."'");
$row=mysql_fetch_array($qry);
	
		$imgSrc   = 'http://tigasiku.com/img/logo_email.png';
		$google_play   = 'http://tigasiku.com/img/google-store2.png'; 
$apple_store   = 'http://tigasiku.com/img/apple-store2.png'; 
$imgDesc  = 'Tiga Siku';  
$imgTitle = 'Tiga Siku'; 



$subjectParae0 =$row['judul'];	
$subjectParae1 = $row['isi_berita']; 

$subjectParae2 =$row['kategori']; 
$kategori =$row['kategori']; 
$judul =$row['judul'];
$image_name=$row['gambar'];

$qry2=mysql_query("select * from berita_detail where kd_artikel='".$id."' order by id");
	while($row2=mysql_fetch_array($qry2)){
		
		$subjudul .= '<h2 style="color: #404040;">'.$row2['subjudul'].'</h2>
		 <a href="http://blog.tigasiku.com/?page=news-details&id='.$id.'&judul='.$judul.'">
		 <img  width="100%"  style="border-width:0" src="http://tigasiku.com/img/blog/'.$row2['gambar'].'" alt="'.$imgDesc.'" title="'.$imgTitle.'"></a><p style="color: #404040;
    font-size: 16px;text-align:justify">'.$row2['isi_berita'].'</p>'; 
	}

$message = '<!DOCTYPE HTML>'. 
'<head>'. 
'
<style>
	.content_artikel img {
	width:100% !important;
	}
	

</style>
'.
'<meta http-equiv="content-type" content="text/html">'. 
'<title>'.$subjectParae0.' | Tiga Siku</title>'. 
'</head>'. 
'<body bgcolor="#363637" style="background-color:#363637">'.
'<br>'. 
'<div id="header" style="text-align: center;" align="center">'.
 '<img  width="496" height="80px" style="border-width:0" src="'.$imgSrc.'" alt="'.$imgDesc.'" title="'.$imgTitle.'">'. 
 '</div>'. 
 '<br>'.
'<div id="header" style="width: 80%;margin: 0 auto;padding: 10px;color: #333;text-align: center;background-color: #fff;font-family: Open Sans,Arial,sans-serif;border-radius: 5px 5px 5px 5px;
-moz-border-radius: 5px 5px 5px 5px;
-webkit-border-radius: 5px 5px 5px 5px;
border: 0px solid #000000;-webkit-box-shadow: 1px 1px 10px 0px rgba(168,168,168,1);
-moz-box-shadow: 1px 1px 10px 0px rgba(168,168,168,1);
box-shadow: 1px 1px 10px 0px rgba(168,168,168,1);">'. 

 '<a href="http://blog.tigasiku.com/?page=news-details&id='.$id.'&judul='.$judul.'" style="color:#333;text-decoration:none"><h2>'.$subjectParae0.'</h2></a>'.
 '<hr>'.

'<div id="outer" style="width: 90%;margin: 0 auto;margin-top: 10px;">'.  
   '<div id="inner" style="width: 94%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;text-align:justify;font-size: 13px;font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px;" class="content_artikel">'. 


	   '<a href="http://www.blog.tigasiku.com/?page=news-details&id='.$id.'&judul='.$judul.'"><img  width="100%"  style="border-width:0" src="http://tigasiku.com/img/blog/'.$image_name.'" alt="'.$imgDesc.'" title="'.$imgTitle.'"></a>'.
	 
	   '<hr>'.
	   '<p style="color: #404040;
    font-size: 16px;text-align:justify">'.$subjectParae1.'</p>'.
	
	  
	
	  '<p style="color: #404040;
    font-size: 16px;text-align:justify">'.$subjudul.'</p>'.
			
	     '<hr>'.
	  '<table>
	  <tr>
	  		<td width="30%"  >
			<a href="http://tigasiku.com"><img  width="90%"  style="border-width:0" src="http://tigasiku.com/img/tiga-siku-footer.png" alt="'.$imgDesc.'" title="'.$imgTitle.'"></a>
			
			</td>
			<td align="left"  width="70%" >
						 <div align="left"><span style="font-size:30px;color:#FF4B00">HEAD</span> <span style="font-size:30px;color:#333">OFFICE</span> <br />
                            
					  <p style=";color:#333">Jl. Boulevard Ruko Topaz Blok F 10<br />
                     Makassar - Sulawesi Selatan<br />     
                                
						  <i class="fa fa-phone"></i>   Telp : 0411 - 444381 <br />
                          <i class="fa fa-mobile"></i>   Mobile : 0811 - 444 - 0241 <br />
					
						  <i class="fa fa-envelope"></i> Email :  <a href="mailto:info@tigasiku.com" style="color:#FFCC00;font-weight:bold">info@tigasiku.com</a><br />
		      <i class="fa fa-globe"></i> Site : <a href="http://www.tigasiku.com" style="color:#FFCC00;font-weight:bold">www.tigasiku.com</a><br />
			  </div>
			</td>
	  </tr>
	  </table>
	  '.
	
       
   '</div>'.   
'</div>'. 
'</div>'.
'<br>'.
'<div style="text-align: center;">'.
 '<a href="'.$android.'" target="_blank" ><img  height="50"  style="border-width:0" src="'.$google_play.'" alt="'.$imgDesc.'" title="'.$imgTitle.'"></a>'. 
  '<a href="'.$ios.'" target="_blank" ><img  height="50"  style="border-width:0" src="'.$apple_store.'" alt="'.$imgDesc.'" title="'.$imgTitle.'"></a>'. 
'<div id="footer" style="height: 30px;text-align: center;padding: 10px;font-family: Verdena;color:#FFF;font-weight:bold">'. 
   'Copyright © TigaSiku. All Rights Reserved. '. 
'</div>'. 
'</body>'; 
	   
										$email_news="";
										$qry=mysql_query("select * from email_newsletter ");
										while($row=mysql_fetch_array($qry)){
										$email_news= $row['1'] ;
										
	  	$to      = 	$email_news;              
		$subject = ''.$subjectParae0.' | '.$kategori.' Tiga Siku';  
		$from    = "TigaSiku@tigasiku.com";     
		                      
		$headers  = "From: " . $from . "\r\n";
		//$headers .= "Reply-To: ". $from . "\r\n"; 
		$headers .='X-Mailer: PHP/' . phpversion();
		$headers .= "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
				
        $kirim  = mail($to, $subject, $message, $headers);	
	
 }
	   
		header("location:index.php?page=artikel&pesan=success");
	
	
?>