<?php
 
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
	echo '<option selected class="" value="">Semua</option>';
     while($data = mysql_fetch_array($getNamaProvinsi)){
		
          echo '<option value="'.$data['0'].'">'.$data['1'].'</option>';
     }

     exit;    
}
?>