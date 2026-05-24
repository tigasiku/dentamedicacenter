<?php
if(isset($_POST['filter_dari'])){
$filter_dari=$_POST['filter_dari'];
$filter_sampai=$_POST['filter_sampai'];
}else{
$filter_sampai=date("Y-m-d");
$filter_dari=date("Y-m-d");
}
?>

<script src="js/chart/highcharts.js"></script>
<script src="js/chart/highcharts-3d.js"></script>
<script src="js/chart/exporting.js"></script>
<div class="page-header">
    <div class="container-fluid">
     
       
      <h1>Grafik Customer</h1>
     
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
                <label class="control-label" for="input-name"></label>
                <input type="text" name="filter_id" value="<?php echo @$_POST['filter_id'] ?>" placeholder="Order Id" id="input-name" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
              </div>	
              <button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
            </div>
          </div>
        </div>
         </form>
        <form action="http://localhost/opencart/upload/admin/index.php?route=catalog/product/delete&amp;token=TvthUB0fpnYKRqAYZYgsYn3RFzeFJBMC" method="post" enctype="multipart/form-data" id="form-product">
       
        <script type="text/javascript">
	var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container2',
            type: 'column'
         },   
         title: {
            text: 'Grafik Customer'
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

if(isset($_POST['filter_dari'])){
	$qry=mysql_query("select customer from penjualan where tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' group by customer");
}else{
	
	$qry=mysql_query("select customer from penjualan group by customer");
}
			 
while($row=mysql_fetch_array($qry)){
	
		if(isset($_POST['filter_dari'])){
		$qty_beli=mysql_fetch_array(mysql_query("select sum(total) as jum from penjualan where tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' and  customer='".$row['customer']."'"));
		}else{
		
			$qty_beli=mysql_fetch_array(mysql_query("select sum(total) as jum from penjualan where customer='".$row['customer']."'"));
		}									
	  ?>
	  {
		  name: '<?php echo $row['customer'] ?>',
		  data: [<?php echo  $qty_beli['jum'] ; ?>]
	  },
	  <?php  } ?>
]
});
});	
</script>
        <script type="text/javascript">
	var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container3',
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

if(isset($_POST['filter_dari'])){
	$qry=mysql_query("select penjualan_detail.kode_barang,nama_barang from penjualan,penjualan_detail,barang where penjualan.no_jual=penjualan_detail.no_jual and barang.kode_barang=penjualan_detail.kode_barang and  tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' group by penjualan_detail.kode_barang");
}else{
	
	$qry=mysql_query("select kode_barang,nama_barang from barang group by kode_barang");
}
			 
while($row=mysql_fetch_array($qry)){
	
		if(isset($_POST['filter_dari'])){
		$qty_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan,penjualan_detail where  penjualan.no_jual=penjualan_detail.no_jual and tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' and  kode_barang='".$row['kode_barang']."'"));
		}else{
		
			$qty_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail where kode_barang='".$row['kode_barang']."'"));
		}									
	  ?>
	  {
		  name: '<?php echo $row['nama_barang'] ?>',
		  data: [<?php echo  $qty_beli['jum'] ; ?>]
	  },
	  <?php  } ?>
]
});
});	
</script>
 
        
       
		<div class="col-sm-12"><div id="container2" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
		</div>
		<div class="col-sm-12"><div id="container3" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
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
</script><script src="js/sub_kat_barang.js" type="text/javascript"></script> 
