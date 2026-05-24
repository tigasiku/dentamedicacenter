<?php


date_default_timezone_set("Asia/Makassar");

?>
<script language="javascript">
function TampilTabel(file){
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=570,width=650');
}
	function func2(){
    
    if(document.getElementById('pembayaran').value=="Cash"){
		
		document.getElementById('jumlah_bayar').style.display="none";
        //Do something 
    }else{
		document.getElementById('jumlah_bayar').style.display="block";
	}
}	
</script>


<script type="text/javascript">//<![CDATA[ 
$(window).load(function(){
	
$(document).on('keyup', '#qty', function(){
    var $this = $(this);
    var sumpprice = $('#harga_beli').val();
	var sumpqty = $('#qty').val();
var sumtotal = ((sumpprice * sumpqty)).toFixed();
	$('#sub_total').val(sumtotal);
});
$(document).on('keyup', '#harga_beli', function(){
    var $this = $(this);
    var sumpprice = $('#harga_beli').val();
	var sumpqty = $('#qty').val();
var sumtotal = ((sumpprice * sumpqty)).toFixed();
	$('#sub_total').val(sumtotal);
});


$('#padd').click(function(){
	
	var kode= $('#kode').val();
	var pname = $('#pname').val();
	var qty = $('#qty').val();
	var satuan = $('#satuan').val();
	var harga_jual = $('#harga_jual').val();
	var harga_beli = $('#harga_beli').val();

	var totalpprice = (qty * harga_beli).toFixed(2);
	$('.bersih').val("");
	<?php  if(isMobile()){ ?>
			$('#addhereform').append('<tr><td colspan="3"><input type="hidden"  name="kode[]" value="' + kode + '" /><input type="hidden" size="40%" name="pname[]" value="' + pname + '" readonly/><span>' + pname + '</span> <input type="hidden" size="18%"  name="satuan[]" value="' + satuan + '" readonly/></td><td rowspan="2" style="vertical-align: middle !important;text-align: center"><input type="hidden" name="sub_total[]" value="' + totalpprice + '" rel="total" readonly/><span>' + totalpprice + '</span></td><td rowspan="2"  style="vertical-align: middle !important;text-align: center"> <a  id="HapusInput" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></td></tr><tr><td colspan="3"  style="vertical-align: middle !important;text-align: center"><input type="hidden"  name="harga_jual[]" value="' + harga_jual + '" readonly/><span>' + harga_beli + '</span><input type="hidden" id="harga_beli" name="harga_beli[]" value="' + harga_beli + '" /> x <input type="hidden"  name="qty[]" value="' + qty + '" required="required" size="8%" readonly/><span>' + qty + '</span> <span>' + satuan + '</span></td></tr>');
	<?php }else{ ?>
			$('#addhereform').append('<tr><td></td><td><input type="hidden"  name="kode[]" value="' + kode + '" /><input type="hidden" size="40%" name="pname[]" value="' + pname + '" readonly/><span>' + pname + '</span></td><td><input type="hidden" size="18%"  name="satuan[]" value="' + satuan + '" readonly/><span>' + satuan + '</span></td><td><input type="hidden"  name="harga_jual[]" value="' + harga_jual + '" readonly/><span>' + harga_beli + '</span><input type="hidden" id="harga_beli" name="harga_beli[]" value="' + harga_beli + '" /></td><td><input type="hidden"  name="qty[]" value="' + qty + '" required="required" size="8%" readonly/> <span>' + qty + '</span></td><td><input type="hidden" name="sub_total[]" value="' + totalpprice + '" rel="total" readonly/><span>' + totalpprice + '</span></td><td> <a  id="HapusInput" class="btn btn-xs btn-danger">Hapus</a></td></tr>');
	<?php } ?>
});	
	

$(document).on('click','#HapusInput' ,function() { 
     <?php  if(isMobile()){ ?>  $(this).closest('tr').next().remove(); <?php } ?>
       $(this).closest("tr").remove();
});
	
$(document).on('click','#HapusInput' ,function() { 
        $('#hitung').click();	 
});	
$(document).on('click','#padd' ,function() { 
        $('#hitung').click();	 
});
	
});//]]>  

