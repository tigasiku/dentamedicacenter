<?php
error_reporting(0);
require "../koneksi.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aplikasi Tambah Edit Delete Berita</title>

<!-- TinyMCE -->
<script src="jscripts/tiny_mce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: ".textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
		 "textcolor",
        "searchreplace visualblocks code fullscreen",
        "emoticons insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor  emoticons",
});
</script>
</head>

<section class="content-header">
	<h1>Perusahaan</h1>
</section>

<section class="content">
<div class="row">
  <div class="col-xs-12">
                <div class="box box-solid box-primary">
					<div class="box-header">
						<h3 class="box-title">Perusahaan</h3>
						
					</div>
                    <div class="box-body">
<?php
switch($_GET['action']){
	case "newpost": // apabila post.php?action=newpost maka tampilkan textarea untuk membuat berita baru
	 ?>
	 <?php 
									if(isset($_GET['pesan'])){?>  
                                  	<div class="small-box bg-<?php if($_GET['pesan']=="success"){ echo "green";}else{ echo "red";}?> ">
                                		<div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                             			</div>
                        			</div><?php }?>
    <?php                                
    echo "
          <form method=\"POST\" action=\"post_perusahaan_action.php?action=input\" enctype='multipart/form-data'>
          <table>
			
			
			<tr>
				<td width=70>Perusahaan</td>
				<td><input type=\"text\" name=\"judul\" size=\"60\" class='form-control' placeholder='Perusahaan'></td>
			</tr>
			<tr>
				<td width=70>Situs Web</td>
				<td><div class='input-group'>
                                                <div class='input-group-addon'>
                                                    <i class='fa fa-globe'></i>
                                                </div>
                                                <input type='text' class='form-control' name='situs'  required placeholder='contoh . www.tigasiku.com'>
                                            </div><!-- /.input group -->
				</td>
			</tr>
			";
			
			
			
    echo "<tr>
			<td>Deskripsi</td>
			<td><textarea name=\"isi_berita\" style=\"width: 600px; height: 350px;\" class='textarea' placeholder='Deskripsi'></textarea></td>
		  </tr><tr>
				<td width=70 valign=top>Logo</td>
				<td><input type=\"file\" name=\"gambar\" size=\"60\" id='exampleInputFile' onchange='readURL(this);'><br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</td>
			</tr>";
    
    echo "<tr><td></td></tr><tr>
			<td></td>
			<td><input type=\"submit\" value=\"Simpan\"><input type=\"button\" value=\"Batal\" onclick=\"self.history.back()\"></td>
		  </tr>
		  <tr>
				<td width=70 valign=top></td>
            	
				<td><center>
                               
                                <img id='img_prev' src='' alt='capture photo' style='width:60%;border:8px solid #fff;box-shadow:0px 0px 1px #000;'/></center></td>
			</tr> 
        </table>
	</form>";
    break;
    
    
	case "edit": // apabila post.php?action=edit maka tampilkan textarea untuk mengedit berita
    $get = "select * from perusahaan WHERE kd_perusahaan = '$_GET[id]'"; // ambil data dari table berita
	$exe = mysql_query($get); // jalankan perintah $get
    $show = mysql_fetch_array($exe); // tampilkan hasil data dari $exe
	?>
  		<h2>Edit Perusahaan</h2>
          <form method="POST" action="post_perusahaan_action.php?action=update" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $show['kd_perusahaan'] ?>">
          <table cellpadding="1" cellspacing="1">
          	
			<tr>
				<td width="70">Perusahaan</td>
				<td><input type="text" name="judul" value="<?php echo $show['perusahaan'] ?>" size="60"></td>
			</tr>
			<tr>
				<td width=70>Situs Web</td>
				<td><div class='input-group'>
                                                <div class='input-group-addon'>
                                                    <i class='fa fa-globe'></i>
                                                </div>
                                                <input type='text' class='form-control' name='situs'  value="<?php echo $show['situs_web'] ?>" required placeholder='contoh . www.tigasiku.com'>
                                            </div><!-- /.input group -->
				</td>
			</tr>
			

  			<tr>
			<td>Isi Berita</td>
			<td><textarea name="isi_berita" style="width: 600px; height: 350px;" class='textarea' ><?php echo $show['deskripsi'] ?></textarea></td>
		  </tr>
		  <tr>
				<td width=70 valign=top>Gambar</td>
                <?php 
							
							if ($show['logo']==""){
								$photo="img/no-image.jpg";
							}else{
							$photo="../img/logo_perusahaan/".$show['logo'];}
							
							?>
                            <input type="hidden" name="capture_lama" value="<?php echo $show['logo'] ?>">
				<td><input type="file" name="gambar" size="60"  id="exampleInputFile" onchange="readURL(this);"><br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</td>
			</tr> 
            <tr>
				<td width=70 valign=top></td>
            	
				<td><center>
                               
                                <img id="img_prev" src="<?php echo $photo ?>" alt="capture photo" style="width:60%;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/></center></td>
			</tr> 
 
  <tr>
			<td></td>
			<td><input type="submit" value="Update!"><input type="button" value="Batal" onclick="self.history.back()"></td>
		  </tr>
        </table>
	</form>
	
	<?php 
    break;
	
	case "delete": // apabila post.php?action=delete maka berita akan dihapus
	$get = "delete from perusahaan where kd_perusahaan = '$_GET[id]'"; // hapus data dari table berita
	$del = mysql_query($get); // jalankan perintah $get
	unlink("../img/logo_perusahaan/".$_GET['gambar']."");
		unlink("../img/logo_perusahaan/_s_".$_GET['gambar']."");
	// tampilkan pesan ketika $del telah dijalankan
	if($del){
		header("location:index.php?page=perusahaan&pesan=success");;
	}
	
	break;
}
?>
<br /><br /></div></div></div>
	</div>
</section><!-- /.content -->

</html>
<script>
			function readURL(input) {
				if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				//document.getElementById("img_prev").style.display = "";
				
				reader.onload = function (e) {
				$('#img_prev')
				.attr('src', e.target.result);
				};
	
				reader.readAsDataURL(input.files[0]);
				}
			}
		</script>
        