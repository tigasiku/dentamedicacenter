<?php
error_reporting(0);
require "../koneksi.php";
    $get = "select * from produk WHERE id = '$_GET[id]'";
	$exe = mysql_query($get); 
    $show = mysql_fetch_array($exe); 
	
?>

<!-- TinyMCE -->
<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<!-- Masukkan TinyMCE ke TextArea -->
<script language="javascript">
function TampilTabel2(file){
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=570,width=575');
}
</script>
<script type="text/javascript">
	tinyMCE.init({
		
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
</head>

<section class="content-header">
	<h1>Product
            <small><?php echo $_SESSION['judul_graha'] ?></small>
    </h1>
</section>

<section class="content">
<div class="row">
  <div class="col-xs-12">
                <div class="box box-solid box-primary">
					<div class="box-header">
				
							<h3 class="box-title">Edit Produk</h3>
					</div>  <?php 
									if(isset($_GET['pesan'])){?>  
                                  	<div class="small-box bg-<?php if($_GET['pesan']=="success"){ echo "green";}else{ echo "red";}?> ">
                                		<div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                             			</div>
                        			</div><?php }?>
                  		  
                         <div class="box-body">
							<div class="col-xs-12">                  
<form method="POST" action="perbarui.product.php" enctype='multipart/form-data'>
          <input type="hidden" name="id" value="<?php echo $show['id']?>">
						<div class="col-xs-6">   
							<div class="form-group" id="status">
								<label>Kategori <b style="color:red;">*</b></label>	
						 		<select name="kategori" class="form-control input-sm" />
                                            	<?php 
												$qry=mysql_query("select * from kategori_produk");
												while($row=mysql_fetch_array($qry)){
												?>
                                               
                                          
                                          		  <optgroup label="<?php echo $row['kategori'] ?>">
                                                   <?php 
										  $query=mysql_query("select * from sub_kategori_produk where kategori='".$row['kategori']."'");
										  while($sub=mysql_fetch_array($query)){ ?>
                  <option value="<?php echo $sub['sub_kategori'] ?>" <?php if($sub['sub_kategori']==$show['sub_kategori']) echo "selected" ?>><?php echo $sub['sub_kategori'] ?></option><?php } ?>
                                                  </optgroup>
                                                <?php } ?>
                                            </select>
					  		</div>
         					<div class="form-group" id="status">
								<label>Nama <b style="color:red;">*</b></label>
                                <input type="text" name="judul" size="60" class="form-control" value="<?php echo $show['judul']?>">
                            </div>
                            <div class="form-group" id="status">
								<label>Merek <b style="color:red;">*</b></label>
                                <input type="text" name="merek" size="60" class="form-control"value="<?php echo $show['merek']?>">
                            </div>
                             
                           
                            <div class="form-group">
								<label>Satuan <b style="color:red;">*</b></label>	
							
                                    <div class="input-group">
                                      <input type="text" class="form-control" name="satuan"  required="required" value="<?php echo $show['satuan']?>" id="satuan" readonly="readonly" />
                                      
                                        <div class="input-group-addon"><a href="javascript:TampilTabel2('list.satuan.php')" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-search" style="color:#FFF"></span></a>
                                        </div>
                                 	 </div>
                                </div>
                         </div>
                         <div class="col-xs-6">
                         		
                             	<div class="form-group" id="status">
                                        <label>Harga Jual</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="">Rp.</i>
                                            </div>
                                            <input type="text" name="harga" size="100%" class="form-control" value="<?php echo $show['harga'] ?>">
                                       </div>
                                </div>
                                <div class="form-group" id="status">
                                        <label>Harga Grosir</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="">Rp.</i>
                                            </div>
                                            <input type="text" name="harga_grosir" size="100%" class="form-control" value="<?php echo $show['harga_grosir'] ?>">
                                       </div>
                                </div>
								<div class="form-group" ><label>Diskon</label>
                                    <div class="input-group">
                                            
                                            <input type="text" name="diskon"  class="form-control" value="<?php echo $show['diskon'] ?>">
                                            <div class="input-group-addon">
                                                        <i class="">%</i>
                                             </div>
                                    </div>
                                </div>
                               <div class="form-group" id="status">
                                        <label>Status</label> 
                                        	 
                                             <div class="radio">
                                                    <label><input type="radio" name="status" value="" <?php if($show['status']=="") echo "checked" ?> onmousedown="this.c=this.checked" onclick="if (this.c) { this.checked
= false }"> Tidak</label>
                                            </div>
                                            <div class="radio">
                                                    <label><input type="radio" name="status" value="terbaru" <?php if($show['status']=="terbaru") echo "checked" ?> onmousedown="this.c=this.checked" onclick="if (this.c) { this.checked
= false }"> Terbaru</label>
                                            </div>
                                           
                                </div>
                         </div> 
						 <div class="col-xs-12">
                            <ul class="nav nav-tabs">
<!-- Untuk Semua Tab.. pastikan a href="#nama_id" sama dengan nama id di "Tap Pane" dibawah-->
                              <li class="" ><a href="#1" data-toggle="tab">Spesifikasi</a></li> <!-- Untuk Tab pertama berikan li class="active" agar pertama kali halaman di load tab langsung active-->
                              <li class="active"><a href="#2" data-toggle="tab">Gambar</a></li>
                              
                            </ul>  
                            
                              <div class="tab-content">
                                  <div class="tab-pane " id="1">
                                        <div class="col-xs-6"> 
                                                <div class="form-group" id="status">
                                                    <label></label>
                                                    <textarea name="spesifikasi" style=" height: 350px;" class="form-control"><?php echo $show['spesifikasi'] ?></textarea>
                                                </div>
                                        </div>
                                  </div>
                                  <div class="tab-pane active" id="2" >
                                        <div class="col-xs-6"> 
                                        <?php
											if ($show['file']==""){
												$photo="img/no-image.jpg";
											}else{
												$photo="../img/portfolio/thumb/$show[file]";
											}
										?>
                                                 <div class="form-group" id="status">
            					<label for="exampleInputFile"></label><input type="file" name="gambar" size="60"  id="exampleInputFile" onchange="readURL(this);">
                                <input type="hidden" name="capture_lama" value="<?php echo $show['file']?>">
                             </div>
                                <center><img id="img_prev" src="<?php echo $photo ?>" alt="capture photo" style="width:60%;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/></center><br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px
                                        </div>
                                  </div>
                              </div>  
                       </div>           
                      
			
                </div>
               
                <div class="box-footer"> 
						<div class="col-xs-12"><hr />
						<small class="badge bg-red">* &nbsp;:&nbsp; Wajib Isi</small>
						<button type="submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-save"></i> &nbsp;Simpan</button>
                        </div>
			</div>
					<div class="clearfix"></div>	</form>
					</div>
             </div>
         </div>
	</div>
</section><!-- /.content -->

