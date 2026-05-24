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
               bank_perusahaan
          WHERE
               kd_bank <> '$idProvinsi' order by sort_by
          
     ";
	
     $getNamaProvinsi = mysql_query($sql) ;
echo '<option selected  value="">Pilih</option>';
     while($data = mysql_fetch_array($getNamaProvinsi)){
		
        
    ?>
	<option value="<?php echo $data[0] ?>"><?php echo $data[1] ?> <?php if(!empty($data[2])) echo " - ".$data[2] ?> <?php if(!empty($data[3])) echo " - ".$data[3] ?></option>
	 <?php }

     exit;    
}
?>