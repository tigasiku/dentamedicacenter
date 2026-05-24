<?php
include "koneksi.php";
koneksi_buka();
$qry=mysql_query("select * from iklan_footer where posisi='".$_GET['posisi']."'");
$row=mysql_fetch_array($qry);
?>

<section class="content-header">
	<h1>
		Edit Iklan Product 
        <small><?php echo $_SESSION['judul_graha'] ?></small>
    </h1>
</section>
<style>
p.summery
{

display:block;
margin-bottom:20px;
background-color:#C4EBFF;
border:1px #ddd solid;
border-left:10px #0088cc solid;
padding:10px

	}
</style>
<section class="content">
  <div class="row">
            
            
            			<div class="col-xs-12">
							<div class="box box-solid box-primary">
								<div class="box-header">
									<h3 class="box-title">Iklan Product </h3>
								</div>  <?php 
									if(isset($_GET['pesan'])){?>  
                                  <div class="small-box bg-green">
                                <div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                                </div>
                              </div><?php }?>
								<form action="perbarui.iklan.footer.php" method="post" enctype="multipart/form-data">
								<div class="box-body">		
								
									
                                   <div class="form-group">
											<label>ID Product <b style="color:red;">*</b></label>
               						 
                                         		                        
										<input type="text" class="form-control" name="id_produk" id="id_ta2"  required="required"  />
                                        	<input type="hidden" class="form-control" name="kd_iklan" id="id_ta2"  required="required" />
                                           
                   						   
                                    </div>
							<div class="form-group">
								<label for="exampleInputFile" class="pull-left">Foto &nbsp;</label>
								<input type="file" id="exampleInputFile" name="file" onchange="readURL(this);" style="width:65%;">
								<input type="hidden" name="capture_lama">
                                <input type="hidden" name="posisi" value="<?php echo $_GET['posisi'] ?>">
                                 <input type="hidden" name="old" value="<?php echo $row['gambar'] ?>">
							</div>
							<center><img id="img_prev" src="../iklan_footer/<?php echo $row['gambar'];?>" alt="capture photo" style="width:60%;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/></center>
                           
                                    
                                    <div class="bootstrap-timepicker">
                                      <div class="form-group"><!-- /.input group -->
                                        </div><!-- /.form group -->
                                    </div>
<button "submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-save"></i> &nbsp;Simpan</button>
								</div>
								</form>
								<div class="clearfix"></div>
							</div>
						</div>
                       
  </div>
  <div class="row">
<div class="col-xs-12">
<p class="summery">Iklan Posisi <?php echo $_GET['posisi'] ?> adalah <?php if($_GET['posisi']=="bawah") { echo "728px";}else{ echo "490px";} ?>. </p>
  								 
</div>
</div>
</section><!-- /.content -->
<?php
koneksi_tutup();
?>
<script>
function pemberitahuan(){

var msg="Apakah Anda Yakin Untuk Menghapus Data?";
var setuju=confirm(msg);
if (setuju)
	return true;
	else
	return false;
	
}
</script>
