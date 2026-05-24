<?php
set_time_limit(0);
include "koneksi.php";

if (isset($_POST['submit'])){
$kategori=$_POST['kategori'];
$id=$_POST['kode'];

$nomor_akun=$_POST['nomor'];
	$kategoripusat=$_POST['kategoripusat'];
$update=mysql_query("update kategori_uang_masuk set kategori_uang_masuk='".$kategori."',nomor_akun='".$nomor_akun."',kode_klasifikasi='".$kategoripusat."' where kode_kategori_uang_masuk='$id'");
		
if ($update){  $pesan="success";}else{ $pesan="error";}

?>		
	<script>
       window.location.href = 'index.php?page=edit.kategori.in&id=<?php echo $id ?>&pesan=<?php echo $pesan ?>';
         
      </script>
<?php	
}else{
	header("location:index.php?page=404");
}
?>