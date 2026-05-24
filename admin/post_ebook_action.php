<?php
session_start();
ini_set("post_max_size", "64M");
    ini_set("upload_max_filesize", "64M");
    ini_set("memory_limit", "20000M"); 
	date_default_timezone_set("Asia/Makassar");
error_reporting(0);
require "../koneksi.php";

$id = $_POST['id'];
$judul = $_POST['judul'];

$target_dir = "../img/ebook/file/";

$nama_file = date("YmdHis").$_FILES['file']['name'];
$lokasi_file = $_FILES['file']['tmp_name'];
$ukuran_file = $_FILES['file']['size'];
$target_file = $target_dir . basename($nama_file);
 
(move_uploaded_file($lokasi_file,"$target_file")) ;
   


$max_size = 400; //max image size in Pixels
	
	$destination_folder = '../img/ebook/cover/';
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
	
switch($_GET['action']){
	case "input": // jika post_action.php?action=input >> form action dari tambah berita
	 
	$tanggal=date("Y-m-d");
	$ins = "insert into ebook values('','$judul','$image_name' , '$nama_file','','$tanggal')"; // input data ke table berita
	$exe = mysql_query($ins); // jalankan perintah $ins
	// tampilkan pesan ketika $exe telah dijalankan
	
	header("location:index.php?page=post.ebook&action=newpost&pesan=success");
	
	break;
	
	case "update": // jika post_action.php?action=update >> form action dari edit berita
	$update = "update ilmu set judul = '$judul',kategori = '$kategori' ,sub_kategori = '$sub_kategori'  , gambar = '$image_name', isi_berita = '$isi_berita', user = '$user' where id = '$id'"; // update data yang ada di table berita
	$exe = mysql_query($update);
	
	header("location:index.php?page=post.ilmu&action=edit&id=$id&pesan=success");
	break;
}
?>