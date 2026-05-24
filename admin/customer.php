<?php
include "koneksi.php";
koneksi_buka();


										if(isset($_GET['orderby2']))
										{
											$orderby2=$_GET['orderby2'];	
											$_SESSION['orderby2']=$orderby2;
											$orderby2=$_SESSION['orderby2'];	
										}else{
											if(isset($_SESSION['orderby2'])){
													@$orderby2=$_SESSION['orderby2'];
											}else{
											$orderby2='nama';}
											
										}
										
										if(isset($_GET['urut2'])){
											$urut2=$_GET['urut2'];	
											$_SESSION['urut2']=$urut2;
											$urut2=$_SESSION['urut2'];	
										}else{
											if(isset($_SESSION['urut2'])){
											@$urut2=$_SESSION['urut2'];	
											}else{
											$urut2='asc';
											}
										}

?>
<div class="page-header">
    <div class="container-fluid">
      
      <h1>Customer</h1>
     
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
        <h3 class="panel-title"><i class="fa fa-list"></i> Customer List</h3>
      </div>
      <div class="panel-body">
      <form action="?page=<?Php echo $page ?>" method="post">
        <div class="well">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-name">Customer Name</label>
                <input type="text" name="filter_name" value="<?php echo @$_POST['filter_name'] ?>" placeholder="Customer Name" id="input-name" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-model">E-mail</label>
                <input type="text" name="filter_email" value="<?php echo @$_POST['filter_email'] ?>" placeholder="E-mail" id="input-model" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
	                <label class="control-label" for="input-price">Date Added</label>
    	            <div class="input-group">
        	        	<input type="text" name="filter_date" value="<?php echo @$_POST['filter_date_added'] ?>" placeholder="Date Added" id="dp1" class="form-control">
                    	<div class="input-group-addon">
                        	<i class="fa fa-calendar"></i>
                        </div>
                    </div>
              </div>
              
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-status">Status</label>
                <select name="filter_status" id="input-status" class="form-control">
                  <option value=""></option>
                                    <option value="Y" <?php if(@$_POST['filter_status']=="Y")  echo "selected" ?>>Enabled</option>
                                    <option value="N" <?php if(@$_POST['filter_status']=="N")  echo "selected" ?>>Disabled</option>
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
                 
                
                  <td class="text-left">                    <a href="?page=customer&orderby2=nama&urut2=<?php if($urut2=="asc") { echo "desc" ; } else { echo "asc";} ?>" class="asc">Customer Name</a>
                    </td>
                      <td class="text-left">                    <a href="?page=customer&orderby2=username&urut2=<?php if($urut2=="asc") { echo "desc" ; } else { echo "asc";} ?>">E-mail</a>
                    </td>
          
                
                  <td class="text-left">                    <a href="?page=customer&orderby2=status&urut2=<?php if($urut2=="asc") { echo "desc" ; } else { echo "asc";} ?>">Status</a>
                    </td>
                     <td class="text-left">                    <a href="?page=customer&orderby2=bergabung&urut2=<?php if($urut2=="asc") { echo "desc" ; } else { echo "asc";} ?>">Date Added	</a>
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
										
										$qry=mysql_query("select * from customer where username like '%".@$_POST['filter_email']."%' and nama like '%".@$_POST['filter_name']."%'  and  bergabung like '%".@$_POST['filter_date_added']."%' and status like '%".@$_POST['filter_status']."%' order by $orderby2 $urut2 LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                                <tr>
               
                
                  <td class="text-left"><?php echo "$row[nama]"; ?></td>
                                       <td class="text-left"><?php echo "$row[username]"; ?></td>
                  
              
                  <td class="text-left"> <?php if($row['status']=="Y"){ ?><span class="label label-success">Enabled</span><?php }else{ ?><span class="label label-danger">Disabled</span><?php } ?></td><td class="text-right">                   
    <?php echo date("d-m-Y",strtotime($row['bergabung'])) ?>                                    
                    </td>
                  <td class="text-right"><a href="?page=edit.product&id=<?php echo $row['id'] ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                  
                  <a  href="hapus.product.php?id=<?php echo $row['id'] ?>&file=<?php echo $row['file'] ?>" class="btn btn-danger hapus" ><i class="fa fa-trash-o"></i></a>	
                  </td>
                </tr><?PHP } ?>
                     
                                              </tbody>
            </table>
          </div>
        </form>
        <div class="row" style="padding-right:5px;padding-left:5px">
         <div class="box-footer clearfix">
								<?php 
									$query  = "SELECT COUNT(username) AS jumData FROM customer where username like '%".@$_POST['filter_email']."%' and nama like '%".@$_POST['filter_name']."%'  and  bergabung like '%".@$_POST['filter_date_added']."%' and status like '%".@$_POST['filter_status']."%' ";
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
