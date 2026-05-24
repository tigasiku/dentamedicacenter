<?php
@$store=mysql_fetch_array(mysql_query("select * from stores"));
 function isMobile() {
											return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
if(isset($_COOKIE["type"])){
			$sql="select * from admin where username='".$_COOKIE["type"]."' and status ='Y'";
			$kueri=mysql_query($sql);
			$jumlah=mysql_num_rows($kueri);
			$data=mysql_fetch_array($kueri);
		if ($jumlah==0 ){
			
			
		session_start();	
		session_destroy();
			setcookie("type", "", time()-3600);
			 header ("location:index.php");
		}
}
if(isset($_COOKIE["type"]) and !isset($_SESSION["user_graha3"] )){
			$sql="select * from admin where username='".$_COOKIE["type"]."' and status ='Y'";
			$kueri=mysql_query($sql);
			$jumlah=mysql_num_rows($kueri);
			$data=mysql_fetch_array($kueri);
		if ($jumlah==1 ){
			
			$_SESSION["user_graha3"] = $data["username"];
			$_SESSION["pass_graha3"] = $data["pass"];
			$_SESSION["loglevel_graha3"] = $data["level"];
			
		$_SESSION["loglevel"] = $data["level"];
				
					$_SESSION['nama_graha'] =  $data['nama'];
					$_SESSION['id_fb'] =  $data['id_fb'];
					$_SESSION['jenis_kelamin'] =  $data['jenis_kelamin'];
					$_SESSION['photo'] =  $data['photo'];
					$_SESSION['email'] =  $data['email'];
				
				$_SESSION['loglevel_agung'] =  "Agung";
					$_SESSION['masuk_lagi'] =  "Aktif";
					$_SESSION['password_lagi'] =  "Aktif";
					$_SESSION['level_lagi'] =  "Aktif";
			
			
			mysql_query("update admin set last='".date("Y-m-d H:i:s")."' where username='".$_COOKIE["type"]."' ");
		}else{
		session_start();	
		session_destroy();
			setcookie("type", "", time()-3600);
			 header ("location:index.php");
		}
}
if(isset($_POST['filter_kode_barang'])){
	$filter_kode_barang=$_POST['filter_kode_barang'];
}else{
	@$filter_kode_barang=$_GET['kode_barang'];
}
if(isset($_POST['filter_dari'])){
	$filter_dari=$_POST['filter_dari'];
}else{
	@$filter_dari=$_GET['filter_dari'];
}
if(isset($_POST['filter_sampai'])){
	$filter_sampai=$_POST['filter_sampai'];
}else{
	@$filter_sampai=$_GET['filter_sampai'];
}
if(isset($_POST['filter_uraian'])){
	$filter_uraian=$_POST['filter_uraian'];
}else{
	@$filter_uraian=$_GET['filter_uraian'];
}
if(isset($_POST['filter_nama'])){
	$filter_nama=$_POST['filter_nama'];
}else{
	@$filter_nama=$_GET['filter_nama'];
}
if(isset($_POST['filter_kategoripusat'])){
	$filter_kategori_pusat=$_POST['filter_kategoripusat'];
}else{
	@$filter_kategori_pusat=$_GET['filter_kategori_pusat'];
}
if(isset($_POST['filter_kategori'])){
	$filter_kategori=$_POST['filter_kategori'];
}else{
	@$filter_kategori=$_GET['filter_kategori'];
}
if(isset($_POST['filter_sub_kategori'])){
	$filter_sub_kategori=$_POST['filter_sub_kategori'];
}else{
	@$filter_sub_kategori=$_GET['filter_sub_kategori'];
}
if(isset($_POST['filter_proyek'])){
	$filter_proyek=$_POST['filter_proyek'];
}else{
	@$filter_proyek=$_GET['filter_proyek'];
}
if(isset($_POST['filter_customer'])){
	$filter_customer=$_POST['filter_customer'];
}else{
	@$filter_customer=$_GET['filter_customer'];
}
if(isset($_POST['filter_id'])){
	$filter_id=$_POST['filter_id'];
}else{
	@$filter_id=$_GET['filter_id'];
}
if(isset($_POST['filter_gudang'])){
	$filter_gudang=$_POST['filter_gudang'];
}else{
	@$filter_gudang=$_GET['filter_gudang'];
}
if(isset($_POST['filter_status'])){
	$filter_status=$_POST['filter_status'];
}
elseif(isset($_GET['filter_status'])){
	$filter_status=$_GET['filter_status'];
}else{
	@$filter_status="Y";
}
?>