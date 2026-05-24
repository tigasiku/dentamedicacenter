<?php
include "koneksi.php";
koneksi_buka(); 
?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
  
      </div>
      <h1>Information</h1>
     
    </div>
  </div>
  <div class="container-fluid" style="padding-right:5px;padding-left:5px">
            <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Information List</h3>
      </div>
      <div class="panel-body">
        <form action="http://localhost/opencart/upload/admin/index.php?route=catalog/information/delete&amp;token=TvthUB0fpnYKRqAYZYgsYn3RFzeFJBMC" method="post" enctype="multipart/form-data" id="form-information">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                 
                  <td class="text-left">                    <a href="http://localhost/opencart/upload/admin/index.php?route=catalog/information&amp;token=TvthUB0fpnYKRqAYZYgsYn3RFzeFJBMC&amp;sort=id.title&amp;order=DESC" class="asc">Information Title</a>
                    </td>
                  <td class="text-right">                    <a href="http://localhost/opencart/upload/admin/index.php?route=catalog/information&amp;token=TvthUB0fpnYKRqAYZYgsYn3RFzeFJBMC&amp;sort=i.sort_order&amp;order=DESC">Sort Order</a>
                    </td>
                  <td class="text-right">Action</td>
                </tr>
              </thead>
              <tbody>
              
              <?php
										
										$i=1;
										
										$qry=mysql_query("select * from pengaturan order by sort_by");
										while($row=mysql_fetch_array($qry)){
										?>
                                                <tr>
          
                  <td class="text-left"><?php 
				  
				  $kode=str_replace("_"," ",$row['kode']);
				  echo ucwords($kode); ?></td>
                  <td class="text-right"><?php echo  $row['sort_by'] ?></td>
                  <td class="text-right"><a href="?page=post.informasi&action=edit&id=<?php echo $row['kode']?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a></td>
                </tr>
                
                     <?php } ?>
                                              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"></div>
          <div class="col-sm-6 text-right">Showing 1 to 4 of 4 (1 Pages)</div>
        </div>
      </div>
    </div>
  </div>
</div>