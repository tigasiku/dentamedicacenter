<?php
session_start();
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){

$username=($_POST['username']);
$nama=($_POST['nama']);
$nik=($_POST['nik']);
$jenis_kelamin=($_POST['jenis_kelamin']);
$level=($_POST['level']);
$fb_id=($_POST['fb_id']);
$pass=md5($_POST['pass']);
$capture_lama=($_POST['capture_lama']);
$max_size = 200; //max image size in Pixels
		
	$destination_folder = 'photo/';
if(!empty($_FILES['file']['name']))
	{
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
	}else{
	$image_name ="";
	}
	
mysql_query("insert into admin value('$username','$pass','$nama','$level','$jenis_kelamin','$fb_id','$image_name','Y','' )");

		header("location:index.php?page=management.user&pesan=success");
	

}else{
	header("location:index.php?page=404");
}

?>