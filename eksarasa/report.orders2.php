<?php
if(isset($_POST['filter_dari'])){
$filter_dari=$_POST['filter_dari'];
$filter_sampai=$_POST['filter_sampai'];

}else{
$filter_sampai=date("Y-m-d");
$filter_dari=date("Y-m-d");
	$filter_jenis="";
}
?>


<div class="page-header">
    <div class="container-fluid">
     
       
      <h1>Orders</h1>
     
    </div>
  </div>
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
<div class="container-fluid" style="padding-right:5px;padding-left:5px">
            <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Order List</h3>
      </div>
      <div class="panel-body">
      <form action="?page=<?Php echo $page ?>" method="post">
        <div class="well">
          <div class="row">
          
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-name">Dari</label>
               
                <div class="input-group">
        	        	<input type="text" name="filter_dari" value="<?php echo @$filter_dari ?>" placeholder="Date Added" id="dp2" class="form-control">
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
            <div class="col-sm-4">
              <div class="form-group">
	                <label class="control-label" for="input-price">Sampai</label>
    	            <div class="input-group">
        	        	<input type="text" name="filter_sampai" value="<?php echo @$filter_sampai ?>" placeholder="Date Added" id="dp1" class="form-control">
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
            <div class="col-sm-4">
             <div class="form-group">
                <label class="control-label" for="input-name">Customer</label>
                <input type="text" name="filter_nama" value="<?php echo @$filter_nama ?>" placeholder="Customer" id="input-name" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
              </div>
              	
              <button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
            </div>
          </div>
        </div>
         </form>
          <div class="col-lg-4 col-xs-4">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                          <?php 
													$num=(mysql_num_rows(mysql_query("select tgl_jual from penjualan where tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' and customer like '%".@$filter_nama."%'")));
													echo number_format($num);
													?>
                                    </h3>
                                    <p>
                                        Total Order
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
                           <div class="col-lg-4 col-xs-4">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                          <?php 
													$num_hari=(mysql_num_rows(mysql_query("select tgl_jual from penjualan where tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' and customer like '%".@$filter_nama."%' group by tgl_jual")));
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
                        <div class="col-lg-4 col-xs-4">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                          <?php 
										
										
									if(!empty($filter_sub_kategori)){
										
									
											
											$num=(mysql_fetch_array(mysql_query("select sum(sub_total) as total  from penjualan_detail,penjualan,barang where penjualan_detail.no_jual=penjualan.no_jual and penjualan_detail.kode_barang=barang.kode_barang  and tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' and customer like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori='".@$filter_sub_kategori."'")));
											
													echo number_format($num['total']);
										 
									}
									elseif(!empty($filter_kategori)){
									
										
											$num=(mysql_fetch_array(mysql_query("select sum(sub_total) as total from penjualan_detail,penjualan,barang where  penjualan_detail.no_jual=penjualan.no_jual and penjualan_detail.kode_barang=barang.kode_barang and tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' and customer like '%".@$filter_nama."%'  and barang.kode_kategori= '".@$filter_kategori."' ")));
													echo number_format($num['total']);
										
									}else{
											$num=(mysql_fetch_array(mysql_query("select sum(total) as total from penjualan where tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."'  and customer like '%".@$filter_nama."%' ")));
											echo number_format($num['total']);
									}
													?>
                                    </h3>
                                    <p>
                                        Total Sales
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <a href="?page=orders" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                       
        <form action="http://localhost/opencart/upload/admin/index.php?route=catalog/product/delete&amp;token=TvthUB0fpnYKRqAYZYgsYn3RFzeFJBMC" method="post" enctype="multipart/form-data" id="form-product">
          <div class="table-responsive">
            <table class="table table-hover " style="margin-top:10px;">
              <tr>
                <th style="text-align:center;">No</th>
                
                <th style="text-align:center;">Nama Barang</th>
                <th >Harga Beli</th>
                <th >Harga Jual</th>
                <th >Jumlah</th>
                <th >Satuan</th>
               
                <th >Total Jual</th>
              
              </tr>
              <?php
									if(!empty($filter_sub_kategori)){
										
										$query=mysql_query("select * from penjualan_detail,penjualan,barang where penjualan_detail.no_jual=penjualan.no_jual and penjualan_detail.kode_barang=barang.kode_barang and tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' and customer like '%".@$filter_nama."%'  and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."' group by penjualan.no_jual  order by tgl_jual");
										 
									}
									elseif(!empty($filter_kategori)){
										$query=mysql_query("select * from penjualan_detail,penjualan,barang where penjualan_detail.no_jual=penjualan.no_jual and penjualan_detail.kode_barang=barang.kode_barang and tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' and customer like '%".@$filter_nama."%'  and barang.kode_kategori= '".@$filter_kategori."' group by penjualan.no_jual order by tgl_jual ");
										
									}else{
										$query=mysql_query("select * from penjualan where tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' and customer like '%".@$filter_nama."%' order by tgl_jual");}
										while($data=mysql_fetch_array($query)){
										?>
              <tr style="font-weight:bold">
             
                <td colspan="9" style="text-align:left;">Tanggal : <?php echo date("d-m-Y",strtotime($data['tgl_jual'])) ?> - <?php echo $data['no_jual'] ?> - <?php echo $data['customer'] ?></td>
               
              </tr>
              <?php
											if(!empty($filter_sub_kategori)){
												
												 $qry=mysql_query("select *,penjualan_detail.harga_jual as  harga_jual,penjualan_detail.harga_beli as  harga_beli  from penjualan_detail,penjualan,barang where penjualan_detail.no_jual=penjualan.no_jual and penjualan_detail.kode_barang=barang.kode_barang and penjualan_detail.no_jual='".$data['no_jual']."'  and customer like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."'");
											}
											  elseif(!empty($filter_kategori)){
											  
												  $qry=mysql_query("select *,penjualan_detail.harga_jual as  harga_jual,penjualan_detail.harga_beli as  harga_beli  from penjualan_detail,penjualan,barang where penjualan_detail.no_jual=penjualan.no_jual and penjualan_detail.kode_barang=barang.kode_barang and penjualan_detail.no_jual='".$data['no_jual']."'  and customer like '%".@$filter_nama."%'  and barang.kode_kategori= '".@$filter_kategori."'");
											  
											  }else{
												$qry=mysql_query("select *,penjualan_detail.harga_jual as  harga_jual,penjualan_detail.harga_beli as  harga_beli  from penjualan_detail,penjualan,barang where penjualan_detail.no_jual=penjualan.no_jual and penjualan_detail.kode_barang=barang.kode_barang and penjualan_detail.no_jual='".$data['no_jual']."'  and customer like '%".@$filter_nama."%' ");
											  }
										while($row=mysql_fetch_array($qry)){
										?>
              <tr>
                <td align="center"></td>
            
                <td style="text-align:center;"><?php echo $row['nama_barang'] ?></td>
                <td><?php
											 
											   echo number_format($row['harga_beli']); ?></td>
                <td><?php 
													  echo number_format($row['harga_jual']); ?></td>
                <td><?php
											 
											 
											 	
											echo 	$stok=$row['jumlah']; 
											   @$stok2=$stok+$stok2;
					@$stok3=$stok+$stok3;?></td>
                <td><?php  echo $row['satuan']; ?></td>
                
                <td><?php
											 
											   echo number_format($total_jual=$row['harga_jual']*$row['jumlah']);
											   @$total_jual2=$total_jual+$total_jual2;
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
                <td>&nbsp;</td>
                <td><?php
											 
											   echo number_format(@$stok2); ?></td>
                <td>&nbsp;</td>
             
                <td><?php
											 
											   echo number_format(@$total_jual2); ?></td>
           
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
</script>
<script src="js/sub_kat_barang.js" type="text/javascript"></script> 