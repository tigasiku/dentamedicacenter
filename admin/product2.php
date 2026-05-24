<?php
include "koneksi.php";
koneksi_buka();

if(isset($_GET['sub-kategori'])){
$sub_kategori=$_GET['sub-kategori'];}else{
$sub_kategori=$_POST['cari'];}
?>
<section class="content-header">
	<h1>
		Product 
        <small><?php echo $_SESSION['judul_graha'] ?></small>
    </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Product </h3>
                              </div><!-- /.box-header --> <?php 
									if(isset($_GET['pesan'])){?>  
                                  	<div class="small-box bg-<?php if($_GET['pesan']=="success"){ echo "green";}else{ echo "red";}?> ">
                                		<div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                             			</div>
                        			</div><?php }?>
                                <div class="box-body" style="padding-top:0px;">
									<a href="?page=post.product&action=newpost" class="btn btn-danger btn-flat" style="float:left;"><i class="fa fa-pencil"></i> &nbsp;Tambah</a>
                                        <form action="?page=product2" method="post">
										<div class="input-group">
                                            <input type="text" name="cari" class="form-control input-sm pull-right" style="width: 20%;" placeholder="Search" value="<?php echo @$_POST['cari'] ?>"/>
                                            <select name="tipe" class="form-control input-sm pull-right" style="width: 20%;" >
                          		<option value="company">Company</option>
                                <option value="toko">Toko</option>
                                <option value="umum">Umum</option>
                          </select>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
										</form>
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>
											<th style="text-align:center;">Foto</th>
                                            <th >Judul</th>
                                            <th >Harga</th>
                                            <th >Harga Diskon</th>
                                            <th >Diskon</th>
                                            <th >Merek</th>
                                            <th >Kategori</th>
                                            <th >Sub Kategori</th>
                                            <th >Status</th>
                                            <th style="text-align:center;">Aksi</th>
                                        </tr>
										<?php
										$limit = 10000;
										if(isset($_GET['hal'])){
											$hal = $_GET['hal'];
										}
										else{
											$hal = 1;
										}

										$offset = ($hal - 1) * $limit;
										$i=1;
										$qry=mysql_query("select * from produk where judul like '%".@$_POST['cari']."%' order by id asc LIMIT $offset, $limit");
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
                                            <td><?php echo number_format($row['harga']); ?></td>
                                            <td><?php echo number_format($row['harga_grosir']); ?></td>
                                            <td><?php echo number_format($row['diskon'],2); ?> %</td>
                                            <td><?php echo ($row['merek']); ?></td>
                                            <td><?php 
										echo $row['kategori'] ?></td>
                                    <td><?php echo ($row['sub_kategori']); ?></td>
                                     <td><?php echo ($row['status']); ?></td>
                                            <td style="text-align:center;"><br /><?php ?>
                                            <a href="?page=simpan.product.rekomendasi&id=<?php echo $row['id']?>" class="btn btn-success btn-xs"><span class="fa fa-check"></span></a>
											<a href="?page=edit.post.product&action=edit&id=<?php echo $row['id']?>"><span class="fa fa-edit"></span></a>  
											<a href="?page=post.product&action=delete&id=<?php echo $row['id']?>&gambar=<?php echo $row['file']?>" onclick="pemberitahuan()" class="hapus"><span class="fa fa-trash-o"></span></a></td>   
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                    </table>
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
									$query  = "SELECT COUNT(id) AS jumData FROM produk where judul like '%".@$_POST['cari']."%'";
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
