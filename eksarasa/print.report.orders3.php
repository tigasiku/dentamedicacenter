<?php
session_start();
include "koneksi.php";
include "function.php";
?>
        <style>
	@page {
  size: A4;
 
	font-family: "Calibri" ;
			font-size: 11px !important;
			padding: 30px;
	
			 
}
@media print {
  html, body {
	  
    width: 210mm;
    
		padding: 30px;
	
	    
         
  }
  /* ... the rest of the rules ... */
}
</style>

        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
         <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link href="css/bs-callout.css" rel="stylesheet" type="text/css" />                   
<div class="container-fluid" style="padding-right:5px;padding-left:5px;padding-top: 0px">
            <div class="row">
                  <div class="col-xs-12"><img src="img/logo2.png" style="float: right;height: 50px;margin-top: -12px">
                            <h2 class="page-header" style="font-size:20px">
                                Detail Penjualan 
                            </h2>                            
                  </div><!-- /.col -->
            </div>
            <div class="panel panel-default">
    
      <div >
     
      <form action="http://localhost/opencart/upload/admin/index.php?route=catalog/product/delete&amp;token=TvthUB0fpnYKRqAYZYgsYn3RFzeFJBMC" method="post" enctype="multipart/form-data" id="form-product">
        
           
           <?php  if(isMobile()){ ?>
         <table class="table table-hover " style="font-size: 12px !important">
              <tr>
                <th style="text-align:center;">No</th>
                
                <th style="text-align:center;">Nama Barang</th>
                <th >Harga </th>
                <th >Qty</th>
                <th >Total</th>
                <th >Selisih</th>
              </tr>
              <?php
									if(!empty($filter_sub_kategori)){
										
										$query=mysql_query("select * from penjualan_detail,penjualan,barang where penjualan_detail.no_jual=penjualan.no_jual and penjualan_detail.kode_barang=barang.kode_barang and tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' and customer like '%".@$filter_nama."%'  and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."' and kd_gudang like '%".@$filter_gudang."%' group by penjualan.no_jual  order by tgl_jual");
										 
									}
									elseif(!empty($filter_kategori)){
										$query=mysql_query("select * from penjualan_detail,penjualan,barang where penjualan_detail.no_jual=penjualan.no_jual and penjualan_detail.kode_barang=barang.kode_barang and tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' and customer like '%".@$filter_nama."%'  and barang.kode_kategori= '".@$filter_kategori."' and kd_gudang like '%".@$filter_gudang."%' group by penjualan.no_jual order by tgl_jual ");
										
									}else{
										$query=mysql_query("select * from penjualan_detail,penjualan where penjualan_detail.no_jual=penjualan.no_jual and tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' and customer like '%".@$filter_nama."%' and kd_gudang like '%".@$filter_gudang."%' group by penjualan.no_jual order by tgl_jual");}
										while($data=mysql_fetch_array($query)){
										?>
              <tr style="font-weight:bold">
             
                <td colspan="6" style="text-align:left;">Tanggal : <?php echo date("d-m-Y",strtotime($data['tgl_jual'])) ?> - <?php echo $data['customer'] ?><br>                  
                <?php echo $data['no_jual'] ?></td>
               
              </tr>
              <?php
											if(!empty($filter_sub_kategori)){
												
												 $qry=mysql_query("select *,penjualan_detail.harga_jual as  harga_jual,penjualan_detail.harga_beli as  harga_beli  from penjualan_detail,penjualan,barang where penjualan_detail.no_jual=penjualan.no_jual and penjualan_detail.kode_barang=barang.kode_barang and penjualan_detail.no_jual='".$data['no_jual']."'  and customer like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."' ");
											}
											  elseif(!empty($filter_kategori)){
											  
												  $qry=mysql_query("select *,penjualan_detail.harga_jual as  harga_jual,penjualan_detail.harga_beli as  harga_beli  from penjualan_detail,penjualan,barang where penjualan_detail.no_jual=penjualan.no_jual and penjualan_detail.kode_barang=barang.kode_barang and penjualan_detail.no_jual='".$data['no_jual']."'  and customer like '%".@$filter_nama."%'  and barang.kode_kategori= '".@$filter_kategori."' ");
											  
											  }else{
												$qry=mysql_query("select *,penjualan_detail.harga_jual as  harga_jual,penjualan_detail.harga_beli as  harga_beli  from penjualan_detail,penjualan,barang where penjualan_detail.no_jual=penjualan.no_jual and penjualan_detail.kode_barang=barang.kode_barang and penjualan_detail.no_jual='".$data['no_jual']."'  and customer like '%".@$filter_nama."%'  ");
											  }
										while($row=mysql_fetch_array($qry)){
										?>
              <tr>
                <td rowspan="2" align="center"></td>
            
                <td rowspan="2" style="text-align:center;"><?php echo $row['nama_barang'] ?></td>
                <td><?php
											 
											   echo number_format($row['harga_beli']); ?></td>
                <td rowspan="2" style="vertical-align: middle"><?php
											 
											 
											 	
											echo 	$stok=$row['jumlah']; 
											   @$stok2=$stok+$stok2;
					@$stok3=$stok+$stok3;
					
					$total_jual=$row['harga_jual']*$row['jumlah'];
					   @$total_jual2=$total_jual+$total_jual2;
					?>
                <?php  echo $row['satuan']; ?></td>
                <td><?php 
													  echo number_format($total_beli=$row['harga_beli']*$row['jumlah']);
													  @$total_beli2=$total_beli+$total_beli2;
													   ?></td>
           
                <td rowspan="2"><?php
											 
											   echo number_format(@$grand_total=$total_jual-$total_beli);
											   @$grand_total2=@$grand_total+@$grand_total2;
											 @$grand_total3=@$grand_total+@$grand_total3;
											
												   @$total_jual3=$total_jual+$total_jual3;
											
											    ?></td>
               
              </tr>
              <tr>
                <td><?php 
													  echo number_format($row['harga_jual']); ?></td>
                <td><?php
											 
											   echo number_format($total_jual);
											
											    ?></td>
              </tr>
              <?php
									
										}
																		?>
              <tr style="font-weight:bold">
                <td align="center">&nbsp;</td>
                <td style="text-align:center;">Sub Total</td>
                <td>&nbsp;</td>
               
               
                <td><?php
											 
											   echo number_format(@$stok3); ?></td>
               
                <td><?php
										   echo number_format(@$total_jual3); 	 
											 ?></td>
                <td><?php
										   echo number_format(@$grand_total3); 	 
											 ?></td>
             
              </tr>
									<?php 	$grand_total3=0;$total_jual3=0;$stok3=0;} 
										?>
              <tr style="font-weight:bold">
                <td rowspan="2" align="center">&nbsp;</td>
                <td rowspan="2" style="text-align:center;">Total</td>
           
                <td rowspan="2">&nbsp;</td>
          
                <td rowspan="2" style="vertical-align: middle"><?php
											 
											   echo number_format(@$stok2); ?></td>
                <td><?php
											 
											   echo number_format(@$total_beli2); ?></td>
                <td rowspan="2" style="vertical-align: middle"><?php
											 
											   echo number_format(@$grand_total2); ?></td>
              
              </tr>
              <tr style="font-weight:bold">
                <td><?php
											 
											   echo number_format(@$total_jual2); ?></td>
              </tr>
            </table>
           <?php }else{ ?>  <div class="table-responsive">
            <table class="table table-hover " style="">
              <tr>
                <th style="text-align:center;">No</th>
                
                <th style="text-align:center;">Nama Barang</th>
                
                <th >Harga Jual</th>
                <th >Jumlah</th>
                <th >Satuan</th>
               
                <th >Total Jual</th>
              
              </tr>
              <?php
									if(!empty($filter_sub_kategori)){
										
										$query=mysql_query("select * from penjualan_detail,penjualan,barang where penjualan_detail.no_jual=penjualan.no_jual and penjualan_detail.kode_barang=barang.kode_barang and tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' and customer like '%".@$filter_nama."%'  and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."' and kd_gudang like '%".@$filter_gudang."%' group by penjualan.no_jual  order by tgl_jual");
										 
									}
									elseif(!empty($filter_kategori)){
										$query=mysql_query("select * from penjualan_detail,penjualan,barang where penjualan_detail.no_jual=penjualan.no_jual and penjualan_detail.kode_barang=barang.kode_barang and tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' and customer like '%".@$filter_nama."%'  and barang.kode_kategori= '".@$filter_kategori."' and kd_gudang like '%".@$filter_gudang."%' group by penjualan.no_jual order by tgl_jual ");
										
									}else{
										$query=mysql_query("select * from penjualan_detail,penjualan where penjualan_detail.no_jual=penjualan.no_jual and tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' and customer like '%".@$filter_nama."%' and kd_gudang like '%".@$filter_gudang."%'  group by penjualan.no_jual order by tgl_jual");}
										while($data=mysql_fetch_array($query)){
										?>
              <tr style="font-weight:bold">
             
                <td colspan="6
                " style="text-align:left;">Tanggal : <?php echo date("d-m-Y",strtotime($data['tgl_jual'])) ?> - <?php echo $data['no_jual'] ?> - <?php echo $data['customer'] ?></td>
               
              </tr>
              <?php
											if(!empty($filter_sub_kategori)){
												
												 $qry=mysql_query("select *,penjualan_detail.harga_jual as  harga_jual,penjualan_detail.harga_beli as  harga_beli  from penjualan_detail,penjualan,barang where penjualan_detail.no_jual=penjualan.no_jual and penjualan_detail.kode_barang=barang.kode_barang and penjualan_detail.no_jual='".$data['no_jual']."'  and customer like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."'");
											}
											  elseif(!empty($filter_kategori)){
											  
												  $qry=mysql_query("select *,penjualan_detail.harga_jual as  harga_jual,penjualan_detail.harga_beli as  harga_beli  from penjualan_detail,penjualan,barang where penjualan_detail.no_jual=penjualan.no_jual and penjualan_detail.kode_barang=barang.kode_barang and penjualan_detail.no_jual='".$data['no_jual']."'  and customer like '%".@$filter_nama."%'  and barang.kode_kategori= '".@$filter_kategori."'");
											  
											  }else{
												$qry=mysql_query("select *,penjualan_detail.harga_jual as  harga_jual,penjualan_detail.harga_beli as  harga_beli  from penjualan_detail,penjualan,barang where penjualan_detail.no_jual=penjualan.no_jual and penjualan_detail.kode_barang=barang.kode_barang and penjualan_detail.no_jual='".$data['no_jual']."'  and customer like '%".@$filter_nama."%' order by tgl_jual");
											  }
										while($row=mysql_fetch_array($qry)){
										?>
              <tr>
                <td align="center"></td>
            
                <td style="text-align:center;"><?php echo $row['nama_barang'] ?></td>
             
                <td><?php 
													  echo number_format($row['harga_jual']); ?></td>
                <td><?php
											 
											 
											 	
											echo 	$stok=$row['jumlah']; 
											   @$stok2=$stok+$stok2;
					@$stok3=$stok+$stok3;?></td>
                <td><?php  echo $row['satuan']; ?>
              </td>
            
                <td><?php
											 
											   echo number_format($total_jual=$row['harga_jual']*$row['jumlah']);
											   @$total_jual2=$total_jual+$total_jual2;
											    ?>
											    <?php
											 
											    number_format(@$grand_total=$total_jual-$total_beli);
											   @$grand_total2=@$grand_total+@$grand_total2;
											 @$grand_total3=@$grand_total+@$grand_total3;
											
												   @$total_jual3=$total_jual+$total_jual3;
											
											    ?></td>
             
              </tr>
              <?php
									
										}
																		?>
              <tr style="font-weight:bold">
                <td align="center">&nbsp;</td>
                <td style="text-align:center;">Sub Total</td>
             
               
                <td>&nbsp;</td>
                <td><?php
											 
											   echo number_format(@$stok3); ?></td>
                <td>&nbsp;</td>
              
                <td><?php
										   echo number_format(@$total_jual3); 	 
											 ?></td>
            
              </tr>
									<?php 	$grand_total3=0;$total_jual3=0;$stok3=0;} 
										?>
              <tr style="font-weight:bold">
                <td align="center">&nbsp;</td>
                <td style="text-align:center;">Total</td>
           
            
                <td>&nbsp;</td>
                <td><?php
											 
											   echo number_format(@$stok2); ?></td>
                <td>&nbsp;</td>
             
                <td><?php
											 
											   echo number_format(@$total_jual2); ?></td>
             
              </tr>
            </table><?php } ?>
          </div>
        </form>
        <div class="row" style="padding-right:5px;padding-left:5px">
         <div class="box-footer clearfix">
							
                                </div>
        </div>
      </div>
    </div>
  </div>
  <script>
	  
$( ".hapus" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin ?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script>
<script src="js/sub_kat_barang.js" type="text/javascript"></script> 