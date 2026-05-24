<?php
include "koneksi.php";
koneksi_buka();
$qry=mysql_query("select * from persen_affiliate");
$row=mysql_fetch_array($qry);
?>
<script language="javascript">
   function setBrg(vkd){
     window.opener.document.getElementById('satuan').value = vkd;
     window.self.close();
   }
</script>

<section class="content-header">
	<h1>
		Persen Affiliate</h1>
</section>

<section class="content">
  <div class="row">
  					<div class="col-xs-3">
							 <div class="box box-primary">
								<div class="box-header">
									
								</div>  
								<form action="perbarui.persen.affiliate.php" method="post" enctype="multipart/form-data">
								<div class="box-body">		
								
									
                                    
                                    
                                     <div class="form-group" id="status">
										<label>Persen<b style="color:red;">*</b></label>	
                                       <input  type="text" class="form-control"  name="persen" value="<?php echo $row['0'] ?>">
                                         
									</div>
                                    
                                   
                                   
                                    
                                    
<button "submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-save"></i> &nbsp;Simpan</button>
								</div>
								</form>
								<div class="clearfix"></div>
							</div>
						</div>
                        
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    
                            </div><!-- /.box-header -->
                                <div class="box-body" style="padding-top:0px;">
									
                                       
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th width="10" style="text-align:center;">No</th>
										
                                            <th width="" style="text-align:center;">Persen</th>
                                            
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
										$qry=mysql_query("select * from persen_affiliate LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr  onclick="javascript:setBrg('<?php echo $row['1'] ?>')">
                                            <td align="center"><?php echo $i;?></td>
											
                                              <td style="text-align:center;"><?php 
											
											 echo $row['0']; 
											 
											   ?></td>
                                               
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                    </table>
                                </div><!-- /.box-body -->
								
                                
                            </div><!-- /.box -->
                        </div>
                    </div>
</section><!-- /.content -->
<?php
koneksi_tutup();
?>