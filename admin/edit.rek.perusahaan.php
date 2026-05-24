<?php
include "koneksi.php";
koneksi_buka();
						$i=1;
										$qry=mysql_query("select * from bank_perusahaan where kd_bank= '".$_GET['id']."' ");
										$row=mysql_fetch_array($qry)
									
?>
<script language="javascript">
   function setBrg(vkd){
     window.opener.document.getElementById('satuan').value = vkd;
     window.self.close();
   }
</script>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
         <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<section class="content-header">
	<h1>
		Rek Perusahaan</h1>
</section>

<section class="content">
  <div class="row">
  					<div class="col-xs-3">
							<div class="box box-solid box-primary">
								<div class="box-header">
									<h3 class="box-title">Edit Rek Perusahaan</h3>
								</div>  <?php 
									if(isset($_GET['pesan'])){?>  
                                  <div class="small-box bg-green">
                                <div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                                </div>
                              </div><?php }?>
								<form action="perbarui.rek.perusahaan.php" method="post" enctype="multipart/form-data">
								<div class="box-body">		
								
									
                                    <div class="form-group" id="status">
										<label>Bank<b style="color:red;">*</b></label>	
                                        
										    <select class="form-control" name="bank"  required="required"  />
                                            	 <?php 
                                            $databank=mysql_query("select * from bank");
                                            while($bank=mysql_fetch_array($databank)){
                                            ?><option value="<?php echo $bank['0'] ?>" <?php if($row['0']==$bank['0']) echo "selected"?>><?php echo $bank['1'] ?></option><?php }?>
                                            </select>
                                            <input type="hidden" class="form-control" name="id"  required="required"  value="<?php  echo $row['kd_bank']?>"/>
									</div>
                                    <div class="form-group" id="status">
										<label>No Rek<b style="color:red;">*</b></label>	
										    <input type="text" class="form-control" name="no_rek"  required="required"  value="<?php  echo $row['2']?>"/>
									</div>
                                    <div class="form-group" id="status">
										<label>Atas Nama<b style="color:red;">*</b></label>	
										    <input type="text" class="form-control" name="atas_nama"  required="required"   value="<?php  echo $row['3']?>"/>
									</div>
                                    
<button "submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-save"></i> &nbsp;Simpan</button>
								</div>
								</form>
								<div class="clearfix"></div>
							</div>
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