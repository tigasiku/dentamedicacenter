
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
		 "textcolor",
        "searchreplace visualblocks code fullscreen",
        "emoticons insertdatetime media table contextmenu paste "
    ],
       toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor   emoticons | sizeselect | bold italic | fontselect |  fontsizeselect",
	fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
});
$(window).load(function(){
$('#padd').click(function(){
	
	angka=Number($('#angka').val());

	$('#addhereform').append('<div class="row" style="padding-bottom:15px"><div style="border:1px solid #ccc"class="col-lg-12" ><div class="col-lg-12" ><h1>Listicle' + angka + '</h1><div class="form-group"><input type="text" name="sub_headline[]"  class="form-control" placeholder="Subheadline' + angka + '"  /></div><div class="form-group"><input type="file" name="gambar_detil[]"  onchange="readURL' + angka + '(this);"> <center><img id="img_prev' + angka + '" src="img/no-image.jpg" alt="capture photo" style="width:30%;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/></center></div><div class="form-group"><textarea name="isi_berita2[]"  class="textarea" placeholder="Deskripsi"></textarea></div></div></div></div>');
$('#angka').val(angka+1);

tinymce.init({
    selector: ".textarea",
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
		 "textcolor",
        "searchreplace visualblocks code fullscreen",
        "emoticons insertdatetime media table contextmenu paste "
    ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor  emoticons | sizeselect | bold italic | fontselect |  fontsizeselect",
	fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
});
});
});
</script>
<script>

  </script>
        <!-- Page Title -->
		   <input type='hidden' class='form-control' id="angka"  value='1'>
			<section class="content-header">
	<h1>Tambah Listicle</h1>
</section>
	  
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
 <form class="form-horizontal" role="form" action="simpan.artikel.php" method="post" enctype="multipart/form-data" >
       
        <div class="content"  style="background-color:#FFF">
	    
	        	<div class="row" style="padding-top:15px"> 
                	
                  		
			<div class="col-md-9"  style="padding-bottom:15px !important">
                 <div class="box-body" >
					
                   
            	   <div class="col-sm-12" style="border:1px #CCC solid;border-radius:5px;padding:12px" >	
					
	        				<div class="col-sm-12">
	        	
                    	
                             			
                                        
                                        
                                    
                                                <div class="form-group" id="status">
                                                      <label class="control-label " for="nama">Judul</label>
                                                    <input type="text" name="judul"  class='form-control' placeholder='Judul' required>
                                             
                                        </div>
                                          <div class="form-group" id="status">
                                                      <label class="control-label " for="nama">Deskripsi</label>
                                                   <textarea name="isi_berita"  class='textarea' placeholder='Deskripsi' ></textarea>
                                             
                                        </div>
										<div id="addhereform">
                                                    
                                        </div>


                                         
                                        
                          </div>
                         	
                                    
                                  
                                   
                                      
                                      	
                         
                       
	        			    </div><!-- End Contact Info -->	        						        	
						 </div> 							 
	        	  </div>
	        		<div class="col-sm-3">
                    	<div class="row" style="padding-bottom:20px">
                          <div class="col-sm-12">
                 		    <div class="col-sm-12"style="border:1px #CCC solid;border-radius:5px;padding:12px" >	
                                <div class="col-sm-12" >	
                                         <div class="form-group" id="status">
            										  <label class="control-label" for="alamat">Terbitkan:</label>
                                  					
                               						  
                             			</div>
                                        <div class="form-group">
                                          <label  for="nama">Tanggal Terbit</label>
                                      
                                              <input type='text' class='form-control' name='tanggal_terbit' id='dp1' required value='<?php echo date("Y-m-d") ?>'>
                                        
                                        </div>
                                        <div class="form-group" id="status">
            									
                                  					
                               						        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                             			</div>
                             </div>
                                 </div> 
                           </div>  
                       </div>      
                       <div class="row">
                       <div class="col-sm-12">	
                 		    <div class="col-sm-12"  style="border:1px #CCC solid;border-radius:5px;padding:12px">	
                                <div class="col-sm-12">	
                                         <div class="form-group" id="status">
            										  <label class="control-label" for="alamat">Gambar Utama:</label>
                                  					
                               						   <input type="file" name="gambar" size="60"  id="exampleInputFile" onchange="readURL(this);" required>
                             			</div>
                                <center><img id="img_prev" src="img/no-image.jpg" alt="capture photo" style="width:60%;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/></center><br>
                                 </div> 
                           </div> </div> 
                       </div>      
                    </div> 
	    	</div>
	    </div>
 
	    <!-- Footer -->
 </form>
	<script>
		<?php 
	for ($i = 1; $i <= 30; $i++)
	{
	?>
     function readURL<?php echo $i ?>(input) {
			if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			//document.getElementById("img_prev").style.display = "";
			
			reader.onload = function (e) {
			$('#img_prev<?php echo $i ?>')
			.attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
			}
		}
		<?php } ?>
		</script>   <!-- Javascripts -->
      
       