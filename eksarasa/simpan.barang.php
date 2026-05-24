<?php
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){
	

		
		$sub_kategori=$_POST['kategori'];
	
		$kat=mysql_query("select * from sub_kategori_barang where id='".$sub_kategori."'");
		$katnya=mysql_fetch_array($kat);
		$kategori=$katnya['kategori'];
		$sub_kategori=$katnya['id'];
	
	
$nama_barang=mysql_real_escape_string($_POST['nama_barang']);
$satuan=$_POST['satuan'];
$stok=$_POST['stok'];
$stokmin=$_POST['stok_min'];	
$harga_beli=$_POST['harga_beli'];
$harga_jual=$_POST['harga_jual'];
$keterangan=$_POST['ket'];
$tipe_barang=$_POST['tipe_barang'];

$barcode=$_POST['barcode'];
$max_size = 800; //max image size in Pixels
		
	$destination_folder = 'photo_barang/';
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
$kode_barang=date('ymdHis');
$update=mysql_query("INSERT INTO barang value('".$kode_barang."','".$barcode."','".$kategori."','".$sub_kategori."','".$nama_barang."','".$satuan."','".$harga_beli."','".$harga_jual."','".$stok."','".$keterangan."','".$tipe_barang."','".$image_name."','".$stokmin."','".date("Y-m-d H:i:s")."','Y')");


	foreach($_POST['pname'] as $key => $name){
	$pname=$_POST['pname'][$key];

	
	$pprice=$_POST['harga_jual_gudang'][$key];
	
	
$insert_d=mysql_query("insert into harga_tiap_gudang  values('','$kode_barang','$pprice','$pname')");
			
}

			if ($update){
			header("location:index.php?page=tambah.barang&pesan=success");
			}else{
			header("location:index.php?page=tambah.barang&pesan=error");}
	
}else{
	header("location:index.php?page=404");
}

?>