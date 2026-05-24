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
               kategori_piutang
          WHERE
               kode_klasifikasi = '$idProvinsi' order by nomor_akun
          
     ";
	
     $getNamaProvinsi = mysql_query($sql) ;
echo '<option selected class="" value="">Semua</option>';
     while($data = mysql_fetch_array($getNamaProvinsi)){
		
          echo '<option value="'.$data['0'].'">'.$data['nomor_akun'].' - '.$data['1'].'</option>';
     }

     exit;    
}
?>