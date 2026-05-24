<?php
error_reporting(0);
$row=mysql_fetch_array(mysql_query("select * from arus_kas where kd_arus_kas='".$_GET['id']."'"))
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
<?php
?>
<div id="content">
  <div class="page-header"  style="padding-right:5px;padding-left:5px">
    <div class="container-fluid">
  	<div class="pull-right" style="padding-right:5px"><a href="?page=arus.kas" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-mail-reply"></i> Cancel</a>
        
      </div>
      </div>
      <h1>Mutasi Kas</h1>
     
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i>Edit Mutasi</h3>
      </div>
      <div class="panel-body">

         
          <div class="tab-content">
            <div class="tab-pane active" id="tab-product">
            	<br />
           
                 		 <div class="col-md-12 konfirmasi table-responsive">
                                        
                            <form action="perbarui.mutasi.kas.php" method="post" enctype="multipart/form-data" class="form-horizontal" onsubmit="ShowLoading()">
                       			
                        		
                                  
                                   <div class="form-group required">
                                 
                                    <label class="col-sm-2 control-label" for="input-telephone">Tanggal Mutasi </label>
                                    <div class="col-sm-10">
												<div class="input-group">
									
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
                                              		  <input name="kode" type="hidden" value="<?php echo $row['0'] ?>" />
                                              		  <input name="tipe_kas" type="hidden" value="<?php echo $row['tipe_kas'] ?>" />
                                               		 <input name="tanggal_mutasi" type="text" readonly  class="form-control"  placeholder="Tanggal Mutasi"  value="<?php echo $row['tanggal'] ?>" id="dp1"/>
                                             	</div>
                                     </div>
                                  </div>
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-address-1"><?php if($row['tipe_kas']=="kredit") { echo "Dana Dari";}else{ echo "Dana Tujuan"; } ?></label>
                                    <div class="col-sm-10">
                                  
                                       
                                                 
                                                     <select name="dana_dari"   class="form-control" id="pembayaran" required onChange="func2()">
                                                     <option>Pilih</option>
                                    	<?php 
												$qrybank=mysql_query("select * from bank_perusahaan order by kd_bank");
												while($bank=mysql_fetch_array($qrybank)){
										?>
                                    	<option value="<?php echo $bank[0] ?>" <?php if($row['kd_bank']==$bank[0]) echo "selected"; ?> ><?php echo $bank[1] ?> <?php if(!empty($bank[2])) echo " - ".$bank[2] ?> <?php if(!empty($bank[3])) echo " - ".$bank[3] ?></option><?php } ?>
                                    	
									</select>
                                                  </div>
                                  </div>
                                   
                              
                                    <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Jumlah </label>
                                    <div class="col-sm-10">
                                    		<input name="jumlah_bayar" type="text"  class="form-control"  placeholder="Jumlah "  value="<?php echo number_format($row['nilai']) ?>" onblur="x1 = Number(this.value) || 0; this.value=addCommas(this.value)"/>
                                             
                                     </div>
                                  </div>
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Keterangan </label>
                                    <div class="col-sm-10">
                                    
                                                <textarea name="keterangan"   class="form-control"  placeholder="Keterangan"  rows="5"/><?php echo ($row['keterangan']) ?></textarea>
                                             
                                     </div>
                                  </div>
								<!-- Pagination -->
                                
                      		 <div class="box-footer">
					
                                <hr />
                                <button type="submit" class="btn btn-primary btn-flat pull-right" name="submit"   id="button_next"><i class="fa fa-arrow-right"></i> &nbsp;Update</button>
                        
              
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
        