<?php
include "koneksi.php";


date_default_timezone_set("Asia/Makassar");
						
$query=mysql_query("select * from pembelian where no_beli='".$_GET['no_beli']."' ");
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


<script type="text/javascript">//<![CDATA[ 
$(window).load(function(){
	
$(document).on('keyup', '#qty', function(){
    var $this = $(this);
    var sumpprice = $this.siblings('#harga_beli').val();
	var sumpqty = $this.val();
	var sumtotal = ((sumpprice * sumpqty)).toFixed(2);
	$this.siblings('#sub_total').val( sumtotal );
});
$(document).on('keyup', '#harga_beli', function(){
    var $this = $(this);
    var sumpprice = $this.val();
	var sumpqty = $this.siblings('#qty').val();
	var sumtotal = ((sumpprice * sumpqty)).toFixed(2);
	$this.siblings('#sub_total').val( sumtotal );
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
	$('#addhereform').append('<li><input type="hidden"id="kode" name="kode[]" value="' + kode + '" /><input type="text" size="40%"id="pname" name="pname[]" value="' + pname + '" readonly/><input type="text" size="18%" id="satuan" name="satuan[]" value="' + satuan + '" readonly/><input type="hidden" id="harga_jual" name="harga_jual[]" value="' + harga_jual + '"/><input type="text" id="harga_beli" name="harga_beli[]" value="' + harga_beli + '"/><input type="number" id="qty" name="qty[]" value="' + qty + '" required="required" size="8%"/> <input type="text" id="sub_total" name="sub_total[]" value="' + totalpprice + '" rel="total" readonly/> <a  id="HapusInput" class="btn btn-xs btn-danger">Hapus</a></li>');
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
	<h1>
		Pembelian
        <small></small></h1>
</section>

<section class="content">
			
            <div class="row">
                        <div class="col-xs-12">
							<div class="box box-solid box-primary">
							  <div class="box-header">
									<h3 class="box-title">Edit Pembelian</h3>
						  </div>  <?php 
									if(isset($_GET['pesan'])){?>  
                                  	<div class="small-box bg-<?php if($_GET['pesan']=="success"){ echo "green";}else{ echo "red";}?> ">
                                		<div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                             			</div>
                        			</div><?php }?>
                                
								<form action="perbarui.pembelian.php" method="post" name="autoSumForm" enctype="multipart/form-data" id="form">
								<div class="box-body">	
                                <div class="col-xs-6">
                                	
                                  <div class="form-group">
                                    <label>No Ref  <b style="color:red;">*</b></label>
                                    <input name="no_ref" type="text" value="<?php  echo $data['no_beli'] ?>"  class="form-control" readonly />
                                  </div>  
                             <div class="form-group">
                                    <label>Nama Vendor  <b style="color:red;">*</b></label>
                                    <input name="nama_vendor" type="text" value="<?php  echo $data['nama_vendor'] ?>"  class="form-control" required />
                                  </div>
							
                              </div>  
                              <div class="col-xs-6">
                               <div class="form-group">
                                    <label>Tanggal  <b style="color:red;">*</b></label>
                                    <input name="tanggal" type="text" value="<?php  echo $data['tgl_beli']?>"  class="form-control" readonly id="dp2"/>
                                  </div>  
                               	   <div class="form-group">
											<label>Dari Gudang  <b style="color:red;">*</b></label>
											<select name="gudang"   class="form-control" required id="gudang">
																
													<?php 
	
													 $qrygud=mysql_query("select *,pembelian_detail.harga_beli as harga_beli from pembelian_detail,barang where pembelian_detail.kode_barang=barang.kode_barang and no_beli='".$data['no_beli']."'");
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
									  <a href="javascript:TampilTabel('list_barang.php?p')" class="btn btn-default btn-primary btn-xs form-control" style="width:30px;height:28px;position:relative;top:-2px"><span class="glyphicon glyphicon-plus" style="font-weight:bold;color:#FFF;position:relative;top:+6px"></span></a><input type="hidden" id="kode" name="kode" value="" class="bersih"/>
    <input name="pname" type="text" class="namanya bersih" id="pname" placeholder="Nama Barang" value="" size="48%" readonly/>
  <input name="satuan" type="text" class="bersih" id="satuan" value=""  size="14%" readonly placeholder="satuan"/><input name="harga_jual" type="hidden" id="harga_jual" placeholder="Harga Jual" value="" size="22%" class="bersih" />
  <input name="harga_beli" type="text" id="harga_beli" placeholder="Harga Beli" value="" size="22%" class="bersih" />
      
  <input name="qty" type="text" id="qty" placeholder="qty" value="" class="bersih"  size="14%"/>
    <input type="text" id="sub_total" name="sub_total" value="" placeholder="Sub Total" checked="checked" class="bersih"/>
       <input type="button" id="padd" name="padd2" value="Add" class="btn btn-sm btn-default" style="font-weight:bold;font-size:12px" onclick="valid()"/></td>
  

                                                    <ol id="addhereform">
                                                    
                                                    <?php 
													 $qry=mysql_query("select *,pembelian_detail.harga_beli as harga_beli from pembelian_detail,barang where pembelian_detail.kode_barang=barang.kode_barang and no_beli='".$data['no_beli']."'");
													 while($row=mysql_fetch_array($qry)){
													?>
                                                    <li><input type="hidden"id="kode" name="kode[]" value="<?php echo $row['kode_barang'] ?>" /><input type="text" size="40%"id="pname" name="pname[]" value="<?php echo $row['nama_barang'] ?>" readonly/><input type="text" size="18%" id="satuan" name="satuan[]" value="<?php echo $row['satuan'] ?>" readonly/><input type="hidden" id="harga_jual" name="harga_jual[]" value=""/><input type="text" id="harga_beli" name="harga_beli[]" value="<?php echo $row['harga_beli'] ?>"/><input type="number" id="qty" name="qty[]" value="<?php echo $row['jumlah'] ?>" required="required" size="8%"/> <input type="text" id="sub_total" name="sub_total[]" value="<?php echo $row['sub_total'] ?>" rel="total" readonly/> <a  id="HapusInput" class="btn btn-xs btn-danger">Hapus</a></li><?php } ?>
                                                    
                                  </ol>
                                                        <input type="hidden" name="grandtotal" id="grand" value="<?php echo $data['total'] ?>">  <input type="button" id="hitung" name="padd" value="Hitung" class="btn btn-sm btn-default" style="font-weight:bold;font-size:14px" /> <div style="float:right;right:+50px;position:relative"> <label style="font-size:24px" >Total : </label> <label id="total" style=";font-size:24px"><?php echo number_format($data['total']) ?></label></div>
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
									<div id="jumlah_bayar" style="display: <?php if($data['pembayaran']=="Kredit") { echo "block"; } else { echo "none"; }  ?>">
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
                                    <label>Dana Keluar  <b style="color:red;">*</b></label>
                                    <select name="kas"   class="form-control" id="pembayaran" required onChange="func2()">
                                    	<?php 
												$qrybank=mysql_query("select * from bank_perusahaan where status='Y' order by sort_by");
												$delete2=mysql_fetch_array(mysql_query("select * from arus_kas where kode='".$data['no_beli']."'"));
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
</script>