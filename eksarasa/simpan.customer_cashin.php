<?php


if (isset($_POST['submit'])){
	
	
	date_default_timezone_set("Asia/Makassar");

		$nama=$_POST['nama'];

	
		$no_telp=$_POST['no_telp'];

	
		
		
		$insert_piutang=mysql_query("insert into user value('','$nama','$no_telp')");
		
	
	if ($insert_piutang){
		echo("<script>location.href = '?page=tambah.cash.in&listmodaluser&pesan=success';</script>");
	
	}else{

		echo("<script>location.href = '?page=tambah.cash.in&listmodaluser&pesan=error';</script>");
	
	}
}else{
	header("location:index.php?page=404");
}

?>