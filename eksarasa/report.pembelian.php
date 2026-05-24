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
$filter_sampai=date("Y-m-d");
$filter_dari=date("Y-m-d");
	$filter_jenis="";
}
?>

<?php  if(isMobile()){ ?>

<div style="margin: 10px 0 20px;">
	
</div>
<?Php }else{ ?>

  <section class="content-header">
	<h1>
		Pembelian<small></small>
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
        <h3 class="panel-title" style="max-width: 250px;display: inline-block"><i class="fa fa-list"></i> Order List </h3> <button class="btn btn-default pull-right" id="myelement" ><i class="fa fa-search"></i></button>
      </div>
      <div class="panel-body">
      <form action="?page=<?Php echo $page ?>" method="post">
        <div class="well" id="another-element" style="<?php if(isset($_POST['submit'])) {echo "display:block";}else{ echo "display:none"; }  ?>">
          <div class="row">
          
            <div class="col-sm-4 col-xs-6 ">
              <div class="form-group">
                <label class="control-label" for="input-name">Dari</label>
               
                <div class="input-group">
        	        	<input name="filter_dari" type="text" class="form-control" id="dp2" placeholder="Date Added" value="<?php echo @$filter_dari ?>" readonly>
                    	<div class="input-group-addon">
                        	<i class="fa fa-calendar"></i>
                        </div>
                    </div>
              </div>
          	<div class="form-group">
                <label class="control-label" for="input-model">Kategori Barang</label>
             
    		         	<select name="filter_kategori" class="form-control" id="cmbKategori">
              				<option value="">Semua</option>
              			<?php
					
							$qry_kategory=mysql_query("select *  from kategori_barang");
							while($kategori=mysql_fetch_array($qry_kategory)){
						?>
              			<option value="<?php echo $kategori['kode_kategori_barang'] ?>" <?php if($kategori['kode_kategori_barang']==@$filter_kategori) echo "selected" ?>><?php echo $kategori['kategori_barang'] ?></option><?php } ?>
              	</select>
              </div>
            </div>
            <div class="col-sm-4 col-xs-6 ">
              <div class="form-group">
	                <label class="control-label" for="input-price">Sampai</label>
    	            <div class="input-group">
        	        	<input name="filter_sampai" type="text" class="form-control" id="dp1" placeholder="Date Added" value="<?php echo @$filter_sampai ?>" readonly>
                    	<div class="input-group-addon">
                        	<i class="fa fa-calendar"></i>
                        </div>
                    </div>
              </div>
              
               <div class="form-group">
                <label class="control-label" for="input-model">Sub Kategori Barang</label>
             
    		         	<select name="filter_sub_kategori" class="form-control" id="subKategori">
              				<option value="">Semua</option>
              			
					<?php
							if(!empty($filter_kategori)){
							$qry_kategory=mysql_query("select *  from  sub_kategori_barang where kategori='".$filter_kategori."'");
							while($kategori=mysql_fetch_array($qry_kategory)){
						?>
              			<option value="<?php echo $kategori['id'] ?>" <?php if($kategori['id'] == @$filter_sub_kategori) echo "selected" ?>><?php echo $kategori['sub_kategori'] ?></option><?php } } ?>
              	</select>
              </div>
            </div>
            <div class="col-sm-4 col-xs-12">
             <div class="form-group">
                <label class="control-label" for="input-name">Nama Vendor</label>
                <input type="text" name="filter_nama" value="<?php echo @$filter_nama ?>" placeholder="Nama Vendor" id="input-name" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
              </div>
              	  <div class="form-group">
                <label class="control-label" for="input-model">Gudang</label>
             
    		         	<select name="filter_gudang" class="form-control" >
              				<option value="">Semua</option>
              			
					<?php
							
							$qry_kategory=mysql_query("select *  from  gudang");
							while($kategori=mysql_fetch_array($qry_kategory)){
						?>
              			<option value="<?php echo $kategori['0'] ?>" <?php if($kategori['0'] == @$filter_gudang) echo "selected" ?>><?php echo $kategori['1'] ?></option><?php }  ?>
              	</select>
              </div>
              <button type="submit" id="button-filter" class="btn btn-primary pull-right"  name="submit" style="margin-left: 10px"><i class="fa fa-search"></i> Filter</button>  <a href="print.report.orders3.php?filter_dari=<?php echo @$filter_dari ?>&filter_sampai=<?php echo @$filter_sampai ?>&filter_gudang=<?php echo @$filter_gudang ?>&filter_kategori=<?php echo @$filter_kategori ?>&filter_sub_kategori=<?php echo @$filter_sub_kategori ?>&filter_nama=<?php echo @$filter_nama ?>" target="_blank" data-toggle="tooltip" title="" class="btn btn-default pull-right" data-original-title="Print" style=""><i class="fa fa-print"></i></a>  
            </div>
          </div>
        </div>
         </form>
         <div class="row">
          <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                          <?php 
													$num=(mysql_num_rows(mysql_query("select tgl_beli from pembelian where tgl_beli between '".@$filter_dari."' and '".@$filter_sampai."' and nama_vendor like '%".@$filter_nama."%'")));
													echo number_format($num);
													?>
                                    </h3>
                                    <p>
                                        Total Pembelian
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <a href="?page=orders" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                           <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                          <?php 
													$num_hari=(mysql_num_rows(mysql_query("select tgl_beli from pembelian_detail,pembelian where pembelian_detail.no_beli=pembelian.no_beli and tgl_beli between '".@$filter_dari."' and '".@$filter_sampai."' and nama_vendor like '%".@$filter_nama."%' and kd_gudang like '%".@$filter_gudang."%' group by tgl_beli")));
													echo number_format($num_hari);
													?>
                                    </h3>
                                    <p>
                                        Total Hari
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <a href="?page=orders" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-4 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                          <?php 
										
										
									if(!empty($filter_sub_kategori)){
										
									
											
											$num=(mysql_fetch_array(mysql_query("select sum(sub_total) as total  from pembelian_detail,pembelian,barang where pembelian_detail.no_beli=pembelian.no_beli and pembelian_detail.kode_barang=barang.kode_barang  and tgl_beli between '".@$filter_dari."' and '".@$filter_sampai."' and nama_vendor like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori='".@$filter_sub_kategori."' and kd_gudang like '%".@$filter_gudang."%' ")));
											
													echo number_format($num['total']);
										 
									}
									elseif(!empty($filter_kategori)){
									
										
											$num=(mysql_fetch_array(mysql_query("select sum(sub_total) as total from pembelian_detail,pembelian,barang where  pembelian_detail.no_beli=pembelian.no_beli and pembelian_detail.kode_barang=barang.kode_barang and tgl_beli between '".@$filter_dari."' and '".@$filter_sampai."' and nama_vendor like '%".@$filter_nama."%'  and barang.kode_kategori= '".@$filter_kategori."' and kd_gudang like '%".@$filter_gudang."%' ")));
													echo number_format($num['total']);
										
									}else{
											$num=(mysql_fetch_array(mysql_query("select sum(sub_total) as total from pembelian_detail,pembelian where pembelian_detail.no_beli=pembelian.no_beli and tgl_beli between '".@$filter_dari."' and '".@$filter_sampai."'  and nama_vendor like '%".@$filter_nama."%' and kd_gudang like '%".@$filter_gudang."%' ")));
										
											echo number_format($num['total']);
									}
													?>
                                    </h3>
                                    <p>
                                        Total Pembelian
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <a href="	" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                       
                         
                        
                </div>        
        <form action="http://localhost/opencart/upload/admin/index.php?route=catalog/product/delete&amp;token=TvthUB0fpnYKRqAYZYgsYn3RFzeFJBMC" method="post" enctype="multipart/form-data" id="form-product">
        
           
           <div class="table-responsive">
            <table class="table table-hover " style="margin-top:10px;">
              <tr>
                <th style="text-align:center;">No</th>
                
                <th style="text-align:center;">Nama Barang</th>
                <th class="text-right">Harga Beli</th>
         
                <th class="text-center">Jumlah</th>
                <th class="text-center">Satuan</th>
                <th class="text-right">Total Beli</th>
             
              </tr>
              <?php
									if(!empty($filter_sub_kategori)){
										
										$query=mysql_query("select * from pembelian_detail,pembelian,barang where pembelian_detail.no_beli=pembelian.no_beli and pembelian_detail.kode_barang=barang.kode_barang and tgl_beli between '".@$filter_dari."' and '".@$filter_sampai."' and nama_vendor like '%".@$filter_nama."%'  and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."' and kd_gudang like '%".@$filter_gudang."%' group by pembelian.no_beli  order by tgl_beli");
										 
									}
									elseif(!empty($filter_kategori)){
										$query=mysql_query("select * from pembelian_detail,pembelian,barang where pembelian_detail.no_beli=pembelian.no_beli and pembelian_detail.kode_barang=barang.kode_barang and tgl_beli between '".@$filter_dari."' and '".@$filter_sampai."' and nama_vendor like '%".@$filter_nama."%'  and barang.kode_kategori= '".@$filter_kategori."' and kd_gudang like '%".@$filter_gudang."%' group by pembelian.no_beli order by tgl_beli ");
										
									}else{
										$query=mysql_query("select * from pembelian_detail,pembelian where pembelian_detail.no_beli=pembelian.no_beli and tgl_beli between '".@$filter_dari."' and '".@$filter_sampai."' and nama_vendor like '%".@$filter_nama."%' and kd_gudang like '%".@$filter_gudang."%'  group by pembelian.no_beli order by tgl_beli");}
										while($data=mysql_fetch_array($query)){
										?>
              <tr style="font-weight:bold">
             
                <td colspan="6" style="text-align:left;">Tanggal : <?php echo date("d-m-Y",strtotime($data['tgl_beli'])) ?> - <?php echo $data['no_beli'] ?> - <?php echo $data['nama_vendor'] ?></td>
               
              </tr>
              <?php
											if(!empty($filter_sub_kategori)){
												
												 $qry=mysql_query("select *,pembelian_detail.harga_beli as  harga_beli  from pembelian_detail,pembelian,barang where pembelian_detail.no_beli=pembelian.no_beli and pembelian_detail.kode_barang=barang.kode_barang and pembelian_detail.no_beli='".$data['no_beli']."'  and nama_vendor like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."'");
											}
											  elseif(!empty($filter_kategori)){
											  
												  $qry=mysql_query("select *,pembelian_detail.harga_beli as  harga_beli  from pembelian_detail,pembelian,barang where pembelian_detail.no_beli=pembelian.no_beli and pembelian_detail.kode_barang=barang.kode_barang and pembelian_detail.no_beli='".$data['no_beli']."'  and nama_vendor like '%".@$filter_nama."%'  and barang.kode_kategori= '".@$filter_kategori."'");
											  
											  }else{
												$qry=mysql_query("select *,pembelian_detail.harga_beli as  harga_beli  from pembelian_detail,pembelian,barang where pembelian_detail.no_beli=pembelian.no_beli and pembelian_detail.kode_barang=barang.kode_barang and pembelian_detail.no_beli='".$data['no_beli']."'  and nama_vendor like '%".@$filter_nama."%' order by tgl_beli");
											  }
										while($row=mysql_fetch_array($qry)){
										?>
              <tr>
                <td align="center"></td>
            
                <td style="text-align:center;"><?php echo $row['nama_barang'] ?></td>
                <td class="text-right"><?php
											 
											   echo number_format($row['harga_beli']); ?></td>
           
                <td class="text-center"><?php
											 
											 
											 	
											echo 	$stok=$row['jumlah']; 
											   @$stok2=$stok+$stok2;
					@$stok3=$stok+$stok3;?></td>
                <td class="text-center"><?php  echo $row['satuan']; ?></td>
                <td class="text-right"><?php 
													  echo number_format($total_beli=$row['harga_beli']*$row['jumlah']);
													  @$total_beli2=$total_beli+$total_beli2;
													  	  @$total_beli3=$total_beli+$total_beli3;
														  
													number_format($total_jual=$row['harga_jual']*$row['jumlah']);
											   @$total_jual2=$total_jual+$total_jual2;
											  
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
                <td style="text-align:center;"><?php
											 
											   echo number_format(@$stok3); ?></td>
                <td>&nbsp;</td>
        
                <td class="text-right"><?php
										   echo number_format(@$total_beli3); 	 
											 ?></td>
          
              </tr>
									<?php 	$grand_total3=0;$total_jual3=0;$stok3=0;$total_beli3=0;} 
										?>
              <tr style="font-weight:bold">
                <td align="center">&nbsp;</td>
                <td style="text-align:center;">Total</td>
           
                <td>&nbsp;</td>
                <td class="text-center"><?php
											 
											   echo number_format(@$stok2); ?></td>
                <td>&nbsp;</td>
                <td class="text-right"><?php
											 
											   echo number_format(@$total_beli2); ?></td>
          
              </tr>
            </table><?php  ?>
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