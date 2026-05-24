<?php
include "koneksi.php";
koneksi_buka();
?>
<script language="javascript">
   function setBrg(vkd){
     window.opener.document.getElementById('satuan').value = vkd;
     window.self.close();
   }
</script>

<section class="content-header">
	<h1>
		Rek Perusahaan</h1>
</section>

<section class="content">
  <div class="row">
  					<div class="col-xs-3">
							<div class="box box-solid box-primary">
								<div class="box-header">
									<h3 class="box-title">Rek Perusahaan</h3>
								</div>  <?php 
									if(isset($_GET['pesan'])){?>  
                                  <div class="small-box bg-green">
                                <div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                                </div>
                              </div><?php }?>
								<form action="simpan.rek.perusahaan.php" method="post" enctype="multipart/form-data">
								<div class="box-body">		
								
									
                                    <div class="form-group" id="status">
										<label>Bank<b style="color:red;">*</b></label>	
                                        
										    <select class="form-control" name="bank"  required="required"  />
                                            <?php 
                                            $databank=mysql_query("select * from bank");
                                            while($bank=mysql_fetch_array($databank)){
                                            ?><option value="<?php echo $bank['0'] ?>"><?php echo $bank['1'] ?></option><?php }?>
                                            </select>
									</div>
                                    <div class="form-group" id="status">
										<label>No Rek<b style="color:red;">*</b></label>	
										    <input type="text" class="form-control" name="no_rek"  required="required"  />
									</div>
                                    <div class="form-group" id="status">
										<label>Atas Nama<b style="color:red;">*</b></label>	
										    <input type="text" class="form-control" name="atas_nama"  required="required"  />
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
									
                                        <form action="?page=satuan" method="post">
										<div class="input-group">
                                            <input type="text" name="cari" class="form-control input-sm pull-right" style="width: 20%;" placeholder="Search" value="<?php echo @$_POST['cari']?>"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
										</form>
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th width="10" style="text-align:center;">No</th>
											<th width="" style="text-align:center;">Kode Bank</th>
                                            <th width="" style="text-align:center;">Nama Bank</th>
                                            <th width="" style="text-align:center;">No Rek</th>
                                            <th width="" style="text-align:center;">Atas Nama</th>
                                       
                                        </tr>
										<?php
										
										$i=1;
										$qry=mysql_query("select * from bank_perusahaan where nama_bank like '%".@$_POST['cari']."%' ");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr  onclick="javascript:setBrg('<?php echo $row['1'] ?>')">
                                            <td align="center"><?php echo $i;?></td>
											 <td style="text-align:center;"><?php echo $row['0'] ?></td>
                                              <td style="text-align:center;"><?php echo $row['1'] ?></td>
                                               <td style="text-align:center;white-space:nowrap"><?php echo $row['2'] ?></td>
                                                <td style="text-align:center;"><?php echo $row['3'] ?></td>
                                                            <td style="text-align:center;"><a href="?page=edit.rek.perusahaan&id=<?php echo $row[0]?>"><span class="fa fa-edit"></span></a>  
											<a href="?page=hapus.rek.perusahaan&id=<?php echo $row[0]?>" class="hapus"><span class="fa fa-trash-o"></span></a></td>
                                                 
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                    </table>
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								
                                </div>
                            </div><!-- /.box -->
                        </div>
                    </div>
</section><!-- /.content -->
<?php
koneksi_tutup();
?>
<script>
$( ".hapus" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin ?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script>