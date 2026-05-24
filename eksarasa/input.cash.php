<?php
error_reporting(0);

$qry=mysql_query("select * from kas_kecil where kd_kas = '".$_GET['id']."'");
$row=mysql_fetch_array($qry);									
							
?>
 
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
<script type="text/javascript">
    function ShowLoading(e) {
        var div = document.createElement('div');
        var img = document.createElement('img');
        img.src = 'page-loader.gif';
		 img.width = "100";
        div.innerHTML = "Loading...<br />";
        div.style.cssText = 'position: fixed; top: 50px; z-index: 5000; width: 100%; height:100% ;text-align: center; background-color: rgba(0, 0, 0, 0.50)';
        div.appendChild(img);
        document.body.appendChild(div);
        return true;
        // These 2 lines cancel form submission, so only use if needed.
        //window.event.cancelBubble = true;
        //e.stopPropagation();
    }
</script>
<script language="javascript">
function TampilTabel(file){
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=570,width=650');
}
</script>
<link rel="stylesheet" href="css/jQueryUI/jquery-ui-1.10.3.custom.min.css">
<script src="js/jquery-ui-1.10.3.min.js"></script>
 <script>
 function cash_out() {
  
    
 
    if($("#tipe").val()=="debet") {
    
	     $("#cash_in").css('display','block');
		 $("#cash_out").css('display','none');
		 
    }
    else {
		 $("#cash_in").css('display','none');
		 $("#cash_out").css('display','block');
		 
    }
    
}
  </script> 	
  <style>
  #load { height: 100%; width: 100%; }
  #load {
    position    : fixed;
    z-index     : 99; /* or higher if necessary */
    top         : 0;
    left        : 0;
    overflow    : hidden;
    text-indent : 100%;
    font-size   : 0;
    opacity     : 0.6;
    background  : #E0E0E0  url('loading.gif') center no-repeat;
  }
  </style>	
<!-- TinyMCE -->
<script src="jscripts/tiny_mce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
	
	

    selector: ".textarea",
    plugins: [
       
        "emoticons insertdatetime contextmenu paste"
    ],
    toolbar: " styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ",
	
});
</script>
<script src="js/provinsi_jne.js"></script> 
  <?php
ini_set('display_errors', 0);
function getApi() {
  $Api = "key: f872db94c9433ef73d4e32e9bcb2fe0a"; // => Api Key Kamu Taruh DI Situ Yah.... :D
  return $Api;
}

function getProvince() {
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://pro.rajaongkir.com/api/province",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    getApi(), "JSON"
  ),
));

	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);

  return $response; 
}


?> 
</head>

