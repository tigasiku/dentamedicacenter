<?php
include "koneksi.php";

?>
<section class="content-header">
	<h1>
		Management User
                <small><?php echo $_SESSION['judul_graha'] ?></small>
    </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Management User</h3>
                                    
                                </div><!-- /.box-header -->
                                <?php 
					if(isset($_GET['pesan'])){?>  
                           	<div class="small-box bg-green">
                                		<div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                             			</div>
                        	</div><?php }?>
                                <div class="box-body" style="padding-top:0px;">
									<a href="?page=tambah.management.user" class="btn btn-danger btn-flat" style="float:left;"><i class="fa fa-pencil"></i> &nbsp;Tambah</a>
                                  <form action="?page=management.user" method="post">
										<div class="input-group">
                                            <input type="text" name="cari" class="form-control input-sm pull-right" style="width: 20%;" placeholder="Search" value="<?Php echo @$cari ?>"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
										</form>
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr >
                                            <th style="text-align:center;">No</th>
                                            <th style="text-align:center;">Foto</th>
											<th align="center" style="text-align:center;">User Name</th>
                                          <th align="center" style="text-align:center;">Nama</th>
                                          <th align="center" style="text-align:center;">Level</th>
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
										if(isset($_POST['cari'])){
										$cari=$_POST['cari'];
										}else{
										@$cari=$_GET['cari'];
										}
										
										$qry=mysql_query("select * from admin where username like '%".@$cari."%'  or nama like '%".@$cari."%' order by username asc LIMIT $offset, $limit");
										
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td> <td style="text-align:center;">
												<?php
												if ($row['photo']==""){
													$photo="img/no-image.jpg";
												}else{
													$photo="photo/$row[photo]";
												}
												?>
												<img src="<?php echo $photo;?>" style="width:100px;border:solid 4px #fff;box-shadow:0px 0px 2px #999;">
											</td>
										    <td  align="center"><?php
											  
								
								echo $row['username']		 
											    ?></td>
                                          <td align="center"><?php 
													  echo ($row['nama']); ?></td>
                                          <td align="center"><?php 
													  echo ($row['level']); ?></td>
                                            <td style="text-align:center;">
                                          
											 <?php if($_SESSION['loglevel_graha']=="Administrator"){ ?>
											<a href="?page=hapus.user&username=<?php echo $row['username']?>" onclick="pemberitahuan()"><span class="fa fa-trash-o"></span></a> <?php  } ?></td>  
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                    </table>
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
								
									$query  = "SELECT COUNT(username) AS jumData FROM  admin where username like '%".@$cari."%'   or nama like '%".@$cari."%'";
									
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
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=nama_alamat&hal=".$i."&cari=".$cari."'>".$i."</a></li>";
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
