<?php
include "koneksi.php";

						$i=1;
										$qry=mysql_query("select * from bank_perusahaan where kd_bank= '".$_GET['id']."' ");
										$row=mysql_fetch_array($qry)
									
?>
<script language="javascript">
   function setBrg(vkd){
     window.opener.document.getElementById('satuan').value = vkd;
     window.self.close();
   }
</script><script type = "text/javascript">

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
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
         <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<section class="content-header">
	<h1>
		Account </h1>
</section>

<section class="content">
  <div class="row">
  					<div class="col-sm-3">
							<div class="box box-solid box-warning">
								<div class="box-header">
									<h3 class="box-title">Edit Account</h3>
								</div>  <?php 
									if(isset($_GET['pesan'])){?>  
                                  <div class="small-box bg-green">
                                <div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                                </div>
                              </div><?php }?>
								<form action="perbarui.rek.perusahaan.php" method="post" enctype="multipart/form-data">
								<div class="box-body">		
								
									   <div class="form-group" id="status">
										<label>Nama Account<b style="color:red;">*</b></label>	
										    <input type="text" class="form-control" name="bank"  required="required"  value="<?php  echo $row['1']?>"/><input type="hidden" class="form-control" name="id"  required="required"  value="<?php  echo $row['kd_bank']?>"/>
									</div>
                                   
                                    <div class="form-group" id="status">
										<label>No Rek<b style="color:red;">*</b></label>	
										    <input type="text" class="form-control" name="no_rek"   value="<?php  echo $row['2']?>"/>
									</div>
                                    <div class="form-group" id="status">
										<label>Atas Nama<b style="color:red;">*</b></label>	
										    <input type="text" class="form-control" name="atas_nama"     value="<?php  echo $row['3']?>"/>
									</div>
                                    <div class="form-group" id="status">
										<label>Warna<b style="color:red;">*</b></label>	
                                        
										    <select class="form-control form-control2" name="warna"  required="required"  />
                                            <option value="bg-green" <?php if($row['5']=="bg-green") echo "selected" ?> >Hijau </option>
                                             <option value="bg-olive" <?php if($row['5']=="bg-olive") echo "selected" ?>>Zaitun </option>
                                              <option value="bg-lime" <?php if($row['5']=="bg-lime") echo "selected" ?>>Lime </option>
                                               <option value="bg-orange" <?php if($row['5']=="bg-orange") echo "selected" ?>>Orange </option>
                                                <option value="bg-fuchsia" <?php if($row['5']=="bg-fuchsia") echo "selected" ?>>Fuchsia </option>
                                                 <option value="bg-purple" <?php if($row['5']=="bg-purple") echo "selected" ?>>Ungu </option>
                                                     <option value="bg-maroon" <?php if($row['5']=="bg-maroon") echo "selected" ?>>Maroon </option>
                                                         <option value="bg-yellow" <?php if($row['5']=="bg-yellow") echo "selected" ?>>Kuning </option>
                                                             <option value="bg-aqua" <?php if($row['5']=="bg-aqua") echo "selected" ?>>Aqua </option>
                                                              <option value="bg-blue" <?php if($row['5']=="bg-blue") echo "selected" ?>>Biru </option>
                                                               <option value="bg-red" <?php if($row['5']=="bg-red") echo "selected" ?>>Merah </option>
                                                                <option value="bg-black" <?php if($row['5']=="bg-black") echo "selected" ?>>Hitam </option>
                                                                 <option value="bg-gray" <?php if($row['5']=="bg-gray") echo "selected" ?>>Abu-abu </option>
                                                                   <option value="bg-light-blue" <?php if($row['5']=="bg-light-blue") echo "selected" ?>>Biru terang</option>
                                                                 
                                                             
                                            </select>
									</div>
										 <div class="form-group" id="status">
										<label>Dana Awal<b style="color:red;">*</b></label>	
										   <div class="input-group">
                                            	<div class="input-group-addon">
                                                	Rp.
                                                </div>
	                                       	<input type="text" name="jumlah"   class="form-control"  placeholder='Jumlah'  value="<?php 
																				$saldo_awal	=(mysql_fetch_array(mysql_query("select nilai from arus_kas where  kode='".$row['0']."'")));
																				echo 	number_format($saldo_awal[0]);														  
																			?>" onblur="x1 = Number(this.value) || 0; this.value=addCommas(this.value)">
                                        </div>
									</div>
									
									
									 <div class="form-group" id="status">
										<label>Sort By<b style="color:red;">*</b></label>	
										
	                                       	<input type="text" name="sort_by"   class="form-control"  placeholder='Sort By'   value="<?php  echo $row['sort_by']?>" >
                                       
									</div>
									 <div class="form-group" id="status">
										<label>Status<b style="color:red;">*</b></label>	
                                        
										    <select class="form-control form-control2" name="status"  required="required"  />
                                            <option value="Y" <?php if($row['status']=="Y") echo "selected" ?> >Aktif</option>
                                             
                                            <option value="N" <?php if($row['status']=="N") echo "selected" ?> >Non Aktif</option>
                                                                 
                                                             
                                            </select>
									</div>
<button "submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-save"></i> &nbsp;Simpan</button>
								</div>
								</form>
								<div class="clearfix"></div>
							</div>
						</div>
                        <DIV class="col-sm-9">
                        	<div class="row">
										<?php 

												$qrybank=mysql_query("select * from bank_perusahaan where kd_bank='".$row['0']."'");
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
                        </DIV>
                       
                    </div>
</section><!-- /.content -->
<?php

?>
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