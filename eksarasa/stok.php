<?php

$limit = 100;
if(isset($_GET['hal'])){
											$hal = $_GET['hal'];
										}
										else{
											$hal = 1;
										}

										$offset = ($hal - 1) * $limit;
										$i=1;
?><script src="js/chart/highcharts.js"></script>
<script src="js/chart/highcharts-3d.js"></script>
<script src="js/chart/exporting.js"></script>
   <link href='css/table-fixed-header.css' rel='stylesheet' />
<section class="content-header">
<?php if($_SESSION["loglevel_graha3"]=="Administrator") { ?>	 <div class="pull-right" style="padding-right:5px"><a href="?page=mutasi.stok" data-toggle="tooltip" title="" class="btn btn-warning" data-original-title="Add New"><i class="fa fa-plus"></i> Mutasi Stok</a>
        
      </div><?php } ?>
	<h1>
		Stok<small></small>
    </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                          <div class="panel panel-default">
      <div class="panel-heading">
      <h3 class="panel-title" style="max-width: 250px;display: inline-block"><i class="fa fa-list"></i> List </h3> <button class="btn btn-default pull-right" id="myelement" ><i class="fa fa-search"></i></button>
      </div>
      <div class="panel-body">
                                <form action="?page=<?Php echo $page ?>" method="post">
        <div class="well" id="another-element" style="<?php if(isset($_POST['submit'])) {echo "display:block";}else{ echo "display:none"; }  ?>">
          <div class="row">
        
            <div class="col-sm-4">
              
            
              <div class="form-group">
                <label class="control-label" for="input-model">Nama Barang</label>
                <input type="text" name="filter_nama" value="<?php echo @$filter_nama ?>" placeholder="Barang" id="input-model" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
              </div>
            </div>
           
            <div class="col-sm-4">
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
              
              <button type="submit" id="button-filter" class="btn btn-primary pull-right" name="submit"><i class="fa fa-search"></i> Filter</button>
            </div>
          </div>
        </div>
         </form>
                                <div class="box-body" style="padding-top:0px;">
									
                                  <ul class="nav nav-tabs">
                                   	<?php
									  		$qry_gudang=mysql_query("select * from gudang order by sort_by");
											while($row_gudang=mysql_fetch_array($qry_gudang)){
									  ?>
       	  						 <li class="<?php echo $row_gudang['2'] ?>"><a href="#<?php echo $row_gudang['0'] ?>" data-toggle="tab"><?php echo $row_gudang['1'] ?></a></li>
       								<?php } ?>
         
          </ul>
                                  
                                  <div class="tab-content" style="background-color: #fff !important">
                                   <?php
									  		$qry_gudang=mysql_query("select * from gudang order by sort_by");
											while($row_gudang=mysql_fetch_array($qry_gudang)){
									  ?>
                                   
                                       <div class="tab-pane <?php echo $row_gudang['2'] ?>" id="<?php echo $row_gudang['0'] ?>">    <a href="print.stok.php?kd_gudang=<?php echo $row_gudang['0'] ?>&filter_nama=<?php echo @$filter_nama ?>&filter_kategori=<?php echo @$filter_kategori ?>&filter_sub_kategori=<?php echo @$filter_sub_kategori ?>&stok_awal=<?php echo @$row_gudang['stok_awal'] ?>" class="btn btn-default pull-right"  data-original-title="Print" target="_blank"><i class="fa fa-print"></i></a>
                                         <script type="text/javascript">
														var chart1; // globally available
													$(document).ready(function() {
														  chart1 = new Highcharts.Chart({
															 chart: {
																renderTo: 'container<?php echo $row_gudang['0'] ?>',
																type: 'bar'
															 },
															  title: {
																	text: 'Grafik Barang Gudang <?php echo $row_gudang['1'] ?>'
																},
																
																xAxis: {
																	categories: [<?php
												 if(!empty($filter_sub_kategori)){
												  
											
														  $qrynama=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."' and nama_barang like '%".@$filter_nama."%' and status_barang='Y'  order by kategori_barang.kode_kategori_barang,id,nama_barang asc LIMIT $offset, $limit");
											  }elseif(!empty($filter_kategori)){
												 
												    $qrynama=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and nama_barang like '%".@$filter_nama."%' and status_barang='Y'  order by kategori_barang.kode_kategori_barang,id,nama_barang asc LIMIT $offset, $limit");
											  }else{
													$qrynama=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and status_barang='Y'  order by kategori_barang.kode_kategori_barang,id,nama_barang asc LIMIT $offset, $limit");}
												  $jumlah_orang=mysql_num_rows($qrynama);
													while($rownama=mysql_fetch_array($qrynama)){ ?>'<?php echo $rownama['nama_barang']  ?>',<?php } ?>],
																	 title: {
            text: null
        }
    },
     yAxis: {
        min: 0,
        title: {
            text: 'Total',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' total'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
																   series:             
																[
													
														  {
															   showInLegend: false,
															  data: [<?php 
													 if(!empty($filter_sub_kategori)){
												  
											
														  $qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."' and nama_barang like '%".@$filter_nama."%' and status_barang='Y'  order by kategori_barang.kode_kategori_barang,id,nama_barang asc LIMIT $offset, $limit");
											  }elseif(!empty($filter_kategori)){
												 
												    $qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and nama_barang like '%".@$filter_nama."%' and status_barang='Y'  order by kategori_barang.kode_kategori_barang,id,nama_barang asc LIMIT $offset, $limit");
											  }else{
													$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and status_barang='Y'  order by kategori_barang.kode_kategori_barang,id,nama_barang asc LIMIT $offset, $limit");}
													while($row=mysql_fetch_array($qry)){
													 	$num_masuk=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='masuk' and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang['0']."'")));
												$num_keluar=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='keluar'  and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang['0']."'")));
											 
											 	$qty_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from pembelian_detail,pembelian where pembelian_detail.no_beli=pembelian.no_beli and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."' "));
												$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail,penjualan where penjualan.no_jual=penjualan_detail.no_jual and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
											$stok_keluar=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_keluar where kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
											
											$stok_masuk=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_masuk where kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
											
												if($row_gudang['stok_awal']=="Y"){	
												 	$stok=($qty_beli[0]+$row['stok']+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];}else{
													
												 	$stok=($qty_beli[0]+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];	
												} ?><?php echo $stok ; ?>,<?php  } ?>]
														  },
														  
													]
													});
													});	
													</script>
                                       <?php  if(isMobile()){ ?>
                                       <table class="table table-hover table-bordered table-fixed-header" style="margin-top:10px;">
                                       <thead class='header'>  <tr>
                                         <th style="text-align:center;">No</th>
											<th style="text-align:left;">Kategori</th>
                                         
                                            <th >Nama Barang </th>
                                            <th style="text-align:center;">Stok</th>                     
                                                                                        
                                        </tr> </thead> <tbody>
										<?php
										
										
											
											  if(!empty($filter_sub_kategori)){
												  
												  $qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."' and status_barang='Y' 
													order by kategori_barang.kode_kategori_barang,id,nama_barang asc LIMIT $offset, $limit");
											  }
											  elseif(!empty($filter_kategori)){
												  	$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where  barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and status_barang='Y' 
													order by kategori_barang.kode_kategori_barang,id,nama_barang asc LIMIT $offset, $limit");
												    
												  
											  }else{
												  
											 
												$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where 
												barang.kode_kategori=kategori_barang.kode_kategori_barang and 
												barang.kode_sub_kategori=sub_kategori_barang.id and
											nama_barang like '%".@$filter_nama."%'  and status_barang='Y' 
											 order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id,nama_barang asc LIMIT $offset, $limit");}
												
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
												<img src="<?php echo $photo;?>" style="width:100px;border:solid 4px #fff;box-shadow:0px 0px 2px #999;float:left;margin-right: 10px"> <br>
                                         									- <?php echo $row['kategori_barang'] ?> <br>
                                          									-- <?php echo $row['sub_kategori'] ?>
                                           </td>
                                            <td><?php echo $row['nama_barang']  ?> / 
                                              <?php  echo $row['satuan']; ?><br>
                                              <span style="text-align: right;font-weight: bold"><?php 	  $qryharga=mysql_query("select * from harga_tiap_gudang where kode_barang ='".$row['kode_barang']."' and kd_gudang ='".$row_gudang['0']."'");
											$cekharga=mysql_num_rows($qryharga);
											$harga=mysql_fetch_array($qryharga);
											if($cekharga > 0){
											echo	number_format($harga_jual=$harga['harga_jual']);
											}else{
											echo number_format($harga_jual=$row['harga_jual']);} ?></span>
                                            </td>
                                         
                                              <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php } ?>
                                            <td style="text-align: center"><?php
											 	$num_masuk=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='masuk' and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang['0']."'")));
												$num_keluar=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='keluar'  and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang['0']."'")));
											 
											 	$qty_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from pembelian_detail,pembelian where pembelian_detail.no_beli=pembelian.no_beli and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."' "));
												$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail,penjualan where penjualan.no_jual=penjualan_detail.no_jual and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
											$stok_keluar=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_keluar where kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
											
											$stok_masuk=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_masuk where kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
											
												if($row_gudang['stok_awal']=="Y"){	
												echo 	$stok=($qty_beli[0]+$row['stok']+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];}else{
													
												echo 	$stok=($qty_beli[0]+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];	
												}  
											   @$stok2=$stok+$stok2; ?></td>
                                                                      <?php if ($_SESSION['loglevel']=="Administrator"){ ?> <?php } ?>
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
                                            <td style="text-align:center;"><?php
											 
											   echo number_format(@$stok2); ?></td>
                                                                         
                                        </tr></tbody>
                                    </table>
                                       
									 <?php  }else{ ?>
                                     <table class="table table-hover table-bordered table-fixed-header" style="margin-top:10px;">
                                       <thead class='header'>  <tr>
                                         <th style="text-align:center;">No</th>
											<th style="text-align:left;">Kategori</th>
                                         
                                            <th >Nama Barang </th>
                                            <th style="text-align:center;">Satuan</th>
                                              <th style="text-align:right;">Harga Jual</th>
                                            <th style="text-align:center;">Stok</th>                     
                                                                                        
                                        </tr> </thead><tbody>
										<?php
										$limit = 100;
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
													order by kategori_barang.kode_kategori_barang,id,nama_barang asc LIMIT $offset, $limit");
											  }
											  elseif(!empty($filter_kategori)){
												  	$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where  barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and status_barang='Y' 
													order by kategori_barang.kode_kategori_barang,id,nama_barang asc LIMIT $offset, $limit");
												    
												  
											  }else{
												  
											 
												$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where 
												barang.kode_kategori=kategori_barang.kode_kategori_barang and 
												barang.kode_sub_kategori=sub_kategori_barang.id and
											nama_barang like '%".@$filter_nama."%' and status_barang='Y'
											 order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id,nama_barang asc LIMIT $offset, $limit");}
												
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                          
                                              <td align="center"><?php echo $i;?></td>
											 <td style="text-align:left;">- <?php echo $row['kategori_barang'] ?> <br>
                                          									-- <?php echo $row['sub_kategori'] ?>
                                           </td>
                                            <td><?php echo $row['nama_barang']  ?></td>
                                         
                                              <td  style="text-align:center;"><?php  echo $row['satuan']; ?></td>
                                                                          <td style="text-align: right"><?php 	  $qryharga=mysql_query("select * from harga_tiap_gudang where kode_barang ='".$row['kode_barang']."' and kd_gudang ='".$row_gudang['0']."'");
											$cekharga=mysql_num_rows($qryharga);
											$harga=mysql_fetch_array($qryharga);
											if($cekharga > 0){
											echo	number_format($harga_jual=$harga['harga_jual']);
											}else{
											echo number_format($harga_jual=$row['harga_jual']);} ?></td>
                                                                   <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php } ?>
                                            <td style="text-align: center"><?php
											 	$num_masuk=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='masuk' and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang['0']."'")));
												$num_keluar=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='keluar'  and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang['0']."'")));
											 
											 	$qty_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from pembelian_detail,pembelian where pembelian_detail.no_beli=pembelian.no_beli and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."' "));
												$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail,penjualan where penjualan.no_jual=penjualan_detail.no_jual and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
											$stok_keluar=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_keluar where kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
											
											$stok_masuk=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_masuk where kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
											
												if($row_gudang['stok_awal']=="Y"){	
												echo 	$stok=($qty_beli[0]+$row['stok']+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];}else{
													
												echo 	$stok=($qty_beli[0]+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];	
												}  
											   @$stok2=$stok+$stok2; ?></td>
                                                                      <?php if ($_SESSION['loglevel']=="Administrator"){ ?> <?php } ?>
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
                                            <td>&nbsp;</td> <td>&nbsp;</td>
                                              <td>&nbsp;</td>
                                                                   <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php }?>
                                            <td style="text-align:center;"><?php
											 
											   echo number_format(@$stok2); ?></td>
                                                                         
                                        </tr></tbody>
                                    </table><?php } ?>
                                    
                                    <div id="container<?php echo $row_gudang['0'] ?>" style="height: <?php if($jumlah_orang >= 15 ){   echo $jumlah_orang * 25 ;}elseif($jumlah_orang >= 6 ){ echo 500; }elseif($jumlah_orang >= 1 ){ echo 200; }?>px;"></div>
								 </div>
                                  <?php $stok=0;$stok2=0;$stok_keluar=0; } ?>
                                   
                                  </div>   
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
									 if(!empty($filter_sub_kategori)){
												  
												
										 	$query  = "SELECT COUNT(nama_barang) AS jumData from barang where kode_kategori = '".@$filter_kategori."' and nama_barang like '%".@$filter_nama."%' and barang.kode_sub_kategori= '".@$filter_sub_kategori."'  ";
										}
									  elseif(!empty($filter_kategori)){
												  	
												  	$query  = "SELECT COUNT(nama_barang) AS jumData from barang where kode_kategori = '".@$filter_kategori."' and nama_barang like '%".@$filter_nama."%'   ";
											  }else{
									$query  = "SELECT COUNT(nama_barang) AS jumData from barang where nama_barang like '%".@$filter_nama."%'  ";}
									$hasil  = mysql_query($query);
									$data  = mysql_fetch_array($hasil);
									$jumData = $data['jumData'];
									$jumPage = ceil($jumData/$limit);
								?>
								<label style="float:left;margin-top:6px;">
								<?php
								if ($jumData==0){
									echo "Showing 0 to 0 of 0 Entries";
								}else{
								
								?>
								Showing <?php echo $offset+1;?> to 
								<?php 
								if ($jumPage==$hal){
								echo $jumData;
								}else{
								echo $limit*$hal;
								}
								?> 
								of <?php echo $jumData;?> Entries &nbsp;&nbsp;
								<?php } ?>
								</label>
								<ul class="pagination pagination-sm no-margin pull-right">
								<?php
								for($i = 1; $i <= $jumPage; $i++){
										 if ((($i >= $hal - 3) && ($i <= $hal + 3)) || ($i == 1) || ($i == $jumPage))
										 {
											if ($i == $hal) echo "<li><a href=''><b>".$i."</b></a></li>";
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=stok&hal=".$i."&kd_gudang=".$row_gudang['0']."&filter_nama=".@$filter_nama."&filter_kategori=".@$filter_kategori."&filter_sub_kategori=".@$filter_sub_kategori."'>".$i."</a></li>";
										 }
								}
								?>
                                </ul>
								<label style="float:right;margin-top:5px;">
									Page :&nbsp;&nbsp;
								</label>
                                </div>
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
<script src="js/sub_kat_barang.js" type="text/javascript"></script> 
