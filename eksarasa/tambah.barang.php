<?php


?>

<script src="script/produk.js"></script>
<script language="javascript">
function TampilTabel2(file){
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=570,width=575');
}
</script>
<script>
function validate(){
if (document.getElementById('jenis').value=="Personal"){
document.getElementById('nama').innerHTML="Nama";
document.autoSumForm.jabatan.style.display="None";
document.getElementById('jabatan').style.display="None";
}else{
	document.getElementById('nama').innerHTML="Perusahaan";
	document.getElementById('jabatan').style.display="Inline";
	document.autoSumForm.jabatan.style.display="Inline";
	}
}
</script> 
<script type="text/javascript">//<![CDATA[ 
$(window).load(function(){
	

$(document).on('keyup', '#harga_jual_gudang', function(){
    var $this = $(this);
    var sumpprice = $('#harga_jual_gudang').val();
	
});


$('#padd').click(function(){
	

	var pname = $('#gudang').val();
	
	var harga_jual = $('#harga_jual_gudang').val();

	
	$('.bersih').val("");
	
			$('#addhereform').append('<tr><td><input type="hidden" size="40%" name="pname[]" value="' + pname + '" readonly/><span>' + pname + '</span></td><td><input type="hidden"  name="harga_jual_gudang[]" value="' + harga_jual + '" readonly/><span>' + harga_jual + '</span></td><td style="vertical-align: middle !important;text-align: center"> <a  id="HapusInput" class="btn btn-xs btn-danger" ><i class="fa fa-trash"></i></a></td></tr>');
	
});

$(document).on('click','#HapusInput' ,function() { 
	 <?php  if(isMobile()){ ?>  $(this).closest('tr').next().remove(); <?php } ?>
       $(this).closest("tr").remove();
	
});
$(document).on('click','#HapusInput' ,function() { 
        $('#hitung').click();	 
});	
$(document).on('click','#padd' ,function() { 
        $('#hitung').click();	 
});
  	
});//]]>  


	
</script>
<style>
.datepicker{
	font-size:12px;
}
</style>
<section class="content-header"><div class="container-fluid">
  	<div class="pull-right" style="padding-right:5px"><a href="?page=barang&filter_kategori=<?php echo $_GET['filter_kategori']  ?>&filter_sub_kategori=<?php echo $_GET['filter_sub_kategori'] ?>" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-mail-reply"></i> Cancel</a>
        
      </div>
      </div>
	<h1>
		Barang<small></small></h1>
</section>

