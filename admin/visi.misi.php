<?php
include "koneksi.php";
koneksi_buka(); 
?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
  
      </div>
      <h1>Visi & Misi</h1>
     
    </div>
  </div>
  <div class="container-fluid" style="padding-right:5px;padding-left:5px">
            <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Visi & Misi List</h3>
      </div>
      <div class="panel-body">
        <form action="http://localhost/opencart/upload/admin/index.php?route=catalog/information/delete&amp;token=TvthUB0fpnYKRqAYZYgsYn3RFzeFJBMC" method="post" enctype="multipart/form-data" id="form-information">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                 
                  <td class="text-left">   Title
                    </td>
                  <td class="text-right">        Sort Order
                    </td>
                  <td class="text-right">Action</td>
                </tr>
              </thead>
              <tbody>
              
              <?php
										
										$i=1;
										
										$qry=mysql_query("select * from visi_misi order by sort_by");
										while($row=mysql_fetch_array($qry)){
										?>
                                                <tr>
          
                  <td class="text-left"><?php 
				  
				  echo $row['judul']; ?></td>
                  <td class="text-right"><?php echo  $row['sort_by'] ?></td>
                  <td class="text-right"><a href="?page=post.visi.misi&action=edit&id=<?php echo $row['id']?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a></td>
                </tr>
                
                     <?php } ?>
                                              </tbody>
            </table>
          </div>
        </form>
        
      </div>
    </div>
  </div>
</div>