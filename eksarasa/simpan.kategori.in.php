<?php
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){
$kategori=$_POST['kategori'];
	
$nomor_akun=$_POST['nomor'];
	$kategoripusat=$_POST['kategoripusat'];
$update=mysql_query("INSERT INTO kategori_uang_masuk value('','".$kategori."','Admin','$nomor_akun','$kategoripusat')");

if ($update){  $pesan="success";}else{ $pesan="error";}

?>		
	<script>
       window.location.href = 'index.php?page=kategori.in&pesan=<?php echo $pesan ?>';
         
      </script>
<?php	
}else{
	header("location:index.php?page=404");
}
?>