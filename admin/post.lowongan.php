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
	<h1>Lowongan Kerja</h1>
</section>

<section class="content">
<div class="row">
  <div class="col-xs-12">
                <div class="box box-solid box-primary">
					<div class="box-header">
						<h3 class="box-title">Lowongan Kerja</h3>
						
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
          <form method=\"POST\" action=\"post_lowongan_action.php?action=input\" enctype='multipart/form-data'>
          <table>";
	?>		
			<tr>
				<td width=70>Perusahaan</td>
				<td><select type="text" name="perusahaan" class="form-control">
                		<?php 
						$qry=mysql_query("select * from perusahaan");
						while ($row=mysql_fetch_array($qry)){
						?>
						<option value="<?php echo $row[0] ?>" ><?php echo $row[1] ?></option>	
                        <?php } ?>
					</select></td>
			</tr>
            
		<?php
		 echo "<tr>
				<td width=70>Judul Lowongan</td>
				<td><input type=\"text\" name=\"judul\" size=\"60\" class='form-control' placeholder='Judul Lowongan'></td>
			</tr>
			
			";
			
			
			
    echo "<tr>
			<td>Job Deskripsi</td>
			<td><textarea name=\"job\" style=\"width: 600px; height: 350px;\" class='textarea' placeholder='Job'></textarea></td>
		  </tr>
		  <tr>
			<td>Requirements</td>
			<td><textarea name=\"requirements\" style=\"width: 600px; height: 350px;\" class='textarea' placeholder='Requirements'></textarea></td>
		  </tr>
		";
    
    echo "<tr><td></td></tr><tr>
			<td></td>
			<td><input type=\"submit\" value=\"Simpan\"><input type=\"button\" value=\"Batal\" onclick=\"self.history.back()\"></td>
		  </tr>
		  <tr>
				<td width=70 valign=top></td>
            	
				
			</tr> 
        </table>
	</form>";
    break;
    
    
	case "edit": // apabila post.php?action=edit maka tampilkan textarea untuk mengedit berita
    $get = "select * from perusahaan,lowongan_kerja WHERE kd_lowongan = '$_GET[id]'"; // ambil data dari table berita
	$exe = mysql_query($get); // jalankan perintah $get
    $show = mysql_fetch_array($exe); // tampilkan hasil data dari $exe
	?>
  		<h2>Edit Lowongan</h2>
          <form method="POST" action="post_lowongan_action.php?action=update" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $show['kd_lowongan'] ?>">
          <table cellpadding="1" cellspacing="1">
          	<tr>
				<td width=70>Perusahaan</td>
				<td><select type="text" name="perusahaan" class="form-control">
                		<?php 
						$qry=mysql_query("select * from perusahaan");
						while ($row=mysql_fetch_array($qry)){
						?>
						<option value="<?php echo $row[0] ?>" <?php if ($show['kd_perusahaan']==$row[0]) echo "selected" ?>><?php echo $row[1] ?></option>	
                        <?php } ?>
					</select></td>
			</tr>
			<tr>
				<td width="70">Judul Lowongan</td>
				<td><input type="text" name="judul" value="<?php echo $show['judul_lowongan'] ?>" size="60"></td>
			</tr>
			
			

  			<tr>
			<td>Job Deskripsi</td>
			<td><textarea name="job" style="width: 600px; height: 350px;" class='textarea' placeholder='Job'><?php echo $show['job'] ?></textarea></td>
		  </tr>
		  <tr>
			<td>Requirements</td>
			<td><textarea name="requirements" style="width: 600px; height: 350px;" class='textarea' placeholder='Requirements'><?php echo $show['requirements'] ?></textarea></td>
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
	$get = "delete from lowongan_kerja where kd_lowongan = '$_GET[id]'"; // hapus data dari table berita
	$del = mysql_query($get); // jalankan perintah $get
	
	// tampilkan pesan ketika $del telah dijalankan
	if($del){
		header("location:index.php?page=lowongan&pesan=success");;
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
        