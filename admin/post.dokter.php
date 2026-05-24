<?php
error_reporting(0);
require "../koneksi.php";
$qry=mysql_query("select * from dokter where id='".$_GET['id']."'");
$row=mysql_fetch_array($qry);
										?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aplikasi Tambah Edit Delete Berita</title>
<script src="../js/comma.js"></script>
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

<div id="content">
  <div class="page-header"  style="padding-right:5px;padding-left:5px">
    <div class="container-fluid">
  
      </div>
      <h1>Dokter</h1>
     
    </div>
<div class="container-fluid" style="padding-right:5px;padding-left:5px">
        <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Dokter</h3>
      </div>
      <div class="panel-body">
        <form action="perbarui.dokter.php" method="post" enctype="multipart/form-data" id="form-information" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
          
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
            	<br />
              <div class="tab-content">
                                <div class="tab-pane active" id="language1">
                                         <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Divisi</label>
                    <div class="col-sm-10">
                  
                      <select type="text" name="divisi"  class="form-control"  > 
                      <?php 
					  $qry3=mysql_query("select * from divisi");
					  while($row3=mysql_fetch_array($qry3)){
					  ?>
                       		<option value="<?php echo $row3['0'] ?>" <?php if($row3['0']==$row['divisi']) echo "selected" ?>><?php echo $row3['1']?></option>
                            <?php } ?>
                       </select>
                                          </div>
                  </div>
                     <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Photo</label>
                    <div class="col-sm-10">
                      <label for="exampleInputFile"></label>
                      <input type="file" name="gambar" size="60"  id="exampleInputFile" onchange="readURL(this);" >
                       
 					<input type="hidden" name="capture_lama" value="<?php echo $row['gambar'] ?>">
                     <img id="img_prev" src="../img/dentist/thumb/<?php echo $row['gambar'] ?>" alt="capture photo" style="width:180px;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/></center><br>
                                        </div>
                  </div>
                       <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-title1">Photo Full Body</label>
                        <div class="col-sm-10">
                          <label for="exampleInputFile"></label>
                          
                          <input type="file" name="gambar_detail" size="60"   >
                          <input type="hidden" name="capture_lama2" value="<?php echo $row['gambar_body'] ?>">
                     <img id="img_prev" src="../img/dentist/full/<?php echo $row['gambar_body'] ?>" alt="capture photo" style="width:180px;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/></center><br>
                       
 					
                  
                                        </div>
                  </div> 
                            
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Dokter</label>
                    <div class="col-sm-10">
                      <input type="hidden" name="kode" value="<?php echo $row['id'] ?>" placeholder="Information Title" id="input-title1" class="form-control" readonly="readonly" > 
                      <input type="text" name="nama" value="<?php echo $row['nama']; ?>" placeholder="Nama" id="input-title1" class="form-control"  > 
                       
                                          </div>
                  </div>
                  
                    <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Profesi</label>
                    <div class="col-sm-10">
                   
                      <input type="text" name="profesi" value="<?php echo $row['profesi']; ?>" placeholder="Profesi" id="input-title1" class="form-control"  > 
                       
                                          </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-description1">Description</label>
                    <div class="col-sm-10">
                      <textarea name="isi_pendek" placeholder="Description" id="input-description1" class="form-control textarea" style="min-height:100px">
	<?php echo $row['isi_pendek'] ?>
</textarea>
</div>
                                       
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-description1">Biografi Lengkap</label>
                    <div class="col-sm-10">
                      <textarea name="isi" placeholder="Description" id="input-description1" class="form-control textarea" style="min-height:400px">
	<?php echo $row['isi'] ?>
</textarea>
</div>
                                       
                  </div>
                   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order">Sort Order</label>
                            <div class="col-sm-10">
                              <input type="text" name="sort_order" value="<?php echo $row['sort_by'] ?>" placeholder="Sort Order" id="input-sort-order" class="form-control">
                            </div>
             	 </div>
                 
                </div>
             </div>
            </div>
            <div class="box-footer">
					
						<hr />
						<button type="submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				
					<div class="clearfix"></div>
					</div>
          </div>
        </form>
      </div>
    </div>
  </div>
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
        