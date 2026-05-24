v<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){


$kode = date('ymdHis');
$nama = $_POST['nama'];

$sort_order = $_POST['sort_order'];


		$max_size = 360; //max image size in Pixels
		$max_size2 = 220;
	$destination_folder = '../img/fasilitas/';

	
	$image_name = str_replace(' ', '',date('ymdHis').$_FILES['gambar']['name']);
	
	
	$image_name = $image_name; //file name
	$image_size = $_FILES['gambar']['size']; //file size
	$image_temp = $_FILES['gambar']['tmp_name']; //file temp
	$image_type = $_FILES['gambar']['type']; //file type

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
		$new_image_width    = 360;
		$new_image_height   = 220;
		$new_canvas         = imagecreatetruecolor($new_image_width , $new_image_height);
		
	

		if(imagecopyresampled($new_canvas, $image_resource , 0, 0, 0, 0, $new_image_width, $new_image_height, $img_width, $img_height) )
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

		
	 $ins = mysql_query("insert into fasilitas value ('".$kode."','".$nama."','".$image_name."','".$sort_order."')"); 
		
	$max_size = 800; //max image size in Pixels
		$max_size2 = 320;
	$destination_folder = '../img/fasilitas/full/';

 if(!empty($_FILES['gambar_detil']['name'][0])){
 	foreach($_FILES['gambar_detil']['name'] as $key => $name ){
		
			if(!empty($_FILES['gambar_detil']['name'][$key])){
				$image_name = str_replace(' ', '',$i.date('ymdHis').$_FILES['gambar_detil']['name'][$key]);
	
	
	$image_name = $image_name; //file name
	$image_size = $_FILES['gambar_detil']['size'][$key]; //file size
	$image_temp = $_FILES['gambar_detil']['tmp_name'][$key]; //file temp
	$image_type = $_FILES['gambar_detil']['type'][$key]; //file type

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
		
		

		if(imagecopyresampled($new_canvas, $image_resource , 0, 0, 0, 0, $new_image_width, $new_image_height, $img_width, $img_height) )
		{
			
		
			
			//Or Save image to the folder
			imagejpeg($new_canvas, $destination_folder.'/'.$image_name , 90);
			
			
			//free up memory
			imagedestroy($new_canvas); 
			imagedestroy($image_resource);
			
			
			
		}
	}
	
		
	 $ins = mysql_query("insert into fasilitas_detail value('','".$image_name."','".$kode."')"); 
	 
	$i++; 	
	}
	} 
}			
 
			header("location:index.php?page=facilities&id=$kode&pesan=success");
			

}else{
	header("location:index.php?page=404");
}
?>