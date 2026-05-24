<?php
if(isset($_POST['filter_dari'])){
$filter_dari=$_POST['filter_dari'];
$filter_sampai=$_POST['filter_sampai'];

}
elseif(isset($_GET['filter_dari'])){
$filter_dari=$_GET['filter_dari'];
$filter_sampai=$_GET['filter_sampai'];

}

else{
	$month_end = strtotime('last day of this month', time());	
$penguran=date('d', $month_end);
$filter_sampai=date("Y-m-").$penguran;;
$filter_dari=date("Y-m-01");
	$filter_jenis="";
}
?>

<?php  if(isMobile()){ ?>

<div style="margin: 10px 0 20px;">
	
</div>
<?Php }else{ ?>

  <section class="content-header">
	<h1>
		Laporan Laba-Rugi<small></small>
    </h1>
</section>
  <?php } ?>
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
                                    Data <code><?php echo $_GET['pesan'] ?></code> berhasil dieksekusi                                    
                                </div><!-- /.box-body -->
                            </div>
</div><?php } ?>                            
<div class="container-fluid" style="padding-right:5px;padding-left:5px;padding-top: 20px">
            <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title" style="max-width: 250px;display: inline-block"><i class="fa fa-list"></i> Laporan </h3> <button class="btn btn-default pull-right" id="myelement" ><i class="fa fa-search"></i></button>
      </div>
      <div class="panel-body">
      <form action="?page=<?Php echo $page ?>" method="post">
        <div class="well" id="another-element" style="<?php if(isset($_POST['submit'])) {echo "display:block";}else{ echo "display:none"; }  ?>">
          <div class="row">
          
            <div class="col-sm-4 col-xs-12 ">
              <div class="form-group">
                <label class="control-label" for="input-name">Dari</label>
               
                <div class="input-group">
        	        	<input name="filter_dari" type="text" class="form-control" id="dp2" placeholder="Date Added" value="<?php echo @$filter_dari ?>" readonly>
                    	<div class="input-group-addon">
                        	<i class="fa fa-calendar"></i>
                        </div>
                    </div>
              </div></div>
               <div class="col-sm-4 col-xs-12 "> 
        <div class="form-group">
	                <label class="control-label" for="input-price">Sampai</label>
    	            <div class="input-group">
        	        	<input type="text" name="filter_sampai" value="<?php echo @$filter_sampai ?>" placeholder="Date Added" id="dp1" class="form-control" readonly>
                    	<div class="input-group-addon">
                        	<i class="fa fa-calendar"></i>
                        </div>
                    </div>
              </div>
        
              
           
            
              <button type="submit" id="button-filter" class="btn btn-primary pull-right"  name="submit"><i class="fa fa-search"></i> Filter</button>
            </div>
          </div>
        </div>
         </form>
       
        <form action="http://localhost/opencart/upload/admin/index.php?route=catalog/product/delete&amp;token=TvthUB0fpnYKRqAYZYgsYn3RFzeFJBMC" method="post" enctype="multipart/form-data" id="form-product">
        
           
          <div class="table-responsive" align="center">
            <table class="table table-hover " style="margin-top:10px;max-width: 690px">
              <tr>
                <th colspan="3" style="text-align:center;color: #1079ae"><span style="font-size: 18px">LAPORAN LABA (RUGI)</span><br>		
