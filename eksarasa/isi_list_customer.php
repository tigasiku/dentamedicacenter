<?php
@session_start();
include "koneksi.php";
include "function.php";
if(isset($_GET['cari'])){
$cari=$_GET['cari'];
}else{
$cari=$_POST['cari'];
}
?>
  
 <div class="box box-primary" style="padding-left: 15px;
    padding-right: 15px;">
                            <div class="box-header">
                               
                          </div><!-- /.box-header -->
                              <div class="pull-left" style="padding-right:5px">	<a id="tambah" class="btn btn-danger btn-flat" style="float:left;"><i class="fa fa-plus"></i> </a>
        
      </div>
                            
										<div class="input-group">
                                            <input name="cari" class="form-control input-sm pull-right" style="max-width: 200px" placeholder="Cari" value="<?php echo @$_GET['cari'] ?>" id="cari2"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default" id="pencarian2"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
										
                                  <table class="table table-hover table-bordered" style="margin-top:10px;font-size: <?php  if(isMobile()){ echo "13px"; } else{ echo "13px !important";} ?>;">
                                      <tr>
                                          <th style="text-align:center;">No</th>
										  <th >Nama</th>
                                       
                                       
                                            <th >No Telp</th>
                                      </tr>
									  <?php
										$limit = 10;
										if(isset($_GET['hal'])){
											$hal = $_GET['hal'];
										}
										else{
											$hal = 1;
										}

										$offset = ($hal - 1) * $limit;
										$i=1;
										
										
									
										 
										
										$qry=mysql_query("select * from customer where customer like '%".@$_GET['cari']."%'   LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                        
                                 
                                      <tr onclick="javascript:setBrg('<?php echo $row['0'] ?>','<?php echo $row['customer'] ?>')" style="font-size: <?php  if(isMobile()){ echo "13px"; } else{ echo "13px !important";} ?>;" class="use-address2">
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
									$query  = "SELECT COUNT(customer) AS jumData FROM customer where customer like '%".@$_GET['cari']."%'";
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
											if ($i == $hal) echo "<li><a ><b>".$i."</b></a></li>";
											else echo "<li class='announce'><a   class='satuan'>".$i."</a></li>";
										 }
								}
								?>
                                </ul>
								<label style="float:right;margin-top:5px;">
									Page :&nbsp;&nbsp;
								</label>
								 
 <script>


//<![CDATA[
$(document).ready(function() {
	 $(".announce").click(function(){ // Click to only happen on announce links
				
		 
		 
		 var row3 = $(this).closest("li"); 

			  var namanya = row3.find(".satuan").text();
					var komen =2;
				  var dataString = 'hal='+ namanya ;
									$.ajax({
										 

										 success: function()
													   {
										
								
														
										  $('#content2').load('isi_list_customer.php?hal='+namanya);
									   }
									});
		 
		 
		 
		 
		 
				
			   });
	
		$("#tambah").click(function(){ // Click to only happen on announce links
				
		 
		 
	

									$.ajax({
										 

										 success: function()
													   {
										
								
														
										  $('#content2').load('tambah.customer.php');
														 
									   }
									});
		 
		 
		 
		 
		 
				
			   }); 
	
	$("#pencarian2").click(function(){ // Click to only happen on announce links
				
		 
		 
	

			  var namanya = $("#cari2").val();
				
				  var dataString = 'cari='+ namanya ;
									$.ajax({
										 

										 success: function()
													   {
										
								
														
										  $('#content2').load('isi_list_customer.php?cari='+namanya);
														 
									   }
									});
		 
		 
		 
		 
		 
				
			   });   

	<?php if(isset($_GET['listmodaluser'])) {?>
	$("#kode").focus();
	$('#listcus').modal('show');
	<?php } ?>
$(".use-address2").click(function() {
    var $row = $(this).closest("tr");    // Find the row
	 var $text2 = $row.find(".nama").text(); // Find the text
    // Let's test it out
	$("#nama").val($text2);
	

	 $('#listcus').modal('hide');
});
});//]]> 


</script>