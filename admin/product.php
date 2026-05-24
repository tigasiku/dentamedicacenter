<?php
include "koneksi.php";
koneksi_buka();
if(($_GET['page']=="product")) {
										if(isset($_GET['orderby']))
										{
											$orderby=$_GET['orderby'];	
											$_SESSION['orderby']=$orderby;
											$orderby=$_SESSION['orderby'];	
										}else{
											if(isset($_SESSION['orderby'])){
													@$orderby=$_SESSION['orderby'];
											}else{
											$orderby='judul';}
											
										}
										
										if(isset($_GET['urut'])){
											$urut=$_GET['urut'];	
											$_SESSION['urut']=$urut;
											$urut=$_SESSION['urut'];	
										}else{
											if(isset($_SESSION['urut'])){
											@$urut=$_SESSION['urut'];	
											}else{
											$urut='asc';
											}
										}
										
}
if(!empty($_GET['filter_name'])){
	@$filter_name=$_GET['filter_name'];
}else{
	@$filter_name=$_POST['filter_name'];
}

if(!empty($_GET['filter_name'])){
	@$filter_name=$_GET['filter_name'];
}else{
	@$filter_name=$_POST['filter_name'];
}
if(!empty($_GET['filter_isbn'])){
	@$filter_isbn=$_GET['filter_isbn'];
}else{
	@$filter_isbn=$_POST['filter_isbn'];
}
if(!empty($_GET['filter_publisher'])){
	@$filter_publisher=$_GET['filter_publisher'];
}else{
	@$filter_publisher=$_POST['filter_publisher'];
}
if(!empty($_GET['filter_penulis'])){
	@$filter_penulis=$_GET['filter_penulis'];
}else{
	@$filter_penulis=$_POST['filter_penulis'];
}
if(!empty($_GET['filter_status'])){
	@$filter_status=$_GET['filter_status'];
}else{
	@$filter_status=$_POST['filter_status'];
}
?>
<div class="page-header">
    <div class="container-fluid">
      <div class="pull-right" style="padding-right:5px"><a href="?page=tambah.product" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i> Tambah </a>
        
      </div>
      <h1>Products</h1>
     
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
        <h3 class="panel-title"><i class="fa fa-list"></i> Product List</h3>
      </div>
      <div class="panel-body">
      <form action="?page=<?Php echo $page ?>" method="post">
        <div class="well">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-name">Product Name</label>
                <input type="text" name="filter_name" value="<?php echo @$filter_name ?>" placeholder="Product Name" id="input-name" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-model">ISBN</label>
                <input type="text" name="filter_isbn" value="<?php echo @$filter_isbn ?>" placeholder="ISBN" id="input-model" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-price">Publisher</label>
                <input type="text" name="filter_publisher" value="<?php echo @$filter_publisher ?>" placeholder="Publisher" id="input-price" class="form-control">
              </div>
              <div class="form-group">
                <label class="control-label" for="input-quantity">Penulis</label>
                <input type="text" name="filter_penulis" value="<?php echo @$filter_penulis ?>" placeholder="Penulis" id="input-quantity" class="form-control">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-status">Status</label>
                <select name="filter_status" id="input-status" class="form-control">
                  <option value=""></option>
                                    <option value="Y" <?php if(@$filter_status=="Y")  echo "selected" ?>>Enabled</option>
                                    <option value="N" <?php if(@$filter_status=="N")  echo "selected" ?>>Disabled</option>
                                  </select>
              </div>
              <button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
            </div>
          </div>
        </div>
         </form>
        <form action="" method="post" enctype="multipart/form-data" id="form-product">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                 
                  <td class="text-center">Image</td>
                  <td class="text-left">                    <a href="?page=product&orderby=judul&urut=<?php if($urut=="asc") { echo "desc" ; } else { echo "asc";} ?>" class="asc">Product Name</a>
                    </td>
                      <td class="text-left">                    <a href="?page=product&orderby=kategori&urut=<?php if($urut=="asc") { echo "desc" ; } else { echo "asc";} ?>">Kategori</a>
                    </td>
                  <td class="text-left">                    <a href="?page=product&orderby=isbn&urut=<?php if($urut=="asc") { echo "desc" ; } else { echo "asc";} ?>">ISBN</a>
                    </td>
                    <td class="text-right">                    <a href="?page=product&orderby=weight&urut=<?php if($urut=="asc") { echo "desc" ; } else { echo "asc";} ?>">Weight</a>
                    </td>
                  <td class="text-right">                    <a href="?page=product&orderby=harga_jual&urut=<?php if($urut=="asc") { echo "desc" ; } else { echo "asc";} ?>">Price</a>
                    </td>
                
                  <td class="text-left">                    <a href="?page=product&orderby=status&urut=<?php if($urut=="asc") { echo "desc" ; } else { echo "asc";} ?>">Status</a>
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
										
										
										$qry=mysql_query("select * from produk where isbn like '%".@$filter_isbn."%' and judul like '%".@$filter_name."%' and publishernya like '%".@$filter_publisher."%' and  penulis like '%".@$filter_penulis."%'	and status like '%".@$filter_status."%' order by $orderby $urut LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                                <tr>
               
                  <td class="text-center">
                 								<?php
												if ($row['file']==""){
													$photo="../img/no-image.jpg";
												}else{
													$photo="../img/portfolio/thumb/".$row['file']."";
												}
												$harga=$row['harga'];
												?>
                  <img src="<?php echo $photo;?>" alt="<?php echo "$row[judul]"; ?>" style="width:50px;height:60px" class="img-thumbnail">
                    </td>
                  <td class="text-left"><?php echo "$row[judul]"; ?></td>
                      <td class="text-left"><?php echo $row['kategori']."<br>".
					  								" &nbsp;&nbsp;&nbsp;- ".$row['sub_kategori']
					  ; ?></td>
                  <td class="text-left"><?php echo "<b>ISBN : </b>".$row['isbn']."<br><br>
				  <b>Penulis : </b>".$row['penulis']."<br>
				  <b>Publisher : </b>".$row['publishernya']
				  ; ?></td>
                   <td class="text-left"><?php echo $row['weight']; ?></td>
                  <td class="text-right">                   
                  <?php if($row['diskon']>0){?>
                   <span style="text-decoration: line-through;"><?php echo number_format($row['harga']) ?></span><br><?php } ?>
                   
                    <div class="text-danger">   <?php if($row['diskon']>0){ echo number_format(($harga)-(($harga*$row['diskon'])/100));echo " <br>save ".$row['diskon']."%"; }else{echo number_format($harga);} ?></div>
                 
                    </td>
              
                  <td class="text-left"> <?php if($row['status']=="Y"){ ?><span class="label label-success">Enabled</span><?php }else{ ?><span class="label label-danger">Disabled</span><?php } ?></td>
                  <td class="text-right;" style="white-space:nowrap">
                  <a href="proses.best.seller.php?id=<?php echo $row['id'] ?>" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Best Seller"><i class="fa fa-dollar"></i></a>
                  
                  <a href="?page=edit.product&id=<?php echo $row['id'] ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                  
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
									$query  = "SELECT COUNT(id) AS jumData FROM produk where isbn like '%".@$filter_isbn."%' and judul like '%".@$filter_name."%' and publishernya like '%".@$filter_publisher."%' and  penulis like '%".@$filter_penulis."%'	and status like '%".@$filter_status."%'";
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
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=".$_GET['page']."&filter_name=".@$filter_name."&filter_publisher=".@$filter_publisher."&filter_penulis=".@$filter_penulis."&filter_isbn=".@$filter_isbn."&filter_status=".@$filter_status."&hal=".$i."'>".$i."</a></li>";
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
