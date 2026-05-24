<?php
if(isset($_POST['filter_dari'])){
$filter_dari=$_POST['filter_dari'];
$filter_sampai=$_POST['filter_sampai'];
}else{
$filter_sampai=date("Y-m-d");
$filter_dari=date("Y-m-01");
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
<section class="content-header">
	<h1>
		Grafik Barang<small></small>
    </h1>
</section>
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
       <h3 class="panel-title" style="max-width: 250px;display: inline-block"><i class="fa fa-list"></i> List </h3> <button class="btn btn-default pull-right" id="myelement" ><i class="fa fa-search"></i></button>
      </div>
      <div class="panel-body">
        <form action="?page=<?Php echo $page ?>" method="post">
         <div class="well" id="another-element" style="<?php if(isset($_POST['submit'])) {echo "display:block";}else{ echo "display:none"; }  ?>">
          <div class="row">
          
           <div class="col-sm-4 col-xs-6">
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
            <div class="col-sm-4 col-xs-6">
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
            <div class="col-sm-4 col-xs-12">
             <div class="form-group">
                <label class="control-label" for="input-name">Customer</label>
                <input type="text" name="filter_nama" value="<?php echo @$filter_nama ?>" placeholder="Customer" id="input-name" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
              </div>
              	
              <button type="submit" id="button-filter" class="btn btn-primary pull-right" name="submit"><i class="fa fa-search"></i> Filter</button>
            </div>
          </div>
        </div>
         </form>
        <?php  if(isMobile()){ ?>
          <script type="text/javascript">
														var chart1; // globally available
													$(document).ready(function() {
														  chart1 = new Highcharts.Chart({
															 chart: {
																renderTo: 'container2',
																type: 'bar'
															 },
															  title: {
																	text: 'Stok Barang '
																},
																
																xAxis: {
																	categories: [<?php
													if(!empty($filter_sub_kategori)){
												  
											
														  $qrynama=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."' and nama_barang like '%".@$filter_nama."%' order by kategori_barang.kode_kategori_barang,id,nama_barang asc");
											  }elseif(!empty($filter_kategori)){
												 
												    $qrynama=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and nama_barang like '%".@$filter_nama."%' order by kategori_barang.kode_kategori_barang,id,nama_barang asc");
											  }else{
													$qrynama=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' order by kategori_barang.kode_kategori_barang,id,nama_barang asc");}
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
															  name: 'Stok',
															  data: [<?php 

if(!empty($filter_sub_kategori)){
												  
											
														  $qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."' and nama_barang like '%".@$filter_nama."%' order by kategori_barang.kode_kategori_barang,id,nama_barang asc");
											  }elseif(!empty($filter_kategori)){
												 
												    $qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and nama_barang like '%".@$filter_nama."%' order by kategori_barang.kode_kategori_barang,id,nama_barang asc");
											  }else{
													$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' order by kategori_barang.kode_kategori_barang,id,nama_barang asc");}
													while($row=mysql_fetch_array($qry)){
														$qty_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from pembelian_detail where kode_barang='".$row['kode_barang']."'"));
												$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail where kode_barang='".$row['kode_barang']."'"));
											$stok_keluar=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_keluar where kode_barang='".$row['kode_barang']."'"));
											$stok_masuk=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_masuk where kode_barang='".$row['kode_barang']."'"));
	
											$stok=($qty_beli[0]+$row['stok']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]; 
												 ?><?php echo $stok ; ?>,<?php  } ?>]
														  },
														  
													]
													});
													});	
													</script>
        <?php }else{ ?>
        <script type="text/javascript">
	var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container2',
            type: 'column'
         },   
         title: {
            text: 'Grafik Barang'
         },
			
		 plotOptions: {
                column: {
					
                    dataLabels: {
                        enabled: true
                    },
                   
                }
            },
		 credits: {
    enabled: false
  },
         xAxis: {
            categories: ['Jumlah ']
         },
         yAxis: {
            title: {
               text: 'Jumlah'
            },
			labels: {
            formatter: function () {
                return Highcharts.numberFormat(this.value,0);
            }
			}
         },
               series:             
            [
<?php 
if(!empty($filter_sub_kategori)){


		  $qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."' and nama_barang like '%".@$filter_nama."%' ");
	
}elseif(!empty($filter_kategori)){
	  $qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and nama_barang like '%".@$filter_nama."%' order by kategori_barang.kode_kategori_barang,id,nama_barang ");
}else{
	


$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id");
	}
while($row=mysql_fetch_array($qry)){
		$qty_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from pembelian_detail where kode_barang='".$row['kode_barang']."'"));
												$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail where kode_barang='".$row['kode_barang']."'"));
											$stok_keluar=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_keluar where kode_barang='".$row['kode_barang']."'"));
											$stok_masuk=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_masuk where kode_barang='".$row['kode_barang']."'"));
	
											$stok=($qty_beli[0]+$row['stok']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]; 
											  
	  ?>
	  {
		  name: '<?php echo $row['nama_barang'] ?>',
		  data: [<?php echo $stok ; ?>]
	  },
	  <?php  } ?>
]
});
});	
</script><?php } ?>
        
          <script type="text/javascript">
	var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container3',
            type: 'column'
         },   
         title: {
            text: 'Rata2 Barang Perbulan'
         },
			
		 plotOptions: {
                column: {
					
                    dataLabels: {
                        enabled: true
                    },
                   
                }
            },
		 credits: {
    enabled: false
  },
         xAxis: {
            categories: ['Jumlah ']
         },
         yAxis: {
            title: {
               text: 'Jumlah'
            },
			labels: {
            formatter: function () {
                return Highcharts.numberFormat(this.value,0);
            }
			}
         },
               series:             
            [
<?php 


$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id");
while($row=mysql_fetch_array($qry)){
	
												$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail,penjualan where kode_barang='".$row['kode_barang']."' and penjualan_detail.no_jual=penjualan.no_jual and tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' "));
										$sp=date("m",strtotime($filter_sampai));
										$dr=date("m",strtotime($filter_dari));
	
										$pembagi=($sp-$dr)+1;
											$stok=$qty_jual['jum']/$pembagi; 
						
	  ?>
	  {
		  name: '<?php echo $row['nama_barang'] ?>',
		  data: [<?php echo round($stok) ; ?>]
	  },
	  <?php  } 	 ?>
]
});
});	
</script>
   
        
           <script type="text/javascript">
	var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container5',
            type: 'column'
         },   
         title: {
            text: 'Barang Laris'
         },
			
		 plotOptions: {
                column: {
					
                    dataLabels: {
                        enabled: true
                    },
                   
                }
            },
		 credits: {
    enabled: false
  },
         xAxis: {
            categories: ['Jumlah ']
         },
         yAxis: {
            title: {
               text: 'Jumlah'
            },
			labels: {
            formatter: function () {
                return Highcharts.numberFormat(this.value,0);
            }
			}
         },
               series:             
            [
<?php 


$qry=mysql_query("select * from barang ");
while($row=mysql_fetch_array($qry)){
			$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail where kode_barang='".$row['kode_barang']."'"));
	if($qty_jual['jum']>0){
	  ?>
	  {
		  name: '<?php echo $row['nama_barang'] ?>',
		  data: [<?php echo $qty_jual['jum'] ; ?>]
	  },
	  <?php }  }	 ?>
]
});
});	
</script>
	
           <script type="text/javascript">
	var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container8',
            type: 'column'
         },   
         title: {
            text: 'Barang Laris Tgl <?php echo $filter_dari." - ".$filter_sampai ?>'
         },
			
		 plotOptions: {
                column: {
					
                    dataLabels: {
                        enabled: true
                    },
                   
                }
            },
		 credits: {
    enabled: false
  },
         xAxis: {
            categories: ['Jumlah ']
         },
         yAxis: {
            title: {
               text: 'Jumlah'
            },
			labels: {
            formatter: function () {
                return Highcharts.numberFormat(this.value,0);
            }
			}
         },
               series:             
            [
<?php 


$qry=mysql_query("select * from barang ");
while($row=mysql_fetch_array($qry)){
			$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail,penjualan where penjualan_detail.no_jual=penjualan.no_jual and tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' and kode_barang='".$row['kode_barang']."'"));
	if($qty_jual['jum']>0){
	  ?>
	  {
		  name: '<?php echo $row['nama_barang'] ?>',
		  data: [<?php echo $qty_jual['jum'] ; ?>]
	  },
	  <?php }  }	 ?>
]
});
});	
</script>
		<div class="row"><div class="col-sm-12">
		  <?php  if(isMobile()){ ?>
		<div id="container2" style="height: <?php if($jumlah_orang >= 15 ){   echo $jumlah_orang * 25 ;}elseif($jumlah_orang >= 6 ){ echo 500; }elseif($jumlah_orang >= 1 ){ echo 200; }?>px;"></div><?php }else{ ?><div id="container2" style=" margin: 0 auto"></div><?php }?>
		</div>
	<div class="col-sm-12"><div id="container3" style=" margin: 0 auto"></div>
		</div>
    
        <div class="col-sm-12"><div id="container5" style=" margin: 0 auto"></div>
		</div>
       <div class="col-sm-12"><div id="container8" style=" margin: 0 auto"></div>
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