</script>
<script type="text/javascript">//<![CDATA[ 
$(document).ready(function(){
    var inpA = "input[rel=total]";
	 $('#hitung').click(function(){
        var avalA=0;
        
        $(inpA).each(function() {
            if(this.value !='') avalA += parseInt(this.value,10);
        });
        $('#total').html((avalA).toLocaleString());
         $('#grand').val((avalA));
    });

});
</script>
<section class="content-header">
	<div class="pull-right" style="padding-right:5px"><a href="?page=pembelian" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-mail-reply"></i> Cancel</a>
        
      </div><h1>
		Pembelian
        <small></small></h1>
</section>

<section class="content">
			
            <div class="row">
                        <div class="col-xs-12">
							<div class="box box-solid box-warning">
							  <div class="box-header">
									<h3 class="box-title">Tambah Pembelian</h3>
						  </div>  <?php 
									if(isset($_GET['pesan'])){?>  
                                  	<div class="small-box bg-<?php if($_GET['pesan']=="success"){ echo "green";}else{ echo "red";}?> ">
                                		<div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                             			</div>
                        			</div><?php }?>
                                
								<form action="simpan.pembelian.php" method="post" name="autoSumForm" enctype="multipart/form-data" id="form">
								<div class="box-body">	
                                <div class="col-xs-6">
                                	
                                  <div class="form-group">
                                    <label>No Ref  <b style="color:red;">*</b></label>
                                    <input name="no_ref" type="text" value="<?php date_default_timezone_set("Asia/Makassar"); echo $no="BL-".date("ymdHis"); ?>"  class="form-control" readonly />
                                  </div>  
                        
							 	<div class="form-group required">
                                    <label class=" control-label" for="input-telephone">Nama Vendor</label>
                                  
                                     <div class="input-group">
                                           		 	<input type="hidden" class="form-control" value="" placeholder="Vendor" name="kode_vendor"  id="kode_vendor" >
                                                    <input type="text" class="form-control"  placeholder="Vendor" name="nama_vendor"  id="nama" value="" required>
                                                    <a    class="btn btn-default btn-primary btn-sm form-control " style="width:1%" data-toggle="modal"
   data-target="#listcus"><span class="glyphicon glyphicon-search" style="font-weight:bold;color:#FFF">  <?php  if(isMobile()){ } else{ echo "Browse";} ?></span></a>
                                                </div> 
                                              
                                  </div>
                              </div>  
                              <div class="col-xs-6">
                               <div class="form-group">
                                    <label>Tanggal  <b style="color:red;">*</b></label>
                                    	<div class="input-group">
                                    		<div class="input-group-addon">
                                    				<i class="fa fa-calendar"></i>
											</div>
                                    		<input name="tanggal" type="text" value="<?php date_default_timezone_set("Asia/Makassar"); echo $no=date("Y-m-d"); ?>"  class="form-control" readonly id="dp2"/>
                                    	</div>
                                    
                                  </div>  
                               	
                                      <div class="form-group">
											<label>Gudang Tujuan <b style="color:red;">*</b></label>
											<select name="gudang"   class="form-control" required id="gudang">
															
													<?php 
															$qrybank=mysql_query("select * from gudang order by sort_by");
															while($bank=mysql_fetch_array($qrybank)){
													?>
													<option value="<?php echo $bank[0] ?>"><?php echo $bank[1] ?></option><?php } ?>

											</select>
                                 	 </div> 
                                        
                                        
                            </div>

                                    <div class="col-xs-12"> 
                                 
										 <div class="box box-solid box-default">
                                                <div class="box-header">
                                                    <h3 class="box-title" style="font-size:14px"><b>Transaksi</b></h3>	
                                                </div>
                                         </div>
                                      
                                                       <?php  if(isMobile()){ ?>
                                         <table class="table" id="addhereform">
                                         	<tr>
                                         		<th><a  class="btn btn-default btn-primary btn-xs form-control listbarang" style="width:30px;height:28px;position:relative;top:-2px" data-toggle="modal"
   data-target="#basicModal"><span class="glyphicon glyphicon-plus" style="font-weight:bold;color:#FFF;position:relative;top:+6px"></span></a></th>
                                         		<th colspan="2">
                                         				Nama Barang	
                                         		</th>
                                         		<th>
                                         				Subtotal
                                         		</th><th>&nbsp;</th>
                                         	</tr>
                                         	<tr>
                                         	  <th colspan="5" >
                                         	    <input type="hidden" id="kode" name="kode" value="" class="bersih"/>
                                         	    <input name="pname" type="text" class="namanya bersih form-control" id="pname" placeholder="Nama Barang" value=""  readonly />
                                         	     <input name="harga_jual" type="hidden" id="harga_jual" placeholder="Harga Jual" value="" class="bersih form-control" />
                                       	   </th>
                                       	   </tr>
                                         	<tr>
                                         	  <th colspan="3"><input type="button" id="padd" name="padd2" value="Add" class="btn btn-sm btn-danger" style="font-weight:bold;font-size:12px;width: 100%" onClick="valid()"/>                                         	      <input name="harga_beli" type="text" id="harga_beli" placeholder="Harga Beli" value=""  class="bersih form-control" /></th>
                                         	  <th colspan="2"><input name="qty" type="number" id="qty" placeholder="qty" value=""  class="bersih form-control"  size="14%"/>
                                       	      <input name="satuan" type="text" class="bersih form-control" id="satuan" value=""  readonly placeholder="satuan"/></th>
                                       	   </tr>
                                         	<tr>
                                         	  <th colspan="5"><input type="text" id="sub_total" name="sub_total" value="" placeholder="Sub Total" checked="checked" class="bersih form-control"/></th>
                                       	   </tr>
                                       	 
                                         </table>
									 
								<?php }else{ ?>
  												 <table class="table" id="addhereform">
                                         	<tr>
                                         		<th>
                                         			+
                                         		</th>
                                         		<th>
                                         				Nama Barang	
                                         		</th>
                                         		<th>
                                         				Satuan
                                         		</th>
                                         		<th>
                                         				Harga
                                         		</th>
                                         		<th>
                                         				Qty
                                         		</th>
                                         		<th>
                                         				Subtotal
                                         		</th>
                                         	</tr>
                                         	<tr>
                                         	  <th><input type="hidden" id="kode" name="kode" value="" class="bersih"/> <a data-toggle="modal"
   data-target="#basicModal" class="btn btn-default btn-primary btn-xs form-control listbarang" style="width:30px;height:28px;position:relative;top:-2px"><span class="glyphicon glyphicon-plus" style="font-weight:bold;color:#FFF;position:relative;top:+6px"></span></a></th>
                                         	  <th><input name="pname" type="text" class="namanya bersih form-control" id="pname" placeholder="Nama Barang" value="" size="48%" readonly/></th>
                                         	  <th><input name="satuan" type="text" class="bersih form-control" id="satuan" value=""  size="14%" readonly placeholder="satuan"/></th>
                                         	  <th><input name="harga_jual" type="hidden" id="harga_jual" placeholder="Harga Jual" value="" size="22%" class="bersih form-control" />
                                       	      <input name="harga_beli" type="text" id="harga_beli" placeholder="Harga Beli" value="" size="22%" class="bersih form-control" /></th>
                                         	  <th><input name="qty" type="text" id="qty" placeholder="qty" value="" class="bersih form-control"  size="14%"/></th>
                                         	  <th><input type="text" id="sub_total" name="sub_total" value="" placeholder="Sub Total" checked="checked" class="bersih form-control"/></th> 	  <td><input type="button" id="padd" name="padd2" value="Add" class="btn btn-sm btn-default" style="font-weight:bold;font-size:12px" onclick="valid()"/></td>
                                       	  </tr>
                                       	 
                                      </table>

                                              	<?php } ?> <hr />      
                                              	
                                              	
                                              	  <?php  if(isMobile()){ ?>
                                      <input type="hidden" name="grandtotal" id="grand">  <input type="button" id="hitung" name="padd" value="Hitung" class="btn btn-xs btn-default" style="font-weight:bold;font-size:14px" /> <div style="float:right;;position:relative"> <label style="font-size:18px" >Total : </label> <label id="total" style=";font-size:18px"> </label></div><?php }else{ ?>
                                                      
                                                      
                                                       <input type="hidden" name="grandtotal" id="grand">  <input type="button" id="hitung" name="padd" value="Hitung" class="btn btn-sm btn-default" style="font-weight:bold;font-size:14px" /> <div style="float:right;;position:relative"> <label style="font-size:24px" >Total : </label> <label id="total" style=";font-size:24px"> </label></div>
                                                    	<?php } ?> 
                                      <hr />   
                                    </div>
                                     <div class="col-xs-6">
                                	
                               
                              <div class="form-group">
                                    <label>Pembayaran  <b style="color:red;">*</b></label>
                                    <select name="pembayaran"   class="form-control" id="pembayaran" required onChange="func2()">
                                    	<option value="Cash">Cash</option>
                                    	<option value="Kredit">Kredit</option>
									</select>
                                  </div>  
							
                              </div>  
                                 <div class="col-xs-6">
                                	
                               
                              <div class="form-group">
                                    <label>Dana Keluar  <b style="color:red;">*</b></label>
                                    <select name="kas"   class="form-control" id="pembayaran" required onChange="func2()">
                                    	<?php 
												$qrybank=mysql_query("select * from bank_perusahaan where status='Y' order by sort_by");
												while($bank=mysql_fetch_array($qrybank)){
										?>
                                    	<option value="<?php echo $bank[0] ?>"><?php echo $bank[1] ?> <?php if(!empty($bank[2])) echo " - ".$bank[2] ?> <?php if(!empty($bank[3])) echo " - ".$bank[3] ?></option><?php } ?>
                                    	
									</select>
                                  </div>  
							
                              </div>  
                              <div class="col-xs-6" id="jumlah_bayar" style="display: none">
                               <div class="form-group">
                                    <label>Jumlah Bayar  <b style="color:red;">*</b></label>
                                     <div class="input-group">
                                    		<div class="input-group-addon">
                                    			Rp.
											</div>
                                    <input name="jumlah_bayar" type="text" value="" class="form-control" id="nilai_bayar" />
								   </div>
                            </div>  
                               	
                                      <div class="form-group">
                                    <label>Tanggal Jatuh Tempo <b style="color:red;">*</b></label>
                                    <div class="input-group">
                                    		<div class="input-group-addon">
                                    				<i class="fa fa-calendar"></i>
											</div>
                                    <input name="tgl_jatuh_tempo" type="text" value="<?php  echo  date("Y-m-d", strtotime("+30 days")); ?>"  class="form-control" readonly id="dp1"/>
                                    </div>
                                  </div>       
                                        
                                        
                            </div>
                                    <div class="col-xs-12">
                                            <div class="form-group">
                                            	<label>Keterangan <b style="color:red;">*</b></label>
                                                <textarea  class="form-control" name="ket" id="id_ta2"  /></textarea>
                                  		 	</div>  
                                      
                                    </div>
                                    
                                </div><!-- /.box-body -->

                              
											<div class="">                                
                                
													<div class="col-xs-12">
									<button type="submit" class="btn btn-primary btn-flat pull-right" name="submit" onclick="pemberitahuan()"><i class="fa fa-save"></i> &nbsp;Simpan</button>
													</div> 
														</form>
													<div class="clearfix"></div>		
                       						</div>
                                   </div>
                        </div>
	
            
			
</section><!-- /.content -->

<?php

?>

<script>
$( "#form" ).submit(function( event ) {
	$( "#hitung" ).click();
  if ( $( "#grand" ).val() > 0  ) {
   
    return;
  }
 
	 alert("Anda belum menghitung total !");;
  event.preventDefault();
});
$('#basicModal').modal(options);
$('#basicModal2').modal(options);
$('#listcus').modal(options);
		</script>
        <?php include("list_barangnya.php") ?>
          <?php include("list_vendor.php") ?>