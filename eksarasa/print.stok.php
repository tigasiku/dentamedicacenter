<?php
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
     <link rel="shortcut icon" href='img/icon.png'>  <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
         <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link href="css/bs-callout.css" rel="stylesheet" type="text/css" />
<section class="content invoice">
			
           <div class="row">
                  <div class="col-xs-12"><img src="img/logo2.png" style="float: right;height: 50px;margin-top: -12px">
                            <h2 class="page-header" style="font-size:20px">
                                Daftar Stok Barang <?PHP echo $_GET['kd_gudang'] ?>
                            </h2>                            
                  </div><!-- /.col -->
            </div>

		  <div class="row invoice-info">
                        <div class="col-xs-12">
                            <div class=" ">
                                
                                <div class="" style="padding-top:0px;">
									
                                  
                                   <?php  if(isMobile()){ ?>
                                  <table class="table table-hover " style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:left;">Barang</th>
                                         
                                        
                                            <th style="text-align:center;" >Stok</th>                      
                                        </tr>
										<?php
										$limit = 1000;
										if(isset($_GET['hal'])){
											$hal = $_GET['hal'];
										}
										else{
											$hal = 1;
										}

										$offset = ($hal - 1) * $limit;
										$i=1;
											if(!empty($filter_sub_kategori)){
												  
												  $qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."' and status_barang='Y' 
													order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id ,nama_barang asc LIMIT $offset, $limit");
											  }
											  elseif(!empty($filter_kategori)){
												  	$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and status_barang='Y' 
													order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id,nama_barang asc LIMIT $offset, $limit");
												    
												  
											  }else{
												  
											 
											$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and status_barang='Y' 
											 order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id ,nama_barang asc LIMIT $offset, $limit");}
										
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
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
                                         									- <?php echo $row['kategori_barang'] ?> <br>
                                          									-- <?php echo $row['sub_kategori'] ?> <br>
                                          									<a  style="font-weight: bold"><?php echo $row['nama_barang']  ?></a>
                                          									<br><b style="color: rgb(255, 87, 34);">Rp 
                                          									<?php 
												
													  $qryharga=mysql_query("select * from harga_tiap_gudang where kode_barang ='".$row['kode_barang']."' and kd_gudang ='".$_GET['kd_gudang']."'");
											$cekharga=mysql_num_rows($qryharga);
											$harga=mysql_fetch_array($qryharga);
											if($cekharga > 0){
											echo	number_format($harga_jual=$harga['harga_jual']);
											}else{
											echo number_format($harga_jual=$row['harga_jual']);}
													   ?></b>
                                       									   </div>
                                           </td>
                                       
                                              <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php } ?>
                                            <td style="text-align:center;"><?php
											 
											 
											 $num_masuk=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='masuk' and kode_barang='".$row['kode_barang']."' and kd_gudang='".$_GET['kd_gudang']."'")));
												$num_keluar=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='keluar'  and kode_barang='".$row['kode_barang']."' and kd_gudang='".$_GET['kd_gudang']."'")));
											 
											 	$qty_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from pembelian_detail,pembelian where pembelian_detail.no_beli=pembelian.no_beli and kode_barang='".$row['kode_barang']."' and kd_gudang='".$_GET['kd_gudang']."' "));
												$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail,penjualan where penjualan.no_jual=penjualan_detail.no_jual and kode_barang='".$row['kode_barang']."' and kd_gudang='".$_GET['kd_gudang']."'"));
											$stok_keluar=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_keluar where kode_barang='".$row['kode_barang']."' and kd_gudang='".$_GET['kd_gudang']."'"));
											
											$stok_masuk=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_masuk where kode_barang='".$row['kode_barang']."' and kd_gudang='".$_GET['kd_gudang']."'"));
											
												if($_GET['stok_awal']=="Y"){	
												echo 	$stok=($qty_beli[0]+$row['stok']+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];}else{
													
												echo 	$stok=($qty_beli[0]+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];	
												} 
											   @$stok2=$stok+$stok2; 
												
													number_format($total_beli=$row['harga_beli']*$stok);
													  @$total_beli2=$total_beli+$total_beli2;
											
											number_format($total_jual=$row['harga_jual']*$stok);
													  @$total_jual2=$total_jual+$total_jual2;
												?></td>
                                                                      <?php if ($_SESSION['loglevel']=="Administrator"){ ?> <?php } ?>
                                             <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php } ?>
                                             <?php if ($_SESSION['loglevel']=="Administrator"){ ?>   

                                          <?php }?>
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                    </table>
                                   <?php }else{ ?>
                            
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>
											<th style="text-align:let;">Barang</th>
                                         
                                 
                                          <th style="text-align: center">Satuan</th>
                                                                   <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php } ?>
                                            <th style="text-align:  right">Harga Jual</th>
                                             <th style="text-align:  right">Stok</th>
                                            <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                             <?php } ?>
                                                                                        <?php if ($_SESSION['loglevel']=="Administrator"){ ?>  
                                            <?php } ?>
                                        </tr>
										<?php
										$limit = 1000;
										if(isset($_GET['hal'])){
											$hal = $_GET['hal'];
										}
										else{
											$hal = 1;
										}

										$offset = ($hal - 1) * $limit;
										$i=1;
											if(!empty($filter_sub_kategori)){
												  
												  $qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."' and status_barang='Y' 
													order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id ,nama_barang asc LIMIT $offset, $limit");
											  }
											  elseif(!empty($filter_kategori)){
												  	$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and status_barang='Y' 
													order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id,nama_barang asc LIMIT $offset, $limit");
												    
												  
											  }else{
												  
											 
											$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%'  and status_barang='Y' 
											 order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id ,nama_barang asc LIMIT $offset, $limit");}
										
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
                                         									- <?php echo $row['kategori_barang'] ?> <br>
                                          									-- <?php echo $row['sub_kategori'] ?> <br>
                                          									<a  style="font-weight: bold"><?php echo $row['nama_barang']  ?></a></div>
                                           </td>
                                       
                                          <td style="text-align: center"><?php  echo $row['satuan']; ?></td>
                                                                   <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php } ?>
                                            <td style="text-align: right"><?php 
													$qryharga=mysql_query("select * from harga_tiap_gudang where kode_barang ='".$row['kode_barang']."' and kd_gudang ='".$_GET['kd_gudang']."'");
											$cekharga=mysql_num_rows($qryharga);
											$harga=mysql_fetch_array($qryharga);
											if($cekharga > 0){
											echo	number_format($harga_jual=$harga['harga_jual']);
											}else{
											echo number_format($harga_jual=$row['harga_jual']);} ?></td>
                                                 <td style="text-align:center;"><?php
											 
											 
											 	
											
											$num_masuk=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='masuk' and kode_barang='".$row['kode_barang']."' and kd_gudang='".$_GET['kd_gudang']."'")));
												$num_keluar=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='keluar'  and kode_barang='".$row['kode_barang']."' and kd_gudang='".$_GET['kd_gudang']."'")));
											 
											 	$qty_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from pembelian_detail,pembelian where pembelian_detail.no_beli=pembelian.no_beli and kode_barang='".$row['kode_barang']."' and kd_gudang='".$_GET['kd_gudang']."' "));
												$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail,penjualan where penjualan.no_jual=penjualan_detail.no_jual and kode_barang='".$row['kode_barang']."' and kd_gudang='".$_GET['kd_gudang']."'"));
											$stok_keluar=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_keluar where kode_barang='".$row['kode_barang']."' and kd_gudang='".$_GET['kd_gudang']."'"));
											
											$stok_masuk=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_masuk where kode_barang='".$row['kode_barang']."' and kd_gudang='".$_GET['kd_gudang']."'"));
											
												if($_GET['stok_awal']=="Y"){	
												echo 	$stok=($qty_beli[0]+$row['stok']+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];}else{
													
												echo 	$stok=($qty_beli[0]+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];	
												}  
											
											
											
										
											   @$stok2=$stok+$stok2; 
												
													number_format($total_beli=$row['harga_beli']*$stok);
													  @$total_beli2=$total_beli+$total_beli2;
											
											number_format($total_jual=$row['harga_jual']*$stok);
													  @$total_jual2=$total_jual+$total_jual2;
												?></td>       
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                         <tr style="font-weight:bold">
                                            <td align="center">&nbsp;</td>
											 <td style="text-align:center;">&nbsp;</td>
                                      
                                              <td>&nbsp;</td>
                                           <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php }?>
                                            <td>&nbsp;</td>
                                                     <?php if ($_SESSION['loglevel']=="Administrator"){ ?> <?php } ?>
                                               <?php if ($_SESSION['loglevel']=="Administrator"){ ?>  
                                            <?php }?>
                                        </tr>
                                    </table>
                                </div><!-- /.box-body --><?php } ?>
							
                               
                            </div><!-- /.box -->
                        </div>
                    </div>
</section><!-- /.content -->
<?php

?><script>
$( ".hapus" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin Untuk Menghapus Data?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script>
<script src="js/sub_kat_barang.js" type="text/javascript"></script> <script type="text/javascript">
    document.title = "Daftar Stok Barang <?PHP echo $_GET['kd_gudang'] ?>";
    window.print();
</script>