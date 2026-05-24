<?php
error_reporting(0);
require "../koneksi.php";
$qry=mysql_query("select * from service where id='".$_GET['id']."'");
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
      <h1>Treatments</h1>
     
    </div>
<div class="container-fluid" style="padding-right:5px;padding-left:5px">
        <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Treatments</h3>
      </div>
      <div class="panel-body">
        <form action="perbarui.treatments.php" method="post" enctype="multipart/form-data" id="form-information" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
           <li class=""><a href="#tab-data" data-toggle="tab" aria-expanded="false">Gambar Detail</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
            	<br />
              <div class="tab-content">
                                <div class="tab-pane active" id="language1">
                     <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Gambar</label>
                    <div class="col-sm-10">
                      <label for="exampleInputFile"></label>
                      <input type="file" name="gambar" size="60"  id="exampleInputFile" onchange="readURL(this);" >
                       
 					<input type="hidden" name="capture_lama" value="<?php echo $row['gambar'] ?>">
                     <img id="img_prev" src="../img/service/<?php echo $row['gambar'] ?>" alt="capture photo" style="width:180px;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/></center><br>
                                        </div>
                  </div>
                            
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Treatments</label>
                    <div class="col-sm-10">
                      <input type="hidden" name="kode" value="<?php echo $row['id'] ?>" placeholder="Information Title" id="input-title1" class="form-control" readonly="readonly" > 
                      <input type="text" name="nama" value="<?php echo $row['judul']; ?>" placeholder="Treatments" id="input-title1" class="form-control"  > 
                       
                                          </div>
                  </div>
                   
                 
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-description1">Description</label>
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
          
            <div class="box-footer">
					
						<hr />
						<button type="submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				
					<div class="clearfix"></div>
					</div>
          </div>
            <div class="tab-pane" id="tab-data">
            	<br />
              <div class="tab-content">
                  <div class="tab-pane active" id="language1">
                
                   <div class="form-group" id="status">
            			<label class="control-label col-sm-2" for="alamat">Gambar Tambahan:</label>
                   		<div class="col-sm-10">
                             	<input type="file" name="gambar_detil[]" size="60"  class="form-control" multiple accept="image/*">
                    	</div>
                  </div>
                  <br />
                    <div class="col-md-12" >       
                                         <?php
										 $gambar=mysql_query("select * from service_detail where service='".$row['id']."'");  
										 while($row2=mysql_fetch_array($gambar)){     
										 ?>
                                        <div class="col-md-2" align="center" id="<?php echo $row2['id']?>">
                                        <?php 
							
										if ($row2['file']==""){
											$photo="../img/no-image.jpg";
										}else{
										$photo="../img/service/thumb/".$row2['file'];}
										
										?>
											<img id="img_prev" src="<?php echo $photo ?>" alt="capture photo" style="width:100%;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/>
                                            <a class="delete " id="<?php echo $row2['id']?>" style="cursor:pointer" >hapus</a>
                                        </div>       
                                      
                                         <?php } ?>
                                         </div> 
                   
                    <div class="box-footer"><hr />
						<button type="submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-save"></i> &nbsp;Simpan</button>
                        <div class="clearfix"></div>
					</div>
                    
                </div>
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
			$(document).ready(function()
{
	$('div a.delete').click(function()
	{
		if (confirm("Anda yakin untuk menghapus gambar ini?"))
		{
			
			var id =$(this).attr('id');
			var data2 = 'id=' + id ;
			var parent = $(this).parent();

			$.ajax(
			{
				   type: "POST",
				   url: "hapus_photo_treat.php",
				   data:data2,
				   cache: false,

				   success: function()
				   {
					parent.fadeOut('slow', function() {$(this).remove();});
				   }
			 });
		}
	});

	// style the table with alternate colors
	// sets specified color for every odd row

});
		</script>
        