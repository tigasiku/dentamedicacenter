<?php
include "koneksi.php";
koneksi_buka();
?>
<section class="content-header">
	<h1>
		User
        <small></small>
    </h1>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-6">
						<div class="box box-solid box-primary">
							<div class="box-header">
								<h3 class="box-title">Ganti Photo</h3>
							</div>
							<form action="perbarui.photo.php" method="post" enctype="multipart/form-data">
							<div class="box-body">
                                
                                <div class="col-xs-6">
                                <div class="form-group">
                              
								<label for="exampleInputFile" class="pull-left">Foto &nbsp;</label>
								<input type="file" id="exampleInputFile" name="file" onchange="readURL(this);" style="width:65%;">
								<input type="hidden" name="capture_lama">
                                
							</div>
							<center>
                            <?php 
							if(!empty($_SESSION['photo'])){
								$photo="photo/".$_SESSION['photo']."";
							}else{
							$photo="img/no-image.jpg";}?>
                            <img id="img_prev" src="<?php echo $photo?>" alt="capture photo" style="width:60%;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/></center>
                           
                                </div>
							</div><!-- /.box-body -->
							<div class="box-footer">
							<div class="col-xs-12">
								<button type="submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-save"></i> &nbsp;Simpan</button>
							</div>
							</form>
							<div class="clearfix"></div>
							</div>
						</div>
        </div>
    </div>
</section><!-- /.content -->
<?php
koneksi_tutup();
?>