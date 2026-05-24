<?php
include "koneksi.php";

?>
<script language="javascript">
   function setBrg(vkd){
     window.opener.document.getElementById('satuan').value = vkd;
     window.self.close();
   }
</script>
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
<section class="content-header">
	<h1>
		Account</h1>
</section>

<section class="content">
  <div class="row">
  					<div class="col-sm-3">
							<div class="box box-solid box-warning">
								<div class="box-header">
									<h3 class="box-title">Data</h3>
								</div>  <?php 
									if(isset($_GET['pesan'])){ ?>  
                                  <div class="small-box <?php if((@$_GET['pesan']=="success")){ echo "bg-green"; }else{  echo "bg-red"; }?>">
                                <div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                                </div>
                              </div><?php }?>
								<form action="simpan.rek.perusahaan.php" method="post" enctype="multipart/form-data">
								<div class="box-body">		
								
									
                                     <div class="form-group" id="status">
										<label>Nama Account<b style="color:red;">*</b></label>	
										    <input type="text" class="form-control" name="bank"  required="required"  />
									</div>
                                    <div class="form-group" id="status">
										<label>No Rek<b style="color:red;">*</b></label>	
										    <input type="text" class="form-control" name="no_rek"   />
									</div>
                                    <div class="form-group" id="status">
										<label>Atas Nama<b style="color:red;">*</b></label>	
										    <input type="text" class="form-control" name="atas_nama"    />
									</div>
                                     <div class="form-group" id="status">
										<label>Warna<b style="color:red;">*</b></label>	
                                        
										 <select class="form-control form-control2" name="warna" required="required">
                                            <option value="bg-green" style="background-color: rgb(0, 166, 90) !important;">Hijau </option>
                                             <option value="bg-olive" style="background-color: rgb(61, 153, 112)  !important;">Zaitun </option>
                                              <option value="bg-lime" style="background-color: rgb(1, 255, 112)  !important;">Lime </option>
                                               <option value="bg-orange" style="background-color: rgb(255, 133, 27);">Orange </option>
                                                <option value="bg-fuchsia" style="background-color: rgb(240, 18, 190);">Fuchsia </option>
                                                 <option value="bg-purple" style="background-color: rgb(147, 42, 182);">Ungu </option>
                                                     <option value="bg-maroon" style="background-color: rgb(133, 20, 75);">Maroon </option>
                                                         <option value="bg-yellow" style="background-color: rgb(243, 156, 18);">Kuning </option>
                                                             <option value="bg-aqua" style="background-color: rgb(0, 192, 239);">Aqua </option>
                                                              <option value="bg-blue" style="background-color: rgb(0, 115, 183);">Biru </option>
                                                               <option value="bg-red" style="background-color: rgb(245, 105, 84);">Merah </option>
                                                                <option value="bg-black" style="background-color: rgb(34, 34, 34);">Hitam </option>
                                                                 <option value="bg-gray" style="background-color: rgb(234, 234, 236);">Abu-abu </option>
                                                                   <option value="bg-light-blue" style="background-color: rgb(60, 141, 188);">Biru terang</option>
                                                                 
                                                             
                                            </select>
									</div>
									 <div class="form-group" id="status">
										<label>Dana Awal<b style="color:red;">*</b></label>	
										   <div class="input-group">
                                            	<div class="input-group-addon">
                                                	Rp.
                                                </div>
	                                       	<input type="text" name="jumlah"   class="form-control"  placeholder='Jumlah'  value="" onblur="x1 = Number(this.value) || 0; this.value=addCommas(this.value)">
                                        </div>
									</div>
										 <div class="form-group" id="status">
										<label>Sort By<b style="color:red;">*</b></label>	
										
	                                       	<input type="text" name="sort_by"   class="form-control"  placeholder='Sort By'  value="" >
                                       
									</div>
