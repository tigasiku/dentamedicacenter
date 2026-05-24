<?php
error_reporting(0);
require "../koneksi.php";
$qry=mysql_query("select * from produk where id = '".$_GET['id']."'");
$row=mysql_fetch_array($qry);									
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aplikasi Tambah Edit Delete Berita</title>
<script type = "text/javascript">

function addCommas(nStr) {
nStr = nStr.replace(/[^0-9\.]/g,"");
nStr = Number(nStr).toFixed(0);   // remove excess decimals
var rgx = /(\d+)(\d{3})/;
while (rgx.test(nStr)) {
nStr = nStr.replace(rgx, '$1,$2');
}
if (nStr.indexOf('.') == -1) {  // if whole number add .00
nStr = nStr + "";
}
nStr = nStr.replace(/(\.\d)$/,"$10");  // if only one DP add another 0
return nStr;
}

var x1;
var x2;

function show() {
var totalStr = (x1 + x2).toString();
totalStr = addCommas(totalStr);
document.form1.t.value = totalStr;
}


</script>
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
      <h1>Product</h1>
     
    </div>
<?php 
 if(isset($_GET['pesan']))
 {
 ?> 
<div class="container-fluid" style="padding-right:5px;padding-left:5px">
        					<div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Pesan</h3>
                                   <div class="box-tools pull-right">
                                        
                                        <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    Data <code><?php echo $_GET['id'] ?></code> berhasil diedit                                    
                                </div><!-- /.box-body -->
                            </div>
</div><?php } ?>           
<div class="container-fluid" style="padding-right:5px;padding-left:5px">
        <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Product</h3>
      </div>
      <div class="panel-body">
        <form action="perbarui.product.php" method="post" enctype="multipart/form-data" id="form-information" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
       	   <li class=""><a href="#tab-data" data-toggle="tab" aria-expanded="false">Data</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
            	<br />
              <div class="tab-content">
                  <div class="tab-pane active" id="language1">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Zona</label>
                    <div class="col-sm-10">
                  
                      <select type="text" name="distributor"  class="form-control"  > 
                      <?php 
					  $query=mysql_query("select * from distributor");
					  while($zona=mysql_fetch_array($query)){
					  ?>
                       		<option value="<?php echo $zona['kode']?>" <?php if($zona['kode']==$row['kd_distributor']) echo "selected" ?> ><?php echo $zona['1']?></option>
                            <?php } ?>
                       </select>
                                          </div>
                  </div>
                   <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Kategori</label>
                    <div class="col-sm-10">
                  
                     <select name="kategori" class="form-control input-sm" />
                                            	<?php 
												$kategori=mysql_query("select * from kategori_produk");
												while($row_kategori=mysql_fetch_array($kategori)){
												?>
                                               
                                          
                                          		  <optgroup label="<?php echo $row_kategori['kategori'] ?>">
                                                   <?php 
										  $query=mysql_query("select * from sub_kategori_produk where kategori='".$row_kategori['kategori']."'");
										  while($sub=mysql_fetch_array($query)){ ?>
                  <option value="<?php echo $sub['0'] ?>" <?php if($sub['sub_kategori']==$row['sub_kategori']) echo "selected" ?> ><?php echo $sub['sub_kategori'] ?></option><?php } ?>
                                                  </optgroup>
                                                <?php } ?>
                                            </select>
                                          </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">ISBN</label>
                    <div class="col-sm-10">
                   <input type="hidden" name="id" value="<?php echo $row['id'] ?>" id="input-title1" class="form-control"  > 
                      <input type="text" name="isbn" required="required" value="<?php echo preg_replace("/[^0-9]/", "",$row['isbn']) ?>" placeholder="ISBN" id="input-title1" class="form-control"  > 
                       
                                          </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Product Name</label>
                    <div class="col-sm-10">
                  
                      <input type="text" name="nama" required="required" value="<?php echo $row['judul'] ?>" placeholder="Product Name" id="input-title1" class="form-control"  > 
                       
                                          </div>
                  </div>
                    <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Penulis</label>
                    <div class="col-sm-10">
                  
                      <input type="text" name="penulis" required="required" value="<?php echo $row['penulis'] ?>" placeholder="Penulis" id="input-title1" class="form-control"  > 
                       
                                          </div>
                  </div>
                 	
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Publisher</label>
                    <div class="col-sm-10">
                  
                      <input type="text" name="publisher" required="required" value="<?php echo $row['publishernya'] ?>" placeholder="Publisher" id="input-title1" class="form-control"  > 
                       
                                          </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-description1">Description</label>
                    <div class="col-sm-10">
                      <textarea name="isi" placeholder="Description" id="input-description1" class="form-control textarea" style="min-height:200px">
	<?php echo $row['spesifikasi'] ?>
</textarea>
</div>
                                       
                  </div>
                
                   
                </div>
             </div>
            </div>
             <div class="tab-pane" id="tab-data">
            	<br />
              <div class="tab-content">
                  <div class="tab-pane active" id="language1">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Information Title</label>
                    <div class="col-sm-10">
                      <label for="exampleInputFile"></label>
                      <input type="file" name="gambar" size="60"  id="exampleInputFile" onchange="readURL(this);" required="required">
                       
 					<input type="hidden" name="capture_lama" value="<?php echo $row['file'] ?>">
                     <img id="img_prev" src="../img/portfolio/thumb/<?php echo $row['file'] ?>" alt="capture photo" style="width:180px;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/></center><br>
                                        </div>
                                          </div>
                  </div>
                 
                   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order">Harga</label>
                            <div class="col-sm-10">
                           		 <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="">Rp.</i>
                                            </div>
                              <input type="text" name="harga" required="required" value="<?php echo number_format($row['harga']) ?>"  placeholder="Harga" onblur="x1 = Number(this.value) || 0; this.value=addCommas(this.value)" class="form-control" >
                              		</div>
                            </div>
             	 </div>
                   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order">Diskon</label>
                            <div class="col-md-2">
                             
                                    <div class="input-group">
                                            
                                            <input type="text" name="diskon"  value="<?php echo ($row['diskon']) ?>" class="form-control" >
                                            <div class="input-group-addon">
                                                        <i class="">%</i>
                                             </div>
                                     </div>        
                            </div>
             	 </div>
                 <div class="form-group">
                <label class="col-sm-2 control-label" for="input-length">Dimensions (L x W)</label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-4">
                    	<div class="input-group">
                      <input type="text" name="length"  value="<?php echo ($row['length']) ?>" placeholder="Length" id="input-length" class="form-control">
                      <div class="input-group-addon">
                                                        <i class="">cm</i>
                                             </div>
                                     </div>    
                    </div>
                    <div class="col-sm-4">
                    	<div class="input-group">
                      <input type="text" name="width" value="<?php echo ($row['width']) ?>" placeholder="Width" id="input-width" class="form-control">
                       <div class="input-group-addon">
                                                        <i class="">cm</i>
                                             </div>
                                     </div>    
                    </div>
                   
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-weight">Weight</label>
                <div class="col-sm-10">
              			  <div class="input-group">
                  <input type="text" name="weight" value="<?php echo ($row['weight']) ?>" placeholder="Weight" id="input-weight" class="form-control">
                 						 <div class="input-group-addon">
                                                        <i class="">Gram</i>
                                             </div>
						   </div>                                             
                </div>
              </div>
                 <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status">Status</label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                                        <option value="Y" <?php if($row['status']=="Y") echo "selected" ?>>Enabled</option>
                    <option value="N" <?php if($row['status']=="N") echo "selected" ?>>Disabled</option>
                                      </select>
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
        