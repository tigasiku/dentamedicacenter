
<?php 
include "koneksi.php";
koneksi_buka();

?>   
<link href="admin/css/datepicker/datepicker.css" rel="stylesheet" type="text/css" />  
<script type = "text/javascript">

function addCommas(nStr) {
nStr = nStr.replace(/[^0-9\.]/g,"");
nStr = Number(nStr).toFixed(0);   // remove excess decimals
var rgx = /(\d+)(\d{3})/;
while (rgx.test(nStr)) {
nStr = nStr.replace(rgx, '$1,$2');
}
if (nStr.indexOf('.') == -1) {  // if whole number add .00
nStr = nStr + "";
}
nStr = nStr.replace(/(\.\d)$/,"$10");  // if only one DP add another 0
return nStr;
}

var x1;
var x2;

function show() {
var totalStr = (x1 + x2).toString();
totalStr = addCommas(totalStr);
document.form1.t.value = totalStr;
}


</script>
<script src="../js/kota.js" type="text/javascript"></script>
<script src="../js/area.js" type="text/javascript"></script>

<script src="jscripts/tiny_mce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: ".textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<script>

  </script>
        <!-- Page Title -->
		
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						
					</div>
				</div>
			</div>
	  
      

        <div class="section"  style="background-color:#FFF">
	    	<div class="container">
	        	<div class="row" style="padding-top:15px"> 
                	
                  
					<div class="col-md-11" >
                 
					<?php if(isset($_GET['pesan'])){
                                                ?>
                    		<div class="col-sm-12" >
                                        <div class="alert alert-<?php if($_GET['pesan']=="success"){ echo "success";}else{ echo "danger";}?>" style="border-left: 4px solid ;">
                                              <h3><?php echo ucfirst($_GET['pesan']) ?></h3>
                                             <?php if($_GET['pesan']=="success"){
                                                ?>
                                                <p>Listing anda berhasil tersimpan. </p>  
                                                <?php } else{
												?>
												<p>Data gagal tersimpan. </p>  
												<?php } ?>	
                                            </div>
                            </div>
                            <?php } ?>	
                    <form class="form-horizontal" role="form" action="simpan.template.php" method="post" enctype="multipart/form-data" >
                    		<div class="col-sm-12" >
                            <legend style="border-bottom:3px solid #FFE034">Tambah Template</legend></div>
                            <div class="col-sm-12" style="border:1px #CCC solid;border-radius:5px;padding:2px">	
					
	        		<div class="col-sm-6">
	        			<legend>Informasi</legend>
                    	
                             			<div class="form-group">
                                          <label class="control-label col-sm-2" for="nama">Kategori</label>
                                          <div class="col-sm-10">
                                            <select class="form-control" name="kategori">
                                            <?php 
											$qry=mysql_query("select kd_kategori,kategori from kategori_website");
											while ($row=mysql_fetch_array($qry)){
											?>
                                            	<option value='<?php echo $row['kd_kategori'] ?>' <?php if($row['kd_kategori']==@$_GET['kategori']) echo "selected" ?>><?php echo $row['kategori'] ?></option>	
                                                <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                                        
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="nama">Title:</label>
                                          <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" required>
                                          </div>
                                        </div>
                                    
                                                <div class="form-group" id="status">
                                                      <label class="control-label col-sm-2" for="nama">Title:</label><div class="col-sm-10">
                                                    <input type="text" class="form-control" id="urlnya" placeholder="Url" name="urlnya" required>
                                                </div>
                                        </div>
                                        
                          </div>
                         		 <div class="col-sm-6">  
                                        <legend>&nbsp;</legend>
                                        
                                       
                                         
                                         <div class="form-group" id="status">
            										  <label class="control-label col-sm-3" for="alamat">Gambar :</label>
                                  						<div class="col-sm-9">
                               						   <input type="file" name="gambar" size="60"  id="exampleInputFile" onchange="readURL(this);" required>
                             							</div>
                                                </div>
                                <center><img id="img_prev" src="img/no-image.jpg" alt="capture photo" style="width:60%;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/></center><br>
                                       
                                          
                                          
                                     </div> 
                                    
                                  
                                    <div class="col-sm-12">
                                    <hr />
                                    <div class="form-group">        
                                             <div class="col-sm-offset-10 col-sm-12">
                                             <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                                            </div>
                                       
                          				 </div> 
                                     </div>  
                                      
                                      	
                          </form>
                       
	        			    </div><!-- End Contact Info -->
	        		
				
	        	
 </div>
	        	  </div>
	        	
	    	</div>
	    </div>

	    <!-- Footer -->
	

        <!-- Javascripts -->
      
       