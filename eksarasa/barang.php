<?php

?>

<section class="content-header">
	<div class="pull-right" style="padding-right:5px"><a href="?page=tambah.barang&filter_kategori=<?php echo $filter_kategori  ?>&filter_sub_kategori=<?php echo $filter_sub_kategori ?>" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Add New"><i class="fa fa-plus"></i> Tambah</a>
        
      </div>
	<h1>
	
		Barang<small></small>
    </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-warning">
                                <div class="box-header">
                                  <div class="panel-heading">
        <h3 class="panel-title" style="max-width: 250px;display: inline-block"><i class="fa fa-list"></i> List </h3> <button class="btn btn-default pull-right" id="myelement" ><i class="fa fa-search"></i></button>
      </div>
                            </div><!-- /.box-header -->
                                <div class="box-body" style="padding-top:0px;">
									
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
					
							$qry_kategory=mysql_query("select *  from kategori_barang order by kategori_barang");
							while($kategori=mysql_fetch_array($qry_kategory)){
						?>
              			<option value="<?php echo $kategori['kode_kategori_barang'] ?>" <?php if($kategori['kode_kategori_barang']==@$filter_kategori) echo "selected" ?>><?php echo $kategori['kategori_barang'] ?></option><?php } ?>
              	</select>
              </div>
              <div class="form-group">
										  <label class="control-label" for="input-model">Status</label>
											<select name="filter_status"   class="form-control" required id="gudang">
																
													
													<option value="Y" <?php if(@$filter_status=="Y") echo "selected" ?>>Aktif</option>
													<option value="N" <?php if(@$filter_status=="N") echo "selected" ?>>Non Aktif</option>	
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
               <div class="form-group">
										  <label class="control-label" for="input-model">Gudang</label>
											<select name="filter_gudang"   class="form-control" required id="gudang">
																
													<?php 
															$qrybank=mysql_query("select * from gudang order by sort_by");
															while($bank=mysql_fetch_array($qrybank)){
													?>
													<option value="<?php echo $bank[0] ?>" <?php if($bank[0] == @$filter_gudang) echo "selected" ?>><?php echo $bank[1] ?></option><?php } ?>

											</select>
                                 	 </div>      
              <a href="print.barang.php?kd_gudang=<?php echo $filter_gudang ?>&filter_nama=<?php echo @$filter_nama ?>&filter_kategori=<?php echo @$filter_kategori ?>&filter_sub_kategori=<?php echo @$filter_sub_kategori ?>" class="btn btn-default pull-right"  data-original-title="Print" target="_blank"><i class="fa fa-print"></i></a>
              <button type="submit" id="button-filter" class="btn btn-primary pull-right" name="submit"><i class="fa fa-search"></i> Filter</button>
            </div>
          </div>
        </div>
         </form>   
                                   <?php  if(isMobile()){ ?>
                                    <table class="table table-hover " style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">Barang</th>
                                         
                                            <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php } ?>
                                            <th style="text-align:center;" >Stok</th>                        <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                             <?php } ?>
                                                                                        <?php if ($_SESSION['loglevel']=="Administrator"){ ?>  
                                            <th style="text-align:center;">Aksi</th><?php } ?>
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
											if(!empty($filter_sub_kategori)){
												  
												  $qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."' and status_barang='".@$filter_status."' 
													order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id ,nama_barang asc LIMIT $offset, $limit");
											  }
											  elseif(!empty($filter_kategori)){
												  	$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and status_barang='".@$filter_status."' 
													order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id,nama_barang asc LIMIT $offset, $limit");
												    
												  
											  }else{
												  
											 
											$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and status_barang='".@$filter_status."' 
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
                                          									<a href="?page=histori.transaksi.penjualan&kode_barang=<?php echo $row['kode_barang'] ?>" style="font-weight: bold"><?php echo $row['nama_barang']  ?></a>
                                          									<br><b style="color: rgb(255, 87, 34);">Rp 
                                          									<?php 	  $qryharga=mysql_query("select * from harga_tiap_gudang where kode_barang ='".$row['kode_barang']."' and kd_gudang ='".$filter_gudang."'");
											$cekharga=mysql_num_rows($qryharga);
											$harga=mysql_fetch_array($qryharga);
											if($cekharga > 0){
											echo	number_format($harga_jual=$harga['harga_jual']);
											}else{
											echo number_format($harga_jual=$row['harga_jual']);} ?></b>
                                       									   </div>
                                           </td>
                                       
                                              <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php } ?>
                                            <td style="text-align:center;"><?php
											 
											 
											 	$qty_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from pembelian_detail,pembelian where pembelian_detail.no_beli=pembelian.no_beli and kode_barang='".$row['kode_barang']."'"));
												$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail,penjualan where penjualan.no_jual=penjualan_detail.no_jual and kode_barang='".$row['kode_barang']."'"));
											$stok_keluar=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_keluar where kode_barang='".$row['kode_barang']."'"));
											$stok_masuk=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_masuk where kode_barang='".$row['kode_barang']."'"));
											echo 	$stok=($qty_beli[0]+$row['stok']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]; 
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

                                               <td style="text-align:center;">
                                            
                                             <div class="text-center"><div class="btn-group text-left"><a type="button" class="dropdown-toggle" data-toggle="dropdown"><img src="img/9bf4705c9e.svg" alt="Action" height="18px"></a>
            <ul class="dropdown-menu pull-right" role="menu">
          
          
         
               <li><a href="?page=histori.transaksi.pembelian&kode_barang=<?php echo $row['kode_barang'] ?>&filter_kategori=<?php echo @$filter_kategori ?>&filter_sub_kategori=<?php echo @$filter_sub_kategori ?>&filter_nama=<?php echo @$filter_nama ?>" class="sledit"><i class="fa fa-mail-reply"></i> Barang masuk </a></li>
                 <li><a href="?page=histori.transaksi.penjualan&kode_barang=<?php echo $row['kode_barang'] ?>&filter_kategori=<?php echo @$filter_kategori ?>&filter_sub_kategori=<?php echo @$filter_sub_kategori ?>&filter_nama=<?php echo @$filter_nama ?>" class="sledit "><i class="fa fa-mail-forward"></i> Barang keluar </a></li>
                 
                <li><a href="?page=edit.barang&kode_barang=<?php echo $row['kode_barang']?>" class="sledit"><i class="fa fa-edit"></i> Edit </a></li>
                 <li><a href="?page=hapus.barang&kode_barang=<?php echo $row['kode_barang']?>" class="sledit hapus"><i class="fa fa-trash-o"></i> Delete </a></li>
            </ul>
        </div></div>               </td><?php }?>
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                         <tr style="font-weight:bold">
                                            <td style="text-align:center;">Total</td>
                                      
                                              <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php }?>
                                            <td><?php
											 
											   echo number_format($stok2); ?></td>
                                                                          <?php if ($_SESSION['loglevel']=="Administrator"){ ?> <?php } ?>
                                               <?php if ($_SESSION['loglevel']=="Administrator"){ ?>  
                                            <td style="text-align:center;">
                                            </td><?php }?>
                                        </tr>
                                           <tr style="font-weight:bold">
                                            <td style="text-align:center;">Total Persediaan</td>
                                      
                                              <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php }?>
                                            <td><?php
											 
											   echo number_format(@$total_beli2); ?></td>
                                                                          <?php if ($_SESSION['loglevel']=="Administrator"){ ?> <?php } ?>
                                               <?php if ($_SESSION['loglevel']=="Administrator"){ ?>  
                                            <td style="text-align:center;">
                                            </td><?php }?>
                                        </tr>
                                            <tr style="font-weight:bold">
                                            <td style="text-align:center;">Total Penjualan</td>
                                      
                                              <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php }?>
                                            <td><?php
											 
											   echo number_format(@$total_jual2); ?></td>
                                                                          <?php if ($_SESSION['loglevel']=="Administrator"){ ?> <?php } ?>
                                               <?php if ($_SESSION['loglevel']=="Administrator"){ ?>  
                                            <td style="text-align:center;">
                                            </td><?php }?>
                                        </tr>
                                            <tr style="font-weight:bold">
                                            <td style="text-align:center;">Total Gross Margin</td>
                                      
                                              <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <?php }?>
                                            <td><?php
											 
											   echo number_format(@$total_jual2-@$total_beli2); ?></td>
                                                                          <?php if ($_SESSION['loglevel']=="Administrator"){ ?> <?php } ?>
                                               <?php if ($_SESSION['loglevel']=="Administrator"){ ?>  
                                            <td style="text-align:center;">
                                            </td><?php }?>
                                        </tr>
                                    </table>
                                   <?php }else{ ?>
                                   <div class="table-responsive">
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>
											<th style="text-align:center;">Barang</th>
                                         
                                 
                                          <th >Satuan</th>
                                                                   <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <th >Harga Beli</th><?php } ?>
                                            <th >Harga Jual</th>
                                           
                                            <th style="text-align:center;">Stok <br>Awal</th> 
                                             <th style="text-align:center;" >Stok</th>                        <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                             <th >Total Beli</th><?php } ?>
                                                                                        <th >Total Jual</th>      
                                                                                        <?php if ($_SESSION['loglevel']=="Administrator"){ ?>  
                                                                                        <th >Selisih</th>
                                                                                         <th style="text-align:center;">Persen</th>
                                            <th style="text-align:center;">Aksi</th><?php } ?>
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
											if(!empty($filter_sub_kategori)){
												  
												  $qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."' and status_barang='".@$filter_status."' 
													order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id ,nama_barang asc LIMIT $offset, $limit");
											  }
											  elseif(!empty($filter_kategori)){
												  	$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and status_barang='".@$filter_status."' 
													order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id,nama_barang asc LIMIT $offset, $limit");
												    
												  
											  }else{
												  
											 
											$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and status_barang='".@$filter_status."' 
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
                                          									<a href="?page=histori.transaksi.penjualan&kode_barang=<?php echo $row['kode_barang'] ?>" style="font-weight: bold"><?php echo $row['nama_barang']  ?></a></div>
                                           </td>
                                       
                                          <td><?php  echo $row['satuan']; ?></td>
                                                                   <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <td><?php
											 
											   echo number_format($row['harga_beli']); ?></td><?php } ?>
                                            <td><?php 	  $qryharga=mysql_query("select * from harga_tiap_gudang where kode_barang ='".$row['kode_barang']."' and kd_gudang ='".$filter_gudang."'");
											$cekharga=mysql_num_rows($qryharga);
											$harga=mysql_fetch_array($qryharga);
											if($cekharga > 0){
											echo	number_format($harga_jual=$harga['harga_jual']);
											}else{
											echo number_format($harga_jual=$row['harga_jual']);} ?></td>
                                                       <td style="text-align:center;"><?php 
													  echo number_format($row['stok']); ?></td>
                                                      <td style="text-align:center;"><?php
											 /*
											 
											 	$qty_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from pembelian_detail,pembelian where pembelian_detail.no_beli=pembelian.no_beli and kode_barang='".$row['kode_barang']."'"));
												$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail,penjualan where penjualan.no_jual=penjualan_detail.no_jual and kode_barang='".$row['kode_barang']."'"));
											$stok_keluar=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_keluar where kode_barang='".$row['kode_barang']."'"));
											$stok_masuk=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_masuk where kode_barang='".$row['kode_barang']."'"));
											echo 	$stok=($qty_beli[0]+$row['stok']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]; 
											   @$stok2=$stok+$stok2;*/ ?></td>
                                                                      <?php if ($_SESSION['loglevel']=="Administrator"){ ?> <td><?php 
													  echo number_format($total_beli=$row['harga_beli']*$stok);
													  @$total_beli2=$total_beli+$total_beli2;
													   ?></td><?php } ?>
                                                       <td><?php
											 
											   echo number_format($total_jual=$row['harga_jual']*$stok);
											   @$total_jual2=$total_jual+$total_jual2;
											    ?></td>
                                             <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <td><?php echo number_format($total_jual-$total_beli); ?></td>
                                                  <td align="center"><?php echo @number_format((($total_jual-$total_beli)/$total_beli)*100,2); ?> %</td>
                                            <?php } ?>
                                             <?php if ($_SESSION['loglevel']=="Administrator"){ ?>   
                                            <td style="text-align:center;">
                                            
                                            <a href="?page=histori.transaksi.pembelian&kode_barang=<?php echo $row['kode_barang'] ?>&filter_kategori=<?php echo @$filter_kategori ?>&filter_sub_kategori=<?php echo @$filter_sub_kategori ?>&filter_nama=<?php echo @$filter_nama ?>" class="btn btn-xs btn-success"><i class="fa fa-mail-reply"></i></a>
                                              <a href="?page=histori.transaksi.penjualan&kode_barang=<?php echo $row['kode_barang'] ?>&filter_kategori=<?php echo @$filter_kategori ?>&filter_sub_kategori=<?php echo @$filter_sub_kategori ?>&filter_nama=<?php echo @$filter_nama ?>" class="btn btn-xs btn-warning"><i class="fa fa-mail-forward"></i></a>
                                            <br>
										<a href="?page=edit.barang&kode_barang=<?php echo $row['kode_barang']?>"><span class="fa fa-edit"></span></a>
											<a href="?page=hapus.barang&kode_barang=<?php echo $row['kode_barang']?>" class="hapus"><span class="fa fa-trash-o"></span></a></td><?php }?>
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
                                            <td>&nbsp;</td><?php }?>
                                            <td>&nbsp;</td>
                                                     <td>&nbsp;</td>
                                                      <td style="text-align:center;"><?php
											 
											   echo number_format($stok2); ?></td>
                                                                          <?php if ($_SESSION['loglevel']=="Administrator"){ ?> <td><?php
											 
											   echo number_format(@$total_beli2); ?></td><?php } ?>
                                                    <td><?php
											 
											   echo number_format(@$total_jual2); ?></td>
                                               <?php if ($_SESSION['loglevel']=="Administrator"){ ?>  
                                                <td><?php  echo number_format(@$total_jual2-$total_beli2); ?></td>
                                                <td align="center"> <?php echo @number_format((($total_jual2-$total_beli2)/$total_beli2)*100,2); ?> %</td>
                                            <td style="text-align:center;">
                                            </td><?php }?>
                                        </tr>
                                    </table>
                                </div><!-- /.box-body --><?php } ?>
								 </div>
                                <div class="box-footer clearfix">
								<?php 
									 if(!empty($filter_sub_kategori)){
												  
												
										 	$query  = "SELECT COUNT(nama_barang) AS jumData from barang where kode_kategori = '".@$filter_kategori."' and nama_barang like '%".@$filter_nama."%' and barang.kode_sub_kategori= '".@$filter_sub_kategori."' and status_barang='".@$filter_status."'  ";
										}
									  elseif(!empty($filter_kategori)){
												  	
												  	$query  = "SELECT COUNT(nama_barang) AS jumData from barang where kode_kategori = '".@$filter_kategori."' and nama_barang like '%".@$filter_nama."%' and status_barang='".@$filter_status."'   ";
											  }else{
									$query  = "SELECT COUNT(nama_barang) AS jumData from barang where nama_barang like '%".@$filter_nama."%'  and status_barang='".@$filter_status."' ";}
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
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=barang&filter_kategori=".@$filter_kategori."&filter_sub_kategori=".@$filter_sub_kategori."&filter_nama=".@$filter_nama."&hal=".$i."'>".$i."</a></li>";
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