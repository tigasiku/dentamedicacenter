<?php

?>
<section class="content-header">
<?php if($_SESSION["loglevel_graha3"]=="Administrator" or $_SESSION["loglevel_graha3"]=="Admin") { ?>	 <div class="pull-right" style="padding-right:5px">	<a href="?page=tambah.penjualan" class="btn btn-danger btn-flat" style="float:left;"><i class="fa fa-plus"></i> Tambah</a>
        
      </div><?php } ?>
	<h1>
		Penjualan<small></small>
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
                                      <?php  if(isMobile()){ ?>
                                      
                                      <table class="table table-hover " style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>
                                            <th style="text-align:left;">Detail</th>
                                            <th  style="text-align:right;">Total</th>
                                                                                        <?php if ($_SESSION['loglevel']=="Administrator"or $_SESSION["loglevel"]=="Admin"){ ?>
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
										$qry=mysql_query("select * from penjualan where  customer like '%".@$_POST['cari']."%' order by tgl_jual desc,no_jual desc LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
                                            <td align="left"><span style="font-size: 11px"><?php echo date("d M Y",strtotime($row['tgl_jual'])) ?></span><br><span style="border-top:1px solid #333"><?php echo $row['no_jual'];?></span><br><b ><?php echo $row['customer'];?></b></td>
                                            <td  style="text-align:right;"><b style="color: rgb(255, 87, 34);"><?php
											 
											   echo number_format($total_jual=$row['total']);
											   @$total_jual2=$total_jual+$total_jual2;
											    ?></b></td>
                                           <?php if ($_SESSION['loglevel']=="Administrator"or $_SESSION["loglevel"]=="Admin"){ ?>
                                            <td style="text-align:center;">
								
                                       
                                          <div class="text-center"><div class="btn-group text-left"><a type="button" class="dropdown-toggle" data-toggle="dropdown"><img src="img/9bf4705c9e.svg" alt="Action" height="18px"></a>
            <ul class="dropdown-menu pull-right" role="menu">
          
          
         		 <li><a href="?page=cetak.detail.penjualan&no_jual=<?php echo $row['no_jual'] ?>" class="sledit" target="_blank"><i class="fa fa-print"></i> Cetak Nota</a></li>
               <li><a href="?page=detail.penjualan&no_jual=<?php echo $row['no_jual'] ?>" class="sledit"><i class="fa fa-wpforms"></i> Detail</a></li>
                 
                <li><a href="?page=edit.penjualan&no_jual=<?php echo $row['no_jual']?>" class="sledit"><i class="fa fa-edit"></i> Edit </a></li>
                 <li><a href="hapus.penjualan.php?no_jual=<?php echo $row['no_jual']?>" class="sledit hapus"><i class="fa fa-trash-o"></i> Delete </a></li>
            </ul>
        </div></div>
                                       </td><?php } ?>
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                         <tr style="font-weight:bold">
                                            <td align="center">&nbsp;</td>
											 <td style="text-align:center;">Total</td>
                                            <td style="text-align:right;"><?php
											 
											   echo number_format(@$total_jual2); ?></td>
                                            <td style="text-align:center;">
                                            </td>
                                        </tr>
                                    </table>
                                       <?php }else{ ?>
                                    <div class="table-responsive">
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>
                                            <th style="text-align:center;">No Ref</th>
                                            <th style="text-align:left;">Customer</th>
											<th style="text-align:center;">Tanggal</th>
                                            <th style="text-align:right;">Total</th>
                                                                                         
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
										$qry=mysql_query("select * from penjualan where  customer like '%".@$_POST['cari']."%' order by tgl_jual desc,no_jual desc LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
                                            <td align="center"><?php echo $row['no_jual'];?></td>
                                            <td align="left"><?php echo $row['customer'];?></td>
											<td style="text-align:center;"><?php echo date("d-m-Y",strtotime($row['tgl_jual'])) ?></td>
                                           
                                            <td  style="text-align:right;"><?php
											 
											   echo number_format($total_jual=$row['total']);
											   @$total_jual2=$total_jual+$total_jual2;
											    ?></td>
                                          
                                           <?php if ($_SESSION['loglevel']=="Administrator" or $_SESSION["loglevel"]=="Admin"){ ?>
                                            <td style="text-align:center;">
                                            	<a href="?page=detail.penjualan&no_jual=<?php echo $row['no_jual'] ?>" title="detail"><span class="fa fa-eye"></span></a>&nbsp;&nbsp;
										<a href="?page=edit.penjualan&no_jual=<?php echo $row['no_jual']?>" title="edit"><span class="fa fa-edit"></span></a>&nbsp;&nbsp;
											<a href="hapus.penjualan.php?no_jual=<?php echo $row['no_jual']?>" class="hapus" title="hapus"><span class="fa fa-trash-o"></span></a></td><?php } ?>
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                         <tr style="font-weight:bold">
                                            <td align="center">&nbsp;</td>
											 <td style="text-align:center;">Total</td>
                                            <td>&nbsp;</td><td>&nbsp;</td>
                                                 <td style="text-align:right;"><?php
											 
											   echo number_format(@$total_jual2); ?></td> <?php if ($_SESSION['loglevel']=="Administrator" or $_SESSION["loglevel"]=="Admin"){ ?> <td>&nbsp;</td><?php } ?>
                                          
                                        </tr>
                                    </table>
                                    </div>  <?php } ?>
                              </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
									$query  = "SELECT COUNT(no_jual) AS jumData from penjualan  where  customer like '%".@$_POST['cari']."%'";
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
