<?php
include "koneksi.php";
koneksi_buka();
?>
<section class="content-header">
	<h1>
		Client
        <small><?php echo $_SESSION['judul_graha'] ?></small>
    </h1>
</section>

<section class="content">
			<div class="row">
            
            
            			<div class="col-xs-3">
							<div class="box box-solid box-primary">
								<div class="box-header">
									<h3 class="box-title">Client</h3>
								</div>  <?php 
									if(isset($_GET['pesan'])){?>  
                                  <div class="small-box bg-green">
                                <div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                                </div>
                              </div><?php }?>
								<form action="simpan.client.php" method="post" enctype="multipart/form-data">
								<div class="box-body">		
								
									
                                   
							<div class="form-group">
								<label for="exampleInputFile" class="pull-left">Foto &nbsp;</label>
								<input type="file" id="exampleInputFile" name="file" onchange="readURL(this);" style="width:65%;">
								<input type="hidden" name="capture_lama">
							</div>
							<center><img id="img_prev" src="<?php echo $photo?>" alt="capture photo" style="width:60%;border:8px solid #fff;box-shadow:0px 0px 1px #000;"/></center>
                           
                                    <div class="form-group">
											<label>Nama <b style="color:red;">*</b></label>
               						 
                                         		                        
										<input type="text" class="form-control" name="nama" id="id_ta2"  required="required"  />
                                           
                   						   
                                    </div>
                                    <div class="bootstrap-timepicker">
                                      <div class="form-group"><!-- /.input group -->
                                        </div><!-- /.form group -->
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
                                    <h3 class="box-title">Client</h3>
                              </div><!-- /.box-header -->
                                <div class="box-body" style="padding-top:0px;">
								
                                        <form action="?page=artikel" method="post">
										<div class="input-group">
                                            <input type="text" name="cari" class="form-control input-sm pull-right" style="width: 20%;" placeholder="Search"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
										</form>
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>
											<th style="text-align:center;">Foto</th>
                                            <th >Perusahaan</th>
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
										$qry=mysql_query("select * from client order by nama asc LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
											 <td style="text-align:center;">
												<?php
												if ($row['gambar']==""){
													$photo="img/no-image.jpg";
												}else{
													$photo="../img/client/".$row['gambar']."";
												}
												?>
												<img src="<?php echo $photo;?>" style="width:180px;border:solid 4px #fff;box-shadow:0px 0px 2px #999;">
											</td>
                                            <td><?php echo "$row[nama]"; ?></td>
                                            <td style="text-align:center;"><br /><?php ?>
											<a href="?page=post&action=edit&id=<?php echo $row['id']?>"><span class="fa fa-edit"></span></a>  
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
									$query  = "SELECT COUNT(id) AS jumData FROM berita ";
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
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=produk&hal=".$i."'>".$i."</a></li>";
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
