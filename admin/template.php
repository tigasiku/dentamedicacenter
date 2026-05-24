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
		Template Website
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
									
                                        <form action="?page=product" method="post">
                                     
                                      <div class="col-md-3">  
                                   
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
                                            <th style="white-space:nowrap">Kategori</th> <th >Judul</th>
                                            
                                             <th style="white-space:nowrap">Url</th>
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
						
										$qry=mysql_query("select *,theme_website.gambar as gambar from theme_website,kategori_website where theme_website.kd_kategori=kategori_website.kd_kategori order by kategori_website.kd_kategori asc LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
											 <td style="text-align:center;">
												<?php
												if ($row['gambar']==""){
													$photo="../img/no-image.jpg";
												}else{
													$photo="../img/theme_website/".$row['gambar']."";
												}
												?>
												<img src="<?php echo $photo;?>" style="width:180px;border:solid 4px #fff;box-shadow:0px 0px 2px #999;">
											</td>
                                             <td><?php echo "$row[kategori]"; ?></td>
                                            <td><?php echo "$row[judul]"; ?></td>
                                             <td><?php echo ($row['url_web']); ?></td>
                                            
                                            <td style="text-align:center;"><br /><?php ?>
                                           <?php 
if($_SESSION["loglevel_graha"]=="Administrator"){ ?> <a href="?page=simpan.product.rekomendasi&id=<?php echo $row['id']?>" class="btn btn-success btn-xs"><span class="fa fa-check"></span></a>  <?php } ?>
											<a href="?page=hapus.template&id=<?php echo $row['kd_theme']?>&gambar=<?php echo $row['gambar']?>"  class="hapus btn btn-xs btn-danger"><span class="fa fa-trash-o"></span></a></td>   
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
									$query  = "SELECT COUNT(id) AS jumData FROM produk where kategori_properti like '%".@$kategori_properti."%' and kategori_jual like '%".@$kategori_jual."%' and id like '%".@$_POST['cari']."%' and iklan='Y'";}else{
									if(!empty($_SESSION["ibuKota"])) {	
									$query  = "SELECT COUNT(id) AS jumData FROM produk where kategori_properti like '%".@$kategori_properti."%' and kategori_jual like '%".@$kategori_jual."%' and id like '%".@$_POST['cari']."%' and idProvinsi='".$_SESSION['idProvinsi']."' and iklan='Y'";}else{
									$query  = "SELECT COUNT(id) AS jumData FROM produk where kategori_properti like '%".@$kategori_properti."%' and kategori_jual like '%".@$kategori_jual."%' and id like '%".@$_POST['cari']."%' and idKota='".$_SESSION['idKota']."' and iklan='Y'";}	
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
