<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<body>
<?php
ini_set("post_max_size", "64M");
    ini_set("upload_max_filesize", "64M");
    ini_set("memory_limit", "20000M"); 
	date_default_timezone_set("Asia/Makassar");
$max_size = 1366; //max image size in Pixels

	$destination_folder = '../img/slides/';
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
		$new_image_width    = 1366;
		$new_image_height   = 664;
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
	$image_name =$_POST['capture_lama'];
}


error_reporting(0);
require "../koneksi.php";

$id = $_POST['id'];
$judul = $_POST['judul'];
$text1 = $_POST['text1'];
$text2 = $_POST['text2'];
$linknya = $_POST['linknya'];
switch($_GET['action']){
	case "input": // jika post_action.php?action=input >> form action dari tambah berita
	 $fileName  = $_FILES['gambar']['name'];
 $fileSize  = $_FILES['gambar']['size'];
 $fileError  = $_FILES['gambar']['error'];
 $fileType  = $_FILES['gambar']['type'];
 $fileName2 = str_replace(" ","-",$fileName);

$tanggal=date("Y-m-d");
	$ins = "insert into slide values('','$judul' ,'$image_name','$text1','$text2','$linknya','$tanggal', '$user')"; // input data ke table berita
	$exe = mysql_query($ins); // jalankan perintah $ins

	// tampilkan pesan ketika $exe telah dijalankan
	
	?><script language="javascript">
			document.location="index.php?page=tambah.slide&action=newpost&pesan=success";
		</script>
    <?php
	
	break;
	case "update": // jika post_action.php?action=update >> form action dari edit berita
	$update = "update slide set gambar = '$image_name',judul = '$judul' , h2 = '$text1' ,p = '$text2' , linknya = '$linknya'  where id = '$id'"; 
	$exe = mysql_query($update);
	
	// tampilkan pesan ketika $del telah dijalankan
	?>
    <script language="javascript">
			document.location="index.php?page=tambah.slide&action=edit&id=<?php echo $id ?>&pesan=success";
		</script>
    <?php 
	break;
}
?>
<br /><br />
</body>
</html>