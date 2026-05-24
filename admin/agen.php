<?php
include "koneksi.php";
koneksi_buka();

date_default_timezone_set("Asia/Makassar");
?>
<section class="content-header">
	<h1>
		Agen<small></small>
    </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Data Agen</h3>
                            </div><!-- /.box-header -->
                                <div class="box-body" style="padding-top:0px;">
									<a href="?page=tambah.agen" class="btn btn-danger btn-flat" style="float:left;"><i class="fa fa-pencil"></i> &nbsp;Tambah</a>
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
                                            <th style="text-align:center;">Username</th>
											<th style="text-align:center;">Nama</th>
                                            <th >Alamat</th>
                                            <th >Tanggal Gabung</th>
                                             <th style="text-align:center;">Status</th>                                           <?php if ($_SESSION['loglevel_graha']=="Administrator"){ ?>
                                            <th style="text-align:center;">Aksi</th><?php } ?>
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
										  $qry=mysql_query("select * from agen,area,kota where kota.idKota=agen.idKota and area.idArea=agen.idArea and username like '%".@$_POST['cari']."%' and agen.idProvinsi='".$_SESSION["idProvinsi"]."' or 
										 kota.idKota=agen.idKota and area.idArea=agen.idArea and nama like '%".@$_POST['cari']."%' and agen.idProvinsi='".$_SESSION["idProvinsi"]."'  order by tanggal_bergabung desc LIMIT $offset, $limit");}
										  else{
										$qry=mysql_query("select * from agen,area,kota where kota.idKota=agen.idKota and area.idArea=agen.idArea and  username like '%".@$_POST['cari']."%' or kota.idKota=agen.idKota and area.idArea=agen.idArea and nama like '%".@$_POST['cari']."%' order by tanggal_bergabung desc LIMIT $offset, $limit");}
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
                                            <td align="center"><?php echo $row['username'];?></td>
											 <td style="text-align:center;"><?php echo (($row['nama'])) ?></td>
                         <td><?php echo "
						
													<b>Kota : </b>".($row['namaKota'])."<br>
													<b>Area : </b>".($row['namaArea'])."<br>
						 $row[alamat]. <br><b>Telp :</b> $row[telp]
											";
											 ?></td>
                                            <td align="center"><?php echo date("d-m-Y",strtotime($row['tanggal_bergabung'])) ?></td>
                                              <td align="center"><?php
											  if($row['status_agen']=="Y"){
											  ?>
                                              <a class="btn btn-success btn-xs">aktif</a>
                                              <?php 
											  }else{
												?>  
											   <a class="btn btn-danger btn-xs">belum</a><?php } ?></td>
                                         
                                            <td style="text-align:center;">
										
                                        	 <?php
	 	if($row['status_agen']<>"Y"){
		 ?><a class="btn btn-xs btn-success setuju" href="proses.member.php?status=Y&username=<?php echo $row['username']?>">Aktifkan</a>
           <?php
			}else{ ?>
         <a class="btn btn-xs btn-danger hapus" href="proses.member.php?status=T&username=<?php echo $row['username']?>">Non Aktifkan</a> <?php } ?>
           <?php if ($_SESSION['loglevel_graha']=="Administrator"){ ?>
										|	<a href="?page=hapus.member&username=<?php echo $row['username']?>" class="hapus"><span class="fa fa-trash-o"></span></a></td><?php } ?>
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
									$query  = "SELECT COUNT(nama) AS jumData from agen where username like '%".@$_POST['cari']."%' and idProvinsi='".$_SESSION["idProvinsi"]."' or nama like '%".@$_POST['cari']."%' and idProvinsi='".$_SESSION["idProvinsi"]."'";}else{
									$query  = "SELECT COUNT(nama) AS jumData from agen where username like '%".@$_POST['cari']."%' or nama like '%".@$_POST['cari']."%' ";	
									}
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

	 var setuju=confirm("Apakah Anda Yakin Untuk Non Aktifkan Akun Ini?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script>
