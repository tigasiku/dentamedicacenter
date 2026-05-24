<?php
include "koneksi.php";
koneksi_buka();

date_default_timezone_set("Asia/Makassar");
?>
<section class="content-header">
	<h1>
		Request Property<small></small>
    </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                   
                            </div><!-- /.box-header -->
                                <div class="box-body" style="padding-top:0px;">
										
                              <form action="?page=<?php echo $_GET['page'] ?>" method="post">
										<div class="input-group">
                                            <input type="text" name="cari" class="form-control input-sm pull-right" style="width: 20%;" placeholder="Search" value="<?php echo @$_POST['cari']?>" />
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
										</form>
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>
											<th style="text-align:center;">Nama</th>
                                            <th >Kontak</th>
                                            <th >Kategori Properti</th>
                                            <th >Lokasi Properti</th>
                                            <th >Deskripsi</th>
                                         
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
										if($_SESSION["kd_cabang"]<>"All"){
											if(!empty($_SESSION["ibuKota"])) {	
										$qry=mysql_query("select * from form_order,kota,provinsi,area where kota.idProvinsi=provinsi.idProvinsi and kota.idKota=area.idKota and area.idArea=form_order.idArea and provinsi.idProvinsi='".$_SESSION['idProvinsi']."'  order by tanggal_order desc LIMIT $offset, $limit");}else{
										$qry=mysql_query("select * from form_order,kota,provinsi,area where kota.idProvinsi=provinsi.idProvinsi and kota.idKota=area.idKota and area.idArea=form_order.idArea and kota.idKota='".$_SESSION['idKota']."'  order by tanggal_order desc LIMIT $offset, $limit");
											}
										}else{
											
										$qry=mysql_query("select * from form_order,kota,provinsi,area where kota.idProvinsi=provinsi.idProvinsi and kota.idKota=area.idKota and area.idArea=form_order.idArea order by tanggal_order desc LIMIT $offset, $limit");}
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
                                            <td align="center"><?php echo $row['nama'];?></td> 
                         					<td><?php echo "<b>Telp :</b> $row[telp]. <br><b>Hp:</b> $row[hp]. <br><b>Email :</b> $row[email]"; ?></td>
                                             <td align="center"><?php echo ($row['kategori_properti']) ?></td>
                                            <td style="white-space:nowrap"><?php echo "<b>Provinsi :</b> $row[namaProvinsi]. <br><b>Kota:</b> $row[namaKota]. <br><b>Area :</b> $row[namaArea]"; ?></td>
                                            <td align="center"><?php echo ($row['deskripsi']) ?></td>
                                              
                                           
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                         
                                    </table>
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
									if($_SESSION["kd_cabang"]<>"All"){
										if(!empty($_SESSION["ibuKota"])) {	
											$query  = "SELECT COUNT(nama) AS jumData from form_order where idProvinsi='".$_SESSION['idProvinsi']."'";}else{
											$query  = "SELECT COUNT(nama) AS jumData from form_order where idKota='".$_SESSION['idKota']."'";}
									}else{$query  = "SELECT COUNT(nama) AS jumData from form_order";}
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
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=agen&hal=".$i."'>".$i."</a></li>";
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
?><script>
$( ".hapus" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin Untuk Menghapus Data?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script>
