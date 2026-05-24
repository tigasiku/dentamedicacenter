<?php

include "koneksi.php";
?>


<div class="modal fade" id="listcus" tabindex="-1" role="dialog" aria-labelledby="listcus" aria-hidden="true"  style="z-index:77040 !important" >
<div class="modal-dialog" style="margin-top:40px">
        <div class="modal-content">
          <?php if(isset($_GET['tambah'])){
				include("tambah.vendor.php");
			}else{?>
<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                          <div class="box box-primary" style="padding-left: 15px;
    padding-right: 15px;">
                            <div class="box-header">
                               
                          </div><!-- /.box-header -->
                                  <div class="pull-left" style="padding-right:5px">	<a href="?page=<?php echo $_GET['page'] ?>&listmodaluser&tambah" class="btn btn-danger btn-flat" style="float:left;"><i class="fa fa-plus"></i> </a>
        
      </div>
                              <form action="?page=<?php echo $_GET['page'] ?>&listmodaluser" method="post">
										<div class="input-group">
                                            <input name="cari" class="form-control input-sm pull-right" style="max-width: 200px" placeholder="Cari" value="<?php echo @$_POST['cari'] ?>"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
										</form>
                                  <table class="table table-hover table-bordered" style="margin-top:10px;font-size: <?php  if(isMobile()){ echo "13px"; } else{ echo "13px !important";} ?>;">
                                      <tr>
                                          <th style="text-align:center;">No</th>
										  <th >Nama</th>
                                       
                                       
                                            <th >No Telp</th>
                                      </tr>
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
										
										
									
										 
										
										$qry=mysql_query("select * from vendor where vendor like '%".@$_POST['cari']."%'   LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                        
                                 
                                      <tr onclick="javascript:setBrg('<?php echo $row['0'] ?>','<?php echo $row['vendor'] ?>')" style="font-size: <?php  if(isMobile()){ echo "13px"; } else{ echo "13px !important";} ?>;" class="use-address2">
                                          <td align="center"><?php echo $i;?></td>
										 
                                          <td><span class="nama"><?php echo  $row[1] ?></span></td>
                                               <td><?php echo  $row[2] ?></td>
                                      </tr>
                                      <?php
										$i++;
										}
										?>
                                  </table>
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
									$query  = "SELECT COUNT(vendor) AS jumData FROM vendor where vendor like '%".@$_POST['cari']."%'";
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
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=".$page."&cari=".@$cari."&hal=".$i."&listmodal'>".$i."</a></li>";
										 }
								}
								?>
                                </ul>
								<label style="float:right;margin-top:5px;">
									Page :&nbsp;&nbsp;
								</label>
                               </div>
                            </div><!-- /.box -->
                        </div>
</section><!-- /.content --><?php } ?>
</div>
</div>
</div>
<?php

?>
 <script>
//<![CDATA[
$(window).load(function(){
	<?php if(isset($_GET['listmodaluser'])) {?>
	$("#kode").focus();
	$('#listcus').modal('show');
	<?php } ?>
$(".use-address2").click(function() {
    var $row = $(this).closest("tr");    // Find the row
	 var $text = $row.find(".nama").text(); // Find the text
    // Let's test it out
	$("#nama").val($text);
	

	 $('#listcus').modal('hide');
});
});//]]> 


</script>