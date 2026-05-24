<?php
error_reporting(0);
require "../koneksi.php";
	date_default_timezone_set("Asia/Makassar");
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
        "emoticons insertdatetime media table contextmenu paste moxiemanager imagetools"
    ],
	
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor  emoticons | sizeselect | bold italic | fontselect |  fontsizeselect",
	fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
	moxiemanager_file_settings : {
			/* Only list txt files, and remove side navigation. */
    		moxiemanager_title : 'Files',
			moxiemanager_extensions : 'txt',
			moxiemanager_leftpanel : false
    	},
    	moxiemanager_image_settings : {
			/* Scope to different folder, show thumbnails of selected extensions */
			moxiemanager_title : 'Images',
    		moxiemanager_extensions : 'jpg,png,gif',
    		moxiemanager_rootpath : '/testfiles/testfolder',
    		moxiemanager_view : 'thumbs'
    }
});
</script>
</head>

<section class="content-header">
	<h1>Artikel</h1>
</section>

<section class="content">
<div class="row">
  <div class="col-xs-12">
                <div class="box box-solid box-primary">
					<div class="box-header">
						<h3 class="box-title">Artikel</h3>
						
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
          <form method=\"POST\" action=\"post_action.php?action=input\" enctype='multipart/form-data'>
          <table>
			<tr>
				<td width=70>Jadwal Terbit</td>
				<td><div class='input-group'>
                                                <div class='input-group-addon'>
                                                    <i class='fa fa-calendar'></i>
                                                </div>
                                                <input type='text' class='form-control' name='tanggal_terbit' id='dp1' required value='".date("Y-m-d")."'>
                                            </div><!-- /.input group -->
				</td>
			</tr>
			<tr>
				<td width=70>Kategori</td>		
				<td>"; ?>
                	<select type="text" name="kategori" class='form-control'>
						<?php 
						$kategori=mysql_query("select * from kategori_berita");
						while($kat=mysql_fetch_array($kategori)){
						?>
                        <option value='<?php echo $kat['kategori'] ?>'><?php echo $kat['kategori'] ?></option>	
						<?php } ?>
					</select>
                    
                    <?php echo "
				</td>
			</tr>
			<tr>
				<td width=70>Judul</td>
				<td><input type=\"text\" name=\"judul\" size=\"60\" class='form-control' placeholder='Judul'></td>
			</tr>";
			
			
			
    echo "<tr>
			<td>Deskripsi</td>
			<td><textarea name=\"isi_berita\" style=\"width: 600px; height: 350px;\" class='textarea' placeholder='Deskripsi'></textarea></td>
		  </tr><tr>
				<td width=70 valign=top>Gambar</td>
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
    $get = "select * from berita WHERE id = '$_GET[id]'"; // ambil data dari table berita
	$exe = mysql_query($get); // jalankan perintah $get
    $show = mysql_fetch_array($exe); // tampilkan hasil data dari $exe
	?>
  		<h2>Edit Artikel</h2>
          <form method="POST" action="post_action.php?action=update" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $show['id'] ?>">
          <table cellpadding="1" cellspacing="1">
          	<tr>
				<td width=70>Jadwal Terbit</td>
				<td><div class='input-group'>
                                                <div class='input-group-addon'>
                                                    <i class='fa fa-calendar'></i>
                                                </div>
                                                <input type='text' class='form-control' name='tanggal_terbit' id='dp1' required value="<?php echo $show['tanggal'] ?>">
                                            </div><!-- /.input group -->
				</td>
			</tr>
			<tr>
				<td width="70">Judul</td>
				<td><input type="text" name="judul" value="<?php echo $show['judul'] ?>" size="60"></td>
			</tr>
			<tr>
				<td width="70">Kategori</td>
				<td>
                
                <select type="text" name="kategori" class='form-control'>
						<?php 
						$kategori=mysql_query("select * from kategori_berita");
						while($kat=mysql_fetch_array($kategori)){
						?>
                        <option value='<?php echo $kat['kategori'] ?>' <?php if($show['kategori']==$kat['kategori']) echo "selected" ?>><?php echo $kat['kategori'] ?></option>	
						<?php } ?>
					</select>
                
				</td>
			</tr>
			

  			<tr>
			<td>Isi Berita</td>
			<td><textarea name="isi_berita" style="width: 600px; height: 350px;" class='textarea' ><?php echo $show['isi_berita'] ?></textarea></td>
		  </tr>
		  <tr>
				<td width=70 valign=top>Gambar</td>
                <?php 
							
							if ($show['gambar']==""){
								$photo="img/no-image.jpg";
							}else{
							$photo="../img/blog/".$show['gambar'];}
							
							?>
                            <input type="hidden" name="capture_lama" value="<?php echo $show['gambar'] ?>">
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
	$get = "delete from berita where id = '$_GET[id]'"; // hapus data dari table berita
	$del = mysql_query($get); // jalankan perintah $get
	unlink("../img/blog/".$_GET['gambar']."");
		unlink("../img/blog/_s_".$_GET['gambar']."");
	// tampilkan pesan ketika $del telah dijalankan
	if($del){
		header("location:index.php?page=artikel&pesan=success");;
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
        