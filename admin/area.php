<?php
include "koneksi.php";
koneksi_buka();
?>
<script language="javascript">
   function setBrg(vkd){
     window.opener.document.getElementById('satuan').value = vkd;
     window.self.close();
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
		Area</h1>
</section>

<section class="content">
  <div class="row">
  					<div class="col-xs-3">
							 <div class="box box-primary">
								<div class="box-header">
									
								</div>  <?php 
									if(isset($_GET['pesan'])){?>  
                                      <div class="callout callout-<?php if($_GET['pesan']=="error"){ echo "danger";}else{ echo "info"; } ?>">
                                        <h4><?php if($_GET['pesan']=="error"){ echo "Mohon Maaf";}else{ echo "Success"; }?></h4>
                                        <?php if($_GET['pesan']=="error"){ 
										?>
                                        <p>Area <b><?php echo $_GET['area'] ?></b> sudah ada.</p><?php } ?>
                                    </div>
									<?php }?>
								<form action="simpan.area.php" method="post" enctype="multipart/form-data">
								<div class="box-body">		
								
									
                                     <div class="form-group" id="status">
										<label>Kota<b style="color:red;">*</b></label>	
                                        <select name="kota" class="form-control">
                                        <?php $qry=mysql_query("select * from kota");while($row=mysql_fetch_array($qry)){?>
										   	<option value="<?php echo $row[0] ?>" <?php if($row['0']==@$_GET['kota']) echo "selected" ?>><?php echo $row[1] ?></option>
                                            <?php } ?>
                                        </select>
									</div>
                                    <div class="form-group" id="status">
										<label>Area<b style="color:red;">*</b></label>	
										    <input type="text" class="form-control" name="area"  required="required"  />
									</div>
                                    
<button "submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-save"></i> &nbsp;Simpan</button>
								</div>
								</form>
								<div class="clearfix"></div>
							</div>
						</div>
                        
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    
                            </div><!-- /.box-header -->
                                <div class="box-body" style="padding-top:0px;">
									
                                        <form action="?page=area" method="post">
										<div class="input-group">
                                            <input type="text" name="cari" class="form-control input-sm pull-right" style="width: 20%;" placeholder="Search" value="<?php echo @$_POST['cari']?>"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
										</form>
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th width="10" style="text-align:center;">No</th>
											<th width="" style="text-align:center;">Provinsi</th>
                                            <th width="" style="text-align:center;">Kota</th>
                                            <th width="" style="text-align:center;">Area</th>
                                        </tr>
										<?php
										$limit = 30;
										if(isset($_GET['hal'])){
											$hal = $_GET['hal'];
										}
										else{
											$hal = 1;
										}

										$offset = ($hal - 1) * $limit;
										$i=1;
										$qry=mysql_query("select * from provinsi,kota,area where provinsi.idProvinsi=kota.idProvinsi and kota.idKota=area.idKota and namaProvinsi like '%".@$_POST['cari']."%' or 
										provinsi.idProvinsi=kota.idProvinsi and kota.idKota=area.idKota and namaKota like '%".@$_POST['cari']."%' or 
										provinsi.idProvinsi=kota.idProvinsi and kota.idKota=area.idKota and namaArea like '%".@$_POST['cari']."%'
										 order by namaprovinsi,namaKota  asc LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr  onclick="javascript:setBrg('<?php echo $row['1'] ?>')">
                                            <td align="center"><?php echo $i;?></td>
											 <td style="text-align:center;"><?php 
											 if(@$provinsi<>$row['1']) 
											 { echo $row['1']; };
											 @$provinsi=$row['1'] ?></td>
                                              <td style="text-align:center;"><?php 
											  if(@$kota<>$row['namaKota']) 
											 { echo $row['namaKota']; };
											 @$kota=$row['namaKota']
											   ?></td>
                                               <td style="text-align:center;"><?php echo $row['namaArea'] ?></td>
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                    </table>
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
									$query  = "SELECT COUNT(area.idkota) AS jumData from provinsi,kota,area where provinsi.idProvinsi=kota.idProvinsi and kota.idKota=area.idKota and namaProvinsi like '%".@$_POST['cari']."%' or 
										provinsi.idProvinsi=kota.idProvinsi and kota.idKota=area.idKota and namaKota like '%".@$_POST['cari']."%' or 
										provinsi.idProvinsi=kota.idProvinsi and kota.idKota=area.idKota and namaArea like '%".@$_POST['cari']."%'";
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
											if ($i == $hal) echo "<li><a href=''><b>".$i."</b></a></li>";
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=area&hal=".$i."'>".$i."</a></li>";
										 }
								}
								?>
                                </ul>
								<label style="float:right;margin-top:5px;">
									Page :&nbsp;&nbsp;
								</label>
                                </div>
                            </div><!-- /.box -->
                        </div>
                    </div>
</section><!-- /.content -->
<?php
koneksi_tutup();
?>