<?php
session_start();
set_time_limit(0);
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){

@unlink("photo/".$_SESSION['photo']."");
$max_size = 200; //max image size in Pixels
		
	$destination_folder = 'photo/';

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
	
		mysql_query("update admin set photo='".$image_name."' where username='".$_SESSION['user_graha']."'");


$_SESSION['photo']=$image_name;


	header("location:index.php?page=ganti.photo&pesan=success");
}else{
	header("location:index.php?page=404");
}
koneksi_tutup();
?>