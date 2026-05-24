<?php
if (isset($_POST['submit'])){
$kategori=$_POST['kategori'];
$id=$_POST['kode'];
$by_penjualan=$_POST['by_penjualan'];
	
	
$nomor_akun=$_POST['nomor'];
	$kategoripusat=$_POST['kategoripusat'];
	
$update=mysql_query("update kategori_uang_keluar set kategori_uang_keluar='".$kategori."',nomor_akun='".$nomor_akun."',kode_klasifikasi='".$kategoripusat."',by_penjualan='".$by_penjualan."' where kode_kategori_uang_keluar='$id'");

if ($update){  $pesan="success";
			}else{ $pesan="error";
			}

?>		
	<script>
       window.location.href = 'index.php?page=edit.kategori.out&id=<?php echo $id ?>&pesan=<?php echo $pesan ?>';
         
      </script>
<?php	
}else{
	header("location:index.php?page=404");
}
?>