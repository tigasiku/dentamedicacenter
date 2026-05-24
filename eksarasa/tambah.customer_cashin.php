<?php
error_reporting(0);
							
							
?>
 <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
         <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aplikasi Tambah Edit Delete Berita</title>
<script>
function validate2(){
	if (document.getElementById('input-status').value=="N"){
		document.getElementById('hilang').style.display="Block";
	}else{
		
		document.getElementById('hilang').style.display="None";
	}
}
</script>
<script type="text/javascript">
    function ShowLoading(e) {
        var div = document.createElement('div');
        var img = document.createElement('img');
		img.width = "100";
        img.src = 'page-loader.gif';
        div.innerHTML = "Loading...<br />";
        div.style.cssText = 'position: fixed; top: 2px; z-index: 5000; width: 100%; height:100% ;text-align: center; background-color: rgba(0, 0, 0, 0.50)';
        div.appendChild(img);
        document.body.appendChild(div);
        return true;
        // These 2 lines cancel form submission, so only use if needed.
        //window.event.cancelBubble = true;
        //e.stopPropagation();
    }
</script> 

</head>

<div id="content">
  <div class="page-header"  style="padding-right:5px;padding-left:5px">
    <div class="container-fluid">
  	<div class="pull-right" style="padding-right:5px"><a href="?page=tambah.cash.in&listmodaluser" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-mail-reply"></i> Cancel</a>
        
      </div>
      </div>
      <h1>Customer</h1>
     
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> Tambah</h3>
      </div>
      <div class="panel-body">

         
          <div class="tab-content">
            <div class="tab-pane active" id="tab-product">
            	<br />
           
                 		 <div class="col-md-12 konfirmasi ">
                                        
                            <form action="?page=simpan.customer_cashin" method="post" enctype="multipart/form-data" class="form-horizontal" onSubmit="ShowLoading()">
                         		
                              
                                
                                 
                                  
                                
                               	<div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Customer</label>
                                    <div class="col-sm-10">
                                           		
                                                    <input type="text" class="form-control"  placeholder="Customer" name="nama"  id="nama" value="">
                                                 
                                                
                                                  </div>
                                  </div>
                     		
                                 <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-address-1">No Telp</label>
                                    <div class="col-sm-10">
                                    	<div class="input-group">
                                            	<div class="input-group-addon">
                                                	<i class="fa fa-phone"></i>
                                                </div>
	                                       	<input type="text" name="no_telp"   class="form-control"  placeholder='No Telp' required value="" >
                                        </div>
                                      </div>
                                  </div>   
                               
                                	
								<!-- Pagination -->
                                
                      		 <div class="box-footer">
					
                                <hr />
                                <button type="submit" class="btn btn-primary btn-flat pull-right" name="submit"   id="button_next"><i class="fa fa-arrow-right"></i> &nbsp;Continue</button>
                        
              
                            <div class="clearfix"></div>
                            </div> 
                            </form>
                                       
                  </div>
                
                   
                </div>
          
           
            
            
            	<div class="box-footer">
					
						
					</div>
          </div>
    
      </div>
    </div>
  </div>
<script>
			
		</script>
        