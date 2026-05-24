<?php
include "koneksi.php";
koneksi_buka();
$row=mysql_fetch_array(mysql_query("select * from cabang where kd_cabang='".$_SESSION["kd_cabang"]."'"));
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
		Cabang <?php echo $_SESSION["cabang"] ?></h1>
</section>

<section class="content">
  <div class="row">
  					<div class="col-xs-4">
							 <div class="box box-primary">
								<div class="box-header">
									
								</div>  <?php 
									if(isset($_GET['pesan'])){?>  
                                      <div class="callout callout-<?php if($_GET['pesan']=="error"){ echo "danger";}else{ echo "info"; } ?>">
                                        <h4><?php if($_GET['pesan']=="error"){ echo "Mohon Maaf";}else{ echo "Success"; }?></h4>
                                        <?php if($_GET['pesan']=="error"){ 
										?>
                                        <p>Cabang <b><?php echo $_GET['area'] ?></b> sudah ada.</p><?php } ?>
                                    </div>
									<?php }?>
								
								<div class="box-body">		
								
									<form action="perbarui.cabang.php" method="post" enctype="multipart/form-data">
                                    
                                     <div class="form-group" id="status">
										<label>Kota<b style="color:red;">*</b></label>	
                                        <select name="kota" class="form-control" readonly>
                                       
                                            <option value="<?php echo $_SESSION["idKota"] ?>" ><?php echo $_SESSION["cabang"] ?></option>
                                           
                                        </select>
									</div>
                                     <div class="form-group" id="status">
										<label>Alamat<b style="color:red;">*</b></label>	
                                        <input name="alamat" class="form-control" required value="<?php echo $row['alamat'] ?>">
									</div>
                                    <div class="form-group" id="status">
										<label>Kontak Person<b style="color:red;">*</b></label>	
                                        <input name="cp" class="form-control"  readonly="readonly" value="<?php echo $row['cp'] ?>">
									</div>
                                    <div class="form-group" id="status">
										<label>Email <b style="color:red;">*</b></label>	
                                        <div class="input-group">
                                        	<div class="input-group-addon">
                                            	<i class="fa fa-envelope-o"></i>
                                            </div>
										    <input type="text" class="form-control" name="email"   readonly="readonly" value="<?php echo $row['email_cabang'] ?>"/>
                                        </div>    
									</div>
                                    <div class="form-group" id="status">
										<label>Email Person<b style="color:red;">*</b></label>	
                                        <div class="input-group">
                                        	<div class="input-group-addon">
                                            	<i class="fa fa-envelope-o"></i>
                                            </div>
										    <input type="text" class="form-control" name="email"   readonly="readonly" value="<?php echo $row['email_owner'] ?>"/>
                                        </div>    
									</div>
                                    <div class="form-group" id="status">
										<label>No Telp<b style="color:red;">*</b></label>
                                         <div class="input-group">
                                        	<div class="input-group-addon">
                                            	<i class="fa fa-phone"></i>
                                            </div>	
										    <input type="text" class="form-control" name="no_telp"  required="required"  value="<?php echo $row['no_telp'] ?>"/>
                                         </div>   
									</div>
                                    <div class="form-group" id="status">
										<label>No Hp<b style="color:red;">*</b></label>	
                                        	<div class="input-group">
                                        	<div class="input-group-addon">
                                            	<i class="fa fa-mobile"></i>
                                            </div>
										    <input type="text" class="form-control" name="no_hp"  required="required" value="<?php echo $row['no_hp'] ?>" />
                                            </div>
									</div>
                                    
<button "submit" class="btn btn-primary btn-flat pull-right perbarui" name="submit"><i class="fa fa-save"></i> &nbsp;Update</button>
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
$( ".perbarui" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin Ingin Memperbarui Data ?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script>