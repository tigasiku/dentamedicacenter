<?php
@session_start();
include "koneksi.php";
include "function.php";
if(isset($_GET['cari'])){
$cari=$_GET['cari'];
}else{
$cari=$_POST['cari'];
}
/* <button class="btn btn-default pull-right" id="myelement2" ><i class="fa fa-search"></i></button>style="<?php if(isset($_POST['submit'])) {echo "display:block";}else{ echo "display:none"; }  ?>"*/
?>
  
 <div class="box box-primary" style="padding-left: 15px;
    padding-right: 15px;">
                            <div class="box-header">
                             <br>
								<div class="well" id="another-element2" >
								  <div class="row">

									<div class="col-sm-4">


									  <div class="form-group">
										<label class="control-label" for="input-model">Nama Barang</label>
										<input type="text" name="filter_nama" value="<?php echo rtrim(@$_GET['cari']) ?>" placeholder="Barang" id="cari" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
									  </div>
									</div>

									<div class="col-sm-4">
									 <div class="form-group">
										<label class="control-label" for="input-model">Kategori Barang</label>

												<select name="filter_kategori" class="form-control" id="cmbKategori">
													<option value="">Semua</option>
												<?php

													$qry_kategory=mysql_query("select *  from kategori_barang order by kategori_barang");
													while($kategori=mysql_fetch_array($qry_kategory)){
												?>
												<option value="<?php echo $kategori['kode_kategori_barang'] ?>" <?php if($kategori['kode_kategori_barang']==@$_GET['filter_kategori']) echo "selected" ?>><?php echo $kategori['kategori_barang'] ?></option><?php } ?>
										</select>
									  </div>


									</div>
									<div class="col-sm-4">
									 <div class="form-group">
										<label class="control-label" for="input-model">Sub Kategori Barang</label>

												<select name="filter_sub_kategori" class="form-control" id="subKategori">
													<option value="">Semua</option>

											<?php
													if(!empty($filter_kategori)){
													$qry_kategory=mysql_query("select *  from  sub_kategori_barang where kategori='".$filter_kategori."'");
													while($kategori=mysql_fetch_array($qry_kategory)){
												?>
												<option value="<?php echo $kategori['id'] ?>" <?php if($kategori['id'] == @$filter_sub_kategori) echo "selected" ?>><?php echo $kategori['sub_kategori'] ?></option><?php } } ?>
										</select>
									  </div>
										  <input type="hidden" name="gudang" style="max-width: 200px" placeholder="Gudang" value="<?php echo @$_GET['gudang'] ?>" id='gudangnya' />
									  <button  id="pencarian" class="btn btn-primary pull-right" name="submit"><i class="fa fa-search"></i> Filter</button>
									</div>
								  </div>
								</div>
								
                          </div><!-- /.box-header -->
                            
									
										
                               	<hr>
                                  <ul class="nav nav-tabs " >
                                   	<?php
									  		$qry_gudang=mysql_query("select * from gudang  where kd_gudang='".$_GET['gudang']."' order by sort_by");
											while($row_gudang=mysql_fetch_array($qry_gudang)){
									  ?>
       	  						 <li class="<?php echo $row_gudang['2'] ?> active"><a href="#<?php echo $row_gudang['0'] ?>" data-toggle="tab"><?php echo $row_gudang['1'] ?></a></li>
       								<?php } ?>
         
          </ul>
                                  
                                  <div class="tab-content" style="background-color: #fff !important">
                                   <?php
									  		$qry_gudang=mysql_query("select * from gudang where kd_gudang='".$_GET['gudang']."' order by sort_by");
											while($row_gudang=mysql_fetch_array($qry_gudang)){
									  ?>
                                   
                                       <div class="tab-pane active" id="<?php echo $row_gudang['0'] ?>"> 
										   <?php  if(isMobile()){ ?>
										  
                                <table class="table table-hover table-bordered" style="  margin-top:10px;font-size: 
																					   <?php  if(isMobile()){  echo "13px"; } else{ echo "13px !important";} ?>;">
                                    <tr>
                                       	<th >Nama Barang</th> 
                                       	<th  style="text-align:center;">Stok</th>
                                        <th style="text-align:right;">Harga Jual</th>
                                    </tr>
                                    <?php
										$limit = 10;
										if(isset($_GET['hal2'])){
											$hal = $_GET['hal2'];
										}
										else{
											$hal = 1;
										}

										$offset = ($hal - 1) * $limit;
										$i=1;
								 if(!empty($_GET['filter_sub_kategori'])){
												  
											 $qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".rtrim(@$_GET['cari'])."%'  and barang.kode_kategori= '".@$_GET['filter_kategori']."' and barang.kode_sub_kategori= '".@$_GET['filter_sub_kategori']."'  and status_barang='Y'  order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id,nama_barang asc LIMIT $offset, $limit");
														
									}
									elseif(!empty($_GET['filter_kategori'])){
												 
												  
									 		
									 $qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".rtrim(@$_GET['cari'])."%'  and barang.kode_kategori= '".@$_GET['filter_kategori']."' and status_barang='Y' order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id,nama_barang asc LIMIT $offset, $limit");
									 
											  }else{
										$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".rtrim(@$_GET['cari'])."%' and status_barang='Y'  order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id,nama_barang asc LIMIT $offset, $limit");}
																 
																 
										while($row=mysql_fetch_array($qry)){
										?>
                                    <tr onclick="javascript:setBrg('<?php echo $row['kode_barang'] ?>','<?php echo $row['kategori_barang'] ?> - <?php echo $row['sub_kategori'] ?> - <?php echo str_replace('"','&quot;',$row['nama_barang']); ?>','<?php  echo $row['satuan']?>','<?php  echo $row['harga_jual']?>','<?php  echo $row['harga_beli']?>')" style="font-size: <?php  if(isMobile()){ echo "13px"; } else{ echo "13px !important";} ?>;" class="use-address">
                                        <td style="text-align:left;border:0px !important;;padding: 0px !important;padding-left: 4px !important"><?php
												if ($row['gambar']==""){
													$photo="img/no-image.jpg";
												}else{
													$photo="photo_barang/$row[gambar]";
												}
												?>
												<img src="<?php echo $photo;?>" style="width:100px;border:solid 4px #fff;box-shadow:0px 0px 2px #999;float:left;margin-right: 10px"> - <?php echo $row['kategori_barang'] ?> <br>
                                          									-- <?php echo $row['sub_kategori'] ?><br>
                                          									<span class="namanya" style="text-align:left;"><b><?php echo $row['nama_barang'] ?></b></span>
                                      </td>
                                        <td rowspan="2" style="text-align:center;"><?php 	
												$num_masuk=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='masuk' and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang['0']."'")));
												$num_keluar=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='keluar'  and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang['0']."'")));
											
												$qty_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from pembelian_detail,pembelian where pembelian_detail.no_beli=pembelian.no_beli and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
												$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail,penjualan where penjualan.no_jual=penjualan_detail.no_jual and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
												$stok_keluar=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_keluar where kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
											
												$stok_masuk=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_masuk where kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
											
												if($row_gudang['stok_awal']=="Y"){	
												echo 	$stok=($qty_beli[0]+$row['stok']+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];}else{
													
												echo 	$stok=($qty_beli[0]+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];	
												}   ?>
                                          <span class="satuan"><?php echo $row['satuan'] ?></span></td>
                                        <td rowspan="2" style="text-align:right;"><?php 
													
													$qryharga=mysql_query("select * from harga_tiap_gudang where kode_barang ='".$row['kode_barang']."' and kd_gudang ='".$row_gudang['0']."'");
											$cekharga=mysql_num_rows($qryharga);
											$harga=mysql_fetch_array($qryharga);
											if($cekharga > 0){
											echo	number_format($harga_jual=$harga['harga_jual']);
											}else{
											echo number_format($harga_jual=$row['harga_jual']);}
													?><span class="harga_jual" style="display: none"><?php echo $harga_jual ?></span><span class="harga_beli" style="display: none"><?php echo ($row['harga_beli']) ?></span><span style="text-align:left;display: none" class='kode'><?php echo $row['kode_barang'] ?></span></td>
                                    </tr>
                                    <tr onclick="javascript:setBrg('<?php echo $row['kode_barang'] ?>','<?php echo $row['kategori_barang'] ?> - <?php echo $row['sub_kategori'] ?> - <?php echo str_replace('"','&quot;',$row['nama_barang']); ?>','<?php  echo $row['satuan']?>','<?php  echo $row['harga_jual']?>','<?php  echo $row['harga_beli']?>')" style="font-size: <?php  if(isMobile()){ echo "13px"; } else{ echo "13px !important";} ?>;" class="use-address">
                                      <td style="text-align:left;;border-top:0px !important;;padding: 0px !important;padding-left: 4px !important"></td>
                                    </tr>
                                    <?php
										$i++;
										}
										?>
                                </table>
										  <?php }else{ ?>
                                <table class="table table-hover table-bordered" style="margin-top:10px;font-size: 
																					  <?php  if(isMobile()){ echo "13px"; } else{ echo "13px !important";} ?>;">
                                  <tr>
                                       	<th >Kategori</th> <th style="text-align:center;">Nama Barang</th>
                                        <th >Satuan</th>
                                           <th >Stok</th>
                                        <th style="text-align:right;">Harga Jual</th>
                                    </tr>
                                    <?php
										$limit = 10;
										if(isset($_GET['hal2'])){
											$hal = $_GET['hal2'];
										}
										else{
											$hal = 1;
										}

										$offset = ($hal - 1) * $limit;
										$i=1;
								
									 if(!empty($_GET['filter_sub_kategori'])){
												  
											 $qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".rtrim(@$_GET['cari'])."%'  and barang.kode_kategori= '".@$_GET['filter_kategori']."'  and barang.kode_sub_kategori= '".@$_GET['filter_sub_kategori']."' and status_barang='Y' order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id,nama_barang asc LIMIT $offset, $limit");
														
									}
									elseif(!empty($_GET['filter_kategori'])){
												 
												  
									 		
									 $qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".rtrim(@$_GET['cari'])."%'  and barang.kode_kategori= '".@$_GET['filter_kategori']."' and status_barang='Y' order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id,nama_barang asc LIMIT $offset, $limit");
									 
											  }else{
										$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".rtrim(@$_GET['cari'])."%' and status_barang='Y' order by kategori_barang.kode_kategori_barang,sub_kategori_barang.id,nama_barang asc LIMIT $offset, $limit");}
										while($row=mysql_fetch_array($qry)){
										?>
                                    <tr onclick="javascript:setBrg('<?php echo $row['kode_barang'] ?>','<?php echo $row['kategori_barang'] ?> - <?php echo $row['sub_kategori'] ?> - <?php echo str_replace('"','&quot;',$row['nama_barang']); ?>','<?php  echo $row['satuan']?>','<?php  echo $row['harga_jual']?>','<?php  echo $row['harga_beli']?>')" style="font-size: <?php  if(isMobile()){ echo "13px"; } else{ echo "13px !important";} ?>;" class="use-address">
                                        <td style="text-align:left;">- <?php echo $row['kategori_barang'] ?> <br>
                                          									-- <?php echo $row['sub_kategori'] ?>
                                      </td>
                                        <td style="text-align:center;"><span style="text-align:left;" class='namanya'><?php echo $row['nama_barang'] ?></span></td>
                                        <td><span class="satuan"><?php echo $row['satuan'] ?></span></td>
                                           <td><?php 	
												$num_masuk=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='masuk' and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang['0']."'")));
												$num_keluar=(mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from  mutasi_gudang where tipe='keluar'  and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang['0']."'")));
											
												$qty_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from pembelian_detail,pembelian where pembelian_detail.no_beli=pembelian.no_beli and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
												$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail,penjualan where penjualan.no_jual=penjualan_detail.no_jual and kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
												$stok_keluar=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_keluar where kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
											
												$stok_masuk=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_masuk where kode_barang='".$row['kode_barang']."' and kd_gudang='".$row_gudang[0]."'"));
											
												if($row_gudang['stok_awal']=="Y"){	
												echo 	$stok=($qty_beli[0]+$row['stok']+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];}else{
													
												echo 	$stok=($qty_beli[0]+$num_masuk['jumlah']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]-$num_keluar['jumlah'];	
												}   ?></td>
                                        <td style="text-align:right;"><?php 
											
											$qryharga=mysql_query("select * from harga_tiap_gudang where kode_barang ='".$row['kode_barang']."' and kd_gudang ='".$row_gudang['0']."'");
											$cekharga=mysql_num_rows($qryharga);
											$harga=mysql_fetch_array($qryharga);
											if($cekharga > 0){
											echo	number_format($harga_jual=$harga['harga_jual']);
											}else{
											echo number_format($harga_jual=$row['harga_jual']);}
											
											
											?><span class="harga_jual" style="display: none"><?php 
											echo ($harga_jual) ?></span><span class="harga_beli" style="display: none"><?php echo ($row['harga_beli']) ?></span><span style="text-align:left;display: none" class='kode'><?php echo $row['kode_barang'] ?></span></td>
                                    </tr>
                                    <?php
										$i++;
										}
										?>
                                </table><?php } ?> </div>
                                  <?php } ?>
                                   
                                  </div>   
                              </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
									
									if(!empty($_GET['filter_sub_kategori'])){
												  
												
										 	$query  = "SELECT COUNT(kode_barang) AS jumData from barang where  kode_kategori= '".@$_GET['filter_kategori']."' and kode_sub_kategori= '".@$_GET['filter_sub_kategori']."' and nama_barang like '%".rtrim(@$_GET['cari'])."%'  and status_barang='Y'";
										}
									  elseif(!empty($_GET['filter_kategori'])){
												  	
												  	$query  = "SELECT COUNT(kode_barang) AS jumData from barang where  kode_kategori= '".@$_GET['filter_kategori']."'  and nama_barang like '%".rtrim(@$_GET['cari'])."%'";
											  }else{
									$query  = "SELECT COUNT(kode_barang) AS jumData FROM barang where nama_barang like '%".rtrim(@$_GET['cari'])."%' and status_barang='Y'";}
									
									
									
									$hasil  = mysql_query($query);
									$data  = mysql_fetch_array($hasil);
									$jumData = $data['jumData'];
									$jumPage = ceil($jumData/$limit);
								?>
								<label style="float:left;margin-top:6px;">
								<?php
								if ($jumData==0){
									echo "Showing 0 to 0 of 0 Entries";
								}else{
								
								?>
								Showing <?php echo $offset+1;?> to 
								<?php 
								if ($jumPage==$hal){
								echo $jumData;
								}else{
								echo $limit*$hal;
								}
								?> 
								of <?php echo $jumData;?> Entries &nbsp;&nbsp;
								<?php } ?>
								</label>
								<ul class="pagination pagination-sm no-margin pull-right">
								<?php
								for($i = 1; $i <= $jumPage; $i++){
										 if ((($i >= $hal - 3) && ($i <= $hal + 3)) || ($i == 1) || ($i == $jumPage))
										 {
											if ($i == $hal) echo "<li><a ><b>".$i."</b></a></li>";
											else echo "<li class='announce'><a   class='satuan'>".$i."</a></li>";
										 }
								}
									
								?>
                                </ul>
								<label style="float:right;margin-top:5px;">
									Page :&nbsp;&nbsp;
								</label>
                                </div>
                             
                      