<div id="content">
  <div class="page-header"  style="padding-right:5px;padding-left:5px">
    <div class="container-fluid">
  	<div class="pull-right" style="padding-right:5px"><a href="?page=cash.in" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-mail-reply"></i> Cancel</a>
        
      </div>
      </div>
      <h1>Cash </h1>
     
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> Input Cash </h3>
      </div>
      <div class="panel-body">

         
          <div class="tab-content">
            <div class="tab-pane active" id="tab-product">
            	<br />
           
                 		 <div class="col-md-12 konfirmasi table-responsive">
                                        
                            <form action="simpan.input.cash.php" method="post" enctype="multipart/form-data" class="form-horizontal" onsubmit="ShowLoading()">
                         
                        		<div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Tgl </label>
                                    <div class="col-sm-10">
                                       <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                   <input type="hidden"   name="kd_kas" value="<?php echo $_GET['id'] ?>">
                                                   
                                                <input name="tgl" type="text" required="required" class="form-control" id="dp1" placeholder="Tanggal" readonly value="<?php echo date("Y-m-d",strtotime($row['tanggal'])) ?>"/>
                                             </div>   
                                     </div>
                                  </div>	
                    		
								  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-address-1">Tipe</label>
                                    <div class="col-sm-10">
                                  
                                       
                                                 
                                                    <select name="tipe_kas" class="form-control " id="tipe" onChange="cash_out()"/>
                                          				
														
														<option value="kredit" <?php if($row['tipe_kas']=="kredit") echo "selected" ?>>Cash Out</option>
                                         				 <option value="debet" <?php if($row['tipe_kas']=="debet") echo "selected" ?>>Cash In</option>
                                          		  </select>
                                                  </div>
                                  </div> 
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-address-1">Proyek</label>
                                    <div class="col-sm-10">
                                  
                                         <select name="proyek" class="form-control">
											<option value="" >Pilih</option>
											<?php
												$qry_proyek=mysql_query("select *  from proyek");
												while($proyek=mysql_fetch_array($qry_proyek)){
											?>
											<option value="<?php echo $proyek['kd_proyek'] ?>" ><?php echo $proyek['proyek'] ?></option><?php } ?>
									</select>
                                                  </div>
                                  </div>  
							
                                
                              
                                  <div style="display: <?php if($row['tipe_kas']=="kredit"){ echo "block"; }else{ echo "none"; } ?>" id="cash_out">
                                   <div class="form-group required" >
                                    <label class="col-sm-2 control-label" for="input-address-1">Kategori</label>
                                    <div class="col-sm-10">
                                  
                                       
                                                 
                                                    <select name="kategori_out" class="form-control " />
                                                    <option value="" >Pilih</option>
                                            	<?php 
												if($_SESSION["loglevel_graha"]=="Administrator"){   
															$qry_kategory=mysql_query("select *  from kategori_uang_keluar"); }else{
															$qry_kategory=mysql_query("select *  from kategori_uang_keluar where akses= 'Admin'");	}
												while($kategori=mysql_fetch_array($qry_kategory)){
												?>
                                               
                                          
                                          		  <optgroup label="<?php echo $kategori['kategori_uang_keluar'] ?>">
                                                   <?php 
										  $query_sub=mysql_query("select * from sub_kategori_uang_keluar where kode_kategori_uang_keluar='".$kategori['kode_kategori_uang_keluar']."'");
										  while($sub=mysql_fetch_array($query_sub)){ ?>
                  <option value="<?php echo $sub['0'] ?>" ><?php echo $sub['sub_kategori_uang_keluar'] ?></option><?php } ?>
                                                  </optgroup>
                                                <?php } ?>
                                            </select>
                                                  </div>
                                  </div>  
                                 	<div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Vendor</label>
                                    <div class="col-sm-10">
                                     <div class="input-group">
                                           		 	<input type="hidden" class="form-control" value="" placeholder="Vendor" name="kode_vendor"  id="kode_vendor" >
                                                    <input type="text" class="form-control"  placeholder="Vendor" name="nama_ven"  id="nama" value="<?php echo $row['nama'] ?>">
                                                    <a   href="javascript:TampilTabel('list_vendor.php')" class="btn btn-default btn-primary btn-sm form-control" style="width:1%" ><span class="glyphicon glyphicon-search" style="font-weight:bold;color:#FFF"> Browse</span></a>
                                                </div> 
                                                  </div>
                                  </div> 
                                  </div>
                                    <div style="display: <?php if($row['tipe_kas']=="debet"){ echo "block"; }else{ echo "none"; } ?>" id="cash_in">
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-address-1">Kategori</label>
                                    <div class="col-sm-10">
                                  
                                       
                                                 
                                                    <select name="kategori" class="form-control " />
                                          				  <option value="" >Pilih</option>
														<?php
															if($_SESSION["loglevel_graha"]=="Administrator"){   
															$qry_kategory=mysql_query("select *  from kategori_uang_masuk"); }else{
															$qry_kategory=mysql_query("select *  from kategori_uang_masuk where akses= 'Admin'");	
															}
															while($kategori=mysql_fetch_array($qry_kategory)){
														?>
														<option value="<?php echo $kategori['kode_kategori_uang_masuk'] ?>" ><?php echo $kategori['kategori_uang_masuk'] ?></option><?php } ?>
                                          		  </select>
                                                  </div>
                                  </div> 
                                  
                                   
                              
                              
                               	<div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">User</label>
                                    <div class="col-sm-10">
                                     <div class="input-group">
                                           		 	<input type="hidden" class="form-control" value="" placeholder="User" name="kode_user"  id="kode_user2" >
                                                    <input type="text" class="form-control"  placeholder="User" name="nama"  id="nama2" value="<?php   echo $row['nama']; ?>">
                                                    <a   href="javascript:TampilTabel('list_user2.php')" class="btn btn-default btn-primary btn-sm form-control" style="width:1%" ><span class="glyphicon glyphicon-search" style="font-weight:bold;color:#FFF"> Browse</span></a>
                                                </div> 
                                                  </div>
                                  </div>
                                 
                                      <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-address-1">No Rumah</label>
                                    <div class="col-sm-10">
                                    	
	                                       	<input type="text" name="no_rumah"   class="form-control"  placeholder='No Rumah'  value="<?php  echo ($row['nomor_rumah']); ?>" >
                                        
                                      </div>
                                  </div>
                                 </div>      
                     		  <legend style="font-size:18px">Jumlah & Uraian</legend>
                                  
                                 <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-address-1">Jumlah</label>
                                    <div class="col-sm-10">
                                    	<div class="input-group">
                                            	<div class="input-group-addon">
                                                	Rp.
                                                </div>
	                                       	<input type="text" name="jumlah"   class="form-control"  placeholder='Jumlah' required value="<?php  echo number_format($row['total']); ?>" onblur="x1 = Number(this.value) || 0; this.value=addCommas(this.value)">
                                        </div>
                                      </div>
                                  </div>   
                                 
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-address-1">Uraian</label>
                                    <div class="col-sm-10">
                                       	<textarea name="keterangan"  class="textarea" placeholder='Uraian' ><?php echo $row['deskripsi'] ?></textarea>
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
			function readURL2(input) {
				if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				//document.getElementById("img_prev").style.display = "";
				
				reader.onload = function (e) {
				$('#img_prev2')
				.attr('src', e.target.result);
				};
	
				reader.readAsDataURL(input.files[0]);
				}
			}
			function readURL3(input) {
				if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				//document.getElementById("img_prev").style.display = "";
				
				reader.onload = function (e) {
				$('#img_prev3')
				.attr('src', e.target.result);
				};
	
				reader.readAsDataURL(input.files[0]);
				}
			}
			function readURL4(input) {
				if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				//document.getElementById("img_prev").style.display = "";
				
				reader.onload = function (e) {
				$('#img_prev4')
				.attr('src', e.target.result);
				};
	
				reader.readAsDataURL(input.files[0]);
				}
			}
			function readURL5(input) {
				if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				//document.getElementById("img_prev").style.display = "";
				
				reader.onload = function (e) {
				$('#img_prev5')
				.attr('src', e.target.result);
				};
	
				reader.readAsDataURL(input.files[0]);
				}
			}
			function readURL6(input) {
				if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				//document.getElementById("img_prev").style.display = "";
				
				reader.onload = function (e) {
				$('#img_prev6')
				.attr('src', e.target.result);
				};
	
				reader.readAsDataURL(input.files[0]);
				}
			}
		</script>
        