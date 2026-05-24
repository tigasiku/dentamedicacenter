<?php
 
ini_set('display_errors',0);
require_once "koneksi.php";
 koneksi_buka();

$idKota = $_POST['idKota'];
 
if($idKota == ''){
     exit;
}else{
     $sql = "
          SELECT
               idArea,
               namaArea
          FROM
               area
          WHERE
               idKota = '$idKota'
          ORDER BY namaArea
     ";
     $getNamaProvinsi = mysql_query($sql) ;
     while($data = mysql_fetch_array($getNamaProvinsi)){
          echo '<option value="'.$data['idArea'].'">'.$data['namaArea'].'</option>';
     }
	 echo '<option value="lainnya">Lainnya</option>';
     exit;    
}
?>