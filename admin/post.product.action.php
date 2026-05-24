
<?php
//Fungsi Perkecil Ukuran Gambar //
//penggunaan ===> perkecil("img/siswa_1.JPG", "img/small/"); (folder/file, folder/folder/)
function perkecil($imgAsal, $imgTujuan) {
 $pcImgAsal   = explode("/", $imgAsal);
 $jAr   = count($pcImgAsal) - 1;
 $namaFileAsli = $pcImgAsal[$jAr];
 //identitas file asli
 $im_src = imagecreatefromjpeg($imgAsal);
 $src_width = imageSX($im_src);
 $src_height = imageSY($im_src);
 //Simpan dalam versi small 110 pixel
 //set ukuran gambar hasil perubahan
 $dst_width = 200;
 $dst_height = ($dst_width/$src_width)*$src_height;
 //proses perubahan ukuran
 $im = imagecreatetruecolor($dst_width,$dst_height);
 imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
 //Simpan gambar
 imagejpeg($im, $imgTujuan.$namaFileAsli);

 imagedestroy($im_src);
 imagedestroy($im);
}
error_reporting(0);
require "../koneksi.php";

$id = $_POST['id'];
$judul = $_POST['judul'];
$satuan = $_POST['satuan'];
$harga = $_POST['harga'];
$harga_grosir = $_POST['harga_grosir'];
$diskon = $_POST['diskon'];
$sub_kategori = $_POST['kategori'];
$merek = $_POST['merek'];
$status = $_POST['status'];
$spesifikasi = $_POST['spesifikasi'];

$kat=mysql_query("select * from sub_kategori_produk where sub_kategori='".$sub_kategori."'");
$katnya=mysql_fetch_array($kat);
$kategori=$katnya['kategori'];
 $fileName  = $_FILES['gambar']['name'];
 $fileSize  = $_FILES['gambar']['size'];
 $fileError  = $_FILES['gambar']['error'];
 $fileType  = $_FILES['gambar']['type'];
 $fileName2 = str_replace(" ","-",$fileName);
	$tanggal=date("Y-m-d");
	


?>
	

	
<script language="javascript">
			document.location="index.php?page=post.product&action=newpost&pesan=success";
		</script>