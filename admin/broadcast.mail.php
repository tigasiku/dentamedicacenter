<?php
include "koneksi.php";
koneksi_buka();


?><script src="jscripts/tiny_mce/tinymce.min.js"></script>
<script type="text/javascript">
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
</script>
<div class="page-header">
    <div class="container-fluid">
      
      <h1>Broadcast</h1>
     
    </div>
  </div>
 <?php 
 if(isset($_GET['pesan']))
 {
 ?> 
<div class="container-fluid" style="padding-right:5px;padding-left:5px">
        					<div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Pesan</h3>
                                   <div class="box-tools pull-right">
                                        
                                           <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    Data <code><?php echo $_GET['pesan'] ?></code> berhasil dihapus                                    
                                </div><!-- /.box-body -->
                            </div>
</div><?php } ?>                            
<div class="container-fluid" style="padding-right:5px;padding-left:5px">
      <div class="box box-info">
                                <div class="box-header ui-sortable-handle" style="cursor: move;">
                                    <i class="fa fa-envelope"></i>
                                    <h3 class="box-title">Quick Email</h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        
                                    </div><!-- /. tools -->
                                </div> 
                                <form action="simpan.broadcast.mail.php" method="post">
                                <div class="box-body">
                                   
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="emailto" placeholder="Email to All Contact" readonly="readonly">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" placeholder="Subject">
                                        </div>
                                        <div>
                                            <textarea name="isi_berita"  class='form-control textarea' placeholder='Deskripsi' ></textarea>
                                            </div>
  
                                    
                                </div>
                                <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-info" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>
                            </form>
  </div>
  <script>
$( ".hapus" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin ?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script>