<section class="content">
<div class="row">
        <div class="col-xs-12">
                <div class="box box-solid box-primary">
					<div class="box-header">
						<h3 class="box-title">Tambah Barang<small></small></h3>
	</div>
    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
                       <li class=""><a href="#tab-data" data-toggle="tab" aria-expanded="false">Harga Gudang</a></li>
                    </ul><form action="simpan.barang.php" method="post" enctype="multipart/form-data" name="autoSumForm">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-general">
					
                    <?php 
					if(isset($_GET['pesan'])){?>  
                           	<div class="small-box bg-green">
                                		<div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                             			</div>
                        	</div><?php }?>
					<div class="box-body">
					<div class="col-sm-4">
						
					  <div class="form-group">
                                      <label>Kategori  <b style="color:red;">*</b></label>
                                         <select name="kategori" class="form-control " />
                                            	<?php 
												$qry=mysql_query("select * from kategori_barang order by kategori_barang");
												while($row=mysql_fetch_array($qry)){
												?>
                                               
                                          
                                          		  <optgroup label="<?php echo $row['kategori_barang'] ?>">
                                                   <?php 
										  $query=mysql_query("select * from sub_kategori_barang where kategori='".$row['kode_kategori_barang']."' order by sub_kategori");
										  while($sub=mysql_fetch_array($query)){ ?>
                  <option value="<?php echo $sub['0'] ?>" ><?php echo $row['kategori_barang'] ?> - <?php echo $sub['sub_kategori'] ?></option><?php } ?>
                                                  </optgroup>
                                                <?php } ?>
                                            </select>
								</div>
						
						<div class="form-group">
							<label id="nama">ID </label>	
							
							
								<input type="text" class="form-control" name="barcode" />
							
						</div>
						<div class="form-group">
							<label id="nama">Nama Barang <b style="color:red;">*</b></label>	
							
							
								<input type="text" class="form-control" name="nama_barang" required/>
							
						</div>
						<div class="form-group">
                                      <label>Satuan <b style="color:red;">*</b></label>
                                      <select name="satuan" id="select" class="form-control">
                                         <?php 
                                         $qry=mysql_query("select satuan,pilih from satuan_produk");
                                         while($row=mysql_fetch_array($qry)){
                                         ?>
                                          <option value="<?php echo $row[0] ?>" <?php if($row[1]=="ya") echo "selected" ?>><?php echo $row[0] ?> </option>
                                          <?php } ?>
                                        </select>
								</div>
									<div class="form-group">
                                      <label>Tipe Barang <b style="color:red;">*</b></label>
                                      <select name="tipe_barang" id="select" class="form-control">
                                        
                                          <option value="Toko">Toko</option>
                                         <option value="Konsinyasi">Konsinyasi</option>
                                        </select>
								</div>
					  </div>

						
                        
                        
                        
                        <div class="col-sm-4">
									<div class="form-group">
						  <label>Stok Minimum <b style="color:red;">*</b></label>
						  <input type="number" class="form-control" name="stok_min" required="required" step="any" />
						</div>
							<div class="form-group">
						  <label>Stok Awal <b style="color:red;">*</b></label>
						  <input type="number" class="form-control" name="stok" required="required" step="any" value="0" readonly/>
						</div>
                                	<div class="form-group">
						  <label>Harga Beli <b style="color:red;">*</b></label>
						  <input type="number" class="form-control" name="harga_beli" required="required" step="any"/>
						</div>
						<div class="form-group">
						  <label>Harga Jual <b style="color:red;">*</b></label>
						  <input type="number" class="form-control" name="harga_jual" required="required" step="any"/>
						</div>
                        <div class="form-group">
						  <label>Keterangan <b style="color:red;">*</b></label>
						  <textarea name="ket" class="form-control" rows="5"></textarea>
						</div>
                        
                                </div>
                                  <div class="col-sm-4">
                                  <?php
								
								$photo="img/no-image.jpg";
									
							
						?>
							<div class="form-group">
								<label for="exampleInputFile" class="pull-left">Foto &nbsp;</label>
								<input type="file" id="exampleInputFile" name="file" onchange="readURL(this);" style="width:65%;" accept="image/*">
								<input type="hidden" name="capture_lama">
							</div>
							<center><img id="img_prev" src="<?php echo $photo?>" alt="capture photo" style="width:60%;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/></center>
                            </div>
						
						<div class="clearfix"></div>
					</div><!-- /.box-body -->
					<div class="box-footer">
					<div class="col-xs-12">
						<small class="badge bg-red">* &nbsp;:&nbsp; Wajib Isi</small>
						<a class="btn btn-default btnNext pull-right" >Next <i class="fa fa-chevron-right"></i></a> 
					</div>
					<div class="clearfix"></div>
					</div>  
				</div><!-- /.box -->    
               
                            <div class="tab-pane " id="tab-data">
                             <div class="col-xs-12">
                            		<table class="table table-bordered" id="addhereform">
                                         	<tr>
                                         		
                                         		<th>
                                         				Gudang	
                                         		</th>
                                         	
                                         		<th>
                                         				Harga
                                         		</th>
                                         		<th>
                                         				Aksi
                                         		</th>
                                         	</tr>
                                         	<tr>
                                         	 
                                         	  <th><select name="gudang"   class="form-control" required id="gudang">
																
													<?php 
															$qrybank=mysql_query("select * from gudang order by sort_by");
															while($bank=mysql_fetch_array($qrybank)){
													?>
													<option value="<?php echo $bank[0] ?>" <?php if($bank[0] == @$filter_gudang) echo "selected" ?>><?php echo $bank[1] ?></option><?php } ?>

											</select></th>
                                         	 
                                         	  <th><input name="harga_jual_gudang" type="text" id="harga_jual_gudang" placeholder="Harga Jual" value="" size="22%" class="bersih form-control" />
                                       	    </th>
                                         	
                                         		  <td><input type="button" id="padd" name="padd2" value="Add" class="btn btn-sm btn-default" style="font-weight:bold;font-size:12px" onclick="valid()"/></td>
                                       	  </tr>
                                       	 <?php 
													
													 $qryharga=mysql_query("select * from harga_tiap_gudang where kode_barang ='".$row['kode_barang']."'");
													 while($rowharga=mysql_fetch_array($qryharga)){
													?>
                                                   <tr>
                                                   <td ><input type="hidden" size="40%" name="pname[]" value="<?php echo $rowharga['kd_gudang'] ?>" readonly/><span><?php echo $rowharga['kd_gudang'] ?></span> </td>
                                                   <td   style="vertical-align: middle !important;text-align: left"><input type="hidden"  name="harga_jual_gudang[]" value="<?php echo $rowharga['harga_jual'] ?>" readonly/><span><?php echo $rowharga['harga_jual'] ?></td>
                                                   <td  style="vertical-align: middle !important;text-align: center"> <a  id="HapusInput" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></td></tr>
                                                   
                                                <?php } ?> 
                                      </table>
                                       </div>
                                  <div class="box-footer">
                                    <div class="col-xs-12">
                                       
                                        <button type="submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-save"></i> &nbsp;Update</button><a class="btn btn-default btnPrevious pull-right"><i class="fa fa-chevron-left"></i> Previous</a>
                                    </div>
                                    <div class="clearfix"></div>
                                    </div>
                            </div>
            			</div><!-- /.tab-content -->    </form>      
			</div>
          </div>
</section><!-- /.content -->
 <script> $('.btnNext').click(function(){
  $('.nav-tabs > .active').next('li').find('a').trigger('click');
});

  $('.btnPrevious').click(function(){
  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});</script>