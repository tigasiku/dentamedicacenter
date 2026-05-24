<?php
 session_start();
ini_set('display_errors',0);
require_once "koneksi.php";
 

$idProvinsi = $_POST['idProvinsi'];
 
if($idProvinsi == ''){
     exit;
}else{
	
	
		  $sql = "
          SELECT
               *
          FROM
               sub_kategori_uang_keluar
          WHERE
               kode_kategori_uang_keluar = '$idProvinsi'
          
     ";
	
     $getNamaProvinsi = mysql_query($sql) ;
	
     while($data = mysql_fetch_array($getNamaProvinsi)){
		
          echo '<option value="'.$data['0'].'">'.$data['nomor_akun_sub'].' - '.$data['1'].'</option>';
     }

     exit;    
}
?>