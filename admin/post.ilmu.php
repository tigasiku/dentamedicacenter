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
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
</head>

<section class="content-header">
	<h1>Ilmu</h1>
</section>

<section class="content">
<div class="row">
  <div class="col-xs-12">
                <div class="box box-solid box-primary">
					<div class="box-header">
						<h3 class="box-title">Ilmu</h3>
						
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
          <form method=\"POST\" action=\"post_ilmu_action.php?action=input\" enctype='multipart/form-data'>
          <table>
			<tr>
				<td width=70>Kategori</td>
				<td>"; ?>
                <select name="kategori" class="form-control input-sm" />
                                            	<?php 
												$qry=mysql_query("select * from kategori_ilmu");
												while($row=mysql_fetch_array($qry)){
												?>
                                               
                                          
                                          		  <optgroup label="<?php echo $row['kategori'] ?>">
                                                   <?php 
										  $query=mysql_query("select * from sub_kategori_ilmu where kategori='".$row['kategori']."'");
										  while($sub=mysql_fetch_array($query)){ ?>
                  <option value="<?php echo $sub['sub_kategori'] ?>" ><?php echo $sub['sub_kategori'] ?></option><?php } ?>
                                                  </optgroup>
                                                <?php } ?>
                                            </select>
<?php                                
    echo "</td>
			</tr>
			<tr>
				<td width=70>Judul</td>
				<td><input type=\"text\" name=\"judul\" size=\"60\" class='form-control input-sm'></td>
			</tr>";
			
			
			
    echo "<tr>
			<td>Isi Berita</td>
			<td><textarea name=\"isi_berita\" style=\"width: 600px; height: 350px;\" class='textarea'></textarea></td>
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
    $get = "select * from ilmu WHERE id = '$_GET[id]'"; // ambil data dari table berita
	$exe = mysql_query($get); // jalankan perintah $get
    $show = mysql_fetch_array($exe); // tampilkan hasil data dari $exe
	?>
  		<h2>Edit </h2>
          <form method="POST" action="post_ilmu_action.php?action=update" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $show['id'] ?>">
          <table cellpadding="1" cellspacing="1">
			<tr>
				<td width="70">Judul</td>
				<td><input type="text" name="judul" value="<?php echo $show['judul'] ?>" size="60"></td>
			</tr>
			<tr>
				<td width="70">Kategori</td>
				<td> <select name="kategori" class="form-control input-sm" />
                                            	<?php 
												$qry=mysql_query("select * from kategori_ilmu");
												while($row=mysql_fetch_array($qry)){
												?>
                                               
                                          
                                          		  <optgroup label="<?php echo $row['kategori'] ?>">
                                                   <?php 
										  $query=mysql_query("select * from sub_kategori_ilmu where kategori='".$row['kategori']."'");
										  while($sub=mysql_fetch_array($query)){ ?>
                  <option value="<?php echo $sub['sub_kategori'] ?>" <?php if($show['sub_kategori']==$sub['sub_kategori']) echo "selected" ?>><?php echo $sub['sub_kategori'] ?></option><?php } ?>
                                                  </optgroup>
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
							$photo="../img/ilmu/".$show['gambar'];}
							
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
	unlink("../img/ilmu/".$_GET['gambar']."");
		unlink("../img/ilmu/_s_".$_GET['gambar']."");
	// tampilkan pesan ketika $del telah dijalankan
	if($del){
		header("location:index.php?page=ilmu&pesan=success");;
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
        