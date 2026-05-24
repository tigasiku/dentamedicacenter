<?php
error_reporting(0);

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
</head>
<?php
	$row=mysql_fetch_array(mysql_query("select * from  piutang,kategori_piutang where piutang.tipe=kategori_piutang.kode_kategori_piutang and piutang.kode_piutang='".$_GET['id']."'"));
?>
<div id="content">
  <div class="page-header"  style="padding-right:5px;padding-left:5px">
    <div class="container-fluid">
  	<div class="pull-right" style="padding-right:5px"><a href="?page=piutang" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-mail-reply"></i> Cancel</a>
        
      </div>
      </div>
      <h1>Bayar Piutang</h1>
     
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i>Bayar Piutang</h3>
      </div>
      <div class="panel-body">

         
          <div class="tab-content">
            <div class="tab-pane active" id="tab-product">
            	<br />
           
                 		 <div class="col-md-12 konfirmasi table-responsive">
                                        
                            <form action="simpan.bayar.piutang.php" method="post" enctype="multipart/form-data" class="form-horizontal" onsubmit="ShowLoading()">
                       			
                        		<div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Ket</label>
                                    <div class="col-sm-10">
                                     
                                               
                                                <input type="text" required="required" class="form-control"  readonly value="<?php echo  $row['keterangan'] ?>"/>
                                           
                                     </div>
                                  </div>	
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Kategori</label>
                                    <div class="col-sm-10">
                                     
                                               
                                                <input name="kat_piutang" type="text" required="required" class="form-control"   readonly value="<?php
	
	echo  $row['kategori_piutang'] ?>"/>
                                             <input type="hidden" name="tipe" required="required" class="form-control"  readonly value="<?php echo  $row['tipe'] ?>"/>
                                     </div>
                                  </div>
                                 
                        		<div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Customer</label>
                                    <div class="col-sm-10">
                                     
                                               
                                                <input name="customer" type="text" required="required" class="form-control"   readonly value="<?php echo  $row['nama'] ?>"/>
                                           
                                     </div>
                                  </div>	
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Total </label>
                                    <div class="col-sm-10">
                                    
                                                <input name="kode" type="hidden" required="required" class="form-control"  value="<?php echo ($row['kode_piutang']) ?>"/>
                                                <input name="total" type="text"  class="form-control"  placeholder="Total"  value="<?php echo number_format($_GET['total']) ?>" readonly/>
                                             
                                     </div>
                                  </div>
                                     <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Jumlah Bayar </label>
                                    <div class="col-sm-10">
                                    
                                           
                                                <input  type="text"  class="form-control"  value="<?php echo number_format($_GET['jumlah_bayar']) ?>" readonly/>
                                             
                                     </div>
                                  </div>
                                    <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Sisa </label>
                                    <div class="col-sm-10">
                                    
                                           
                                                <input  type="text"  class="form-control"  value="<?php echo number_format($_GET['sisa']) ?>" readonly/>
                                             
                                     </div>
                                  </div>
                                   <div class="form-group required">
                                   <hr>
                                    <label class="col-sm-2 control-label" for="input-telephone">Tanggal Bayar </label>
                                    <div class="col-sm-10">
												<div class="input-group">
									
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
                                               		 <input name="tanggal_bayar" type="text" readonly  class="form-control"  placeholder="Tanggal Bayar"  value="<?php echo date("Y-m-d") ?>" id="dp1"/>
                                             	</div>
                                     </div>
                                  </div>
                               
                                   <div class="form-group ">
                                    <label class="col-sm-2 control-label" for="input-address-1">Kategori</label>
                                    <div class="col-sm-10">
                                  
                                       
                                                 
                                                    <select name="kategori" class="form-control " />
                                            <option value="" >Pilih</option>
														<?php
															
															$qry_kategory=mysql_query("select *  from kategori_uang_masuk order by nomor_akun");
															
															while($kategori=mysql_fetch_array($qry_kategory)){
														?>
														<option value="<?php echo $kategori['kode_kategori_uang_masuk'] ?>" ><?php echo $kategori['nomor_akun'] ?> - <?php echo $kategori['kategori_uang_masuk'] ?></option><?php } ?>
                                          		  </select>
                                                  </div>
                                  </div> 
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-address-1">Dana Masuk</label>
                                    <div class="col-sm-10">
                                  
                                       
                                                 
                                                     <select name="kas"   class="form-control" id="pembayaran" required onChange="func2()">
                                                     <option>Pilih</option>
                                    	<?php 
												$qrybank=mysql_query("select * from bank_perusahaan  where status='Y' order by sort_by");
												while($bank=mysql_fetch_array($qrybank)){
										?>
                                    	<option value="<?php echo $bank[0] ?>"><?php echo $bank[1] ?> <?php if(!empty($bank[2])) echo " - ".$bank[2] ?> <?php if(!empty($bank[3])) echo " - ".$bank[3] ?></option><?php } ?>
                                    	
									</select>
                                                  </div>
                                  </div> 
                                   <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Jumlah Bayar </label>
                                    <div class="col-sm-10">
                                    
                                                <input name="jumlah_bayar" type="text"  class="form-control"  placeholder="Jumlah Bayar"  value="<?php
	

	
	echo number_format($_GET['sisa']) ?>" onblur="x1 = Number(this.value) || 0; this.value=addCommas(this.value)"/>
                                             
                                     </div>
                                  </div>
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Keterangan </label>
                                    <div class="col-sm-10">
                                    
                                                <textarea name="keterangan"   class="textarea"  placeholder="Keterangan"  rows="5" /><?php echo $row['keterangan'] ?></textarea>
                                             
                                     </div>
                                  </div>
								<!-- Pagination -->
                                
                      		 <div class="box-footer">
					
                                <hr />
                                <button type="submit" class="btn btn-primary btn-flat pull-right" name="submit"   id="button_next"><i class="fa fa-arrow-right"></i> &nbsp;Simpan</button>
                        
              
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
        