
 <?php  if(isMobile()){ ?>
<style>
.small-box h3 {
    font-size: 24px !important;
    font-weight: 700;
    margin: 0 0 10px;
    white-space: nowrap;
    padding: 0;
}</style><?php } ?>
        <link href="css/AdminLTE2.css" rel="stylesheet" type="text/css" />
<div id="content">

  
  <section class="content-header">
      <h1 style="color: #c7c7c7 !important">
        Dashboard
       
      </h1>
      
    </section>
  <section class="content">
<?php
if($_SESSION["loglevel_graha3"]<>"Admin" and $_SESSION["loglevel_graha3"]<>"Administrator"){ ?>


        <center>
        <br />
        <img src="img/logo.png" style="width:60%;"><br><br>
        
        </center>
 <?php }else{ 
	  
	
	  ?>


                    <!-- Small boxes (Stat box) -->
              
    <div class="row">
         <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="?page=report.orders" style="color: #000">
             <div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>
										  <?php 
															$num2=(mysql_fetch_array(mysql_query("select sum(total) as total from penjualan where tgl_jual='".date("Y-m-d")."'")));
															

			$num=(mysql_fetch_array(mysql_query("select sum(total) as total from penjualan where month(tgl_jual)='".date("m")."' and year(tgl_jual)='".date("Y")."'")));


															?>



					<div class="info-box-content">
					  <span class="info-box-text">Order Hari Ini</span>
					  <span class="info-box-number"><?php echo number_format($num2['total']);?></span>
					   <span class="info-box-text">  <?php echo number_format($perhari=$num['total'] / date('d'));?> / hari</span>
					</div>
            <!-- /.info-box-content -->
				</div>
         </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
           <a href="?page=report.orders&filter_dari=<?php echo date("Y-m-01") ?>&filter_sampai=<?php echo date("Y-m-d") ?>" style="color: #000">
          <div class="info-box">
            <span class="info-box-icon bg-red" style="background-color: #dd4b39 !important;"><i class="fa fa-credit-card"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number"> <?php  echo number_format($num['total']); ?></span>
               <span class="info-box-text"><?php 
												$month_end = strtotime('last day of this month', time());	
	
												$penguran=date('d', $month_end) - date('d');
													
												echo number_format($perhari * $penguran); echo " - "; echo number_format(($perhari * $penguran)+$num['total']);
	
										?></span>
           
            </div>
            <!-- /.info-box-content -->
          </div>
		</a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
      

         <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="?page=customer" style="color: #000">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Customers</span>
              <span class="info-box-number">  <?php 
													$num=(mysql_num_rows(mysql_query("select * from customer")));
													echo number_format($num);
													?></span>
            </div>
            <!-- /.info-box-content -->
          </div></a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
         <div class="col-md-3 col-sm-6 col-xs-12">
           <a href="?page=barang" style="color: #000">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-database"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Persediaan</span>
              <span class="info-box-number"><?php include("hitung.aset.barang.php") ?></span>
            </div>
            <!-- /.info-box-content -->
          </div></a>
          <!-- /.info-box -->
        </div>
        
         <?php 
	
						$qrybank2=mysql_query("select * from gudang order by sort_by");
						while($bankgudang=mysql_fetch_array($qrybank2)){
	
							?>
                   
                        <div class="col-md-3 col-sm-6 col-xs-12">
						   <a href="?page=barang" style="color: #000">
						  <div class="info-box">
							<span class="info-box-icon bg-yellow"><i class="fa fa-database"></i></span>

							<div class="info-box-content">
							  <span class="info-box-text">Total Persediaan</span>
							  <span class="info-box-text"><?php  echo $bankgudang[1] ?>
							  <?php
								  
								  			
									
												
													
											

											$qry=mysql_query("select * from barang where   status_barang='Y' ");
										
										while($row=mysql_fetch_array($qry)){
									
											 
											 	$num_masuk=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='masuk' and kode_barang='".$row['kode_barang']."' and kd_gudang='".$bankgudang['0']."'")));
												$num_keluar=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='keluar'  and kode_barang='".$row['kode_barang']."' and kd_gudang='".$bankgudang['0']."'")));
											 
											 	$qty_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from pembelian_detail,pembelian where pembelian_detail.no_beli=pembelian.no_beli and kode_barang='".$row['kode_barang']."' and kd_gudang='".$bankgudang[0]."' "));
												$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail,penjualan where penjualan.no_jual=penjualan_detail.no_jual and kode_barang='".$row['kode_barang']."' and kd_gudang='".$bankgudang[0]."'"));
											$stok_keluar=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_keluar where kode_barang='".$row['kode_barang']."' and kd_gudang='".$bankgudang[0]."'"));
											
											$stok_masuk=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_masuk where kode_barang='".$row['kode_barang']."' and kd_gudang='".$bankgudang[0]."'"));
											if($bankgudang['stok_awal']=="Y"){	
												 	$stokhome=($qty_beli[0]+$row['stok']+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];}else{
													
												 	$stokhome=($qty_beli[0]+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];	
												} 
										
											   @$stokhome2=$stokhome+$stokhome2;
											
												 number_format($total_beli=$row['harga_beli']*$stokhome);
													  @$total_belihome2=$total_beli+$total_belihome2;
													
											   number_format($total_jual=$row['harga_jual']*$stokhome);
											   @$total_jualhome2=$total_jual+$total_jualhome2;
											 
										}
										?>
                                    		
													
																
								  
								 </span>
								  
					   <span class="info-box-number"><?php echo number_format(@$total_belihome2);$total_belihome2=0; ?></span>
							</div>
							<!-- /.info-box-content -->
						  </div></a>
						  <!-- /.info-box -->
						</div><?php  } ?>
        <?php 
	
						$qrybank2=mysql_query("select * from gudang order by sort_by");
						while($bankgudang=mysql_fetch_array($qrybank2)){
	
							?>
                   
                        <div class="col-md-3 col-sm-6 col-xs-12">
						   <a href="?page=barang" style="color: #000">
						  <div class="info-box">
							<span class="info-box-icon bg-gray"><i class="fa fa-money"></i></span>

							<div class="info-box-content">
							  <span class="info-box-text"><?php  echo $bankgudang[1] ?></span>
							  <span class="info-box-number"><?php
								  
								  			

											$num_gudang=(mysql_fetch_array(mysql_query("select sum(sub_total) as total from penjualan,penjualan_detail where  penjualan.no_jual=penjualan_detail.no_jual and month(tgl_jual)='".date("m")."' and year(tgl_jual)='".date("Y")."' and kd_gudang = '".$bankgudang[0]."'")));
															
echo number_format($num_gudang['total']);
																
								  
								  ?></span>
								  
					   <span class="info-box-text">  <?php  number_format($perhari_gudang=$num_gudang['total'] / date('d'));
							
							echo number_format($perhari_gudang*$penguran);
							echo " - "; echo number_format(($perhari_gudang * $penguran)+$num_gudang['total']); ?> </span>
							</div>
							<!-- /.info-box-content -->
						  </div></a>
						  <!-- /.info-box -->
						</div><?php } ?>
        <!-- /.col -->
        
        
        
        
      </div>
<div class="row">
			 <div class="col-lg-12">
				<div class="box box-warning" style=";background: #1b1b1b !important">
				<div class="box-body" style="padding-top: 15px">
				<?php 
	
						$qrybank=mysql_query("select * from bank_perusahaan where   status ='Y' order by sort_by");
						while($bank=mysql_fetch_array($qrybank)){
	
				?>
								
					  <div class="col-md-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box <?php echo $bank['color'] ?>">
                                <div class="inner" style="min-height: 125px">
                                    <h3>
                                          <?php 
													$saldo_awal	=(mysql_fetch_array(mysql_query("select saldo from saldo_awal_kas where  kd_bank='".$bank['0']."'")));
													$num_debet=(mysql_fetch_array(mysql_query("select sum(nilai) as total_debet from arus_kas where tipe_kas='debet' and kd_bank='".$bank['0']."'")));
													$num_kredit=(mysql_fetch_array(mysql_query("select sum(nilai) as total_kredit from arus_kas where tipe_kas='kredit'  and kd_bank='".$bank['0']."'")));
	
													echo number_format($saldo_awal[0]+$num_debet['total_debet']-$num_kredit['total_kredit']);
													?>
                                    </h3>
                                    <p>
                                      <?php echo $bank[1] ?> <?php if(!empty($bank[2])) echo " - ".$bank[2] ?> <?php if(!empty($bank[3])) echo " - ".$bank[3] ?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <a href="?page=arus.kas&kd_bank=<?php echo $bank['0'] ?> " class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
			
				<?php } ?> <div class="col-md-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-black">
                                <div class="inner" style="min-height: 125px">
                                    <h3>
                                          <?php 
												
													$num_debet=(mysql_fetch_array(mysql_query("select sum(nilai) as total_debet from arus_kas where tipe_kas='debet' and kd_bank<>'' and kd_bank<>'Pilih'")));
													$num_kredit=(mysql_fetch_array(mysql_query("select sum(nilai) as total_kredit from arus_kas where tipe_kas='kredit'  and  kd_bank<>'' and kd_bank<>'Pilih'")));
	
													echo number_format($num_debet['total_debet']-$num_kredit['total_kredit']);
													?>
                                    </h3>
                                    <p>
                                      Total 
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <a href="?page=arus.kas" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
<?php /*
	<div class="col-xs-6">
       <div id="container"	 style="min-width: 400px; height: 400px; margin: 0 auto"></div>
    </div>
    <div class="col-xs-6"><div id="container2" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
    </div>
    <div class="col-xs-6"><div id="container3" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
    </div>
  */ ?>							<div class="box-footer clearfix" style="border-top: 0px !important;background: #1b1b1b !important">
																
                                </div>
                                </div>
				</div>
</div>
	</div>
					<!-- /.content --><?php } ?>
		</section>			
  </div>
</div>
                           
