<?php
if(isset($_POST['filter_dari'])){
$filter_dari=$_POST['filter_dari'];

}
elseif(isset($_GET['filter_dari'])){
$filter_dari=$_GET['filter_dari'];

}

else{
$filter_sampai=date("Y-m-d");
$filter_dari=date("Y-m-d");
	$filter_jenis="";
}
?>

<?php  if(isMobile()){ ?>

<div style="margin: 10px 0 20px;">
	
</div>
<?Php }else{ ?>

  <section class="content-header">
	<h1>
		Report Customer<small></small>
    </h1>
</section>
  <?php } ?>
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
          
            </div>
           
            <div class="col-sm-4 col-xs-12">
             <div class="form-group">
                <label class="control-label" for="input-name">Kepala Tukang</label>
               
                
                 	<select name="filter_nama" class="form-control">
              			
              			
					<?php
						
							$qry_tukang=mysql_query("select *  from  customer ");
							while($tukang=mysql_fetch_array($qry_tukang)){
						?>
              			<option value="<?php echo $tukang['customer'] ?>" <?php if($tukang['customer'] == @$filter_nama) echo "selected" ?>><?php echo $tukang['customer'] ?></option><?php } ?>
              	</select>
              </div>
              	
              <button type="submit" id="button-filter" class="btn btn-primary pull-right"  name="submit"><i class="fa fa-search"></i> Filter</button>
            </div>
          </div>
        </div>
         </form>
            
                                   <h4 align="left"><?Php echo $store['store_name'] ?><br>	
                                   	<b><?PHP echo  @$filter_nama ?></b>	
<br>
        </h4>
        <form action="http://localhost/opencart/upload/admin/index.php?route=catalog/product/delete&amp;token=TvthUB0fpnYKRqAYZYgsYn3RFzeFJBMC" method="post" enctype="multipart/form-data" id="form-product">
        
           
         <?php $bln=date("m",strtotime($filter_dari));
					   $thn=date("Y",strtotime($filter_dari));
					   $month_end =  cal_days_in_month(CAL_GREGORIAN, $bln, $thn); 
					   $filter_sampai=$thn."-".$bln."-".$month_end; ?>
           <div class="table-responsive">
             <table class="table table-hover table-bordered" style="margin-top:10px;">
               <tr>
                 <th style="text-align:center;vertical-align: middle" rowspan="2">No</th>
                 <th rowspan="2" style="text-align:center;vertical-align: middle">Uraian</th>
            
                  <th colspan="<?php echo $month_end ?>" style="text-align:center;"><?php echo date("F",strtotime($filter_dari)); ?> <?php echo date("Y",strtotime($filter_dari)); ?></th>
               
                 <th rowspan="2" style="text-align:center;vertical-align: middle">Jumlah</th>
               </tr>
               <tr>
                 <?php for ($i= 1; $i <= $month_end; $i++){ ?>
                  <th ><?php echo $i ?></th>
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
													
					   						$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang,penjualan_detail,penjualan where penjualan_detail.no_jual=penjualan.no_jual and barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and customer like '%".@$filter_nama."%'  and  barang.kode_barang=penjualan_detail.kode_barang and  tgl_jual between '".@$filter_dari."' and '".@$filter_sampai."' group by barang.kode_barang");
											
										while($row=mysql_fetch_array($qry)){
										?>
               <tr>
                 <td align="center"><?php echo $i;?></td>
                  <td><?php echo $row['nama_barang']  ?></td>
                <?php for ($g= 1; $g <= $month_end; $g++){ ?>
           
                  
                  
                   <td><?php  $qrysum=mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from penjualan_detail,penjualan where penjualan_detail.no_jual=penjualan.no_jual and  kode_barang='".$row['kode_barang']."' and customer ='".@$row['customer']."'  and   day(tgl_jual)='".$g."'  and   month(tgl_jual)='".date("m",strtotime($filter_dari))."'   and   year(tgl_jual)='".date("Y",strtotime($filter_dari))."'"));
									echo	$qrysum[0]	;
														  
														  @$total_sum=$qrysum[0]+@$total_sum;
									?></td>
                  <?php } ?>
                
                 <td style="text-align:center;font-weight: 600"><?php echo $total_sum; ?></td>
               </tr>
               <?php
											$total_sum=0;
										$i++;
										}
										?>
           
             </table>
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
<script src="js/sub_kat_barang.js" type="text/javascript"></script> <strong></strong>