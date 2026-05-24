<?php
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){
	
$store_name=$_POST['store_name'];
$store_tagline=$_POST['store_tagline'];
$store_address=$_POST['store_address'];
$store_geocode=$_POST['store_geocode'];
$store_email=$_POST['store_email'];
$store_telp=$_POST['store_telp'];
$store_fax=$_POST['store_fax'];
$store_name=$_POST['store_name'];
$website=$_POST['website'];
	
	
$capture_lama=($_POST['capture_lama']);
$max_size = 200; //max image size in Pixels
		
	$destination_folder = 'img/';
if(!empty($_FILES['file']['name']))
	{
	$image_name = "logo2.png"; //file name
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
		$new_image_width    = 266;
		$new_image_height   = 80;
		$new_canvas         = imagecreatetruecolor($new_image_width , $new_image_height);
		
	 imagealphablending($new_canvas, false);
		
    imagesavealpha($new_canvas, true);
		
imagefill($new_canvas,0,0,imagecolorallocatealpha($new_canvas, 0,0,0,127));
		
		
		
		
		if(imagecopyresampled($new_canvas, $image_resource , 0, 0, 0, 0, $new_image_width, $new_image_height, $img_width, $img_height))
		{
			
			if(!is_dir($destination_folder)){ 
				mkdir($destination_folder);//create dir if it doesn't exist
			}
			
			//Or Save image to the folder
				imagepng($new_canvas, $destination_folder.'/'.$image_name , 9);
			//free up memory
			imagedestroy($new_canvas); 
			imagedestroy($image_resource);
			
			
		}
	}
	}else{
	$image_name =$capture_lama;
	}
	
	
	
	
$capture_lama2=($_POST['capture_lama2']);
$max_size = 200; //max image size in Pixels
		
	$destination_folder = 'img/';
if(!empty($_FILES['file2']['name']))
	{
	$image_name2 = "icon.png"; //file name
	$image_size = $_FILES['file2']['size']; //file size
	$image_temp = $_FILES['file2']['tmp_name']; //file temp
	$image_type = $_FILES['file2']['type']; //file type

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
		$new_image_width    = 32;
		$new_image_height   = 32;
		$new_canvas         = imagecreatetruecolor($new_image_width , $new_image_height);
		
	 imagealphablending($new_canvas, false);
		
    imagesavealpha($new_canvas, true);
		
imagefill($new_canvas,0,0,imagecolorallocatealpha($new_canvas, 0,0,0,127));
		
		
		
		
		if(imagecopyresampled($new_canvas, $image_resource , 0, 0, 0, 0, $new_image_width, $new_image_height, $img_width, $img_height))
	
		{
			
			if(!is_dir($destination_folder)){ 
				mkdir($destination_folder);//create dir if it doesn't exist
			}
			
			//Or Save image to the folder
			imagepng($new_canvas, $destination_folder.'/'.$image_name2 , 9);
			
			//free up memory
			imagedestroy($new_canvas); 
			imagedestroy($image_resource);
			
			
		}
	}
	}else{
	$image_name2 =$capture_lama2;
	}
$update=mysql_query("update stores set 	store_name='".$store_name."',store_tagline='".$store_tagline."',store_address='".$store_address."',store_geocode='".$store_geocode."',store_email='".$store_email."' ,store_telp='".$store_telp."' ,website='".$website."' ,store_fax='".$store_fax."' ,store_logo='".$image_name."'  , store_icon='".$image_name2."' ");

			if ($update){
			header("location:index.php?page=store.location&pesan=success");
			}else{
			header("location:index.php?page=store.location&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}

?>