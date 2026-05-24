<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){
	 ini_set("post_max_size", "64M");
    ini_set("upload_max_filesize", "64M");
    ini_set("memory_limit", "20000M"); 
	date_default_timezone_set("Asia/Makassar");
		$kode = date("ymdHis");
		$kategori = ($_POST['kategori']);	
		$nama=$_POST['nama'];
		$urlnya=$_POST['urlnya'];
		
		$kategori=$_POST['kategori'];
		
		$max_size = 340; //max image size in Pixels

	$destination_folder = '../img/theme_website/';
	
	$image_name = date('ymdHis').$_FILES['gambar']['name']; //file name
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
			
								
        $query = mysql_query("INSERT INTO theme_website VALUES
		 ('',
		   '".$kategori."', 
		  '".$nama."', 
			 '".$urlnya."',
			  '".$image_name."')");
 
        if ($query){
			header("location:index.php?page=tambah.template&pesan=success&kategori=$kategori");
			}else{
			header("location:index.php?page=tambah.template&pesan=error");}


}else{
	header("location:index.php?page=404");
}
?>