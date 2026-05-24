<?php 
@date_default_timezone_set("Asia/Makassar");
include("koneksi.php");
@session_start();
include("counter.php");
initCounter();
?>
<?php
function gantiformat($nomorhp) {
     //Terlebih dahulu kita trim dl
     $nomorhp = trim($nomorhp);
    //bersihkan dari karakter yang tidak perlu
     $nomorhp = strip_tags($nomorhp);     
    // Berishkan dari spasi
    $nomorhp= str_replace(" ","",$nomorhp);
    // bersihkan dari bentuk seperti  (022) 66677788
     $nomorhp= str_replace("(","",$nomorhp);
    // bersihkan dari format yang ada titik seperti 0811.222.333.4
     $nomorhp= str_replace(".","",$nomorhp); 

     //cek apakah mengandung karakter + dan 0-9
     if(!preg_match('/[^+0-9]/',trim($nomorhp))){
         // cek apakah no hp karakter 1-3 adalah +62
         if(substr(trim($nomorhp), 0, 3)=='+62'){
             $nomorhp= trim($nomorhp);
         }
         // cek apakah no hp karakter 1 adalah 0
        elseif(substr($nomorhp, 0, 1)=='0'){
             $nomorhp= '+62'.substr($nomorhp, 1);
         }
     }
     return $nomorhp;
 }
?>
<?php
include("function.php");
?>
<!DOCTYPE html>
<!-- saved from url=(0027)http://dianadentalcare.com/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
 
        <link rel="icon" type="image/png" href="img/icon/icon.ico">

         <?php  include("og.facebook.php");  ?>
   
	<?php  include("title.php");  ?>
<!-- /all in one seo pack -->

		<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>
<link rel="stylesheet" id="contact-form-7-css" href="css/styles.css" type="text/css" media="all">
<link rel="stylesheet" id="cff-css" href="css/cff-style.css" type="text/css" media="all">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<link rel="stylesheet" id="google-font-css" href="css/css" type="text/css" media="all">
<?php /*<link rel="stylesheet" id="font-awesome-css" href="css/font-awesome.min(2).css" type="text/css" media="all">*/ ?>
<link rel="stylesheet" id="ddc-custom-css-css" href="css/app.css" type="text/css" media="all">



<script type="text/javascript">
(function(url){
	if(/(?:Chrome\/26\.0\.1410\.63 Safari\/537\.31|WordfenceTestMonBot)/.test(navigator.userAgent)){ return; }
	var addEvent = function(evt, handler) {
		if (window.addEventListener) {
			document.addEventListener(evt, handler, false);
		} else if (window.attachEvent) {
			document.attachEvent('on' + evt, handler);
		}
	};
	var removeEvent = function(evt, handler) {
		if (window.removeEventListener) {
			document.removeEventListener(evt, handler, false);
		} else if (window.detachEvent) {
			document.detachEvent('on' + evt, handler);
		}
	};
	var evts = 'contextmenu dblclick drag dragend dragenter dragleave dragover dragstart drop keydown keypress keyup mousedown mousemove mouseout mouseover mouseup mousewheel scroll'.split(' ');
	var logHuman = function() {
		var wfscr = document.createElement('script');
		wfscr.type = 'text/javascript';
		wfscr.async = true;
		wfscr.src = url + '&r=' + Math.random();
		(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(wfscr);
		for (var i = 0; i < evts.length; i++) {
			removeEvent(evts[i], logHuman);
		}
	};
	for (var i = 0; i < evts.length; i++) {
		addEvent(evts[i], logHuman);
	}
})('//dianadentalcare.com/?wordfence_logHuman=1&hid=4118FACB68AC70317526F0AB4141A380');
</script>    <style type="text/css">undefined</style><script type="text/javascript" async src="Diana Dental Care_files/saved_resource"></script></head>
    <body>
    <?php include("menu.php") ?>
  
   <?php include("konten.php") ?>

    
	    <!-- Footer -->
	    <?php include("footer.php") ?>
    <!-- Custom Facebook Feed JS -->
<script type="text/javascript">
var cfflinkhashtags = "true";
</script>
<script type="text/javascript">
/* <![CDATA[ */
var _wpcf7 = {"loaderUrl":"http:\/\/dianadentalcare.com\/wp-content\/plugins\/contact-form-7\/images\/ajax-loader.gif","recaptchaEmpty":"Please verify that you are not a robot.","sending":"Sending ..."};
/* ]]> */
</script>
<script type="text/javascript" src="Diana Dental Care_files/scripts.js"></script>
<script type="text/javascript" src="Diana Dental Care_files/cff-scripts.js"></script>
<script type="text/javascript">
/* <![CDATA[ */
var sb_instagram_js_options = {"sb_instagram_at":"1636165384.97584da.56a165851df74e0fae165e376ab6f50b"};
/* ]]> */
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js" integrity="sha512-9Xuq3jB9VNnkt8gg0bXvMulI33N4nI/NUb8LGsfSgvBbVA0U3bC1ZExEvcb5ka5nyfSnhZX0szvZFgGiSu8UAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="Diana Dental Care_files/app.js"></script>
<script type="text/javascript" src="Diana Dental Care_files/wp-embed.min.js"></script>
   
</body></html>