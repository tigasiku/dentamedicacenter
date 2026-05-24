<?php
include "koneksi.php";

?>
<section class="content-header">
	<h1>
		User
      
    </h1>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-5">
						<div class="box box-solid box-primary">
							<div class="box-header">
								<h3 class="box-title">Ganti Password</h3>
							</div>
							<form action="?page=perbarui.pass" method="post" enctype="multipart/form-data">
							<div class="box-body">		
								<div class="form-group" id="status">
									<label>Password Lama <b style="color:red;">*</b></label>	
									<input type="password" class="form-control" name="old" id="id_fak" required>
								</div>
								<div class="form-group">
									<label>Password Baru <b style="color:red;">*</b></label>	
									<input type="password" class="form-control" name="new" required>
								</div>
								<div class="form-group">
									<label>Ulang Password Baru <b style="color:red;">*</b></label>	
									<input type="password" class="form-control" name="rnew" required>
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

?>