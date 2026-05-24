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
		$kode = ($_POST['id']);
		$kategori = ($_POST['kategori']);	
		$nama=$_POST['nama'];
		$isbn=preg_replace("/[^0-9]/", "",$_POST['isbn']);
		$distributor=$_POST['distributor'];
		$deskripsi=$_POST['isi'];
		$harga = preg_replace("/[^0-9]/", "",$_POST['harga']);
		$diskon = $_POST['diskon'];
		$harga_diskon=$harga-(($harga*$diskon)/100);
		$harga_jual = $harga_diskon;
		$penulis=$_POST['penulis'];
		$publisher=$_POST['publisher'];
		
		$sub_kategori = $_POST['kategori'];
		
		$weight = $_POST['weight'];
		
		$length = $_POST['length'];
		$width = $_POST['width'];

		
			$status = $_POST['status'];
		
		
		$kat=mysql_query("select * from sub_kategori_produk where id='".$sub_kategori."'");
		$katnya=mysql_fetch_array($kat);
		$kategori=$katnya['kategori'];
		$sub_kategori=$katnya['sub_kategori'];
		
		
if(!empty($_FILES['gambar']['name']))
	{
		$max_size = 800; //max image size in Pixels
		$max_size2 = 420;
	$destination_folder = '../img/portfolio/full/';
	$destination_folder2 = '../img/portfolio/thumb/';
	
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
		$new_image_width    = 600;
		$new_image_height   = 800;
		$new_canvas         = imagecreatetruecolor($new_image_width , $new_image_height);
		
		$image_scale2        = min($max_size2 / $img_width, $max_size2 / $img_height); 
		$new_image_width2    = 315;
		$new_image_height2   = 420;
		$new_canvas2      = imagecreatetruecolor($new_image_width2 , $new_image_height2);

		if(imagecopyresampled($new_canvas, $image_resource , 0, 0, 0, 0, $new_image_width, $new_image_height, $img_width, $img_height) and imagecopyresampled($new_canvas2, $image_resource , 0, 0, 0, 0, $new_image_width2, $new_image_height2, $img_width, $img_height))
		{
			
			if(!is_dir($destination_folder)){ 
				mkdir($destination_folder);//create dir if it doesn't exist
			}
			
		
			
			//Or Save image to the folder
			imagejpeg($new_canvas, $destination_folder.'/'.$image_name , 90);
			imagejpeg($new_canvas2, $destination_folder2.'/'.$image_name , 90);
			
			//free up memory
			imagedestroy($new_canvas); 
			imagedestroy($image_resource);
			
			imagedestroy($new_canvas2); 
			
		}
	}
}else{
	$image_name =$_POST['capture_lama'];
}
								
        $query = mysql_query("update produk set 		 	
		isbn= '".$isbn."', 
		kd_distributor= '".$distributor."', 
		 kategori='".$kategori."', 
		 sub_kategori='".$sub_kategori."', 		 
		 judul= '".$nama."', 
		  harga='".$harga."', 
		diskon=  '".$diskon."', 
		harga_jual=  '".$harga_jual."', 
		weight = '".$weight."', 
		width=  '".$width."', 
		length=  '".$length."', 
			spesifikasi= '".$deskripsi."',
			file=  '".$image_name."',			  
  		publishernya=	  '".$publisher."',
		penulis=	  '".$penulis."',
			tgl=  '".date("Y-m-d H-i-s")."', 
			status= '".$status."' where id='".$kode."'");
 
        if ($query){
			header("location:index.php?page=edit.product&id=$kode&pesan=success");
			}else{
			header("location:index.php?page=edit.product&id=$kode&pesan=error");}


}else{
	header("location:index.php?page=404");
}
?>