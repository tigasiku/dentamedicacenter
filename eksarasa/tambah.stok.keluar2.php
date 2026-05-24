<?php
include "koneksi.php";


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
    var sumpprice = $this.siblings('#harga_jual').val();
	var sumpqty = $this.val();
	var sumtotal = ((sumpprice * sumpqty)).toFixed(2);
	$this.siblings('#sub_total').val( sumtotal );
});
$(document).on('keyup', '#harga_jual', function(){
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
	var totalpprice = (qty * harga_jual).toFixed(2);
	$('.bersih').val("");
	$('#addhereform').append('<li><input type="hidden"id="kode" name="kode[]" value="' + kode + '" /><input type="text" size="40%"id="pname" name="pname[]" value="' + pname + '" readonly/><input type="text" size="18%" id="satuan" name="satuan[]" value="' + satuan + '" readonly/><input type="text" id="harga_jual" name="harga_jual[]" value="' + harga_jual + '" readonly/><input type="hidden" id="harga_beli" name="harga_beli[]" value="' + harga_beli + '"/><input type="number" id="qty" name="qty[]" value="' + qty + '" required="required" size="8%" readonly/> <input type="text" id="sub_total" name="sub_total[]" value="' + totalpprice + '" rel="total" readonly/>  <a  id="HapusInput" class="btn btn-xs btn-danger">Hapus</a></li>');
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
		Stok Keluar
        <small></small></h1>
</section>

<section class="content">
			
            <div class="row">
                        <div class="col-xs-10">
							<div class="box box-solid box-primary">
							  <div class="box-header">
									<h3 class="box-title">Tambah Stok Keluar</h3>
						  </div>  <?php 
									if(isset($_GET['pesan'])){?>  
                                  	<div class="small-box bg-<?php if($_GET['pesan']=="success"){ echo "green";}else{ echo "red";}?> ">
                                		<div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                             			</div>
                        			</div><?php }?>
                                
								<form action="simpan.stok.keluar.php" method="post" name="autoSumForm" enctype="multipart/form-data" id="form">
								<div class="box-body">	
                               
                            <div class="col-xs-5">
                               <div class="form-group">
                                    <label>Tanggal  <b style="color:red;">*</b></label>
                                    <input name="tanggal" type="text" value="<?php date_default_timezone_set("Asia/Makassar"); echo $no=date("Y-m-d"); ?>"  class="form-control" readonly id="dp2"/>
                                  </div>  
                               	
                                         
                                        
                                        
                            </div>
								<div class="col-xs-5">
                                       <div class="form-group">
											<label>Dari Gudang  <b style="color:red;">*</b></label>
											<select name="gudang"   class="form-control" >
																
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
                                         <table style="width: 1050px">
                                         	<tr>
                                         		<th width="51">
                                         			+
                                         		</th>
                                         		<th width="280">
                                         				Nama Barang	
                                         		</th>
                                         		<th width="106">
                                         				Satuan
                                         		</th>
                                         		<th width="160">
                                         				Harga
                                         		</th>
                                         		<th width="94">
                                         				Qty
                                         		</th>
                                         		<th width="331">
                                         				Subtotal
                                         		</th>
                                         	
                                         	</tr>
                                         </table>
									  <a href="javascript:TampilTabel('list_barang.php')" class="btn btn-default btn-primary btn-xs form-control" style="width:30px;height:28px;position:relative;top:-2px"><span class="glyphicon glyphicon-plus" style="font-weight:bold;color:#FFF;position:relative;top:+6px"></span></a><input type="hidden" id="kode" name="kode" value="" class="bersih"/>
    <input name="pname" type="text" class="namanya bersih" id="pname" placeholder="Nama Barang" value="" size="48%" readonly/>
  <input name="satuan" type="text" class="bersih" id="satuan" value=""  size="14%" readonly placeholder="satuan"/><input name="harga_jual" type="text" id="harga_jual" placeholder="Harga Jual" value="" size="22%" class="bersih" />
  <input name="harga_beli" type="hidden" id="harga_beli" placeholder="Harga Jual" value="" size="22%" class="bersih" />
      
  <input name="qty" type="text" id="qty" placeholder="qty" value="" class="bersih"  size="14%"/>
    <input type="text" id="sub_total" name="sub_total" value="" placeholder="Sub Total" checked="checked" class="bersih"/>
    <input type="button" id="padd" name="padd2" value="Add" class="btn btn-sm btn-default" style="font-weight:bold;font-size:12px" onclick="valid()"/></td>
  

                                                    <ol id="addhereform">
                                                    
                                  </ol>
                                                        <input type="hidden" name="grandtotal" id="grand">  <input type="button" id="hitung" name="padd" value="Hitung" class="btn btn-sm btn-default" style="font-weight:bold;font-size:14px" /> <div style="float:right;right:+50px;position:relative"> <label style="font-size:24px" >Total : </label> <label id="total" style=";font-size:24px"> </label></div>
                                                     <hr />  
                                    </div>
                                    
                                    <div class="col-xs-12">
                                            <div class="form-group">
                                            	<label>Keterangan <b style="color:red;">*</b></label>
                                                <textarea  class="form-control" name="ket" id="id_ta2"  /></textarea>
                                  		 	</div>  
                                      
                                    </div>
                                    
                                </div><!-- /.box-body -->

                              
											<div class="box-footer">                                
                                			
													<div class="col-xs-12">
													<hr>
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