<?php

?>
<section class="content-header">
	<h1>
		Contact
         <small><?php echo $_SESSION['judul_graha'] ?></small>
    </h1>
</section>

<section class="content">
			<div class="row">
            
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                   
                              </div><!-- /.box-header -->
                                <div class="box-body" style="padding-top:0px;">
								<?php @$cari=$_POST['cari']; ?>
                                        <form action="?page=artikel" method="post">
										<div class="input-group">
                                            <input type="text" name="cari" class="form-control input-sm pull-right" style="width: 20%;" placeholder="Search" value="<?php echo @$cari ?>"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
										</form>
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>
											<th >Name</th>
                                            <th >Telp</th>
                                            <th >Email</th>
                                            <th >Message</th>
                                           	<th >Tanggal</th>
                                        
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
										$qry=mysql_query("select * from contact where nama like '%".@$cari."%' or email like '%".@$cari."%' order  by tanggal desc LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
										    <td><?php echo $row['nama']; ?></td>
                                            <td><?php echo $row['telp']; ?></td>
                                             <td><?php echo $row['email']; ?></td>
                                            <td style="text-align:center;"><?php echo $row['isi']; ?>
                                            <td style="text-align:center;"><?php echo date("H:i, d M Y",strtotime($row['tanggal'])); ?>
											</td>   
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                    </table>
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
									$query  = "SELECT COUNT(id) AS jumData FROM contact where nama like '%".@$cari."%' or email like '%".@$cari."%'";
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
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=contact-user&hal=".$i."'>".$i."</a></li>";
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
