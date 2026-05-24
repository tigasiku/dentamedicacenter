<?php
error_reporting(0);
require "../koneksi.php";

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
      <h1>Testimoni</h1>
     
    </div>
<div class="container-fluid" style="padding-right:5px;padding-left:5px">
        <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> Tambah Testimoni</h3>
      </div>
      <div class="panel-body">
        <form action="simpan.testimoni.php" method="post" enctype="multipart/form-data" id="form-information" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
          
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
            	<br />
              <div class="tab-content">
                                <div class="tab-pane active" id="language1">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Testimoni</label>
                    <div class="col-sm-10">
                     
                      <input type="text" name="title" value="" placeholder="Testimoni Dari" id="input-title1" class="form-control"  > 
                       
                                          </div>
                  </div>
                   <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Profesi</label>
                    <div class="col-sm-10">
                     
                      <input type="text" name="profesi" value="" placeholder="Profesi" id="input-title1" class="form-control"  > 
                       
                                          </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-description1">Description</label>
                    <div class="col-sm-10">
                      <textarea name="isi" placeholder="Description" id="input-description1" class="form-control textarea" style="min-height:400px">
	
</textarea>
</div>
                                       
                  </div>
                   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order">Sort Order</label>
                            <div class="col-sm-10">
                              <input type="text" name="sort_order" value="<?php 
							  $qry=mysql_num_rows(mysql_query("select * from testimoni"));
							  
							  echo $qry+1 ?>" placeholder="Sort Order" id="input-sort-order" class="form-control">
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
        