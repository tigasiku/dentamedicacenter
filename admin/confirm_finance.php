<?php
error_reporting(0);
require "../koneksi.php";
$qry=mysql_query("select * from penjualan where kd_penjualan = '".$_GET['id']."'");
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
<link rel="stylesheet" href="css/jQueryUI/jquery-ui-1.10.3.custom.min.css">
<script src="js/jquery-ui-1.10.3.min.js"></script>
 <script>
  $(document).ready(function(){
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
        data: {origin: $("#origin_id_count").val(),destination: $("#destination_id_count").val(),weight: $("#weight").val()},
        cache : false,
        success: function(data) {
          $("#load").hide();
          $("#show-cost").html('');
          $.each(data, function(index, item) {
            $.each(item.costs, function(index, subitem) {
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
  	<div class="pull-right" style="padding-right:5px"><a href="?page=orders.confirm" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-mail-reply"></i> Cancel</a>
        
      </div>
      </div>
      <h1>Confirm Order</h1>
     
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i>  Orders</h3>
      </div>
      <div class="panel-body">

          <ul class="nav nav-tabs">
       	 
           <li class="<?php if((@$_GET['next'] == "order.details")){ echo "active"; }else{  echo "disabled";} ?>"><a href="#tab-od" data-toggle="<?php  if((@$_GET['next']=="order.details")) echo "tab" ?>" aria-expanded="false">Order Details</a></li>
           
          
           
          </ul>
          <div class="tab-content">
            <div class="tab-pane <?php if((@$_GET['next']=="products")) echo "active" ?>" id="tab-product">
            	<br />
              <div class="tab-content">
                  <div class="tab-pane active" id="language1">
                 		 <div class="col-md-12 konfirmasi table-responsive">
                                        
                            <form action="perbarui.orders_product.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                             <input type="hidden" name="id_pen" value="<?php echo $_GET['id'] ?>" >
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr class="cart" style="color: #58595B;font-weight:100;height:50px" valign="middle">
                                    <th>Foto</th>
                                    <th class="text-center">Product Detail</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php 
					  	
             $qry_detail=mysql_query("select *,penjualan_detail.id as kd_penjualan_detail from produk,penjualan_detail where produk.id=penjualan_detail.kd_produk and kd_penjualan='".$_GET['id']."'");
                                           
						while($row_detail=mysql_fetch_array($qry_detail)) {
					  ?>
                     
				
										
                                <input type="hidden" name="update" class="form-control" value="TRUE">
                                <input type="hidden" name="jumlah_trans" class="form-control" value="2">			
                                                                                
                                            <?php if($row_detail['diskon']>0){  
											$harga=($row_detail['harga']-($row_detail['harga']*$row['diskon']/100));
											}else{ 
											$harga=($row_detail['harga']); } ?>
                                            
                                            <input type="hidden" name="id" value="<?php echo $row_detail['kd_produk'] ?>">
                                            <input type="hidden" name="harga" value="<?php echo $harga ?>">
                                           
                                            
                                            
                                            <tr>
                                                <td class="">
                                                    <div class="media">
                                                        <a class="thumbnail pull-left" href="#"> 
                                                            <img class="media-object" src="../img/portfolio/thumb/<?php echo $row_detail['file'] ?>" style="width: 50px;"> 
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class=""><strong><?php echo $row_detail['judul'] ?>  </strong></td>
                                                <td class=""><strong>Rp <?php  echo number_format($harga) ?>,-</strong></td>
                                                <td class="" style="text-align: center;">	
                                                
                                                <div class="input-group btn-block" style="width: 200px;"><input type="text" name="qty" value="<?php  echo number_format($row_detail['qty']) ?>" class="form-control">
                                                    <span class="input-group-btn">
                                                        <button type="button" data-toggle="tooltip" title="" data-loading-text="Loading..." class="btn btn-primary" data-original-title="Refresh"><i class="fa fa-refresh"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                </td>
                                                <td class="" align="right"><strong>Rp <?php  echo number_format($sub_total=$harga*$row_detail['qty']) ?>,-</strong></td>
                                                 <?php /* <td align="right">
                                                 <a class="btn btn-danger " href="hapus.penjualan_detail.php?id=<?php echo $row['kd_penjualan_detail '] ?>"><i class="fa fa-remove"></i></a>
                                                </td>	*/?>
                                             </tr>		
                                             																							
                                           		<?php 
												@$total=$sub_total+$total;
												} 
												$_SESSION['total_pembelian']=$total;
												?>																						
                                                                                        
                                <!--Untuk button update jumlah-->
                               
                                <tfoot>
                <tr class="subtotal first">
        <td colspan="4" class="a-right" align="right">
                       Total                    </td>
        <td class="last a-right" align="right">
                        <span class="price" ><strong>Rp  <?php echo number_format($total) ?></strong></span>                    </td>
    </tr>
         
        </tfoot>
                            </tbody>
                        </table>
                    		</div>
                            
                        </div>
					<!-- Blog Post Excerpt -->
					
					<!-- End Blog Post Excerpt -->	

								<!-- Pagination -->
                                
                      		 <div class="box-footer">
					
                                <hr />
                                <button type="submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-arrow-right"></i> &nbsp;Continue</button>
                        
                            <div class="clearfix"></div>
                            </div> 
                            </form>
                                       
                  </div>
                
                   
                </div>
             <!-- billing information --><?php 
						if((@$_GET['next']=="billing.information")) { ?>
             <div class="tab-pane <?php if((@$_GET['next']=="billing.information")) echo "active" ?>" id="tab-bi">
            	<br />
              <div class="tab-content">
                  <div class="tab-pane active" id="language1">
                   <legend style="font-size:18px">Your Personal Details</legend>
                   <form action="perbarui.billing.information.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                 <div class="form-group required">
                  <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" >
                                    <label class="col-sm-2 control-label" for="input-firstname">Nama</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="nama" value="<?php echo $row['bi_nama'] ?>" placeholder="Nama" id="input-firstname" class="form-control"  required>
                                                  </div>
                                  </div>
                                 
                                 
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Telephone</label>
                                    <div class="col-sm-10">
                                      <input type="tel" name="telp" value="<?php echo $row['bi_telp'] ?>" placeholder="Telephone" id="input-telephone" class="form-control"  required>
                                                  </div>
                                  </div>
                                 
                                          </fieldset>
                                <fieldset id="address">
                                  <legend style="font-size:18px">Your Address</legend>
                                  
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-address-1">Alamat</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="address" value="<?php echo $row['bi_alamat'] ?>" placeholder="Alamat " id="input-address-1" class="form-control"  required autocomplete="off">
                                                  </div>
                                  </div>
                                
                                  <?php 
                                   $sql = "SELECT * FROM  provinsi ORDER BY namaProvinsi";
                                   $getComboNegara = mysql_query($sql) ;
                                   ?>   
									<div class="form-group">
                                          <label class="control-label col-sm-2" for="email">Provinsi:</label>
                                          <div class="col-sm-10">
                                            <select name="cmbProvinsi" id="cmbProvinsi" class="form-control" required>
                                                <option value="">--Pilih Provinsi--</option>
                                                <?php
                                                
                                              while($data = mysql_fetch_array($getComboNegara)){
                                                       ?>
													   <option value="<?php echo $data['namaProvinsi'] ?>" <?php if($data['namaProvinsi']==$row['bi_provinsi']) echo "selected" ?> ><?php echo $data['namaProvinsi'] ?></option><?php
                                                                                   }
                                                                              ?>
                                                </select>
                                          </div>
                                        </div> 
						
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-city">Kota</label>
                                    <div class="col-sm-10">
                                     <input id="origin_id" type="hidden" class="form-control" readonly name="kode" required value="<?php echo $row['bi_kode_kota'] ?>">
                                        
                                      <input type="text" name="city" value="<?php echo $row['bi_kota'] ?>" placeholder="Kota" id="origin" class="autocomplete form-control"  required autocomplete="off" >
                                      <span style="color:red">*Ketik kota anda dan pilih kota yang muncul secara otomatis muncul</span>
                                                  </div>
                                  </div>
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-postcode">Kode Pos</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="postcode" value="<?php echo $row['bi_kode_pos'] ?>" placeholder="Kode Pos" id="input-postcode" class="form-control"  required>
                                                  </div>
                                  </div>
                                  <div class="box-footer">
					
						<hr />
                        <a href="?page=edit.orders&id=<?php echo $_GET['id'] ?>&next=products" class="btn btn-default btn-flat pull-left" name="submit"><i class="fa fa-arrow-left"></i> &nbsp;Back</a>
						<button type="submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-arrow-right"></i> &nbsp;Continue</button>
				
					<div class="clearfix"></div>
					</div>
                 	</form>
                 
                </div>
             </div>
            </div>
            <?php } 
				if((@$_GET['next']=="shipping.information")) { ?>
            
             <!-- shipping information -->
             <div class="tab-pane <?php if((@$_GET['next']=="shipping.information")) echo "active" ?>" id="tab-si">
            	<br />
              <div class="tab-content">
                  <div class="tab-pane active" id="language1">
                   <legend style="font-size:18px">Your Personal Details</legend>
                   <form action="perbarui.shipping.information.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                 <div class="form-group required">
                  <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" >
                                    <label class="col-sm-2 control-label" for="input-firstname">Nama</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="nama" value="<?php echo $row['si_nama'] ?>" placeholder="Nama" id="input-firstname" class="form-control"  required>
                                                  </div>
                                  </div>
                                 
                                 
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Telephone</label>
                                    <div class="col-sm-10">
                                      <input type="tel" name="telp" value="<?php echo $row['si_telp'] ?>" placeholder="Telephone" id="input-telephone" class="form-control"  required>
                                                  </div>
                                  </div>
                                 
                                          </fieldset>
                                <fieldset id="address">
                                  <legend style="font-size:18px">Your Address</legend>
                                  
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-address-1">Alamat</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="address" value="<?php echo $row['si_alamat'] ?>" placeholder="Alamat " id="input-address-1" class="form-control"  required autocomplete="off">
                                                  </div>
                                  </div>
                                
                                  <?php 
                                   $sql = "SELECT * FROM  provinsi ORDER BY namaProvinsi";
                                   $getComboNegara = mysql_query($sql) ;
                                   ?>   
									<div class="form-group">
                                          <label class="control-label col-sm-2" for="email">Provinsi:</label>
                                          <div class="col-sm-10">
                                            <select name="cmbProvinsi" id="cmbProvinsi" class="form-control" required>
                                                <option value="">--Pilih Provinsi--</option>
                                                <?php
                                                
                                              while($data = mysql_fetch_array($getComboNegara)){
                                                       ?>
													   <option value="<?php echo $data['namaProvinsi'] ?>" <?php if($data['namaProvinsi']==$row['si_provinsi']) echo "selected" ?> ><?php echo $data['namaProvinsi'] ?></option><?php
                                                                                   }
                                                                              ?>
                                                </select>
                                          </div>
                                        </div> 
						
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-city">Kota</label>
                                    <div class="col-sm-10">
                                     <input id="origin_id" type="hidden" class="form-control" readonly name="kode" required value="<?php echo $row['si_kode_kota'] ?>">
                                        
                                      <input type="text" name="city" value="<?php echo $row['si_kota'] ?>" placeholder="Kota" id="origin" class="autocomplete form-control"  required autocomplete="off" >
                                      <span style="color:red">*Ketik kota anda dan pilih kota yang muncul secara otomatis muncul</span>
                                                  </div>
                                  </div>
                                  <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-postcode">Kode Pos</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="postcode" value="<?php echo $row['si_kode_pos'] ?>" placeholder="Kode Pos" id="input-postcode" class="form-control"  required>
                                                  </div>
                                  </div>
                                  <div class="box-footer">
					
						<hr />
                        <a href="?page=edit.orders&id=<?php echo $_GET['id'] ?>&next=billing.information" class="btn btn-default btn-flat pull-left" name="submit"><i class="fa fa-arrow-left"></i> &nbsp;Back</a>
						<button type="submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-arrow-right"></i> &nbsp;Continue</button>
				
					<div class="clearfix"></div>
					</div>
                 	</form>
                 
                </div>
             </div>
            </div>
			<?php } 
				if((@$_GET['next']=="shipping.method")) { ?>
            
             <!-- shipping .method -->
             <div class="tab-pane <?php if((@$_GET['next']=="shipping.method")) echo "active" ?>" id="tab-si">
            	<br />
              <div class="tab-content">
                  <div class="tab-pane active" id="language1">
                   <legend style="font-size:18px">Shipping Method</legend>
                   <form action="perbarui.shipping.method.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="row">
                 <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" >
                                  <div class="col-sm-12">
	                                       	<p><img  src="../img/matrixrate.png"> JNE</p>
                                   </div>
                                    <div class="col-sm-12">
                                        	<div id="load"></div>
               
                                                <div class="ui-widget">
              
                                                <?php
                                                $row_dis=mysql_fetch_array(mysql_query("select * from distributor"));
                                                ?>
                                                 <input id="origin_id_count" type="hidden" value="<?php  echo $row_dis['kode'] ?>">
                                                 <input id="destination_id_count" type="hidden" value="<?php echo $row['si_kode_kota'] ?>">
                                                  <input name="kota_origin" value="<?php  echo $row_dis['namakota'] ?>" type="hidden" >
                                                 <input name="kota_destination" type="hidden" value="<?php echo $row['si_kota'] ?>">
                                                <?php 
                                                      $berat=mysql_fetch_array(mysql_query("select sum(penjualan_detail.weight) as berat from produk,penjualan_detail where produk.id=penjualan_detail.kd_produk and kd_penjualan='".$_GET['id']."'")); 
                                                     
                                                      ?>
                                                 <div style="height:55px">
                                                     <b>Weight</b> = <?php  echo $berat['berat'] ?> (gram) <br><b>Ongkir</b> = <span id="show-cost"></span> 
                                                 </div>
                                                 <address><?php echo $row['si_nama'] ?><br>
                                                                
                                                                <?php echo $row['si_alamat'] ?><br>
                                                                
                                                                
                                                                
                                                                <?php echo $row['si_kota'] ?>,  <?php echo $row_shipping_informasi['provinsi'] ?>, <?php echo $row['si_kode_pos'] ?><br>
                                                                Indonesia<br>
                                                                T: <?php echo $row['si_telp'] ?>
                                                                
                                                                </address>
                                                                
                                                     <input id="weight" name="weightnya" class="autocomplete" type="hidden" value="<?php  echo $berat['berat'] ?>" >
                                                    <input type="button" class="btn btn-success btn-xs" id="calculate" value="Hitung Ongkir"><br>
                                                    <span style="font-size:11px;color:#F30004">*Klik tombol hitung ongkir jika nilai belum keluar.</span>
                                                 <div align="right">     
                                                       
                                                  
                                                      <input id="service_jne" name="service_jne"  type="hidden" value="" >
                                                      <input id="ongkir_jne" name="ongkir_jne" type="hidden" value="">
                                                      <input id="est_jne"  name="est_jne" type="hidden" value="">
                                                  </div>
                                              
                                                </div>
                                                <br />


                          </div>
                          </div>
                             <div class="box-footer">
					
						<hr />
                        <a href="?page=edit.orders&id=<?php echo  $_GET['id'] ?>&next=shipping.information" class="btn btn-default btn-flat pull-left" name="submit"><i class="fa fa-arrow-left"></i> &nbsp;Back</a>
						<button type="submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-arrow-right"></i> &nbsp;Continue</button>
				
					<div class="clearfix"></div>
					</div>
                    </form>
                 
                </div>
             </div>
            </div>
            <?php } 
				if((@$_GET['next']=="payment.method")) { ?>
                      <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" >
             <!-- payment .method -->
             <div class="tab-pane <?php if((@$_GET['next']=="payment.method")) echo "active" ?>" id="tab-si">
            	<br />
              <div class="tab-content">
                  <div class="tab-pane active" id="language1">
                   <legend style="font-size:18px">ATM Transfer</legend>
                   <form action="perbarui.payment.method.php" method="post" enctype="multipart/form-data" class="form-horizontal"> 	
                  <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" >
                                  <div class="row">
                                  
                                        	<?php 
											
											$namabank=mysql_query("select * from  bank_perusahaan ");
											$no=1;
											while($bank=mysql_fetch_array($namabank)){
											?>
                                            <div class="col-sm-4">
                                            	<label for="transfer-0" style="font-weight:400;">
                                      		<input name="trans_bank" id="transfer-0" value="<?php echo $bank['0'] ?>" type="radio" <?php if($row['kd_bank']==$bank['0'])  { echo "checked";}elseif($no==1) {echo "checked";} ?> /> <?php echo $bank['1'] ?> <br><?php echo $bank['2'] ?><br> an <?php echo $bank['3'] ?></label>
                                            </div>
                                              
                                              <?php $no++; } ?>
                          </div>
                                  <div class="box-footer">
					
						<hr />
                        <a href="?page=edit.orders&id=<?php echo $_GET['id'] ?>&next=shipping.method" class="btn btn-default btn-flat pull-left" name="submit"><i class="fa fa-arrow-left"></i> &nbsp;Back</a>
						<button type="submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-arrow-right"></i> &nbsp;Continue</button>
				
					<div class="clearfix"></div>
					</div>
                 	</form>
                 
                </div>
             </div>
            </div>
            <?php } ?>
            <?php  
				if((@$_GET['next']=="order.details")) { ?>
            
             <!-- shipping .method -->
             <div class="tab-pane <?php if((@$_GET['next']=="order.details")) echo "active" ?>" id="tab-si">
            	<br />
              <div class="tab-content">
                  <div class="tab-pane active" id="language1">
                   <legend style="font-size:18px">Detail</legend>
                 <form action="perbarui.confirm_finance.php" method="post" enctype="multipart/form-data" class="form-horizontal">  
                <div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <td class="text-left">Product Name</td>
       
        <td class="text-right">Unit Price</td>
        <td class="text-right">Quantity</td>
        <td class="text-right">Total</td>
      </tr>
    </thead>
    <tbody>
            <tr>
       <?php 
					  	
$qry_detail=mysql_query("select *,penjualan_detail.id as kd_penjualan_detail from produk,penjualan_detail where produk.id=penjualan_detail.kd_produk and kd_penjualan='".$_GET['id']."'");
                                           
						while($row_detail=mysql_fetch_array($qry_detail)) {
                     
					  ?>
                     
				
										
                                <input type="hidden" name="update" class="form-control" value="TRUE">
                                <input type="hidden" name="jumlah_trans" class="form-control" value="2">			
                                                                                
                                            <?php if($row_detail['diskon']>0){  
											$harga=($row_detail['harga']-($row_detail['harga']*$row_detail['diskon']/100));
											}else{ 
											$harga=($row_detail['harga']); } ?>
                                            
                                         
                                           
                                            
                                            
                                            <tr>
                                               
                                                <td class="col-md-4"><?php echo $row_detail['judul'] ?></td>
                                                <td class="text-center col-md-2">Rp <?php  echo number_format($harga) ?>,-</td>
                                                <td class="text-center col-md-1" style="text-align: center;">
                                                   <?php  echo number_format($row_detail['qty']) ?></strong>
                                                </td><td class="text-center col-md-2">Rp <?php  echo number_format($sub_total=$harga*$row_detail['qty']);
												@$sub_total2=$sub_total+@$sub_total2;
												 ?>,-</td>
      </tr><?php } ?>
                </tbody>
    <tfoot>
            <tr>
        <td colspan="3" class="text-right"><strong>Sub-Total:</strong></td>
        <td class="text-right">Rp <?php  echo number_format($sub_total2) ?></td>
        <input type="hidden" value="<?php  echo($sub_total2) ?>" name="subtotal">
      </tr>
       <tr>
        <td colspan="3" class="text-right"><strong>Shipping & Handling (<?php  echo $row['shipping'] ?> - <?php  echo $row['servicenya'] ?> (<?php  echo $row['weight'] ?> Gram)):</strong></td>
        <td class="text-right">Rp. <?php  echo number_format($row['cost']) ?></td>
      </tr>
      <tr>
        <td colspan="3" class="text-right"><strong>Wallet:</strong> <br>
                        <span style="color:green;font-size:11px">* Saldo Wallet anda akan digunakan untuk transaksi.  </span></td>
        
        <td class="text-right">Rp -<?php  echo number_format($row['wallet']) ?></td>
        <input type="hidden" value="<?php  echo($row['wallet']) ?>" name="wallet">
      </tr>
            <tr>
        <td colspan="3" class="text-right"><strong> Kode Unik </strong>                  
                        <br>
                        <span style="color:red;font-size:11px">* Kode unik digunakan untuk mempermudah pelacakan.  </span></td>
        <td class="text-right">Rp. <?php 
		
		 echo ($row['kode_unik']) ?>
          <input type="hidden" value="<?php  echo ($row['kode_unik']) ?>" name="kode_unik">
         </td>
      </tr>
            <tr>
        <td colspan="3" class="text-right"><strong>Total:</strong></td>
        <td class="text-right">Rp. <?php 
		$total=$row['cost']+$sub_total2+$row['kode_unik']-$row['wallet'];
		 echo number_format($total) ?>
         <input type="hidden" value="<?php  echo($total) ?>" name="grandtotal">
         </td>
      </tr>
          </tfoot>
  </table>
</div>
 <legend style="font-size:18px">Status Order</legend>
                   
                 <div class="form-group required">
                  <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" >
                  <input type="hidden" name="username" value="<?php echo $row['username'] ?>" >
                                    <label class="col-sm-2 control-label" for="input-firstname">Status</label>
                                    <div class="col-sm-10">
                                     <select name="status" id="input-status" class="form-control">
                                  
                                     <option value="V" <?php if(@$row['status']=="V")  echo "selected" ?>>Verified</option>
                                    
                                     </select>
                                                  </div>
                                  </div>
        <legend style="font-size:18px">Tranfer</legend>                       
							<div class="form-group">
                             <label class="col-sm-2 control-label" for="input-firstname">Transfer To</label>
                                    <div class="col-sm-10">                            		
                                          
                                          	<select type="text" name="kd_bank"  class="form-control"  > 
											  <?php 
                                              $qry=mysql_query("select * from bank_perusahaan");
                                              while($row=mysql_fetch_array($qry)){
                                              ?>
                                                    <option value="<?php echo $row['kd_bank']?>"><?php echo $row['nama_bank']?> - <?php echo $row['no_rek']?> - <?php echo $row['atas_nama']?></option>
                                                    <?php } ?>
                                               </select>
                                       </div>
  					</div>
                    <?php 
					$row=mysql_fetch_array(mysql_query("select from_nama_bank from konfirmasi_pembayaran where kd_penjualan='".$_GET['id']."'"));
					?>
                    <div class="form-group">
                                          <label class="col-sm-2 control-label" for="input-firstname">Transfer From</label>
                                    <div class="col-sm-10">                                     
                                          <input type="text" name="dari_nama_bank" value="<?php echo $row['from_nama_bank']?>" placeholder="Nama Bank" id="password1" class="form-control"  >
                                       </div>
                    </div>
                             <div class="box-footer">
					
						<hr /><br />
                      
						<button type="submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-arrow-right"></i> &nbsp;Continue</button>
				
					<div class="clearfix"></div>
					</div>
                    </form>
                 
                </div>
             </div>
            </div>
            <?php } ?>
            
            
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
		</script>
        