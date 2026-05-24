<?php
set_time_limit(50);
include "../koneksi.php";
if (isset($_POST['submit'])){
		$password = md5($_POST['password']);
		$pass = ($_POST['password']); 
		$email = ($_POST['email']);	
		$cmbProvinsi=$_POST['cmbProvinsi'];
		if($_POST['cmbKota']=='lainnya'){
		$num=mysql_fetch_array(mysql_query("select idKota from kota order by idKota desc"));
		$num2=$num['idKota']+1;
		$ins_query = mysql_query("INSERT INTO kota VALUES ('$num2', '".$_POST['kota']."', '$cmbProvinsi','')");
		$cmbKota=$num2;
		}else{
		$cmbKota=$_POST['cmbKota'];}
		if($_POST['cmbArea']=='lainnya'){
		$num=mysql_fetch_array(mysql_query("select idArea from area order by idArea desc"));
		$num2=$num['idArea']+1;
		$ins_query = mysql_query("INSERT INTO area VALUES ('$num2', '".$_POST['area']."', '$cmbKota')");
		$cmbArea=$num2;
		}else{
		$cmbArea=$_POST['cmbArea'];}
		$nama=$_POST['nama'];
		$tanggal_lahir=$_POST['tanggal_lahir'];
		$telp=$_POST['telp'];
		$alamat=$_POST['alamat'];
		$hp=$_POST['hp'];
		$bb=$_POST['bb'];

	$max_size = 250;
	$destination_folder = '../foto_agen/';

	$image_name = date('ymdHis').$_FILES['file']['name']; //file name
	$image_size = $_FILES['file']['size']; //file size
	$image_temp = $_FILES['file']['tmp_name']; //file temp
	$image_type = $_FILES['file']['type']; //file type

	switch(strtolower($image_type)){ //determine uploaded image type 
			//Create new image from file
			case 'image/png': 
				$image_resource =  imagecreatefrompng($image_temp);
				break;
			case 'image/gif':
				$image_resource =  imagecreatefromgif($image_temp);
				break;          
			case 'image/jpeg': case 'image/pjpeg':
				$image_resource = imagecreatefromjpeg($image_temp);
				break;
			default:
				$image_resource = false;
		}
	
	if($image_resource){
		//Copy and resize part of an image with resampling
		list($img_width, $img_height) = getimagesize($image_temp);
		
	    //Construct a proportional size of new image
		$image_scale        = min($max_size / $img_width, $max_size / $img_height); 
		$new_image_width    = ceil($image_scale * $img_width);
		$new_image_height   = ceil($image_scale * $img_height);
		$new_canvas         = imagecreatetruecolor($new_image_width , $new_image_height);
		
	

		if(imagecopyresampled($new_canvas, $image_resource , 0, 0, 0, 0, $new_image_width, $new_image_height, $img_width, $img_height))
		{
			
			if(!is_dir($destination_folder)){ 
				mkdir($destination_folder);//create dir if it doesn't exist
			}
			
			//Or Save image to the folder
			imagejpeg($new_canvas, $destination_folder.'/'.$image_name , 90);
			
			//free up memory
			imagedestroy($new_canvas); 
			imagedestroy($image_resource);
			
			
		}
	}
	
 $update = mysql_query("INSERT INTO agen VALUES ('$email', '$password', '$cmbProvinsi', '$cmbKota','$cmbArea', '$alamat', '$nama', '$telp', '$hp', '$bb', '$tanggal_lahir' ,'', '$kode', '$pass','Y' ,'".date("Y-m-d")."')") ;
 
			if ($update){
			header("location:index.php?page=agen&pesan=success");
			}else{
			header("location:index.php?page=agen&pesan=error");}
}else{
	header("location:index.php?page=404");
}

?>