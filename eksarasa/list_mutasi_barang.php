<?php
session_start();
include "function.php";
include "koneksi.php";

?>
		
<script language="javascript">
   function setBrg(id,vkd,st,hj,hb,qty){
	    window.opener.document.getElementById('kode').value = id;
    	window.opener.document.getElementById('pname').value = vkd;
		    	window.opener.document.getElementById('satuan').value = st;
	   						<?php if(isset($_GET['p'])) { ?>
				    	window.opener.document.getElementById('harga_jual').value = hb;
   							
							 <?php 	}else{?>	
							window.opener.document.getElementById('harga_jual').value = hj;
							<?php } ?>
	   		    	window.opener.document.getElementById('qty').value = qty;
						window.opener.document.getElementById('qty').focus();
	   window.opener.document.getElementById('harga_beli').value = hb;
	    window.self.close();
   }
  </script>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
         <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- Calendar-->
		
<section class="content-header">
	<h1>
	Daftar Barang </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                          <div class="box box-primary">
                            <div class="box-header">
                               
                          </div><!-- /.box-header -->
                              <form action="list_barang.php" method="post">
										<div class="input-group">
                                            <input name="cari" class="form-control input-sm pull-right" style="width: 20%;" placeholder="Barang" value="<?php echo @$_POST['cari'] ?>"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
										</form>
                               	
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
                                   
                                       <div class="tab-pane <?php echo $row_gudang['2'] ?>" id="<?php echo $row_gudang['0'] ?>"> 
                                <table class="table table-hover table-bordered" style="margin-top:10px;font-size: <?php  if(isMobile()){ echo "25px"; } else{ echo "13px !important";} ?>;">
                                    <tr>
                                       	<th >Kategori</th> <th style="text-align:center;">Nama Barang</th>
                                        <th >Satuan</th>
                                           <th >Stok</th>
                                        <th style="text-align:right;">Harga Jual</th>
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
								
										$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$_POST['cari']."%' order by nama_barang asc LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
											$num_masuk=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='masuk' and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang['0']."'")));
												$num_keluar=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='keluar'  and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang['0']."'")));
											
												$qty_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from pembelian_detail,pembelian where pembelian_detail.no_beli=pembelian.no_beli and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
												$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail,penjualan where penjualan.no_jual=penjualan_detail.no_jual and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
												$stok_keluar=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_keluar where kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
											
												$stok_masuk=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_masuk where kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
											
												if($row_gudang['stok_awal']=="Y"){	
													$stok=($qty_beli[0]+$row['stok']+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];}else{
													
													$stok=($qty_beli[0]+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];	
												} 
										?>
                                    <tr onclick="javascript:setBrg('<?php echo $row['kode_barang'] ?>','<?php echo $row['kategori_barang'] ?> - <?php echo $row['sub_kategori'] ?> - <?php echo str_replace('"','&quot;',$row['nama_barang']); ?>','<?php  echo $row['satuan']?>','<?php  echo $row['harga_jual']?>','<?php  echo $row['harga_beli']?>','<?php  echo $stok ?>')" style="font-size: <?php  if(isMobile()){ echo "25px"; } else{ echo "13px !important";} ?>;">
                                        <td style="text-align:left;">- <?php echo $row['kategori_barang'] ?> <br>
                                          									-- <?php echo $row['sub_kategori'] ?>
                                           </td>
                                        <td style="text-align:center;"><span style="text-align:left;"><?php echo $row['nama_barang'] ?></span></td>
                                        <td><?php echo $row['satuan'] ?></td>
                                           <td><?php 	
											echo 	$stok;	
												 ?></td>
                                        <td style="text-align:right;"><?php echo number_format($row['harga_jual']) ?></td>
                                    </tr>
                                    <?php
										$i++;
										}
										?>
                                </table> </div>
                                  <?php } ?>
                                   
                                  </div>   
                              </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
									$query  = "SELECT COUNT(kode_barang) AS jumData FROM barang where  nama_barang like '%".@$_POST['cari']."%'";
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
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=list_barang&hal=".$i."'>".$i."</a></li>";
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
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<?php

?>