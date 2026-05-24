<?php
error_reporting(0);
							
			
$row=mysql_fetch_array(mysql_query("select * from stores "));			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aplikasi Tambah Edit Delete Berita</title>

</head>


  
    <section class="content-header">
	<h1>
		Store Location<small></small>
    </h1>
</section>
    <?php 
 if(isset($_GET['pesan']))
 {
 ?> 
 <div id="content">
<div class="container-fluid" style="padding-right:5px;padding-left:5px">
        					<div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Pesan</h3>
                                   <div class="box-tools pull-right">
                                        
                                        <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    Data berhasil disimpan                             
                                </div><!-- /.box-body -->
                            </div>
</div><?php } ?>     
<div class="container-fluid" style="padding-right:5px;padding-left:5px;padding-top:20px">
        <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> Store</h3>
      </div>
      <div class="panel-body">
        <form action="perbarui.store.location.php" method="post" enctype="multipart/form-data" id="form-information" class="form-horizontal">
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
                    <label class="col-sm-2 control-label" for="input-title1">Store Name</label>
                    <div class="col-sm-10">
                  
                    <input type="text" name="store_name" value="<?php echo $row[0] ?>"  placeholder="Store Name" id="input-title1" class="form-control"  > 
                                          </div>
                  </div>
                   <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Store Tagline</label>
                    <div class="col-sm-10">
                  
                      <input type="text" name="store_tagline" value="<?php echo $row[1] ?>"  placeholder="Store Tagline" id="input-title1" class="form-control"  > 
                       
                                          </div>
                  </div>
                   <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Store Owner</label>
                    <div class="col-sm-10">
                  
                  <input type="text" name="store_owner" value="<?php echo $row[2] ?>"  placeholder="Store Owner" id="input-title1" class="form-control" > 
                                          </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Address</label>
                    <div class="col-sm-10">
                  
                      <input type="text" name="store_address" value="<?php echo $row[3] ?>"  placeholder="Address" id="input-title1" class="form-control"  > 
                       
                                          </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Geocode</label>
                    <div class="col-sm-10">
                  
                      <input type="text" name="store_geocode"  value="<?php echo $row[4] ?>" placeholder="Geocode" id="input-title1" class="form-control"  > 
                       
                                          </div>
                  </div>
                    <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Email</label>
                    <div class="col-sm-10">
                  
                      <input type="text"  name="store_email" value="<?php echo $row[5] ?>" placeholder="Email" id="input-title1" class="form-control"  > 
                       
                                          </div>
                  </div>
                 	
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Telephone</label>
                    <div class="col-sm-10">
                  
                      <input type="text"  name="store_telp" value="<?php echo $row[6] ?>" placeholder="Telephone" id="input-title1" class="form-control"  > 
                       
                                          </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-description1">Fax</label>
                    <div class="col-sm-10">
                       <input type="text" name="store_fax" value="<?php echo $row[7] ?>"  placeholder="Fax" id="input-title1" class="form-control"  > 
</div>
                                       
                  </div>
                 <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-description1">Website</label>
                    <div class="col-sm-10">
                       <input type="text" name="website" value="<?php echo $row[8] ?>"  placeholder="Website" id="input-title1" class="form-control"  > 
</div>
                                       
                  </div>
                   
                </div>
             </div>
            </div>
             <div class="tab-pane" id="tab-data">
            			<div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Logo</label>
                    <div class="col-sm-10">
                      <label for="exampleInputFile"></label>
                      <input type="file" name="file" size="60"  id="exampleInputFile" onchange="readURL(this);" >
                       
 					<input type="hidden" name="capture_lama" value="<?php echo $row['store_logo'] ?>">
                     <img id="img_prev" src="img/<?php echo $row['store_logo'] ?>" alt="capture photo" style="width:180px;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/></center><br><span style="color: red">Ukuran 266px x 80px</span>
                                        </div>
                                          </div>
                                          
                                          
                                          	<div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title1">Icon</label>
                    <div class="col-sm-10">
                      <label for="exampleInputFile"></label>
                      <input type="file" name="file2" size="60"  id="exampleInputFile" onchange="readURL2(this);" >
                       
 					<input type="hidden" name="capture_lama2" value="<?php echo $row['store_icon'] ?>">
                     <img id="img_prev2" src="img/<?php echo $row['store_icon'] ?>" alt="capture photo" style="width:32px;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/></center><br><span style="color: red">Ukuran 32px x 32px</span>
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
       
      </div>
    </div>
  </div>

        