<?php
include "koneksi.php";
koneksi_buka();
?>
<section class="content-header">
	<h1>
		Iklan Product 
        <small><?php echo $_SESSION['judul_graha'] ?></small>
    </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Iklan Product </h3>
                              </div><!-- /.box-header -->
                                <div class="box-body" style="padding-top:0px;">
									
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>
											<th style="text-align:center;">Foto Iklan</th>
                                            <th >ID Product</th>
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
										$qry=mysql_query("select * from iklan_slide order by kd_iklan asc LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
											 <td style="text-align:center;">
												<?php
												if ($row['gambar']==""){
													$photo="../img/no-image.jpg";
												}else{
													$photo="../iklan_slide/".$row['gambar']."";
												}
												?>
												<img src="<?php echo $photo;?>" style="width:180px;border:solid 4px #fff;box-shadow:0px 0px 2px #999;">
											</td>
                                            <td><?php echo "$row[id]"; ?></td>
                                            <td style="text-align:center;"><br /><?php ?>
											<a href="?page=post.product&action=edit&id=<?php echo $row['id']?>"><span class="fa fa-edit"></span></a>  
											<a href="?page=post&action=delete&id=<?php echo $row['id']?>&gambar=<?php echo $row['gambar']?>" onclick="pemberitahuan()"><span class="fa fa-trash-o"></span></a></td>   
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                    </table>
                              </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
									$query  = "SELECT COUNT(kd_iklan) AS jumData FROM iklan_slide ";
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
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=".$_GET['page']."&hal=".$i."'>".$i."</a></li>";
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
function pemberitahuan(){

var msg="Apakah Anda Yakin Untuk Menghapus Data?";
var setuju=confirm(msg);
if (setuju)
	return true;
	else
	return false;
	
}
</script>
