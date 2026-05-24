<?php
 
date_default_timezone_set('Asia/Makassar');
 
function initCounter() {
 
     $ip = $_SERVER['REMOTE_ADDR']; // menangkap ip pengunjung
     $location = $_SERVER['PHP_SELF']; // menangkap server path
 
     //membuat log dalam tabel database 'counter'
     $num=mysql_num_rows(mysql_query("select ip from counter where ip='".$ip."' and day(tanggal)='".date("d")."' and month(tanggal)='".date("m")."' and year(tanggal)='".date("Y")."'"));
	 if($num <= 0){
	 $create_log = mysql_query("INSERT INTO counter(ip,location,tanggal)VALUES('$ip', '$location','".date("Y-m-d H:i:s")."')");
	 }
}
 
function getCounter($mode, $location = NULL) {
 
if(is_null($location)) {
     $location = $_SERVER['PHP_SELF'];
}
 
if($mode == "unique") {
     $get_res = mysql_query("SELECT DISTINCT ip FROM counter WHERE location = '$location' ");
}     else{
     $get_res = mysql_query("SELECT ip FROM counter WHERE location = '$location' ");
}
 
$res = mysql_num_rows($get_res);
 
return $res;
 
}
 
?>