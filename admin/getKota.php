<?php
 
ini_set('display_errors',0);
require_once "koneksi.php";
 koneksi_buka();

$idProvinsi = $_POST['idProvinsi'];
 
if($idProvinsi == ''){
     exit;
}else{
     $sql = "
          SELECT
               idKota,
               namaKota
          FROM
               kota
          WHERE
               idProvinsi = '$idProvinsi'
          ORDER BY namakota
     ";
     $getNamaProvinsi = mysql_query($sql) ;
     while($data = mysql_fetch_array($getNamaProvinsi)){
          echo '<option value="'.$data['idKota'].'">'.$data['namaKota'].'</option>';
     }
	  echo '<option value="lainnya">Lainnya</option>';
     exit;    
}
?>