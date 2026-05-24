<?php

date_default_timezone_set("Asia/Makassar");
$query=mysql_query("select * from penjualan where no_jual='".$_GET['no_jual']."' ");
$data=mysql_fetch_array($query);
?>
<script language="javascript">
function TampilTabel(file){
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=570,width=650');
}
	
function func2(){
    
    if(document.getElementById('pembayaran').value=="Cash"){
		
		document.getElementById('jumlah_bayar').style.display="none";
        //Do something 
	}else if(document.getElementById('pembayaran').value=="DO"){
	}else{
		document.getElementById('jumlah_bayar').style.display="block";
	}
}		
</script>
<?php  if(isMobile()){ ?> 
<script type="text/javascript">//<![CDATA[ 
$(window).load(function(){
	
$(document).on('keyup', '#qty', function(){
    var $this = $(this);
    var sumpprice = $('#harga_jual').val();
	var sumpqty = $('#qty').val();
var sumtotal = ((sumpprice * sumpqty)).toFixed();
	$('#sub_total').val(sumtotal);
});
$(document).on('keyup', '#harga_jual', function(){
    var $this = $(this);
    var sumpprice = $('#harga_jual').val();
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

	var totalpprice = (qty * harga_jual).toFixed(2);
	$('.bersih').val("");
	
			$('#addhereform').append('<tr><td colspan="3"><input type="hidden"  name="kode[]" value="' + kode + '" /><input type="hidden" size="40%" name="pname[]" value="' + pname + '" readonly/><span>' + pname + '</span> <input type="hidden" size="18%"  name="satuan[]" value="' + satuan + '" readonly/></td><td rowspan="2" style="vertical-align: middle !important;text-align: center"><input type="hidden" name="sub_total[]" value="' + totalpprice + '" rel="total" readonly/><span>' + totalpprice + '</span></td><td rowspan="2"  style="vertical-align: middle !important;text-align: center"> <a  id="HapusInput" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></td></tr><tr><td colspan="3"  style="vertical-align: middle !important;text-align: center"><input type="hidden"  name="harga_jual[]" value="' + harga_jual + '" readonly/><span>' + harga_jual + '</span><input type="hidden" id="harga_beli" name="harga_beli[]" value="' + harga_beli + '" /> x <input type="hidden"  name="qty[]" value="' + qty + '" required="required" size="8%" readonly/><span>' + qty + '</span> <span>' + satuan + '</span></td></tr>');
	
});

$(document).on('click','#HapusInput' ,function() { 
	  $(this).closest('tr').next().remove(); 
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
<?php } else { ?>
<script type="text/javascript">//<![CDATA[ 
$(window).load(function(){
	
$(document).on('keyup', '#qty', function(){
    var $this = $(this);
    var sumpprice = $this.siblings('#harga_jual').val();
	var sumpqty = $this.val();
	var sumtotal = ((sumpprice * sumpqty)).toFixed(2);
	$this.siblings('#sub_total').val( sumtotal );
	 $('#hitung').click();	
});
$(document).on('keyup', '#harga_jual', function(){
    var $this = $(this);
    var sumpprice = $this.val();
	var sumpqty = $this.siblings('#qty').val();
	var sumtotal = ((sumpprice * sumpqty)).toFixed(2);
	$this.siblings('#sub_total').val( sumtotal );
	 $('#hitung').click();	
});


$('#padd').click(function(){
	
	var kode= $('#kode').val();
	var pname = $('#pname').val();
	var qty = $('#qty').val();
	var satuan = $('#satuan').val();
	var harga_jual = $('#harga_jual').val();
	var harga_beli = $('#harga_beli').val();

	var totalpprice = (qty * harga_jual).toFixed(2);
	$('.bersih').val("");
	$('#addhereform').append('<li><input type="hidden"id="kode" name="kode[]" value="' + kode + '" /><input type="text" size="40%"id="pname" name="pname[]" value="' + pname + '" readonly/><input type="text" size="18%" id="satuan" name="satuan[]" value="' + satuan + '" readonly/><input type="text" id="harga_jual" name="harga_jual[]" value="' + harga_jual + '"/><input type="number" id="qty" name="qty[]" value="' + qty + '" required="required" size="8%"/><input type="hidden" id="harga_beli" name="harga_beli[]" value="' + harga_beli + '"/> <input type="text" id="sub_total" name="sub_total[]" value="' + totalpprice + '" rel="total" readonly/> <a  id="HapusInput" class="btn btn-xs btn-danger">Hapus</a></li>');
});

$(document).on('click','#HapusInput' ,function() { 
       $(this).parent('li').remove(); 
});
$(document).on('click','#HapusInput' ,function() { 
        $('#hitung').click();	 
});		
$(document).on('click','#padd' ,function() { 
        $('#hitung').click();	 
});
	
});//]]>  

</script><?php } ?>
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
	<h1>
		Penjualan
        <small></small></h1>
</section>

<section class="content">
			
            <div class="row">
                        <div class="col-xs-12">
							<div class="box box-solid box-primary">
							  <div class="box-header">
									<h3 class="box-title">Edit Penjualan</h3>
						  </div>  <?php 
									if(isset($_GET['pesan'])){?>  
                                  	<div class="small-box bg-<?php if($_GET['pesan']=="success"){ echo "green";}else{ echo "red";}?> ">
                                		<div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                             			</div>
                        			</div><?php }?>
                                
								<form action="perbarui.penjualan.php" method="post" name="autoSumForm" enctype="multipart/form-data" id="form">
								<div class="box-body">	
                                <div class="col-xs-6">
                                	
                                  <div class="form-group">
                                    <label>No Ref  <b style="color:red;">*</b></label>
                                    <input name="no_ref" type="text" value="<?php  echo $data['no_jual'] ?>"   class="form-control" readonly />
                                  </div>  
                                <div class="form-group">
                                    <label>Nama Customer  <b style="color:red;">*</b></label>
                                    <input name="nama_vendor" type="text" value="<?php  echo $data['customer'] ?>"   class="form-control" required />
                                  </div>  
							
							
                              </div>  
                              <div class="col-xs-6">
                               <div class="form-group">
                                    <label>Tanggal  <b style="color:red;">*</b></label>
                                    <input name="tanggal" type="text" value="<?php  echo $data['tgl_jual'] ?>"   class="form-control" readonly id="dp2"/>
                                  </div>  
                               	
                                         
                                           <div class="form-group">
											<label>Dari Gudang  <b style="color:red;">*</b></label>
											<select name="gudang"   class="form-control" required id="gudang">
																
													<?php 
	$qrygud=mysql_query("select * from penjualan_detail where no_jual='".$data['no_jual']."'");
													 $rowgud=mysql_fetch_array($qrygud);
															$qrybank=mysql_query("select * from gudang order by sort_by");
															while($bank=mysql_fetch_array($qrybank)){
													?>
													<option value="<?php echo $bank[0] ?>" <?php if($rowgud['kd_gudang']==$bank[0]) echo "selected"?>><?php echo $bank[1] ?></option><?php } ?>

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
                                         	     <input name="harga_beli" type="hidden" id="harga_beli" placeholder="Harga Beli" value="" class="bersih form-control" />
                                       	   </th>
                                       	   </tr>
                                         	<tr>
                                         	  <th colspan="3"><input type="button" id="padd" name="padd2" value="Add" class="btn btn-sm btn-danger" style="font-weight:bold;font-size:12px;width: 100%" onClick="valid()"/>                                         	      <input name="harga_jual" type="text" id="harga_jual" placeholder="Harga Jual" value=""  class="bersih form-control" /></th>
                                         	  <th colspan="2"><input name="qty" type="number" id="qty" placeholder="qty" value=""  class="bersih form-control"  size="14%"/>
                                       	      <input name="satuan" type="text" class="bersih form-control" id="satuan" value=""  readonly placeholder="satuan"/></th>
                                       	   </tr>
                                         	<tr>
                                         	  <th colspan="5"><input type="text" id="sub_total" name="sub_total" value="" placeholder="Sub Total" checked="checked" class="bersih form-control"/></th>
                                       	   </tr>
                                       
                                       	 
                                       	 	 	 <?php 
													 $qry=mysql_query("select *,penjualan_detail.harga_jual as harga_jual from penjualan_detail,barang where penjualan_detail.kode_barang=barang.kode_barang and no_jual='".$data['no_jual']."'");
													 while($row=mysql_fetch_array($qry)){
													?>
                                                   <tr><td colspan="3"><input type="hidden"  name="kode[]" value="<?php echo $row['kode_barang'] ?>" /><input type="hidden" size="40%" name="pname[]" value="<?php echo $row['nama_barang'] ?>" readonly/><span><?php echo $row['nama_barang'] ?></span> <input type="hidden" size="18%"  name="satuan[]" value="<?php echo $row['satuan'] ?>" readonly/></td><td rowspan="2" style="vertical-align: middle !important;text-align: center"><input type="hidden" name="sub_total[]" value="<?php echo $row['sub_total'] ?>" rel="total" readonly/><span><?php echo $row['sub_total'] ?></span></td><td rowspan="2"  style="vertical-align: middle !important;text-align: center"> <a  id="HapusInput" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></td></tr><tr><td colspan="3"  style="vertical-align: middle !important;text-align: center"><input type="hidden"  name="harga_jual[]" value="<?php echo $row['harga_jual'] ?>" readonly/><span><?php echo $row['harga_jual'] ?></span><input type="hidden" id="harga_beli" name="harga_beli[]" value="<?php echo $row['harga_beli'] ?>" /> x <input type="hidden"  name="qty[]" value="<?php echo $row['jumlah'] ?>" required="required" size="8%" readonly/><span><?php echo $row['jumlah'] ?></span> <span><?php echo $row['satuan'] ?></span></td></tr>
                                                   
                                                <?php } ?>   
                                                    
                                                    
                                         </table>
									 
								<?php }else{ ?>
									  <a href="javascript:TampilTabel('list_barang.php')" class="btn btn-default btn-primary btn-xs form-control" style="width:30px;height:28px;position:relative;top:-2px"><span class="glyphicon glyphicon-plus" style="font-weight:bold;color:#FFF;position:relative;top:+6px"></span></a><input type="hidden" id="kode" name="kode" value="" class="bersih"/>
    <input name="pname" type="text" class="namanya bersih" id="pname" placeholder="Nama Barang" value="" size="48%" readonly/>
  <input name="satuan" type="text" class="bersih" id="satuan" value=""  size="14%" readonly placeholder="satuan"/><input name="harga_jual" type="text" id="harga_jual" placeholder="Harga Jual" value="" size="22%" class="bersih" />
  <input name="harga_beli" type="hidden" id="harga_beli" placeholder="Harga Jual" value="" size="22%" class="bersih" />
      
  <input name="qty" type="text" id="qty" placeholder="qty" value="" class="bersih"  size="14%"/>
    <input type="text" id="sub_total" name="sub_total" value="" placeholder="Sub Total" checked="checked" class="bersih"/>
       <input type="button" id="padd" name="padd2" value="Add" class="btn btn-sm btn-default" style="font-weight:bold;font-size:12px" onclick="valid()"/></td>
  

                                                    <ol id="addhereform">
                                                 <?php 
													 $qry=mysql_query("select *,penjualan_detail.harga_jual as harga_jual from penjualan_detail,barang where penjualan_detail.kode_barang=barang.kode_barang and no_jual='".$data['no_jual']."'");
													 while($row=mysql_fetch_array($qry)){
													?>
                                                    <li><input type="hidden"id="kode" name="kode[]" value="<?php echo $row['kode_barang'] ?>" /><input type="text" size="40%"id="pname" name="pname[]" value="<?php echo $row['nama_barang'] ?>" readonly/><input type="text" size="18%" id="satuan" name="satuan[]" value="<?php echo $row['satuan'] ?>" readonly/><input type="text" id="harga_jual" name="harga_jual[]" value="<?php echo $row['harga_jual'] ?>"/><input type="number" id="qty" name="qty[]" value="<?php echo $row['jumlah'] ?>" required="required" size="8%"/><input type="hidden" id="harga_beli" name="harga_beli[]" value="<?php echo $row['harga_beli'] ?>"/> <input type="text" id="sub_total" name="sub_total[]" value="<?php echo $row['sub_total'] ?>" rel="total" readonly/> <a  id="HapusInput" class="btn btn-xs btn-danger">Hapus</a></li><?php } ?>   
                                  </ol><?php } ?>
                                                        <input type="hidden" name="grandtotal" id="grand" value="<?php echo ($data['total']) ?>">  <input type="button" id="hitung" name="padd" value="Hitung" class="btn btn-sm btn-default" style="font-weight:bold;font-size:14px" /> <div style="float:right;right:+50px;position:relative"> <label style="font-size:24px" >Total : </label> <label id="total" style=";font-size:24px"><?php echo number_format($data['total']) ?></label></div>
                                                     <hr />  
                                    </div>
                                     <div class="col-xs-6">
                                	
                               
                              <div class="form-group">
                                    <label>Pembayaran  <b style="color:red;">*</b></label>
                                    <select name="pembayaran"   class="form-control" id="pembayaran" required onChange="func2()">
                                    	<option value="Cash" <?php  if($data['pembayaran']=="Cash") echo "selected" ?> >Cash</option>
                                    	<option value="Kredit" <?php  if($data['pembayaran']=="Kredit") echo "selected" ?> >Kredit</option>
									</select>
                                  </div>  
									<div id="jumlah_bayar" style="display: <?php if($data['pembayaran']=="Kredit") { 
	
	
				
	
	echo "block"; } else { echo "none"; }  ?>">
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
                                    <input name="tgl_jatuh_tempo" type="text" value=""  class="form-control" readonly id="dp1"/>
                                    </div>
                                  </div>       
                                        
                                        
                            </div>
                              </div>  
                              <div class="col-xs-6">
                                	
                               
                              <div class="form-group">
                                    <label>Dana Masuk  <b style="color:red;">*</b></label>
                                    <select name="kas"   class="form-control" id="pembayaran" required onChange="func2()">
                                    	<?php 
												$qrybank=mysql_query("select * from bank_perusahaan where status='Y' order by sort_by");
										$delete2=mysql_fetch_array(mysql_query("select * from arus_kas where kode='".$data['no_jual']."'"));
												while($bank=mysql_fetch_array($qrybank)){
										?>
                                    	<option value="<?php echo $bank[0] ?>" <?php if($delete2['kd_bank']==$bank[0]) echo "selected" ?>><?php echo $bank[1] ?> <?php if(!empty($bank[2])) echo " - ".$bank[2] ?> <?php if(!empty($bank[3])) echo " - ".$bank[3] ?></option><?php } ?>
                                    	
									</select>
                                  </div>  
							
                              </div>  
                              
                                    <div class="col-xs-12">
                                            <div class="form-group">
                                            	<label>Keterangan <b style="color:red;">*</b></label>
                                                <textarea  class="form-control" name="ket" id="id_ta2"  /><?php echo $data['ket'] ?></textarea>
                                  		 	</div>  
                                      
                                    </div>
                                    
                                </div><!-- /.box-body -->

                              
											<div class="box-footer">                                
                                
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
<$('#basicModal').modal(options);
$('#basicModal2').modal(options);
$('#listcus').modal(options);
		</script>
        <?php include("list_barangnya.php") ?>
          <?php include("list_customer.php") ?>