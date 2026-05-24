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
               sub_kategori_barang
          WHERE
               kategori = '$idProvinsi'
          
     ";
     $getNamaProvinsi = mysql_query($sql) ;
	echo '<option selected class="" value="">Semua</option>';
     while($data = mysql_fetch_array($getNamaProvinsi)){
		
          echo '<option value="'.$data['0'].'">'.$data['2'].'</option>';
     }

     exit;    
}
?>