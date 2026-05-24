<?php

date_default_timezone_set("Asia/Makassar");

$query=mysql_query("select * from mutasi where no_mutasi='".$_GET['no_mutasi']."' ");
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
    }else{
		document.getElementById('jumlah_bayar').style.display="block";
	}
}	
</script>


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

$(document).on('focus', '#qty', function(){
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
	<?php  if(isMobile()){ ?>
			$('#addhereform').append('<tr><td colspan="3"><input type="hidden"  name="kode[]" value="' + kode + '" /><input type="hidden" size="40%" name="pname[]" value="' + pname + '" readonly/><span>' + pname + '</span> <input type="hidden" size="18%"  name="satuan[]" value="' + satuan + '" readonly/></td><td rowspan="2" style="vertical-align: middle !important;text-align: center"><input type="hidden" name="sub_total[]" value="' + totalpprice + '" rel="total" readonly/><span>' + totalpprice + '</span></td><td rowspan="2"  style="vertical-align: middle !important;text-align: center"> <a  id="HapusInput" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></td></tr><tr><td colspan="3"  style="vertical-align: middle !important;text-align: center"><input type="hidden"  name="harga_jual[]" value="' + harga_jual + '" readonly/><span>' + harga_jual + '</span><input type="hidden" id="harga_beli" name="harga_beli[]" value="' + harga_beli + '" /> x <input type="hidden"  name="qty[]" value="' + qty + '" required="required" size="8%" readonly/><span>' + qty + '</span> <span>' + satuan + '</span></td></tr>');
	<?php }else{ ?>
			$('#addhereform').append('<tr><td></td><td><input type="hidden"  name="kode[]" value="' + kode + '" /><input type="hidden" size="40%" name="pname[]" value="' + pname + '" readonly/><span>' + pname + '</span></td><td><input type="hidden" size="18%"  name="satuan[]" value="' + satuan + '" readonly/><span>' + satuan + '</span></td><td><input type="hidden"  name="harga_jual[]" value="' + harga_jual + '" readonly/><span>' + harga_jual + '</span><input type="hidden" id="harga_beli" name="harga_beli[]" value="' + harga_beli + '" /></td><td><input type="hidden"  name="qty[]" value="' + qty + '" required="required" size="8%" readonly/> <span>' + qty + '</span></td><td><input type="hidden" name="sub_total[]" value="' + totalpprice + '" rel="total" readonly/><span>' + totalpprice + '</span></td><td> <a  id="HapusInput" class="btn btn-xs btn-danger">Hapus</a></td></tr>');
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
<section class="content-header"><div class="pull-right" style="padding-right:5px"><a href="?page=stok" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-mail-reply"></i> Cancel</a>
        
      </div>
	<h1>
		Edit Mutasi Stok 
        <small></small></h1>
</section>

<section class="content">
			
            <div class="row">
                        <div class="col-xs-12">
							<div class="box box-solid box-warning">
							  <div class="box-header">
									<h3 class="box-title">Mutasi</h3>
						  </div>  <?php 
									if(isset($_GET['pesan'])){?>  
                                  	<div class="small-box bg-<?php if($_GET['pesan']=="success"){ echo "green";}else{ echo "red";}?> ">
                                		<div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                             			</div>
                        			</div><?php }?>
                                
								<form action="perbarui.mutasi.stok.php" method="post" name="autoSumForm" enctype="multipart/form-data" id="form">
								<div class="box-body">	
                               
                            <div class="col-xs-6">
                               <div class="form-group">
                                    <label>Tanggal  <b style="color:red;">*</b></label>
                                    <input name="tanggal" type="text" value="<?php  echo $data['tgl_mutasi'] ?>"  class="form-control" readonly id="dp2"/>
                                    <input name="no_ref" type="hidden" value="<?php  echo $data['no_mutasi'] ?>" />
                                  </div>  
                               	
                                         
                                        
                                        
                            </div>
								 <div class="col-xs-6">
                              		 <div class="form-group">
											<label>Dari Gudang  <b style="color:red;">*</b></label>
											<select name="gudang_dari"   class="form-control" id="gudang" required onChange="func2()">
																 <option>Pilih</option>
													<?php 
															$qrybank=mysql_query("select * from gudang order by sort_by");
															while($bank=mysql_fetch_array($qrybank)){
													?>
													<option value="<?php echo $bank[0] ?>" <?php if($data['gudang_utama']==$bank[0]) echo "selected"?>><?php echo $bank[1] ?></option><?php } ?>

											</select>
                                 	 </div> 
                                 	  <div class="form-group">
											<label>Gudang Tujuan <b style="color:red;">*</b></label>
											<select name="gudang_tujuan"   class="form-control" id="pembayaran" required onChange="func2()">
																 <option>Pilih</option>
													<?php 
															$qrybank=mysql_query("select * from gudang order by sort_by");
															while($bank=mysql_fetch_array($qrybank)){
													?>
													<option value="<?php echo $bank[0] ?>" <?php if($data['gudang_tujuan']==$bank[0]) echo "selected"?>><?php echo $bank[1] ?></option><?php } ?>

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
													 $qry=mysql_query("select *,mutasi_gudang.harga_jual as harga_jual from mutasi_gudang,barang where mutasi_gudang.kode_barang=barang.kode_barang and mutasi_gudang.keterangan='".$data['no_mutasi']."' and tipe='masuk'");
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
													 $qry=mysql_query("select *,mutasi_gudang.harga_jual as harga_jual from mutasi_gudang,barang where mutasi_gudang.kode_barang=barang.kode_barang and mutasi_gudang.keterangan='".$data['no_mutasi']."' and tipe='masuk'");
													 while($row=mysql_fetch_array($qry)){
													?>
                                                    <li><input type="hidden"id="kode" name="kode[]" value="<?php echo $row['kode_barang'] ?>" /><input type="text" size="40%"id="pname" name="pname[]" value="<?php echo $row['nama_barang'] ?>" readonly/><input type="text" size="18%" id="satuan" name="satuan[]" value="<?php echo $row['satuan'] ?>" readonly/><input type="text" id="harga_jual" name="harga_jual[]" value="<?php echo $row['harga_jual'] ?>"/><input type="number" id="qty" name="qty[]" value="<?php echo $row['jumlah'] ?>" required="required" size="8%"/><input type="hidden" id="harga_beli" name="harga_beli[]" value="<?php echo $row['harga_beli'] ?>"/> <input type="text" id="sub_total" name="sub_total[]" value="<?php echo $row['sub_total'] ?>" rel="total" readonly/> <a  id="HapusInput" class="btn btn-xs btn-danger">Hapus</a></li><?php } ?>   
                                  </ol><?php } ?>
                                                        <input type="hidden" name="grandtotal" id="grand" value="<?php echo ($data['total']) ?>">  <input type="button" id="hitung" name="padd" value="Hitung" class="btn btn-sm btn-default" style="font-weight:bold;font-size:14px" /> <div style="float:right;right:+50px;position:relative"> <label style="font-size:24px" >Total : </label> <label id="total" style=";font-size:24px"><?php echo number_format($data['total']) ?></label></div>
                                                     <hr />  
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