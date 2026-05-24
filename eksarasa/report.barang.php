<?php
if(isset($_POST['filter_dari'])){
$filter_dari=$_POST['filter_dari'];
$filter_sampai=$_POST['filter_sampai'];
}else{
$filter_sampai=date("Y-m-d");
$filter_dari=date("Y-m-d");
}
$no=1;
$qry=mysql_query("select * from kategori_barang");
	while($row=mysql_fetch_array($qry)){
		
	$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and kategori_barang.kode_kategori_barang like '%".@$row['kode_kategori_barang']."%' order by kategori_barang.kode_kategori_barang,nama_barang asc ");
		while($row=mysql_fetch_array($qry)){
					$qty_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from pembelian_detail,pembelian where pembelian_detail.no_beli=pembelian.no_beli and kode_barang='".$row['kode_barang']."'"));
					$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail,penjualan where penjualan.no_jual=penjualan_detail.no_jual and kode_barang='".$row['kode_barang']."'"));
					$stok_keluar=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_keluar where kode_barang='".$row['kode_barang']."'"));
					$stok_masuk=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_masuk where kode_barang='".$row['kode_barang']."'"));
					$stok=($qty_beli[0]+$row['stok']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]; 
					@$stok2=$stok+$stok2;
			
				 ($total_beli=$row['harga_beli']*$stok);
				 @$total_beli2=$total_beli+$total_beli2;
			
			
		}
		$katnya.$no=$row['kategori_barang'];
		$total_beli2.$no=$total_beli2;
		
		$no++;
		$total_beli2=0;
		@$stok2=0;
}
?>

<script src="js/chart/highcharts.js"></script>
<script src="js/chart/highcharts-3d.js"></script>
<script src="js/chart/exporting.js"></script>
<div class="page-header">
    <div class="container-fluid">
     
       
      <h1 style="font-size: 24px;
    color: #c7c7c7;">Report Barang</h1>
     
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
        <h3 class="panel-title"><i class="fa fa-list"></i>  List</h3>
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
       
		<div class="row">
       <div class="col-sm-12">
       
      
       
       
       
       
       <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>
											<th style="text-align:center;">Barang</th>
                                         
                                 
                                          <th align="center"  style="text-align:center;" >Satuan</th>
                                                                   <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php } ?>
                                            <th  style="text-align:right;" >Harga Jual</th>
                                           
                                            <th style="text-align:center;" >Qty</th>                        <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                             <?php } ?>
                                                                                        <th align="right" style="text-align:right;" >Total Jual</th>      
                                                                                        <?php if ($_SESSION['loglevel']=="Administrator"){ ?>  
                                            <?php } ?>
                                        </tr>
										<?php
									
										$i=1;
												  
											 
											$qry=mysql_query("select *,sum(penjualan_detail.jumlah) as jum,sum(penjualan_detail.harga_jual) as harga_jual,sum(penjualan_detail.harga_beli) as harga_beli,sum(penjualan_detail.sub_total) as sub_total from penjualan_detail,penjualan,barang where   barang.kode_barang=penjualan_detail.kode_barang and penjualan_detail.no_jual=penjualan.no_jual and tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' group by penjualan_detail.kode_barang order by jum desc");
										
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
											 <td style="text-align:left;">
                                         									<?php
												if ($row['gambar']==""){
													$photo="img/no-image.jpg";
												}else{
													$photo="photo_barang/$row[gambar]";
												}
												?>
											   <img src="<?php echo $photo;?>" style="width:100px;border:solid 4px #fff;box-shadow:0px 0px 2px #999;float:left;margin-right: 10px"> 
           									   <div style="">
                                          									- <?php 
											
											
																			$sub_kategori=mysql_fetch_array(mysql_query("select * from kategori_barang,sub_kategori_barang where kategori_barang.kode_kategori_barang=sub_kategori_barang.kategori and sub_kategori_barang.id='".$row['kode_sub_kategori']."'"));
											
																			echo $sub_kategori['kategori_barang'] ?> <br>
                                          									-- <?php echo $sub_kategori['sub_kategori'] ?> <br>
                                          									<a href="?page=histori.transaksi.penjualan&kode_barang=<?php echo $row['kode_barang'] ?>" style="font-weight: bold"><?php echo $row['nama_barang']  ?></a></div>
                                           </td>
                                       
                                          <td align="center"><?php  echo $row['satuan']; ?></td>
                                                                   <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php } ?>
                                            <td align="right"><?php 
													  echo number_format($row['sub_total']/$row['jum']); ?></td>
                                                      <td style="text-align:center;"><?php
											 
											 
										
												
											echo 	$stok=$row['jum']; 
											   @$stok2=$stok+$stok2; ?></td>
                                                                      <?php if ($_SESSION['loglevel']=="Administrator"){ ?> <?php } ?>
                                                       <td align="right"><?php
											 
											   echo number_format($total_jual=$row['sub_total']);
											   @$total_jual2=$total_jual+$total_jual2;
											
											
											    ?></td>
                                             <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php } ?>
                                             <?php if ($_SESSION['loglevel']=="Administrator"){ ?>   
                                            <?php }?>
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                         <tr style="font-weight:bold">
                                            <td align="center">&nbsp;</td>
											 <td style="text-align:center;">Total</td>
                                      
                                              <td>&nbsp;</td>
                                           <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php }?>
                                            <td>&nbsp;</td>
                                                     <td style="text-align:center;"><?php
											 
											   echo number_format($stok2); ?></td>
                                                                          <?php if ($_SESSION['loglevel']=="Administrator"){ ?> <?php } ?>
                                                    <td style="text-align:right;"><?php
											 
											   echo number_format(@$total_jual2); ?></td>
                                               <?php if ($_SESSION['loglevel']=="Administrator"){ ?>  
                                            <?php }?>
                                        </tr>
                                    </table>
       
       
		</div></div>
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
