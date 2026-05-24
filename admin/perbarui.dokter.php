<?php 
date_default_timezone_set('Asia/Makassar');
set_time_limit(0);
session_start();
include "koneksi.php";
koneksi_buka();
if (isset($_POST['submit'])){


$kode = $_POST['kode'];
$nama = $_POST['nama'];
$profesi = $_POST['profesi'];
$sort_order = $_POST['sort_order'];
$text1=str_replace('<div>', '<p>',$_POST['isi']);
$text1=str_replace('</div>', '</p>',$text1);

$text1=str_replace("'", '"',$text1);
$isi_berita =($text1);


$text12=str_replace('<div>', '<p>',$_POST['isi_pendek']);
$text12=str_replace('</div>', '</p>',$text12);

$text12=str_replace("'", '"',$text12);
$isi_berita2 =($text12);

if(!empty($_FILES['gambar']['name']))
	{
		$max_size = 800; //max image size in Pixels
		$max_size2 = 420;
	$destination_folder = '../img/dentist/thumb/';

	
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
		$new_image_width    = 280;
		$new_image_height   = 280;
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


if(!empty($_FILES['gambar_detail']['name']))
	{
		$max_size = 800; //max image size in Pixels
		$max_size2 = 420;
	$destination_folder = '../img/dentist/full/';

	
	$image_name2 = str_replace(' ', '',date('ymdHis').$_FILES['gambar_detail']['name']);
	
	
	$image_name2 = $image_name2; //file name
	$image_size2 = $_FILES['gambar_detail']['size']; //file size
	$image_temp2 = $_FILES['gambar_detail']['tmp_name']; //file temp
	$image_type2 = $_FILES['gambar_detail']['type']; //file type

	switch(strtolower($image_type2)){ //determine uploaded image type 
			//Create new image from file
			case 'image/png': 
				$image_resource =  imagecreatefrompng($image_temp2);
				break;
			case 'image/gif':
				$image_resource =  imagecreatefromgif($image_temp2);
				break;          
			case 'image/jpeg': case 'image/pjpeg':
				$image_resource = imagecreatefromjpeg($image_temp2);
				break;
			default:
				$image_resource = false;
		}
	
	if($image_resource){
		//Copy and resize part of an image with resampling
		list($img_width, $img_height) = getimagesize($image_temp2);
		
	    //Construct a proportional size of new image
		$image_scale        = min($max_size / $img_width, $max_size / $img_height); 
		$new_image_width    = ceil($image_scale * $img_width);
		$new_image_height   = ceil($image_scale * $img_height);
		$new_canvas         = imagecreatetruecolor($new_image_width , $new_image_height);
		
	

		if(imagecopyresampled($new_canvas, $image_resource , 0, 0, 0, 0, $new_image_width, $new_image_height, $img_width, $img_height) )
		{
			
			if(!is_dir($destination_folder)){ 
				mkdir($destination_folder);//create dir if it doesn't exist
			}
			
		
			
			//Or Save image to the folder
			imagejpeg($new_canvas, $destination_folder.'/'.$image_name2 , 90);

			
			//free up memory
			imagedestroy($new_canvas); 
			imagedestroy($image_resource);
			
		
			
		}
	}
}else{
	$image_name2 =$_POST['capture_lama2'];
}
		
	 $ins = mysql_query("update dokter set nama='".$nama."',profesi='".$profesi."',sort_by='".$sort_order."',isi='".$isi_berita."',isi_pendek='".$isi_berita2."',gambar='".$image_name."',gambar_body='".$image_name2."' where id='".$kode."'"); 
		
		
 
			header("location:index.php?page=post.dokter&id=$kode&pesan=success");
			

}else{
	header("location:index.php?page=404");
}
?>