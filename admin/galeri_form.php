<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">

<?php
ini_set("post_max_size", "64M");
    ini_set("upload_max_filesize", "64M");
    ini_set("memory_limit", "20000M"); 


		$max_size = 800; //max image size in Pixels
		$max_size2 = 320;
		$destination_folder = '../foto/full/';
		$destination_folder2 = '../foto/thumb/';

include "../koneksi.php";
@$p  = $_GET['p'];
$id_kat = $_GET['id_kat'];
@$id_foto= $_GET['id_foto'];
@$mod  = $_GET['mod'];
if (empty($id_kat)) {
 echo "<script>alert('Pilih dulu albumnya')</script>";
 echo "<meta http-equiv='refresh' content='0;url=http:index.php'>";
}
$q_ket_kategori = mysql_query("SELECT * FROM galerikategori WHERE id = '".$id_kat."'");
$ket_kat  = mysql_fetch_array($q_ket_kategori);
 if ($p == "upload") {
	 $id_kat  = $_POST['id_kat'];
	 //$ket  = $_POST['ket'];
  	 //upload foto

 	$i=1;
 	foreach($_FILES['foto']['name'] as $key => $name ){

	$image_name = $i.date('ymdHis').$_FILES['foto']['name'][$key]; //file name
	$image_size = $_FILES['foto']['size'][$key]; //file size
	$image_temp = $_FILES['foto']['tmp_name'][$key]; //file temp
	$image_type = $_FILES['foto']['type'][$key]; //file type

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
			
			
			//Or Save image to the folder
			imagejpeg($new_canvas, $destination_folder.'/'.$image_name , 90);
			imagejpeg($new_canvas2, $destination_folder2.'/'.$image_name , 90);
			
			//free up memory
			imagedestroy($new_canvas); 
			imagedestroy($image_resource);
			
			imagedestroy($new_canvas2); 
			
		}
	}
	
		
	 $ins = mysql_query("INSERT INTO galeri VALUES ('', '$image_name', '$id_kat', '0', now())"); 
	 
	$i++; 
	}
	 echo "<script>alert('Berhasil Ditambahkan'); window.open('?page=galeri_form&id_kat=$id_kat', '_self');</script>";

	  } else if ($p == "del_foto") {
 $getNamaFile  = mysql_query("SELECT file FROM galeri WHERE id = '".$id_foto."'");
 $aNamaFile  = mysql_fetch_array($getNamaFile);
 $q_del  = mysql_query("DELETE FROM galeri WHERE id = '$id_foto'");
 if ($q_del) {
  $del_file1 = unlink("../foto/full/".$aNamaFile[0]);
  $del_file2 = unlink("../foto/thumb/_s_".$aNamaFile[0]);
    echo "<script>alert('Berhasil Dihapuskan'); window.open('?page=galeri_form&id_kat=$id_kat', '_self');</script>";
 } else {
  echo "<script>alert('Gagal Dihapuskan'); window.open('?page=galeri_form&id_kat=$id_kat', '_self');</script>";
 }

}
?>
<div id="isi">
 <h1>Upload foto pada : <?php echo $ket_kat['nama']; ?></h1>

 <form name="fUploadGaleri" action="?page=galeri_form&p=upload&id_kat=<?php echo $id_kat; ?>" method="POST" enctype="multipart/form-data">
 <input type="hidden" name="id_kat" value="<?php echo $id_kat; ?>">
 <table>
  <tr>
  <td>File</td>
  <script>
$("#id_question_pic").change(function() {
    if(number_of_uploads > $(this).attr(max-uploads))
    {
    alert('Your Message');
    }
    else
    {
    number_of_uploads = number_of_uploads + 1;
    }
});
  </script>
  <td><input type="file" name="foto[]" id="files" multiple="multiple" max-uploads = 10   > 
  <script>
	var selDiv = "";
		
	document.addEventListener("DOMContentLoaded", init, false);
	
	function init() {
		document.querySelector('#files').addEventListener('change', handleFileSelect, false);
		selDiv = document.querySelector("#selectedFiles");
	}
		
	function handleFileSelect(e) {
		
		if(!e.target.files) return;
		
		selDiv.innerHTML = "";
		
		var files = e.target.files;
		for(var i=0; i<files.length; i++) {
			var f = files[i];
			
			selDiv.innerHTML += f.name + "<br/>";

		}
		
	}
	</script>

  *HANYA tipe .GIF dan .JPEG</td>
  </tr>

   <td width="124">&nbsp;</td>
   <td width="319"><div id="selectedFiles"></div></td>
  </tr> <tr>
     <td>&nbsp;</td>
     <td><input type="submit" name="tbUpload" value="kirim" /></td>
   </tr>
 </table>
 </form>
 <hr>
 <br>
 <b>Daftar Foto dalam kategori ini</b><br>
  <?php
 $QJumlahPerKategori = mysql_query("SELECT file FROM galeri WHERE kategori = '".$id_kat."'");
 $JJumlahPerKategori = mysql_num_rows($QJumlahPerKategori);
 ?>
     <div id='foto' style='background: #E3FFB5; padding: 5px; margin: 10px 0 10px 0; border: solid 1px #85C226; overflow: auto; width: 100%'>
  <h3 style='font-size: 10px; font-weight: bold;'><?php echo $ket_kat['nama']." ( ".$JJumlahPerKategori."  foto) | "?> 
  [ <a href="index2.php?mod=del_kat&id_kat=<?php echo $id_kat?>" onclick="return konfirmasi('Menghapus Data ini - <?php echo $ket_kat['nama']?> - ')">Hapus Kategori ini</a> ]
  </h3>
      <?php
  $QGaleri = mysql_query("SELECT * FROM galeri WHERE kategori = '$id_kat'");
  if ($JJumlahPerKategori == 0) {
   echo "<font color='red'><b>Belum ada foto dalam kategori ini</b></font>";
  } else {
   while ($AGaleri = mysql_fetch_array($QGaleri)) {
  ?>
   <div style="float: left">
    <img src='../foto/thumb/<?php echo $AGaleri[1]?>' width='120px'  style='margin: 10px 10px auto; border: solid 3px #85C226'>
        <a style="font-size: 12px; margin-left: 23px; display: block" href='?page=galeri_form&p=del_foto&id_kat=<?php echo $id_kat?>&id_foto=<?php echo $AGaleri[0]?>' title='Klik Untuk Menghapus Foto Ini' onclick="return confirm('Anda yakin akan menghapus Foto ini ? ')">Hapus
    </a>
   </div>          <?php      }
  }
  echo "</tr></div><!--</tr></table><br>-->";
  ?>
</div> 