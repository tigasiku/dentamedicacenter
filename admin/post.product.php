<?php
error_reporting(0);
require "../koneksi.php";

switch($_GET['action']){
					case "newpost":
					
    break;
	
	case "delete": 
	$get = "delete from produk where id = '$_GET[id]'"; 
	$del = mysql_query($get); 
	unlink("../img/portfolio/full/".$_GET['gambar']."");
	unlink("../img/portfolio/thumb/".$_GET['gambar']."");
	$gambar=mysql_query("select filenya from gambar_detail where id='".$_GET['id']."'");
	while($detail=mysql_fetch_array($gambar)){
	unlink("../img/portfolio/full/".$detail['filenya']."");
	unlink("../img/portfolio/thumb/".$detail['filenya']."");		
	}
	$delete=mysql_query("delete from gambar_detail where id='$_GET[id]'");
	
	// tampilkan pesan ketika $del telah dijalankan
	if($del){
		header("location:index.php?page=product&pesan=Data $_GET[id] berhasil dihapus");
	}
	else{
	header("location:index.php?page=product&pesan=error");
	}
	break;
}
?>
	
            

