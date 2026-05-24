<?php
include "koneksi.php";
koneksi_buka(); 

?>
<section class="content-header">
	<h1>
		Artikel
       <small><?php echo $_SESSION['judul_graha'] ?></small>
    </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                              </div><!-- /.box-header -->
                               <?php 
									if(isset($_GET['pesan'])){?>  
                                  	<div class="small-box bg-<?php if($_GET['pesan']=="success"){ echo "green";}else{ echo "red";}?> ">
                                		<div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                             			</div>
                        			</div><?php }?>
                                <div class="box-body" style="padding-top:0px;">
									<a href="?page=tambah.artikel" class="btn btn-danger btn-flat" style="float:left;"><i class="fa fa-pencil"></i> &nbsp;Tambah</a>
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
                                          
                                            <th >Judul</th>
                                            <th >Isi</th>
                                           
                                            <th >Tanggal Terbit</th> <th >Views</th>
                                            <th >Status</th>
                                             <th >Broadcast</th>
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
									date_default_timezone_set("Asia/Makassar");
										$offset = ($hal - 1) * $limit;
										$i=1;
										  if($_SESSION["loglevel_graha"]=="Editor" or $_SESSION["loglevel_graha"]=="Admin"){ 
										  $qry=mysql_query("select * from berita where user='".$_SESSION["user_graha"]."'  order by tanggal desc LIMIT $offset, $limit");}
										  else{
										$qry=mysql_query("select * from berita  order by tanggal desc LIMIT $offset, $limit");}
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
											 <td style="text-align:center;">
												<?php
												if ($row['gambar']==""){
													$photo="img/no-image.jpg";
												}else{
													$photo="../img/blog/_s_".$row['gambar']."";
												}
												?>
												<img src="<?php echo $photo;?>" style="width:180px;border:solid 4px #fff;box-shadow:0px 0px 2px #999;">
											</td>
                                           
                                            <td><?php echo "$row[judul]"; ?></td>
                                             
                                            <td><?php 
											
											$str=str_replace('<div>', '<span>', $row['isi_berita']);
									$str=str_replace('<b>', ' ', $str);
									$str=str_replace('</b>', ' ', $str);
									$str=str_replace('<strong>', ' ', $str);
									$text=str_replace('</div>', '</span>', $str);
									?>
                                    <?php echo substr(trim(strip_tags($text)), 0, 250) .((strlen(trim(strip_tags($text))) > 150) ? '.....' : ''); ?></td>
                                    <td style="white-space:nowrap"><?php echo "$row[tanggal]"; ?></td>
                                     <td><?php 
									
										$jumlah=mysql_num_rows(mysql_query("select ip from counter_artikel where kd_produk='".$row['id']."' "));
									echo number_format($jumlah); ?></td>
                                    <td style="white-space:nowrap"> <?php
													   $date1=date("Y-m-d",strtotime($row['tanggal']));
													   $date2=date("Y-m-d ");
													
													  $diff = (strtotime($date2) - strtotime($date1)); 
													 $umur=floor(($diff )/ (60*60*24));
													
													
														?>
                                                         <a class="btn btn-<?php if($umur < 0 ){ echo "danger";}
											else{ echo "success";} ?> btn-xs"><?php if($umur < 0 ){ echo "Belum";}
											else{ echo "Terbit";} ?></a>
    </td>
    <td style="text-align:center;"><?php ?>
											<a href="?page=broadcast.artikel&id=<?php echo $row['id']?>" class="btn btn-warning"><span class="fa fa-bullhorn"></span></a> </td>
                                            <td style="text-align:center;"><br /><?php ?>
											<a href="?page=edit.artikel&id=<?php echo $row['id']?>"><span class="fa fa-edit"></span></a>  
											<a href="?page=post&action=delete&id=<?php echo $row['id']?>&gambar=<?php echo $row['gambar']?>"  class="hapus"><span class="fa fa-trash-o"></span></a></td>   
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                    </table>
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
								  if($_SESSION["loglevel_graha"]=="Editor" or $_SESSION["loglevel_graha"]=="Admin"){ 
									$query  = "SELECT COUNT(id) AS jumData FROM berita where user='".$_SESSION["user_graha"]."'";}else{
									$query  = "SELECT COUNT(id) AS jumData FROM berita ";
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
$( ".hapus" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin ?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script>