<?php
set_time_limit(0);
if (isset($_POST['submit'])){
$kategori=$_POST['kategori'];
	
$by_penjualan=$_POST['by_penjualan'];
$nomor_akun=$_POST['nomor'];
	$kategoripusat=$_POST['kategoripusat'];
$update=mysql_query("INSERT INTO kategori_uang_keluar value('','".$kategori."','Admin','".$nomor_akun."','".$kategoripusat."','".$by_penjualan."')");

	if ($update){  $pesan="success";}else{ $pesan="error";}

?>		
	<script>
       window.location.href = 'index.php?page=kategori.out&pesan=<?php echo $pesan ?>';
         
      </script>
<?php	
}else{
	header("location:index.php?page=404");
}
?>