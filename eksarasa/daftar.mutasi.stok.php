<?php

?>
<section class="content-header">
<?php if($_SESSION["loglevel_graha3"]=="Administrator" or $_SESSION["loglevel_graha3"]=="Admin") { ?><div class="pull-right" style="padding-right:5px"><a href="?page=mutasi.stok" data-toggle="tooltip" title="" class="btn btn-warning" data-original-title="Add New"><i class="fa fa-plus"></i> Mutasi Stok</a>
        
      </div><?php } ?>
	<h1>
		Daftar Mutasi Stok<small></small>
    </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-warning">
                                <div class="box-header">
                                   
                            </div><!-- /.box-header -->
                                <div class="box-body" style="padding-top:0px;">
								
                                  <form action="?page=<?php echo $_GET['page'] ?>" method="post">
										<div class="input-group">
                                            <input type="text" name="cari" class="form-control  pull-right" style="width: 50%;max-width: 300px" placeholder="Search" value="<?php echo @$_POST['cari']?>" />
                                            <div class="input-group-btn">
                                                <button class="btn btn-md btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
										</form>
                                    
                                    <div class="table-responsive">
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>
                                            <th style="text-align:center;">No Ref</th>
                                            <th style="text-align:center;">Gudang Utama</th>
											<th style="text-align:center;"><span style="text-align:left;">Gudang Tujuan</span></th>
                                            <?php if ($_SESSION['loglevel']=="Administrator" or $_SESSION["loglevel"]=="Admin"){ ?>
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
										$qry=mysql_query("select * from mutasi  order by tgl_mutasi desc,no_mutasi desc LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
                                            <td align="center"><?php echo $row['no_mutasi'];?></td>
                                            <td style="text-align:center;"><?php echo $row['gudang_utama'];?></td>
											<td style="text-align:center;"><?php echo (($row['gudang_tujuan'])) ?></td>
                                           
                                           <?php if ($_SESSION['loglevel']=="Administrator" or $_SESSION["loglevel"]=="Admin"){ ?>
                                            <td style="text-align:center;">
                                            	<a href="?page=detail.mutasi.stok&no_mutasi=<?php echo $row['no_mutasi'] ?>" title="detail"><span class="fa fa-eye"></span></a>&nbsp;&nbsp;
										<a href="?page=edit.mutasi.stok&no_mutasi=<?php echo $row['no_mutasi']?>" title="edit"><span class="fa fa-edit"></span></a>&nbsp;&nbsp;
											<a href="hapus.daftar.mutasi.stok.php?no_mutasi=<?php echo $row['no_mutasi']?>" class="hapus" title="hapus"><span class="fa fa-trash-o"></span></a></td><?php } ?>
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                         <tr style="font-weight:bold">
                                            <td align="center">&nbsp;</td>
											 <td style="text-align:center;">Total</td>
                                            <td>&nbsp;</td><td>&nbsp;</td>
                                                 <?php if ($_SESSION['loglevel']=="Administrator" or $_SESSION["loglevel"]=="Admin"){ ?> <td>&nbsp;</td><?php } ?>
                                          
                                        </tr>
                                    </table>
                                    </div>  <?php ?>
                              </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
									$query  = "SELECT COUNT(no_mutasi) AS jumData from mutasi";
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

?><script>
$( ".hapus" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin Untuk Menghapus Data?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script>