<script>

//<![CDATA[
$(document).ready(function() {
	 $(".announce").click(function(){ // Click to only happen on announce links
				
		 var kategori = $("#cmbKategori").val();
		 var sub_kategori = $("#subKategori").val();
		   var gudangnya = $("#gudangnya").val();
		 var row3 = $(this).closest("li"); 
 		  var namanya2 = $("#cari").val();
			  var namanya = row3.find(".satuan").text();
					var komen =2;
		 
				  var dataString = 'hal2='+ namanya ;
									$.ajax({
										 

										 success: function()
													   {
										
								
														
										  $('#content').load(encodeURI('isi_list_barangnya.php?hal2='+namanya+'&cari='+namanya2+'&gudang='+gudangnya+'&filter_kategori='+kategori+'&filter_sub_kategori='+sub_kategori));
														   $('#content').stop();
									   }
									});
		 
		 
		 
		 
		 
				
			   });
	$("#pencarian").click(function(){ // Click to only happen on announce links
				
		 
		 
	

			  var namanya = $("#cari").val();
				  var gudangnya = $("#gudangnya").val();
		 var kategori = $("#cmbKategori").val();
		 var sub_kategori = $("#subKategori").val();
		
				  var dataString = 'cari='+ namanya ;
									$.ajax({
										 

										 success: function()
													   {
										
								
														
										  $('#content').load(encodeURI('isi_list_barangnya.php?cari='+namanya+'&gudang='+gudangnya+'&filter_kategori='+kategori+'&filter_sub_kategori='+sub_kategori));
											$('#content').stop();			 
									   }
									});
		 
		 
		 
		 
		 
				
			   });
	$("#cmbKategori").change(function(){ // Click to only happen on announce links
				
		 
		 
	

			  var namanya = $("#cari").val();
				  var gudangnya = $("#gudangnya").val();
		 var kategori = $("#cmbKategori").val();
		 var sub_kategori = $("#subKategori").val();
		
				  var dataString = 'cari='+ namanya ;
									$.ajax({
										 

										 success: function()
													   {
										
								
														
										  $('#content').load(encodeURI('isi_list_barangnya.php?cari='+namanya+'&gudang='+gudangnya+'&filter_kategori='+kategori+'&filter_sub_kategori='+sub_kategori));
											$('#content').stop();			 
									   }
									});
		 
		 
		 
		 
		 
				
			   });
	
	$("#subKategori").change(function(){ // Click to only happen on announce links
				
		 
		 
	

			  var namanya = $("#cari").val();
				  var gudangnya = $("#gudangnya").val();
		 var kategori = $("#cmbKategori").val();
		 var sub_kategori = $("#subKategori").val();
		
				  var dataString = 'cari='+ namanya ;
									$.ajax({
										 

										 success: function()
													   {
										
								
														
										  $('#content').load(encodeURI('isi_list_barangnya.php?cari='+namanya+'&gudang='+gudangnya+'&filter_kategori='+kategori+'&filter_sub_kategori='+sub_kategori));
											$('#content').stop();			 
									   }
									});
		 
		 
		 
		 
		 
				
			   });
	
$(".use-address").click(function() {
    var $row = $(this).closest("tr");    // Find the row
	  var $row2 = $(this).closest('tr').next();
    var $text = $row.find(".kode").text(); // Find the text
	<?php if(isMobile()){ ?>
     var $namanya = $row.find(".namanya").text();<?php  ?> // Find the text
	<?php }else{ ?>
     var $namanya = $row.find(".namanya").text();<?php } ?> // Find the text
	    var $harga_jual = $row.find(".harga_jual").text(); // Find the text
	    var $harga_beli = $row.find(".harga_beli").text(); // Find the text
	    var $satuan= $row.find(".satuan").text(); // Find the text
	    var $qty = $row.find(".qty").text(); // Find the text
	 var $sub_total = $row.find(".sub_total").text(); // Find the text
    // Let's test it out
	$("#kode").val($text);
	$("#pname").val($namanya); 

	$("#harga_jual").val($harga_jual); 
	$("#harga_beli").val($harga_beli); 
		$("#satuan").val($satuan); 

	 $('#basicModal').modal('hide');
		$("#qty").focus();
});
});//]]> 


</script>
<script>
	$( document ).ready(function() {
			$( "#myelement2" ).click(function() {     
				if($('#another-element2:visible').length)
					$('#another-element2').hide("slide", { direction: "up" }, 300);
				else
					$('#another-element2').show("slide", { direction: "up" }, 300);        
			});
	});	
</script>