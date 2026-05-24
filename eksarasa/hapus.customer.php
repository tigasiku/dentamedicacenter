<?php


if (isset($_GET['kode_customer'])){
	
$username=$_GET['kode_customer'];
$update=mysql_query("delete from customer where kode_customer='".$username."'");
	
		
	
	if ($update){
		echo("<script>location.href = '?page=customer&pesan=success';</script>");
	
	}else{

		echo("<script>location.href = '?page=customer&pesan=error';</script>");
	
	}
	
}else{
	header("location:index.php?page=404");
}

?>