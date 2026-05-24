<?php
if(isset($_POST['filter_dari'])){
$filter_dari=$_POST['filter_dari'];
}else{

$filter_dari=date("Y-m-d");
}
$no=1;

?>

<script src="js/chart/highcharts.js"></script>
<script src="js/chart/highcharts-3d.js"></script>
<script src="js/chart/exporting.js"></script>

 <section class="content-header">
	 <h1>Grafik Cash Bulanan</h1>
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
         <h3 class="panel-title" style="max-width: 250px;display: inline-block"><i class="fa fa-list"></i>  List </h3> <button class="btn btn-default pull-right" id="myelement" ><i class="fa fa-search"></i></button>
      </div>
      <div class="panel-body">
      
      
        <form action="?page=<?Php echo $page ?>" method="post">
        <div class="well" id="another-element" style="<?php if(isset($_POST['submit'])) {echo "display:block";}else{ echo "display:none"; }  ?>">
          <div class="row">
          
            <div class="col-sm-4 col-xs-6 ">
              <div class="form-group">
                <label class="control-label" for="input-name">Bulan</label>
               
                <div class="input-group">
        	        	<input name="filter_dari" type="text" class="form-control" id="dp2" placeholder="Date Added" value="<?php echo @$filter_dari ?>" readonly>
                    	<div class="input-group-addon">
                        	<i class="fa fa-calendar"></i>
                        </div>
                    </div>
              </div>
          	 <button type="submit" id="button-filter" class="btn btn-primary pull-right"  name="submit"><i class="fa fa-search"></i> Filter</button>
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
            text: 'Pemasukan Tahun <?php echo date('Y',strtotime($filter_dari)) ?> ( <?php $qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum,tanggal from pemasukan where   year(tanggal)='".date('Y',strtotime($filter_dari))."'")); echo  number_format($qty_jual['jum'])?> )'
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
			$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum,tanggal from pemasukan where  month(tanggal)='".$i."' and year(tanggal)='".date('Y',strtotime($filter_dari)) ."'"));
	if(!empty($qty_jual['jum'])) {
	  ?>
	  {
		  name: '<?php echo date("M",strtotime($qty_jual['tanggal'])) ?>',
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
            text: 'Pengeluaran Tahun <?php echo date('Y',strtotime($filter_dari))  ?> ( <?php $qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum,tanggal from pengeluaran where   year(tanggal)='".date('Y',strtotime($filter_dari)) ."'")); echo  number_format($qty_jual['jum'])?> )'
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
			$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum,tanggal from pengeluaran where  month(tanggal)='".$i."' and year(tanggal)='".date('Y',strtotime($filter_dari)) ."'"));
	if(!empty($qty_jual['jum'])) {
	  ?>
	  {
		  name: '<?php echo date("M",strtotime($qty_jual['tanggal'])) ?>',
		  data: [<?php echo $qty_jual['jum'] ; ?>]
	  },
	  <?php }  }	 ?>
]
});
});	
</script>
        <div class="row" >
        <div class="col-sm-12"><div id="container5" style=" margin: 0 auto"></div>
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
