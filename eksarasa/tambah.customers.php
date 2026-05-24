<?php

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
		<?php 
		if(isset($_GET['tipe'])=="min"){
		?>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <!-- Theme style -->
         <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
         <?php }
		 ?>
<style>
.datepicker{
	font-size:12px;
}
</style>
<section class="content-header">
 <div class="pull-right" style="padding-right:5px"> <a href="?page=customer" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-mail-reply"></i> Cancel </a></div>
	<h1>Customers</h1>  
   
</section>

<section class="content">
<div class="row">
        <div class="col-xs-12">
                <div class="box box-solid box-warning">
					<div class="box-header">
						<h3 class="box-title">Tambah Customers</h3>
					</div>
    				<?php 
					if(isset($_GET['pesan'])){?>  
                           	<div class="small-box bg-green">
                                		<div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                             			</div>
                        	</div><?php }?>
					<form action="?page=simpan.customers" method="post" enctype="multipart/form-data" name="autoSumForm">
					<div class="box-body">
					<div class="col-xs-4">
						
                      <div class="form-group" id="status">
						<label>Nama <b style="color:red;">*</b></label>
						<input type="text" class="form-control" name="nama" id="nama" required="required" />
                       
                      </div>

						<div class="form-group" id="status">
						<label>No Telp<b style="color:red;">*</b></label>	
						  <input type="text" class="form-control" name="no_hp" id="no_hp" required>
						</div>
                     
					
						
					
                        
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