<button "submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-save"></i> &nbsp;Simpan</button>
								</div>
								</form>
								<div class="clearfix"></div>
							</div>
						</div>
                        
                        <div class="col-sm-9">
                            <div class="box box-waring">
                                <div class="box-header">
                            </div><!-- /.box-header -->
                                <div class="box-body" style="padding-top:0px;">
									
                                        <form action="?page=satuan" method="post">
										<div class="input-group">
                                            <input type="text" name="cari" class="form-control input-sm pull-right" style="width: 20%;" placeholder="Search" value="<?php echo @$_POST['cari']?>"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
										</form>
                                        <div class="table-responsive">
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th width="10" style="text-align:center;">No</th>
											<th width="" style="text-align:center;">Kode </th>
                                            <th width="" style="text-align:center;">Nama </th>
                                            <th width="" style="text-align:center;">No Rek</th>
                                            <th width="" style="text-align:center;">Atas Nama</th>
                                             <th width="" style="text-align:center;">Status</th>
                                       		  <th width="" style="text-align:center;">Aksi</th>
                                        </tr>
										<?php
										
										$i=1;
										$qry=mysql_query("select * from bank_perusahaan where nama_bank like '%".@$_POST['cari']."%' order by sort_by");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr  onclick="javascript:setBrg('<?php echo $row['1'] ?>')">
                                            <td align="center"><?php echo $i;?></td>
											 <td style="text-align:center;"><?php echo $row['0'] ?></td>
                                              <td style="text-align:center;"><?php echo $row['1'] ?></td>
                                               <td style="text-align:center;white-space:nowrap"><?php echo $row['2'] ?></td>
                                                <td style="text-align:center;"><?php echo $row['3'] ?></td>
                                                             <td style="text-align:center;"><?php echo $row['status'] ?></td>
                                                            <td style="text-align:center;"><a href="?page=edit.rek.perusahaan&id=<?php echo $row[0]?>"><span class="fa fa-edit"></span></a>  
											<a href="?page=hapus.rek.perusahaan&id=<?php echo $row[0]?>" class="hapus"><span class="fa fa-trash-o"></span></a></td>
                                                 
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                    </table></div>
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<div class="row">
										<?php 

												$qrybank=mysql_query("select * from bank_perusahaan order by kd_bank");
												while($bank=mysql_fetch_array($qrybank)){

										?>
											 <div class="col-lg-3 col-xs-6">
													<!-- small box -->
													<div class="small-box <?php echo $bank['color'] ?>">
														<div class="inner">
															<h3>
																  <?php 
																			$saldo_awal	=(mysql_fetch_array(mysql_query("select saldo from saldo_awal_kas where  kd_bank='".$bank['0']."'")));
																			$num_debet=(mysql_fetch_array(mysql_query("select sum(nilai) as total_debet from arus_kas where tipe_kas='debet' and kd_bank='".$bank['0']."'")));
																			$num_kredit=(mysql_fetch_array(mysql_query("select sum(nilai) as total_kredit from arus_kas where tipe_kas='kredit'  and kd_bank='".$bank['0']."'")));

																			echo number_format($saldo_awal[0]+$num_debet['total_debet']-$num_kredit['total_kredit']);
																			?>
															</h3>
															<p>
															  <?php echo $bank[1] ?> <?php if(!empty($bank[2])) echo " - ".$bank[2] ?> <?php if(!empty($bank[3])) echo " - ".$bank[3] ?>
															</p>
														</div>
														<div class="icon">
															<i class="fa fa-credit-card"></i>
														</div>
														<a href="?page=arus.kas&kd_bank=<?php echo $bank['0'] ?> " class="small-box-footer">
															More info <i class="fa fa-arrow-circle-right"></i>
														</a>
													</div>
												</div>

										<?php } ?>
                               		  </div>
                                </div>
                            </div><!-- /.box -->
                        </div>
                    </div>
</section><!-- /.content -->

<script>
	
$(".form-control2 option").each(function() {


  $(this).css("background-color", $(this).text())
})	
	
$( ".hapus" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin ?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script>