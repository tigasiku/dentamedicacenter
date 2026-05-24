<?php
session_start();
	ini_set("post_max_size", "64M");
    ini_set("upload_max_filesize", "64M");
    ini_set("memory_limit", "20000M"); 
	date_default_timezone_set("Asia/Makassar");
error_reporting(0);
require "../koneksi.php";

$id = $_POST['id'];
$kategori = $_POST['kategori'];
$jam=date("H:i:s");
$tanggal = $_POST['tanggal_terbit']." ".$jam;
$judul = $_POST['judul'];
$text1=str_replace('<div>', '<p>',$_POST['isi_berita']);
$text1=str_replace('</div>', '</p>',$text1);


$text1=str_replace("'", '"',$text1);

$isi_berita =($text1);
$max_size = 800; //max image size in Pixels
		$max_size2 = 200;
	$destination_folder = '../img/blog/';
	$image_name = str_replace(' ', '',date('ymdHis').$_FILES['gambar']['name']);
	
	
	$image_name = $image_name; //file name
	$image_size = $_FILES['gambar']['size']; //file size
	$image_temp = $_FILES['gambar']['tmp_name']; //file temp
	$image_type = $_FILES['gambar']['type']; //file type
if(!empty($_FILES['gambar']['name']))
	{
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

		if(imagecopyresampled($new_canvas, $image_resource , 0, 0, 0, 0, $new_image_width, $new_image_height, $img_width, $img_height) and imagecopyresampled($new_canvas2, $image_resource , 0, 0, 0, 0, $new_image_width2, $new_image_height2, $img_width, $img_height))
		{
			
			if(!is_dir($destination_folder)){ 
				mkdir($destination_folder);//create dir if it doesn't exist
			}
			
			
			
			
			//Or Save image to the folder
			imagejpeg($new_canvas, $destination_folder.'/'.$image_name , 90);
			imagejpeg($new_canvas2, $destination_folder.'/_s_'.$image_name , 90);
			
			//free up memory
			imagedestroy($new_canvas); 
			imagedestroy($image_resource);
			
			imagedestroy($new_canvas2); 
			
		}
	}
}else{
	$image_name =$_POST['capture_lama'];
}
	
switch($_GET['action']){
	case "input": // jika post_action.php?action=input >> form action dari tambah berita
	 

	$ins = "insert into berita values('','$kategori','$judul' , '$isi_berita','$image_name','$tanggal', '".$_SESSION["user_graha"]."')"; // input data ke table berita
	$exe = mysql_query($ins); // jalankan perintah $ins
	// tampilkan pesan ketika $exe telah dijalankan
	
	
	
	
		header("location:index.php?page=post&action=newpost&pesan=success");
	
	break;
	
	case "update": // jika post_action.php?action=update >> form action dari edit berita
	$update = "update berita set judul = '$judul',kategori = '$kategori'  , gambar = '$image_name', isi_berita = '$isi_berita', user = '$user',tanggal = '$tanggal' where id = '$id'"; // update data yang ada di table berita
	$exe = mysql_query($update);
	
	header("location:index.php?page=post&action=edit&id=$id&pesan=success");
	break;
}
?>