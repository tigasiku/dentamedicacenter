<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){


$kode = $_POST['kode'];
$nama = $_POST['nama'];

$sort_order = $_POST['sort_order'];
$text1=str_replace('<div>', '<p>',$_POST['isi']);
$text1=str_replace('</div>', '</p>',$text1);

$text1=str_replace("'", '"',$text1);
$isi_berita =($text1);



if(!empty($_FILES['gambar']['name']))
	{
		$max_size = 360; //max image size in Pixels
		$max_size2 = 220;
	$destination_folder = '../img/service/';

	
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
}else{
	$image_name =$_POST['capture_lama'];
}
		
	 $ins = mysql_query("update service set judul='".$nama."',sort_by='".$sort_order."',isi='".$isi_berita."',gambar='".$image_name."' where id='".$kode."'"); 
		
$max_size = 800; //max image size in Pixels
		$max_size2 = 320;
	$destination_folder = '../img/service/full/';
$destination_folder2 = '../img/service/thumb/';
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
		
		
		$image_scale2        = min($max_size2 / $img_width, $max_size2 / $img_height); 
		$new_image_width2    = ceil($image_scale2 * $img_width);
		$new_image_height2   = ceil($image_scale2 * $img_height);
		$new_canvas2      = imagecreatetruecolor($new_image_width2 , $new_image_height2);

		if(imagecopyresampled($new_canvas, $image_resource , 0, 0, 0, 0, $new_image_width, $new_image_height, $img_width, $img_height) and imagecopyresampled($new_canvas2, $image_resource , 0, 0, 0, 0, $new_image_width2, $new_image_height2, $img_width, $img_height) )
		{
			
		
			
			//Or Save image to the folder
			imagejpeg($new_canvas, $destination_folder.'/'.$image_name , 90);
			
			imagejpeg($new_canvas2, $destination_folder2.'/'.$image_name , 90);
			
			//free up memory
			imagedestroy($new_canvas); 
			imagedestroy($image_resource);
			
				
			imagedestroy($new_canvas2); 		
			
			
		}
	}
	
		
	 $ins = mysql_query("insert into service_detail value('','".$image_name."','".$kode."')"); 
	 
	$i++; 	
	}
	} 
}		
		
 
			header("location:index.php?page=post.treatments&id=$kode&pesan=success");
			

}else{
	header("location:index.php?page=404");
}
?>