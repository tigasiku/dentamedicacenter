<?php
error_reporting(0);

$qry=mysql_query("select * from pemasukan where kode_pemasukan = '".$_GET['id']."'");
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
  $(document).ready(function(){
	  
	$("#courier").change(function(){
		$("#ongkir_select").children().remove();
		$("#calculate").click();
	});  
    $("#load").hide();
    $('.autocomplete').each(function() {
      var $al = $(this);
        $al.autocomplete({
          source: function( request, response ) {
            window.globalVar = $al.attr('id');
            $.ajax({
              type: "POST",
              url: "execute.php?city=true",
              dataType: "json",
              data: {term: request.term},
              success: function(data) {
                response($.map(data, function(item) {
                  return {
                    label: item.city_name+' ('+item.type+')',
                    city_id: item.city_id
                  };
                }));
              }
            });
          },
          minLength: 2,
            select: function(event, ui) {
              $('#'+window.globalVar+'_id').val(ui.item.city_id);
            }
        });
    });

    $("#calculate").click(function(){

      var origin_id      = $("#origin_id_count").val();
      var destination_id = $("#destination_id_count").val();
      var weight         = $("#weight").val();

      if(!origin_id || !destination_id || !weight){
        alert('Please fill all form');
        return false;
      }

      if(parseInt(weight) < 1){
        alert('Weight min 1');
        return false;
      }

      if($.isNumeric( weight ) == true){

      } else {
        alert('Weight must number');
        return false;
      }
      
      $("#load").show();
      $.ajax({
        type: "POST",
        url: "execute.php?cost=true",
        dataType: "json",
        data: {origin: $("#origin_id_count").val(),destination: $("#destination_id_count").val(),weight: $("#weight").val(),courier: $("#courier").val()},
        cache : false,
        success: function(data) {
          $("#load").hide();
          $("#show-cost").html('');
          $.each(data, function(index, item) {
            $.each(item.costs, function(index, subitem) {
			    /*
				
				 if(subitem.service=="CTC"){
				  $("#show-cost").append(subitem.service+' : '+subitem.cost[0].value+' ( '+subitem.cost[0].etd+' days )');
					$("#service_jne").val(subitem.service);
					$("#ongkir_jne").val(subitem.cost[0].value);
					$("#est_jne").val(' ( '+subitem.cost[0].etd+' days )');
				   }
			    else if(subitem.service=="REG"){
				  $("#show-cost").append(subitem.service+' : '+subitem.cost[0].value+' ( '+subitem.cost[0].etd+' days )');
					$("#service_jne").val(subitem.service);
					$("#ongkir_jne").val(subitem.cost[0].value);
					$("#est_jne").val(' ( '+subitem.cost[0].etd+' days )');
				}
			
				*/
				  
				  
				$("select#ongkir_select").append('<option value="'+subitem.service+' : '+subitem.cost[0].value+'" >'+subitem.service+' : '+subitem.cost[0].value+'</option>');
				  
			   $("#show-cost").append(subitem.service+' : '+subitem.cost[0].value+' ( '+subitem.cost[0].etd+' days )'+'<br />');
            });
          });
        }
      });
    });

    $(".autocomplete").keyup(function(){
      var x = event.keyCode;
      if(x != 13){
        $('#'+$(this).attr("id")+'_id').val("");
      }
    });

  });
  <?php 
  if(@$_GET['next']=="shipping.method"){
  ?>
  $(document).ready(function()
	{
		$("#calculate").click();
	});
  <?php } ?>
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
      <h1>Cash In</h1>
     
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Cash In</h3>
      </div>
      <div class="panel-body">

         
          <div class="tab-content">
            <div class="tab-pane active" id="tab-product">
            	<br />
           
                 		 <div class="col-md-12 konfirmasi table-responsive">
                                        
                            <form action="perbarui.cash.in.php" method="post" enctype="multipart/form-data" class="form-horizontal" onsubmit="ShowLoading()">
                         
                        		<div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Tgl </label>
                                    <div class="col-sm-10">
                                       <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input name="tgl" type="text" required="required" class="form-control" id="dp1" placeholder="Tanggal" readonly value="<?php echo $row['tanggal'] ?>"/>
                                             </div>   
                                     </div>
                                  </div>	
                    		
								<div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">No Ref</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="kode" value="<?php echo $_GET['id'] ?>"  class="form-control"  required readonly="readonly">
                                                  </div>
                                  </div>
                              
							
                                
                                 
                                  
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
														<option value="<?php echo $kategori['kode_kategori_uang_masuk'] ?>" <?php if($row['kode_kategori_uang_masuk']==$kategori['kode_kategori_uang_masuk']) echo "selected" ?>><?php echo $kategori['kategori_uang_masuk'] ?></option><?php } ?>
                                          		  </select>
                                                  </div>
                                  </div>  
                               	<div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">User</label>
                                    <div class="col-sm-10">
                                     <div class="input-group">
                                           		 	<input type="hidden" class="form-control" value="" placeholder="Vendor" name="kode_user"  id="kode_user" >
                                                    <input type="text" class="form-control"  placeholder="User" name="nama"  id="nama" value="<?php   echo $row['nama_user']; ?>">
                                                    <a   href="javascript:TampilTabel('list_user.php')" class="btn btn-default btn-primary btn-sm form-control" style="width:1%" ><span class="glyphicon glyphicon-search" style="font-weight:bold;color:#FFF"> Browse</span></a>
                                                </div> 
                                                  </div>
                                  </div>
                                       <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-address-1">Dana Masuk</label>
                                    <div class="col-sm-10">
                                  
                                       
                                                 
                                                     <select name="kas"   class="form-control" id="pembayaran" required onChange="func2()">
                                                     <option value="">Pilih</option>
                                    	<?php 
														 
														 	$row2=mysql_fetch_array(mysql_query("select kd_bank from arus_kas where kode='$row[0]'"));
														 
												$qrybank=mysql_query("select * from bank_perusahaan  where status='Y' order by sort_by");
												while($bank=mysql_fetch_array($qrybank)){
										?>
                                    	<option value="<?php echo $bank[0] ?>" <?php if( $bank[0]==$row2[0]) echo "selected"?> ><?php echo $bank[1] ?> <?php if(!empty($bank[2])) echo " - ".$bank[2] ?> <?php if(!empty($bank[3])) echo " - ".$bank[3] ?></option><?php } ?>
                                    	
									</select>
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
	                                       	<input type="text" name="jumlah"   class="form-control"  placeholder='Jumlah' required value="<?php  echo number_format($row['jumlah']); ?>" onblur="x1 = Number(this.value) || 0; this.value=addCommas(this.value)">
                                        </div>
                                      </div>
                                  </div>   
                                 
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-address-1">Uraian</label>
                                    <div class="col-sm-10">
                                       	<textarea name="keterangan"  class="textarea" placeholder='Uraian' ><?php echo $row['keterangan'] ?></textarea>
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
        