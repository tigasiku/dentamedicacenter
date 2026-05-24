<?php
error_reporting(0);
require "../koneksi.php";
									
			
$row=mysql_fetch_array(mysql_query("select * from stores "));			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aplikasi Tambah Edit Delete Berita</title>

</head>

<div id="content">
  <div class="page-header"  style="padding-right:5px;padding-left:5px">
    <div class="container-fluid">
  
      </div>
      <h1>Sosial Media</h1>
     
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
                                    Data berhasil disimpan                             
                                </div><!-- /.box-body -->
                            </div>
</div><?php } ?>     
<div class="container-fluid" style="padding-right:5px;padding-left:5px">
        <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> Sosial Media</h3>
      </div>
      <div class="panel-body">
        <form action="perbarui.sosial.media.php" method="post" enctype="multipart/form-data" id="form-information" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
       	
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
            	<br />
              <div class="tab-content">
                  <div class="tab-pane active" id="language1">
                  <div class="form-group required">
                  
                   		<div class="col-sm-12">
                 			 <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-facebook"></i>
                                    </div>
                                     <input type="hidden" name="store_name" value="<?php echo $row[0] ?>"  placeholder="Store Name" id="input-title1" class="form-control"  readonly="readonly"> 
                    				<input type="text" name="store_fb" value="<?php echo $row['store_fb'] ?>"  placeholder="Store Facebook" id="input-title1" class="form-control"  > 
                              </div>      
                       </div>
                  </div>
                   <div class="form-group required">
              
                    <div class="col-sm-12">
                  		<div class="input-group">
                        	<div class="input-group-addon">
                            	<i class="fa fa-twitter"></i>
                            </div>
                     		 	<input type="text" name="store_twitter" value="<?php echo $row['store_twitter'] ?>"  placeholder="Store Twitter" id="input-title1" class="form-control"  > 
                   	    </div>
                       
                                          </div>
                  </div>
                  <div class="form-group required">
              
                    <div class="col-sm-12">
                  		<div class="input-group">
                        	<div class="input-group-addon">
                            	<i class="fa fa-google-plus"></i>
                            </div>
                     		 	<input type="text" name="store_google_plus" value="<?php echo $row['store_google'] ?>"  placeholder="Store Google Plus" id="input-title1" class="form-control"  > 
                   	    </div>
                       
                                          </div>
                  </div>
                  <div class="form-group required">
              
                    <div class="col-sm-12">
                  		<div class="input-group">
                        	<div class="input-group-addon">
                            	<i class="fa fa-instagram"></i>
                            </div>
                     		 	<input type="text" name="store_instagram" value="<?php echo $row['store_instagram'] ?>"  placeholder="Store Instagram" id="input-title1" class="form-control"  > 
                   	    </div>
                       
                                          </div>
                  </div>
                    <div class="form-group required">
              
                    <div class="col-sm-12">
                  		<div class="input-group">
                        	<div class="input-group-addon">
                            	<i class="fa fa-pinterest"></i>
                            </div>
                     		 	<input type="text" name="store_pinterest" value="<?php echo $row['store_pinterest'] ?>"  placeholder="Store Pinterest" id="input-title1" class="form-control"  > 
                   	    </div>
                       
                    </div>
                  </div>
                   <div class="form-group required">
              
                    <div class="col-sm-12">
                  		<div class="input-group">
                        	<div class="input-group-addon">
                            	<i class="fa fa-linkedin"></i>
                            </div>
                     		 	<input type="text" name="store_linkedin" value="<?php echo $row['store_linkedin'] ?>"  placeholder="Store Linkedin" id="input-title1" class="form-control"  > 
                   	    </div>
                       
                                          </div>
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

        