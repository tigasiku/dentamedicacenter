<?php

if (isset($_POST['submit'])){
	
	$nama = $_POST['nama'];
	$no_hp = $_POST['no_hp'];		
 
$isidata = "insert into customer value('','$nama','$no_hp')";
mysql_query ($isidata);

	if ($isidata){
		echo("<script>location.href = '?page=tambah.customer&pesan=success';</script>");
	
	}else{

		echo("<script>location.href = '?page=tambah.customer&pesan=error';</script>");
	
	}
	
}else{
	header("location:index.php?page=404");
}

?>