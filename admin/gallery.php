<?php
include "koneksi.php";
koneksi_buka();
?>
<style>
a:link { color:#B00004;} a:visited { color:#B00004;} a:active { color:#FFFFFF;} a:hover {color:#FFFFFF;}

p.summery
{

display:block;
margin-bottom:20px;
background-color:#C4EBFF;
border:1px #ddd solid;
border-left:10px #0088cc solid;
padding:10px
}
</style>
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">



<section class="content-header">
	<h1>
		Admin Galeri Foto
         <small><?php echo $_SESSION['judul_graha'] ?></small>
    </h1>
</section>


<section class="content">
				<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Gallery Foto</h3>
                                    
                                </div><!-- /.box-header -->
                                <?php 
					if(isset($_GET['pesan'])){?>  
                           	<div class="small-box bg-green">
                                		<div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                             			</div>
                        	</div><?php }?>
                              <div class="box-body" style="padding-top:0px;">
 <?php
//variabel post
@$p  = $_GET['p'];
if ($p == "simpan_album") {
 $QTambahKategori  = mysql_query("INSERT INTO galerikategori VALUES ('', '".$_POST['kategori']."')");
  if ($QTambahKategori) {
  echo "<script>alert('Berhasil Ditambahkan'); window.open('?page=gallery', '_self');</script>";
 } else {
  echo "<script>alert('Gagal Ditambahkan'); window.open('?page=gallery', '_self');</script>";
 }
}
//variabel Get
@$mod  = $_GET['mod'];
@$id_kat = $_GET['id_kat'];
if ($mod == "del_kat") {
 //hapus file
 
  $query=mysql_query("select * from galeri WHERE kategori = '$id_kat'");
  while($baris=mysql_fetch_array($query))
 {

unlink("../foto/full/".$baris[1]);
 unlink("../foto/thumb/".$baris[1]);
 }
 $QDelKategori  = mysql_query("DELETE FROM galerikategori WHERE id = '$id_kat'");
 $dat=mysql_fetch_array($query);


 $QDelGaleriKat = mysql_query("DELETE FROM galeri WHERE kategori = '$id_kat'");
 
  if ($QDelKategori && $QDelGaleriKat) {
   echo "<script>alert('Berhasil Dihapuskan'); window.open('?page=gallery', '_self');</script>";
 } else {
  echo "<script>alert('Gagal Dihapus'); window.open('index2.php', '_self');</script>";
 }
} else if ($mod == "upload") {
 $id_kat  = $_POST['id_kat'];
 $ket  = $_POST['ket'];
  //upload foto
 $fileName  = $_FILES['foto']['name'];
 $fileSize  = $_FILES['foto']['size'];
 $fileError  = $_FILES['foto']['error'];
 $fileType  = $_FILES['foto']['type'];
  if ($fileType == "image/gif" || $fileType == "image/pjpeg" || $fileType == "image/jpeg") {
     if (move_uploaded_file($_FILES['foto']['tmp_name'], '../foto/'.$fileName)) {
   perkecil("../foto/$fileName", "../foto/");
   mysql_query("INSERT INTO galeri VALUES ('', '$fileName', '$id_kat', '$ket', '0', now())");
  }
    echo "<script>alert('Berhasil Ditambahkan'); window.open('galeri_form.php?id_kat=".$_POST['kategori']."', '_self');</script>";
    } else {
  echo "<script>alert('Gagal Ditambahkan'); window.open('galeri_form.php?id_kat=".$_POST['kategori']."', '_self');</script>";
 }
}
?>
 <!-- End Box Head -->   <div style="margin: 0 15px 0 15px">
 <div id="tKategori">
 <form action="?page=gallery&p=simpan_album" method="post" name="tmKategori" onsubmit="return cekNama();">
 <input type="text" name="kategori" size="40" style="padding: 3px" placeholder="Isikan nama album" required>&nbsp;<input type="submit" value="Buat Kategori" name="tbKat" style="padding: 3px" class="btn btn-primary btn-flat ">
 </form>
 </div>
 </div>
  <div style="margin: 0 15px 0 15px">
 <?php
 $QKategori = mysql_query("SELECT * FROM galerikategori");
 while ($AKategori = mysql_fetch_array($QKategori)) {
  $Kategori = $AKategori[0];
    $QGetNamaKategori = mysql_query("SELECT nama FROM galerikategori WHERE id = '$Kategori'");
  $AGetNamaKategori = mysql_fetch_array($QGetNamaKategori);
  $QJumlahPerKategori = mysql_query("SELECT file FROM galeri WHERE kategori = '$Kategori'");
  $JJumlahPerKategori = mysql_num_rows($QJumlahPerKategori);
  ?>
  <div id='foto' style='background: #F0F0FF; padding: 5px; margin: 10px 0 10px 0; border: solid 1px #CCC; overflow: auto; width: 100%' >
  <h3 style='font-size: 10px; font-weight: bold;'><?php echo $AKategori[1]?> (<?php echo $JJumlahPerKategori ?> foto) | 
  [ <a href='?page=galeri_form&id_kat=<?php echo $AKategori[0] ?>'>Manajemen Kategori Foto</a> ] |
  [ <a href='?page=gallery&p=galeri&mod=del_kat&id_kat=<?php echo $Kategori ?>' onclick="return konfirmasi('Menghapus Data ini - $Kategori - ')">Hapus Kategori ini</a> ]
  </h3>
  <?php
        $QGaleri = mysql_query("SELECT * FROM galeri WHERE kategori = '$Kategori'");
  $no = 1;
  if ($JJumlahPerKategori == 0) {
  ?>
   <font color='red'><b>Belum ada foto dalam kategori ini</b></font>
 <?php } else {
   while ($AGaleri = mysql_fetch_array($QGaleri)) {
    ?>
    <td align='center'>
     <img src="../foto/thumb/<?php echo $AGaleri[1] ?>" width='125px' style='margin: 10px 10px auto;max-height:70px '>
    </td>
    <?php
        $no++;
    if ($no > 6 ) {
     echo "</tr><tr>";
    }
   }
  }
  echo "</div><!--</tr></table><br>-->";
 }
 ?>
 
 </div>
 </div><!-- /.box-body -->
								            <div class="box-footer clearfix">
                                              </div><!-- /.box -->
                        </div>
                        </div>
                        </div>
                    </div>
</section><!-- /.content -->
