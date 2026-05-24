<?php 
include "koneksi.php";
koneksi_buka();
$sql = "SELECT * FROM  provinsi where idProvinsi='".$_SESSION["idProvinsi"]."'";
$getComboNegara = mysql_query($sql) ;

?>   
<link href="css/datepicker/datepicker.css" rel="stylesheet" type="text/css" />  
<script src="../js/kota.js" type="text/javascript"></script>
<script src="../js/area.js" type="text/javascript"></script>


        <!-- Page Title -->
		
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						
					</div>
				</div>
			</div>
	  
      

        <div class="section "  style="background-color:#FFF">
	    	<div class="container">
	        	<div class="row" style="padding-top:15px"> 
                	
                   
					<div class="col-sm-11" >
                    <?php if(isset($_GET['data'])){
                                                ?>
                    		<div class="col-sm-12" >
                                        <div class="alert alert-danger" style="border-left: 4px solid ;">
                                              <h3>Data</h3>
                                            
                                                <p>Silahkan melengkapi profile Anda terlebih dahulu. ! </p>  
                                                
                                            </div>
                            </div>
                            <?php } ?>
					<?php if(isset($_GET['pesan'])){
                                                ?>
                    		<div class="col-sm-12" >
                                        <div class="alert alert-<?php if($_GET['pesan']=="success"){ echo "success";}else{ echo "danger";}?>" style="border-left: 4px solid ;">
                                              <h3><?php echo ucfirst($_GET['pesan']) ?></h3>
                                             <?php if($_GET['pesan']=="success"){
                                                ?>
                                                <p>Profile anda berhasil diedit. </p>  
                                                <?php } else{
												?>
												<p>Profile anda gagal diedit. </p>  
												<?php } ?>	
                                            </div>
                            </div>
                            <?php } ?>	
                            
                    <form class="form-horizontal" role="form" action="simpan.agen.php" method="post" enctype="multipart/form-data">
                    		<div class="col-sm-12" >
                            <legend style="border-bottom:3px solid #FFE034">Agen</legend>
                            </div>
                            <div class="col-sm-12" style="border:1px #CCC solid;border-radius:5px;padding:2px">	
					
	        		<div class="col-sm-6">
	        			<legend>Informasi Akun</legend>
                    	
                            <div class="form-group">
                              <label class="control-label col-sm-3" for="email">Email:</label>
                              <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="" >
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-3" for="email">Pass:</label>
                              <div class="col-sm-9">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="" >
                              </div>
                            </div>
                          	<legend>Photo</legend> 
                            <div class="form-group">
                            		
								<label for="exampleInputFile" class="pull-left control-label col-sm-3">Foto : &nbsp;</label>
                                 <div class="col-sm-9">
								<input type="file" id="exampleInputFile" name="file" onchange="readURL(this);" style="width:65%;">
								<input type="hidden" name="capture_lama" value=""></div>
								
                            </div>
                            <?php 
							
						
								$photo="img/no-image.jpg";
							
							
							?>
							<center><img id="img_prev" src="<?php echo $photo?>" alt="capture photo" style="width:60%;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/></center>
                          </div>
                         		 <div class="col-sm-6">  
                                        <legend>Profile</legend>
                                         <div class="form-group">
                                          <label class="control-label col-sm-2" for="email">Provinsi:</label>
                                          <div class="col-sm-10">
                                            <select name="cmbProvinsi" id="cmbProvinsi" class="form-control">
                                               
                                               	<?php
                                                
                                              while($data = mysql_fetch_array($getComboNegara)){
                                                      ?>
                                                      <option value="<?php echo $data['idProvinsi'] ?>"  ><?php echo $data['namaProvinsi'] ?></option>
													  <?php
                                                                                   }
                                                                              ?>
                                                </select>
                                          </div>
                                        </div>
                                          <div class="form-group">
                                          <label class="control-label col-sm-2" for="email" >Kota:</label>
                                          <div class="col-sm-10">
                                            <select name="cmbKota" id="cmbKota" class="form-control" required onchange="validasi_kota()" onfocus="validasi_kota()">
											 <?php $kotanya=mysql_query("select * from kota where idKota='".$_SESSION["idKota"]."'");
                                                    while($kota=mysql_fetch_array($kotanya)){
                                              ?>
                                            <option value="<?php echo $kota['idKota'] ?>" ><?php echo $kota['namaKota'] ?></option>
                                            <?php  } ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="form-group" style="display:none" id="input_kota">
                                              <label class="control-label col-sm-2" for="email"></label>
                                              <div class="col-sm-10">
                                                 <input type="text" class="form-control" id="kota" placeholder="Input Kota" name="kota">
                                              </div>
                           				 </div>
                                         <div class="form-group">
                                          <label class="control-label col-sm-2" for="email">Area:</label>
                                          <div class="col-sm-10">
                                            <select name="cmbArea" id="cmbArea" class="form-control" onchange="validasi_area()" onfocus="validasi_area()">
                                             <?php $areanya=mysql_query("select * from area where idKota='".$_SESSION["idKota"]."'");
			 		while($area=mysql_fetch_array($areanya)){
			  ?>
                                                   <option value="<?php echo $area['idArea'] ?>" ><?php echo $area['namaArea'] ?></option>
                                                   <?php  } ?>
                                                   <option value="lainnya">Lainnya</option>
            								</select>
                                          </div>
                                        </div>
                                        	<div class="form-group" style="display:none" id="input_area">
                                              <label class="control-label col-sm-2" for="email"></label>
                                              <div class="col-sm-10">
                                                 <input type="text" class="form-control" id="area" placeholder="Input Area" name="area">
                                              </div>
                                            </div>
                                         <div class="form-group">
                                          <label class="control-label col-sm-2" for="alamat">Alamat:</label>
                                          <div class="col-sm-10">
                                            <textarea class="form-control" id="alamat" placeholder="Alamat" name="alamat" rows="3"></textarea>
                                          </div>
                                        </div>
                                         <div class="form-group">
                                          <label class="control-label col-sm-2" for="nama">Nama:</label>
                                          <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" value="">
                                          </div>
                                        </div>
                                         <div class="form-group">
                                          <label class="control-label col-sm-2" for="tgl">Tanggal Lahir:</label>
                                          <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control" name="tanggal_lahir" id="dp1" required value="">
                                            </div><!-- /.input group -->
                                          </div>
                                        </div>
                                         <div class="form-group">
                                          <label class="control-label col-sm-2" for="Telp">Telp:</label>
                                          <div class="col-sm-10">
                                                <div class="input-group">
                                                 <div class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <input type="text" class="form-control" name="telp" value="" />
                                            </div><!-- /.input group -->
                                          </div>
                                        </div>
                                         <div class="form-group">
                                          <label class="control-label col-sm-2" for="Mobile">Mobile:</label>
                                          <div class="col-sm-10">
                                            <div class="input-group">
                                                 <div class="input-group-addon">
                                                    <i class="fa fa-mobile"></i>
                                                </div>
                                                <input type="text" class="form-control" name="hp" value=""/>
                                            </div><!-- /.input group -->
                                          </div>
                                        </div>
                                         <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">Pin BB:</label>
                                              <div class="col-sm-10">
                                                <input type="text" class="form-control" id="bb" placeholder="Pin BB" name="bb" value="">
                                              </div>
                                         </div>
                                          <div class="form-group">        
                                             <div class="col-sm-offset-2 col-sm-10">
                                             <button type="submit" class="btn btn-primary perbarui" name="submit" >Simpan</button>
                                            </div>
                                       
                          				 </div> 
                                     </div>   
                                      </div> 
                                        	
                          </form>
                       			
	        			    </div><!-- End Contact Info -->
	        		
				
	        	

	        	
	        	</div>
	    	</div>
	    </div>

	    <!-- Footer -->
	

        <!-- Javascripts -->
      
        <script src="js/bootstrap.min.js"></script>
		
		<!-- Scrolling Nav JavaScript -->
        <script src="admin/js/plugins/datepicker/bootstrap-datepicker.js"></script>	
	<script>
		
		
		$(function(){
		$('#dp1').datepicker({
				format: 'yyyy-mm-dd'
		});
        $("[data-mask]").inputmask();
		
		});
			
		

		function readURL(input) {
			if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			//document.getElementById("img_prev").style.display = "";
			
			reader.onload = function (e) {
			$('#img_prev')
			.attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
			}
		}
		</script>
        <script>
$( ".perbarui" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin ?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script>