<span style="text-transform: uppercase;color: #911c18"><?php echo date('F',strtotime($filter_dari)) ?>  TAHUN <?php echo date('Y',strtotime($filter_dari)) ?></span><br>		
</th>
              </tr>
              <?php
									
										$query=mysql_query("select * from kategori where kode >=4 and kode < 5");
										while($data=mysql_fetch_array($query)){
										?>
              <tr style="font-weight:bold">
             
                <td colspan="2" style="text-align:left;color: #1079ae"><?php echo $data['klasifikasi'] ?></td>
                <td style="text-align:left;">&nbsp;</td>
               
              </tr>
              <?php
											  
												  $qry=mysql_query("select * from kategori_uang_masuk where  kode_klasifikasi = '".$data['kode']."' order by nomor_akun");
											  
											
											 
										while($row=mysql_fetch_array($qry)){
										?>
              <tr <?php if($row['kode_kategori_uang_masuk']=='1'){ ?> class="listpenjualan" data-toggle="modal"
   data-target="#basicModal"<?php  }else{ ?> class="listcashin" data-toggle="modal"
   data-target="#basicModal3" <?php } ?> >
                <td align="center"><?php echo $row['nomor_akun'] ?></td>
            
                <td style="text-align:left;"><?php echo $row['kategori_uang_masuk'] ?> <span style="display:none" class="kode_kategori"><?php echo $row['kode_kategori_uang_masuk'] ?></span></td>
                <td style="text-align:right;"><?php
											 
											
											
											
											if($row['kode_kategori_uang_masuk']=='1'){
														
													$num=(mysql_fetch_array(mysql_query("select sum(sub_total) as subtotal from penjualan_detail,penjualan where penjualan_detail.no_jual=penjualan.no_jual and tgl_jual between '".$filter_dari."' and '".@$filter_sampai."' ")));
										
													echo number_format($num['subtotal']);
												
												
											}else{
												 
												$num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pemasukan where 
														kode_kategori_uang_masuk = '".@$row['kode_kategori_uang_masuk']."' and tanggal between '".$filter_dari."' and '".@$filter_sampai."' "))); 
												
											echo number_format($num['subtotal']);}
											
										(@$grand_total=$num['subtotal']+$grand_total);
											   @$grand_total2=$num['subtotal']+$grand_total2;
										
											
											    ?></td>
              </tr>
              <?php
									
										}
																		?>
              <tr style="font-weight:bold;">
                <td align="center">&nbsp;</td>
                <td style="text-align:left;color: #1079ae"> Total <?php echo $data['klasifikasi'] ?></td>
                <td style="text-align:right;color: #1079ae"><?php
										   echo number_format(@$grand_total); 	 
											 ?></td>
              </tr>
									<?php 	$grand_total=0;} 
										?>
              <tr style="font-weight:bold;color: #1079ae">
                <td colspan="2"  style="text-align:left;">Total Pendapatan</td>
                <td style="text-align:right;"><?php
											 
											   echo number_format(@$grand_total2);$total_pendapatan=$grand_total2; ?></td>
              </tr>
                 <tr style="font-weight:bold;">
                <td align="center">&nbsp;</td>
                <td style="text-align:center;"></td>
           
                <td></td>
              </tr>
              <?php $grand_total2=0;//cashout ?>
               
               <?php
									
										$query=mysql_query("select * from kategori where   kode =5");
										while($data=mysql_fetch_array($query)){
										?>
              <tr style="font-weight:bold;color: #1079ae" >
             
                <td colspan="2" style="text-align:left;"><?php echo $data['klasifikasi'] ?></td>
                <td style="text-align:left;">&nbsp;</td>
               
              </tr>
              <?php
											  
												  $qry=mysql_query("select * from kategori_uang_keluar where  kode_klasifikasi = '".$data['kode']."' order by nomor_akun");
											  
											
											 
										while($row=mysql_fetch_array($qry)){
										?>
              <tr class="listcashout" data-toggle="modal"
   data-target="#basicModal2">
                <td align="center"><?php echo $row['nomor_akun'] ?></td>
            
                <td style="text-align:left;"><?php echo $row['kategori_uang_keluar'] ?> <span style="display:none" class="kode_kategori"><?php echo $row['kode_kategori_uang_keluar'] ?></span></td>
                <td style="text-align:right;"><?php
											 
									
											
										 $num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and  kategori_uang_keluar.kode_kategori_uang_keluar = '".@$row['kode_kategori_uang_keluar']."'  and tanggal between '".$filter_dari."' and '".@$filter_sampai."' ")));
											
											
											
											echo number_format($num['subtotal']);
											
										(@$grand_total=$num['subtotal']+$grand_total);
											   @$grand_total2=$num['subtotal']+$grand_total2;
										
											
											    ?></td>
              </tr>
              <?php
									
										}
																		?>
              <tr style="font-weight:bold;color: #1079ae">
                <td align="center">&nbsp;</td>
                <td style="text-align:left;">Total <?php echo $data['klasifikasi'] ?></td>
                <td style="text-align:right;"><?php
										   echo number_format(@$grand_total); 	 
											 ?></td>
              </tr>
									<?php 	$grand_total=0;} 
										?>
               <tr style="">
                <td align="center">&nbsp;</td>
                <td style="text-align:left;"></td>
           
                <td style="text-align:right;"></td>
              </tr>
              <tr style="font-weight:bold;color: #911c18">
                <td colspan="2" style="text-align:left;">Laba Kotor</td>
                <td style="text-align:right;"><?php
											 
											   echo number_format(@$total_pendapatan-$grand_total2); ?></td>
              </tr>
                  </tr>
                 <tr style="font-weight:bold;">
                <td align="center">&nbsp;</td>
                <td style="text-align:center;"></td>
           
                <td></td>
              </tr>
              
                  </tr>
              
               
                <?php
									
										$query=mysql_query("select * from kategori where   kode >5");
										while($data=mysql_fetch_array($query)){
										?>
              <tr style="font-weight:bold" >
             
                <td colspan="2" style="text-align:left;color: #1079ae"><?php echo $data['klasifikasi'] ?></td>
                <td style="text-align:left;">&nbsp;</td>
               
              </tr>
              <?php
											  
												  $qry=mysql_query("select * from kategori_uang_keluar where  kode_klasifikasi = '".$data['kode']."' order by nomor_akun");
											  
											
											 
										while($row=mysql_fetch_array($qry)){
										?>
              <tr class="listcashout" data-toggle="modal"
   data-target="#basicModal2">
                <td align="center"><?php echo $row['nomor_akun'] ?></td>
            
                <td style="text-align:left;"><?php echo $row['kategori_uang_keluar'] ?> <span style="display:none" class="kode_kategori"><?php echo $row['kode_kategori_uang_keluar'] ?></span></td>
                <td style="text-align:right;"><?php
											 
									
											
										 $num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and  kategori_uang_keluar.kode_kategori_uang_keluar = '".@$row['kode_kategori_uang_keluar']."'  and tanggal between '".$filter_dari."' and '".@$filter_sampai."' ")));
											
											
											
											echo number_format($num['subtotal']);
											
										(@$grand_total=$num['subtotal']+$grand_total);
											   @$grand_total2=$num['subtotal']+$grand_total2;
										
											
											    ?></td>
              </tr>
              <?php
									
										}
																		?>
              <tr style="font-weight:bold;;color: #1079ae">
                <td align="center">&nbsp;</td>
                <td style="text-align:left;">Total <?php echo $data['klasifikasi'] ?></td>
                <td style="text-align:right;"><?php
										   echo number_format(@$grand_total); 	 
											 ?></td>
              </tr>
									<?php 	$grand_total=0;} 
										?>
              <tr style="font-weight:bold;;color: #1079ae">
                <td align="center">&nbsp;</td>
                <td style="text-align:left;">Total Pengeluaran</td>
           
                <td style="text-align:right;"><?php
											 
											   echo number_format(@$grand_total2); ?></td>
              </tr>
                  </tr>
                 <tr style="font-weight:bold;">
                <td align="center">&nbsp;</td>
                <td style="text-align:center;"></td>
           
                <td></td>
              </tr>
              
                  </tr>
                 <tr style="font-weight:bold;color: #911c18">
                <td colspan="2" align="left">Laba Bersih</td>
                <td style="text-align:right;"><?php
											 
											   echo number_format(@$total_pendapatan-$grand_total2); ?></td>
              </tr>
            </table>
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
	$('#basicModal').modal(options);
$('#basicModal2').modal(options);
$('#basicModal3').modal(options);
$('#listcus').modal(options);
</script>
<script src="js/sub_kat_barang.js" type="text/javascript"></script>  
 <?php include("listpenjualan.php") ?>
 <?php include("listcashout.php") ?> 
 <?php include("listcashin.php") ?>