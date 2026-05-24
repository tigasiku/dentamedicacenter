<?php
include "koneksi.php";

?>
<script language="javascript">
function TampilTabel(file){
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=570,width=650');
}
</script>
<script>

function validate2(){
if (document.getElementById('keluarga').value=="belum"){
	 document.getElementById('sudah').style.display ="None";

	 document.getElementById('belum').style.display ="Block";
	 
}
else{
	 document.getElementById('sudah').style.display ="Block";
	 document.getElementById('belum').style.display ="None";

}
}
function validate(){
if (document.getElementById('remember').value=="Cash"){

	 
document.getElementById('no_rek').style.display ="None";
document.getElementById('nama_bank').style.display ="None";
document.getElementById('cabang_bank').style.display ="None";
document.getElementById('atas_nama_bank').style.display ="None";
	 
}
else{
document.getElementById('no_rek').style.display ="Block";
document.getElementById('nama_bank').style.display ="Block";
document.getElementById('cabang_bank').style.display ="Block";
document.getElementById('atas_nama_bank').style.display ="Block";	
  	
}
}
</script>

<style>
.datepicker{
	font-size:12px;
}
</style>
<section class="content-header">
	<h1>Management User</h1>
</section>

<section class="content">
<div class="row">
        <div class="col-xs-12">
                <div class="box box-solid box-primary">
					<div class="box-header">
						<h3 class="box-title">Tambah User</h3>
						
					</div>
					<form action="simpan.user.php" method="post" enctype="multipart/form-data" name="autoSumForm">
					<div class="box-body">
					<div class="col-xs-4">
						 <div class="form-group" id="status">
						<label>Username <b style="color:red;">*</b></label>	
						  <input type="text" class="form-control" name="username" id="nim" required>
					  </div>
                        <div class="form-group" id="status">
								    <label>Nama <b style="color:red;">:</b> </label>
                                    <input type="text" class="form-control" name="nama" id="id_ta2"  required="required"  value="" />
                                    
                                       </div>  
                         
						
						<div class="form-group">
						  <label>Jenis Kelamin <b style="color:red;">*</b></label>	
							<select name="jenis_kelamin"  class="form-control"  >
                           		 <option value="Laki-laki">Laki-laki</option>
                            	 <option value="Perempuan">Perempuan</option>
                             
                            </select>
						</div>
								 
						
						
                                 
						
					
						
				
					  </div>
					
						<?php
						
								$photo="img/no-image.jpg";
							
						?>
						<div class="col-xs-4"> 
                        <div class="form-group" id="status">
								    <label>FB ID <b style="color:red;">:</b> </label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                                    	<i class="fa fa-facebook"></i>
                                    </div>
                                    <input type="text" class="form-control" name="fb_id"  required="required"  value="" placeholder="FB ID"/>
                                    </div>
                                    
                         </div> 
                         <div class="form-group">
							<label>Level <b style="color:red;">*</b></label>
<select name="level" class="form-control">
							  <option value="Editor" >Editor</option>
							
                              <option value="Admin" >Admin</option>
                              <option value="Finance" >Finance</option>
                              <option value="Logistik" >Logistik</option>
						 <option value="Administrator" >Administrator</option>
						  </select>
						</div>
                        
                        <div class="form-group">
						  <label>Password <b style="color:red;">*</b></label>	
							<input name="pass" type="password" class="form-control" id="pass" />
						</div>
							<div class="form-group">
								<label for="exampleInputFile" class="pull-left">&nbsp;</label>
								
							  <input type="hidden" name="capture_lama">
							</div>
						  <center></center>
						  <div class="form-group"></div>
                          <div id='sudah'></div> 
						</div>
                        <div class="col-xs-4">
							<div class="form-group">
								<label for="exampleInputFile" class="pull-left">Foto &nbsp;</label>
								<input type="file" id="exampleInputFile" name="file" onchange="readURL(this);" style="width:65%;">
								<input type="hidden" name="capture_lama">
							</div>
							<center><img id="img_prev" src="<?php echo $photo?>" alt="capture photo" style="width:60%;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/></center>
                            </div>
						<div class="clearfix"></div>
					</div><!-- /.box-body -->
					<div class="box-footer">
					<div class="col-xs-12">
						<small class="badge bg-red">* &nbsp;:&nbsp; Wajib Isi</small>
						<button type="submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-save"></i> &nbsp;Simpan</button>
					</div>
					<div class="clearfix"></div>
					</div>
				</div><!-- /.box -->            
			</div>
				</form>
				</div>
</section><!-- /.content -->
<?php 

?>