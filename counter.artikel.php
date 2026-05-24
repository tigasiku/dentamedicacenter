<?php
 
date_default_timezone_set('Asia/Makassar');
 
function initCounter2() {
 
     $ip = $_SERVER['REMOTE_ADDR']; // menangkap ip pengunjung
     $location = $_SERVER['PHP_SELF']; // menangkap server path
 
     //membuat log dalam tabel database 'counter'
   
	 $create_log = mysql_query("INSERT INTO counter_artikel(ip,kd_produk,location,tanggal)VALUES('$ip', '".$_GET['id']."', '$location','".date("Y-m-d H:i:s")."')");
	
}
 
function getCounter2($mode, $location = NULL) {
 
if(is_null($location)) {
     $location = $_SERVER['PHP_SELF'];
}
 
if($mode == "unique") {
     $get_res = mysql_query("SELECT DISTINCT ip FROM counter_artikel WHERE location = '$location' ");
}     else{
     $get_res = mysql_query("SELECT ip FROM counter_artikel WHERE location = '$location' ");
}
 
$res = mysql_num_rows($get_res);
 
return $res;
 
}
 
?>