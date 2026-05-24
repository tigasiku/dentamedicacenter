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
$filter_kategori=$_GET['filter_kategori'];



$qry_kategory=mysql_fetch_array(mysql_query("select * from kategori_uang_masuk,kategori where
											kategori.kode=kategori_uang_masuk.kode_klasifikasi and
											kode_kategori_uang_masuk='".$filter_kategori."'"));
		
											$kategori=$qry_kategory['kategori_uang_masuk'];
											$klasifikasi=$qry_kategory['klasifikasi'];

?>
  
 <div class="box box-primary" style="padding-left: 15px;
    padding-right: 15px;">
                            <div class="box-header">
                               
                          </div><!-- /.box-header -->
   <div align="center">
										<span style=";font-weight:bold;color: #1079ae;font-size: 29px"><?php echo $klasifikasi ?> - <?php echo $kategori ?></span><br>
	 <span style=";font-weight:bold;color: #911c18;font-size: 16px"><?php echo date('01 F Y',strtotime($filter_dari)) ?> - <?php echo date('d F Y',strtotime($filter_dari)) ?></span>
   </div>		<br>
                           
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped" style="margin-top:10px;">
                                        <tr>
                                            		   <th class="text-left">No Ref</th>
                    <th class="text-left">Tanggal</th>
                    <th class="text-left">Kategori</th>
                       <th class="text-left">Uraian</th>
                     <th style="text-align:right">Total</th>
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
										$qry=mysql_query("select * from pemasukan where  month(tanggal) = '".date('m',strtotime($filter_dari))."' and year(tanggal) = '".date('Y',strtotime($filter_dari))."' and  kode_kategori_uang_masuk= '".@$filter_kategori."'  order by  tanggal desc  ");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                    			  <td class="text-left"><?php echo $row[0]?><br>
                    
                  <b> <?php 
											$qry_kategory=mysql_fetch_array(mysql_query("select * from kategori_uang_masuk,sub_kategori_uang_masuk where
											kategori_uang_masuk.kode_kategori_uang_masuk=sub_kategori_uang_masuk.kode_kategori_uang_masuk and
											kode_sub_kategori_uang_masuk='".$row['kode_sub_kategori_uang_masuk']."'"));
		
											$kategori=$qry_kategory['kategori_uang_masuk'];
											$subkategori=$qry_kategory['sub_kategori_uang_masuk'];
		
										
											
											if($kategori=="Pembelian"){
														 	$row2=mysql_fetch_array(mysql_query("select kd_bank from arus_kas where kode='".$row['keterangan']."'"));}else{$row2=mysql_fetch_array(mysql_query("select kd_bank from arus_kas where kode='$row[0]'"));}
														 
												$qrybank=mysql_query("select * from bank_perusahaan where kd_bank='".$row2[0]."'");
												$bank=mysql_fetch_array($qrybank);
										?><?php echo $bank[1] ?> <?php if(!empty($bank[2])) echo " <br>".$bank[2] ?> <?php if(!empty($bank[3])) echo " <br> ".$bank[3] ?></b> </td>
                 <td class="text-left"><b><?php echo date("d-m-Y",strtotime($row['tanggal'])) ?></b> </td>
                
                              <td class="text-left" align="right">
                 							- <?php echo ($subkategori); ?>
                 							<?php if(!empty($row['nama_vendor'])) { echo "<br>--- ".($row['nama_vendor']);} ?>
                 							</td>
                  
                  
                       <td class="text-left" align="right"><?php echo ($row['keterangan']); ?></td>
                  
              
                  
                  
                  <td class="text-right"><?php echo number_format($row['jumlah']); @$jumlah2=$row['jumlah']+$jumlah2;?></td> 
      
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                         <tr style="font-weight:bold">
                                           
											 <td colspan="4" style="text-align:center;">Total</td>
                                       
                                       <td style="text-align:right;">
                                         <?php echo number_format(@$jumlah2); ?></td>
                                    
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