<?php
@session_start();
include "koneksi.php";
include "function.php";
if(isset($_GET['cari'])){
$cari=$_GET['cari'];
}else{
$cari=$_POST['cari'];
}

$filter_dari=$_GET['tanggal'];
?>
  
 <div class="box box-primary" style="padding-left: 15px;
    padding-right: 15px;">
                            <div class="box-header">
                               
                          </div><!-- /.box-header -->
   <div align="center">
										<span style=";font-weight:bold;color: #1079ae;font-size: 29px">Penjualan</span><br>
	 <span style=";font-weight:bold;color: #911c18;font-size: 16px"><?php echo date('01 F Y',strtotime($filter_dari)) ?> - <?php echo date('d F Y',strtotime($filter_dari)) ?></span>
   </div>		<br>
                           
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped" style="margin-top:10px;">
                                        <tr>
                                            		<th style="text-align:center;">Tanggal</th>
                                            <th style="text-align:center;">No Ref</th>
                                            <th style="text-align:center;">Customer</th>
									
                                            <th style="text-align:right;">Total</th>
                                                                                          <th style="text-align:right;">Pembayaran</th>    <th style="text-align:right;">Saldo</th>
                                                                                        <?php if ($_SESSION['loglevel']=="Administrator" or $_SESSION["loglevel"]=="Admin"){ ?>
                                            <?php } ?>
                                        </tr>
										<?php
										$limit = 30;
										if(isset($_GET['hal'])){
											$hal = $_GET['hal'];
										}
										else{
											$hal = 1;
										}

										$offset = ($hal - 1) * $limit;
										$i=1;
										$qry=mysql_query("select * from penjualan where  month(tgl_jual) = '".date('m',strtotime($filter_dari))."' and year(tgl_jual) = '".date('Y',strtotime($filter_dari))."' and  customer like '%".@$_POST['cari']."%' order by tgl_jual asc,no_jual asc ");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                    			<td style="text-align:center;"><?php echo date("d-m-Y",strtotime($row['tgl_jual'])) ?></td>
                                            <td align="center"><a  onclick="window.open('?page=detail.penjualan&no_jual=<?php echo $row['no_jual'] ?>','mywindow','scrollbars=1,width=800,height=500')" style="cursor:pointer;font-weight:bold;color: #1079ae"><?php echo $row['no_jual'];?></a></td>
                                            <td align="center" style="text-align:left;"><?php echo $row['customer'];?></td>
								
                                           
                                            <td style="text-align:right;"><?php
											 
											   echo number_format($total_jual=$row['total']);
											   @$total_jual2=$total_jual+$total_jual2;
											    ?></td>
                                            <td style="text-align:right;">
                                            	<?php 
													if( $row['pembayaran']=='Kredit'){
															$jumlah_bayar=mysql_fetch_array(mysql_query("select sum(jumlah_bayar) as jumlah_bayar from bayar_piutang,piutang where  		bayar_piutang.kode_piutang=piutang.kode_piutang  and piutang.keterangan='".$row['no_jual']."'"));
														
																$jumlah_bayar_arus=mysql_fetch_array(mysql_query("select sum(nilai) as jumlah_bayar from arus_kas where  		kode='".$row['no_jual']."'"));
														
															echo number_format($total_pembayaran=$jumlah_bayar['jumlah_bayar']+$jumlah_bayar_arus['jumlah_bayar']);
													}else{
														echo number_format($total_pembayaran=$row['total']);
														 @$total_pembayaran2=$total_pembayaran+$total_pembayaran2;
													}
											?>
                                            	
                                            </td>  <td style="text-align:right;">	<?php 
													if( $row['pembayaran']=='Kredit'){
													
											
													echo number_format($total_saldo=$row['total']-($jumlah_bayar['jumlah_bayar']+$jumlah_bayar_arus['jumlah_bayar']));
														
														 @$total_saldo2=$total_saldo+$total_saldo2;
													}else{
													echo "0";
													}
											?></td>
                                           <?php if ($_SESSION['loglevel']=="Administrator" or $_SESSION["loglevel"]=="Admin"){ ?>
                                            <?php } ?>
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                         <tr style="font-weight:bold">
                                           
											 <td colspan="3" style="text-align:center;">Total</td>
                                            <td style="text-align:right;"><?php
											 
											   echo number_format(@$total_jual2); ?></td>     <td style="text-align:right;">
                                         <?php
											 
											   echo number_format(@$total_pembayaran2); ?>
                                   </td>
                                       <td style="text-align:right;">
                                         <?php
											 
											   echo number_format(@$total_saldo2); ?></td>
                                    
                                        </tr>
                                    </table>
                                    </div> 
                        
                                   
</div>   
                              </div><!-- /.box-body -->
								
                             
                             
                      
<script>

//<![CDATA[
$(document).ready(function() {
	 $(".announce").click(function(){ // Click to only happen on announce links
				
		 
		   var gudangnya = $("#gudangnya").val();
		 var row3 = $(this).closest("li"); 

			  var namanya = row3.find(".satuan").text();
					var komen =2;
		 
				  var dataString = 'hal2='+ namanya ;
									$.ajax({
										 

										 success: function()
													   {
										
								
														
										  $('#content').load('isi_list_barangnya.php?hal2='+namanya+'&gudang='+gudangnya);
														   $('#content').stop();
									   }
									});
		 
		 
		 
		 
		 
				
			   });
	
	$("#pencarian").click(function(){ // Click to only happen on announce links
				
		 
		 
	

			  var namanya = $("#cari").val();
				  var gudangnya = $("#gudangnya").val();
				  var dataString = 'cari='+ namanya ;
									$.ajax({
										 

										 success: function()
													   {
										
								
														
										  $('#content').load('isi_list_barangnya.php?cari='+namanya+'&gudang='+gudangnya);
											$('#content').stop();			 
									   }
									});
		 
		 
		 
		 
		 
				
			   });
	
	
	
$(".use-address").click(function() {
    var $row = $(this).closest("tr");    // Find the row
	  var $row2 = $(this).closest('tr').next();
    var $text = $row.find(".kode").text(); // Find the text
	<?php if(isMobile()){ ?>
     var $namanya = $row.find(".namanya").text();<?php  ?> // Find the text
	<?php }else{ ?>
     var $namanya = $row.find(".namanya").text();<?php } ?> // Find the text
	    var $harga_jual = $row.find(".harga_jual").text(); // Find the text
	    var $harga_beli = $row.find(".harga_beli").text(); // Find the text
	    var $satuan= $row.find(".satuan").text(); // Find the text
	    var $qty = $row.find(".qty").text(); // Find the text
	 var $sub_total = $row.find(".sub_total").text(); // Find the text
    // Let's test it out
	$("#kode").val($text);
	$("#pname").val($namanya); 

	$("#harga_jual").val($harga_jual); 
	$("#harga_beli").val($harga_beli); 
		$("#satuan").val($satuan); 

	 $('#basicModal').modal('hide');
		$("#qty").focus();
});
});//]]> 


</script>