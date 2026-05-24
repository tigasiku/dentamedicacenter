<?php
date_default_timezone_set('Asia/Makassar');
include "koneksi.php";
koneksi_buka();

if(isset($_POST['kategori_properti2'])){	
	$kategori_properti=$_POST['kategori_properti2'];
	$_SESSION['kategori_properti2']=$_POST['kategori_properti2'];
	
	$kategori_jual=$_POST['kategori_jual2'];
	$_SESSION['kategori_jual2']=$_POST['kategori_jual2'];
}else{
	
	@$kategori_properti=$_SESSION['kategori_properti2'];
	@$kategori_jual=$_SESSION['kategori_jual2'];
}

?>
<section class="content-header">
	<h1>
		Properti
        <small><?php echo $_SESSION['judul_graha'] ?></small>
    </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                              </div><!-- /.box-header --> <?php 
									if(isset($_GET['pesan'])){?>  
                                  	<div class="small-box bg-<?php if($_GET['pesan']=="success"){ echo "green";}else{ echo "red";}?> ">
                                		<div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                             			</div>
                        			</div><?php }?>
                                <div class="box-body" style="padding-top:0px;overflow:scroll ">
									
                                        <form action="?page=properti.hari.ini" method="post">
                                     
                                      <div class="col-md-3">  
                                       <div class="form-group">
                                            <select id="filter-category" name="kategori_jual2" class="select-display btn btn-default select-label">
                                                <option value="" >Semua</option>
                                                <option value="dijual" <?php if(@$kategori_jual=="dijual") echo "selected" ?>>Dijual</option>
                                                <option value="disewa" <?php if(@$kategori_jual=="disewa") echo "selected" ?>>Disewa</option>
                                              
                                            </select>
                                            <select id="filter-type"  name="kategori_properti2" class="select-display btn btn-default select-label">
												<option value="" >Semua</option>
                                                <option value="rumah" <?php if(@$kategori_properti=="rumah") echo "selected" ?>>Rumah</option>
                                                <option value="apartemen"<?php if(@$kategori_properti=="apartemen") echo "selected" ?>>Apartemen</option>
                                                <option value="ruko"<?php if(@$kategori_properti=="ruko") echo "selected" ?>>Ruko</option>
                                                <option value="tanah"<?php if(@$kategori_properti=="tanah") echo "selected" ?>>Tanah</option>
                                              
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" name="cari" class="form-control input-sm "  placeholder="ID Properti / Judul" value="<?php echo @$_POST['cari'] ?>"/>
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                       </div> 
										</form>
                                    <table class="table table-hover table-bordered" style="margin-top:10px;width:100%;overflow:scroll">
                                        <tr>
                                            <th style="text-align:center;">No</th>
											<th style="text-align:center;">Foto</th>
                                            <th >Judul</th>
                                            <th >Harga</th>
                                            <th style="white-space:normal;width:200px">Lokasi</th>
                                        
                                             <th style="white-space:nowrap">Spesifikasi</th>
                                             <th >Tanggal</th>
                                            <th style="text-align:center;">Aksi</th>
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
										 
										if($_SESSION["kd_cabang"]=="All"){ 
										$qry=mysql_query("select * from produk,area,kota,provinsi where area.idarea=produk.idarea and area.idkota=kota.idkota and kota.idprovinsi=provinsi.idprovinsi and  kategori_properti like '%".@$kategori_properti."%' and kategori_jual like '%".@$kategori_jual."%' and id like '%".@$_POST['cari']."%' and iklan='Y' and tgl='".date("Y-m-d")."' order by id asc LIMIT $offset, $limit");}else{
										$qry=mysql_query("select * from produk,area,kota,provinsi where area.idarea=produk.idarea and area.idkota=kota.idkota and kota.idprovinsi=provinsi.idprovinsi and  kategori_properti like '%".@$kategori_properti."%' and kategori_jual like '%".@$kategori_jual."%' and   provinsi.idProvinsi='".$_SESSION['idProvinsi']."' and id like '%".@$_POST['cari']."%' and iklan='Y'  and tgl='".date("Y-m-d")."' order by id asc LIMIT $offset, $limit");	
										}
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
											 <td style="text-align:center;">
												<?php
												if ($row['file']==""){
													$photo="../img/no-image.jpg";
												}else{
													$photo="../img/portfolio/thumb/".$row['file']."";
												}
												?>
												<img src="<?php echo $photo;?>" style="width:180px;border:solid 4px #fff;box-shadow:0px 0px 2px #999;">
											</td>
                                            <td><?php echo "$row[judul]"; ?></td>
                                             <td><?php echo number_format($row['harga_jual']); ?></td>
                                            
                                            <td style="white-space:normal;width:200px"><?php  echo "<b>Kategori Properti : </b>".ucfirst($row['kategori_properti'])." <br>
									  				<b>Kategori Beli : </b>".($row['kategori_jual'])." <br>
													<b>Status Kepemilikan : </b>".($row['status_kepemilikan'])." <br><br>
													
													<b>Provinsi : </b>".($row['namaProvinsi'])."<br>
													<b>Kota : </b>".($row['namaKota'])."<br>
													<b>Area : </b>".($row['namaArea'])."<br>
													<b>Alamat : </b>".($row['alamat'])."<br>
												
													
									  "; ?></td>
                                      <td style="white-space:nowrap"><?php echo "<b>Luas Bangunan : </b>".number_format($row['luas_bangunan'])." m<sup>2</sup><br>
									  				<b>Luas Tanah : </b>".number_format($row['luas_tanah'])." m<sup>2</sup><br>
													<b>Kamar Tidur : </b>".number_format($row['kamar_tidur'])."<br>
													<b>Kamar Mandi : </b>".number_format($row['kamar_mandi'])."<br>
													<b>Garasi : </b>".number_format($row['garasi'])."<br>
													<b>Listrik : </b>".($row['listrik'])."<br>
													<b>Air : </b>".($row['air'])."<br>
													<b>Telepon : </b>".($row['telepon'])."<br>
													
									  "; ?></td>
                                      <td><?php echo date("d M Y",strtotime($row['tgl'])); ?></td>
                                            <td style="text-align:center;"><br /><?php ?>
                                           <?php 
if($_SESSION["loglevel_graha"]=="Administrator"){ ?> <a href="?page=simpan.product.rekomendasi&id=<?php echo $row['id']?>" class="btn btn-success btn-xs"><span class="fa fa-check"></span></a>  <?php } ?>
											<a href="?page=post.product&action=delete&id=<?php echo $row['id']?>&gambar=<?php echo $row['file']?>" onclick="pemberitahuan()" class="hapus btn btn-xs btn-danger"><span class="fa fa-trash-o"></span></a></td>   
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                    </table>
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
								if($_SESSION["kd_cabang"]=="All"){ 
									$query  = "SELECT COUNT(id) AS jumData FROM produk where kategori_properti like '%".@$kategori_properti."%' and kategori_jual like '%".@$kategori_jual."%' and id like '%".@$_POST['cari']."%' and iklan='Y' and tgl='".date("Y-m-d")."'";}else{
									$query  = "SELECT COUNT(id) AS jumData FROM produk where kategori_properti like '%".@$kategori_properti."%' and kategori_jual like '%".@$kategori_jual."%' and id like '%".@$_POST['cari']."%' and iklan='Y' and   idProvinsi='".$_SESSION['idProvinsi']."' and tgl='".date("Y-m-d")."'";
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
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=".$_GET['page']."&kategori=".@$kategori."&sub-kategori=".@$sub_kategori."&hal=".$i."'>".$i."</a></li>";
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
<script>
$( ".hapus" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin ?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script>
