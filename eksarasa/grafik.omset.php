<?php
if(isset($_POST['filter_sampai'])){
$filter_dari=$_POST['filter_dari'];
$filter_sampai=$_POST['filter_sampai'];
}else{
$filter_sampai=date("Y");
$filter_dari=date("Y");
}

$no=1;

?>

<script src="js/chart/highcharts.js"></script>
<script src="js/chart/highcharts-3d.js"></script>
<script src="js/chart/exporting.js"></script>
<section class="content-header">
	<h1>
		Grafik Omset<small></small>
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
        <h3 class="panel-title"><i class="fa fa-list"></i>  List</h3>
      </div>
      <div class="panel-body">
      
        <form action="?page=<?Php echo $page ?>" method="post">
        <div class="well">
          <div class="row">
          
           
            <div class="col-sm-4">
              <div class="form-group">
	                <label class="control-label" for="input-price">Tahun</label>
    	            <div class="input-group">
        	        	<select name="filter_sampai"class="form-control">
        	        			<option value="2018" <?php if(@$filter_sampai=="2018") echo "selected" ?> >2018</option>
        	        				<option value="2019" <?php if(@$filter_sampai=="2019") echo "selected" ?> >2019</option>
        	        				<option value="2020" <?php if(@$filter_sampai=="2020") echo "selected" ?> >2020</option>
        	        	</select>
                   			
                    	<div class="input-group-addon">
                        	<i class="fa fa-calendar"></i>
                        </div>
                    </div>
              </div>
              
               <button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
            </div>
          
          </div>
        </div>
         </form>
      
      
      <script type="text/javascript">
	var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container5',
            type: 'column'
         },   
         title: {
            text: 'Penjualan Tahun <?php echo $filter_sampai ?> ( <?php $qty_jual=mysql_fetch_array(mysql_query("select sum(total) as jum,tgl_jual from penjualan where   year(tgl_jual)='".$filter_sampai."'")); echo  number_format($qty_jual['jum'])?> )'
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


for ($i = 1; $i <= 12; $i++) {    
			$qty_jual=mysql_fetch_array(mysql_query("select sum(total) as jum,tgl_jual from penjualan where  month(tgl_jual)='".$i."' and year(tgl_jual)='".$filter_sampai."'"));
	if(!empty($qty_jual['jum'])) {
	  ?>
	  {
		  name: '<?php echo date("M",strtotime($qty_jual['tgl_jual'])) ?>',
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
            renderTo: 'container7',
            type: 'column'
         },   
         title: {
            text: 'Pembelian Tahun <?php echo $filter_sampai ?> ( <?php $qty_jual=mysql_fetch_array(mysql_query("select sum(total) as jum,tgl_beli from pembelian where   year(tgl_beli)='".$filter_sampai."'")); echo  number_format($qty_jual['jum'])?> )'
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


for ($i = 1; $i <= 12; $i++) {    
			$qty_jual=mysql_fetch_array(mysql_query("select sum(total) as jum,tgl_beli from pembelian where  month(tgl_beli)='".$i."' and year(tgl_beli)='".$filter_sampai."'"));
	if(!empty($qty_jual['jum'])) {
	  ?>
	  {
		  name: '<?php echo date("M",strtotime($qty_jual['tgl_beli'])) ?>',
		  data: [<?php echo $qty_jual['jum'] ; ?>]
	  },
	  <?php }  }	 ?>
]
});
});	
</script>
        <div class="row">
        <div class="col-sm-12"><div id="container5" style= "margin: 0 auto"></div>
		</div>
     <div class="col-sm-12"><div id="container7" style=" margin: 0 auto"></div>
		</div>
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
