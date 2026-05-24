<?php
include "koneksi.php";
koneksi_buka();


?>
<div class="page-header">
    <div class="container-fluid">
     
      <h1>Orders</h1>
     
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
                                    Data <code><?php echo $_GET['pesan'] ?></code> berhasil dihapus                                    
                                </div><!-- /.box-body -->
                            </div>
</div><?php } ?>                            
<div class="container-fluid" style="padding-right:5px;padding-left:5px">
            <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Order List</h3>
      </div>
      <div class="panel-body">
      <form action="?page=<?Php echo $page ?>" method="post">
        <div class="well">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-name">Order ID</label>
                <input type="text" name="filter_id" value="<?php echo @$_POST['filter_id'] ?>" placeholder="Order Id" id="input-name" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-model">Customer</label>
                <input type="text" name="filter_customer" value="<?php echo @$_POST['filter_customer'] ?>" placeholder="Customer" id="input-model" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
	                <label class="control-label" for="input-price">Date Added</label>
    	            <div class="input-group">
        	        	<input type="text" name="filter_date_added" value="<?php echo @$_POST['filter_date_added'] ?>" placeholder="Date Added" id="dp1" class="form-control">
                    	<div class="input-group-addon">
                        	<i class="fa fa-calendar"></i>
                        </div>
                    </div>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-model">Total</label>
                <input type="text" name="filter_total" value="<?php echo @$_POST['filter_total'] ?>" placeholder="Total" id="input-model" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
              </div>
              
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-status">Status</label>
                <select name="filter_status" id="input-status" class="form-control">
                  <option value=""></option>
                                    <option value="Y" <?php if(@$_POST['filter_status']=="Y")  echo "selected" ?>>Success</option>
                                     <option value="V" <?php if(@$_POST['filter_status']=="V")  echo "selected" ?>>Verified</option>
                                     <option value="S" <?php if(@$_POST['filter_status']=="S")  echo "selected" ?>>Being verified</option>
                                    <option value="N" <?php if(@$_POST['filter_status']=="N")  echo "selected" ?>>Not confirmed yet</option>
                                  </select>
              </div>
              <button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
            </div>
          </div>
        </div>
         </form>
        <form action="http://localhost/opencart/upload/admin/index.php?route=catalog/product/delete&amp;token=TvthUB0fpnYKRqAYZYgsYn3RFzeFJBMC" method="post" enctype="multipart/form-data" id="form-product">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                 
                     <td class="text-left">        Order ID
                    </td>
                  <td class="text-left">         Customer Name
                    </td>
                      <td class="text-left">                 Total
                    </td>
          
                
                  <td class="text-left">        Status
                    </td>
                   
                     <td class="text-left">              Date Added
                    </td> <td class="text-left">    Corfirm Payment
                    </td> <td class="text-left">              Packing
                    </td>
                  <td class="text-right">Action</td>
                </tr>
              </thead>
              <tbody>
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
										
										$qry=mysql_query("select *,penjualan.status as status from penjualan,customer where  penjualan.username=customer.username and kd_penjualan like '%".@$_POST['filter_id']."%' and nama like '%".@$_POST['filter_customer']."%' and total like '%".@$_POST['filter_total']."%'  and  tgl_penjualan like '%".@$_POST['filter_date_added']."%' and penjualan.status like '%".@$_POST['filter_status']."%' order by tgl_penjualan desc LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                                <tr>
               
                <td class="text-left"><?php echo "$row[kd_penjualan]"; ?></td>
                  <td class="text-left"><b><?php echo "$row[nama]"; ?></b><br>
                  <?php echo "$row[username]"; ?>
                  </td>
                                       <td class="text-left" align="right">Rp. <?php echo number_format($row['total']); ?></td>
                  
              
                  <td class="text-left"> <?php if($row['status']=="Y"){ ?><span class="label label-success">Success</span><?php }elseif($row['status']=="V"){ ?><span class="label label-info">Verified</span><?php }elseif($row['status']=="S"){
				   ?>
                   <span class="label label-warning">Being verified</span>
				  <?php  }else{ ?><span class="label label-danger">Not confirmed yet</span><?php } ?></td>
                  
                  <td class="text-right">                   
    <?php echo date("d-m-Y",strtotime($row['tgl_penjualan'])) ?>                                    
                    </td>
 <td class="text-left" align="right"><?php 
 $query=mysql_query("select * from confirm_finance where kd_penjualan='".$row['kd_penjualan']."'");
 $confirm_finance=mysql_fetch_array	($query);
 $jum_confirm_finance=mysql_num_rows	($query);
 if($jum_confirm_finance > 0) {
	 echo "".$confirm_finance['nama']."<br><br>";
	 
	 echo "Tgl : ".date("d M Y",strtotime($confirm_finance['tgl_confirm_finance']))."<br>";
	 	 echo "Jam : ".date("H:i",strtotime($confirm_finance['tgl_confirm_finance']));
	 
	 
	  }else{

	 };
  ?></td>
   <td class="text-left" align="right"><?php 
 $query=mysql_query("select * from confirm_logistik where kd_penjualan='".$row['kd_penjualan']."'");
 $confirm_logistik=mysql_fetch_array	($query);
 $jum_confirm_logistik=mysql_num_rows	($query);
 if($jum_confirm_logistik > 0) {
	 echo "".$confirm_logistik['nama']."<br><br>";
	 
	 echo "Tgl : ".date("d M Y",strtotime($confirm_logistik['tgl_logistik']));

	   echo "<br>No Resi : ".$confirm_logistik['no_tracking'];
	 
	  }else{

	 };
  ?></td>
                  <td class="text-right">
                  <a href="report.shipping.php?inv=<?php echo $row['kd_penjualan'] ?>" target="_blank" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Print Shipping List"><i class="fa fa-truck"></i></a>
                   <a href="report.order.php?inv=<?php echo $row['kd_penjualan'] ?>" target="_blank" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Print Invoice"><i class="fa fa-print"></i></a>
                  <a href="view.order.php?inv=<?php echo $row['kd_penjualan'] ?>" target="_blank" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="View"><i class="fa fa-eye"></i></a>
                  
                  <a href="?page=edit.orders&id=<?php echo $row['kd_penjualan'] ?>&next=products" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                  
                  <a  href="hapus.orders.php?id=<?php echo $row['kd_penjualan'] ?>" class="btn btn-danger hapus" ><i class="fa fa-trash-o"></i></a>	
                  </td>
                </tr><?PHP } ?>
                     
                                              </tbody>
            </table>
          </div>
        </form>
        <div class="row" style="padding-right:5px;padding-left:5px">
         <div class="box-footer clearfix">
								<?php 
									$query  = "SELECT COUNT(penjualan.username) AS jumData FROM penjualan,customer where penjualan.username=customer.username and kd_penjualan like '%".@$_POST['filter_id']."%' and nama like '%".@$_POST['filter_customer']."%' and total like '%".@$_POST['filter_total']."%'   and  tgl_penjualan like '%".@$_POST['filter_date_added']."%' and penjualan.status like '%".@$_POST['filter_status']."%'";
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
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=".$_GET['page']."&kategori=".@$kategori."&sub-kategori=".@$sub_kategori."&hal=".$i."'>".$i."</a></li>";
										 }
								}
								?>
                                </ul>
								<label style="float:right;margin-top:5px;">
									Page :&nbsp;&nbsp;
								</label>
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
