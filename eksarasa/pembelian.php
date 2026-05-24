<?php


?>
<section class="content-header">
	<?php if($_SESSION["loglevel_graha3"]=="Administrator" or $_SESSION["loglevel_graha3"]=="Admin") { ?>	 <div class="pull-right" style="padding-right:5px">	<a href="?page=tambah.pembelian" class="btn btn-danger btn-flat" style="float:left;"><i class="fa fa-plus"></i> Tambah</a>
        
      </div><?php } ?>
	
	
	<h1>
		Pembelian<small></small>
    </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-warning">
                                <div class="box-header">
                                  
                            </div><!-- /.box-header -->
                                <div class="box-body" style="padding-top:0px;">
							
                                 <form action="?page=<?Php echo $page ?>" method="post">
        <div class="well" id="another-element" >
          <div class="row">
          
            <div class="col-sm-4 col-xs-6 ">
              <div class="form-group">
                <label class="control-label" for="input-name">Dari</label>
               
                <div class="input-group">
        	        	<input name="filter_dari" type="text" class="form-control" id="dp2" placeholder="Date Added" value="<?php echo @$filter_dari ?>" readonly>
                    	<div class="input-group-addon">
                        	<i class="fa fa-calendar"></i>
                        </div>
                    </div>
              </div>
          	
            </div>
            <div class="col-sm-4 col-xs-6 ">
              <div class="form-group">
	                <label class="control-label" for="input-price">Sampai</label>
    	            <div class="input-group">
        	        	<input name="filter_sampai" type="text" class="form-control" id="dp1" placeholder="Date Added" value="<?php echo @$filter_sampai ?>" readonly>
                    	<div class="input-group-addon">
                        	<i class="fa fa-calendar"></i>
                        </div>
                    </div>
              </div>
              
               
            </div>
            <div class="col-sm-4 col-xs-12">
             <div class="form-group">
                <label class="control-label" for="input-name">Nama Vendor</label>
                <input type="text" name="filter_nama" value="<?php echo @$filter_nama ?>" placeholder="Nama Vendor" id="input-name" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
              </div>
              	  <div class="form-group">
                <label class="control-label" for="input-model">Gudang</label>
             
    		         	<select name="filter_gudang" class="form-control" >
              				<option value="">Semua</option>
              			
					<?php
							
							$qry_kategory=mysql_query("select *  from  gudang");
							while($kategori=mysql_fetch_array($qry_kategory)){
						?>
              			<option value="<?php echo $kategori['0'] ?>" <?php if($kategori['0'] == @$filter_gudang) echo "selected" ?>><?php echo $kategori['1'] ?></option><?php }  ?>
              	</select>
              </div>
              <button type="submit" id="button-filter" class="btn btn-primary pull-right"  name="submit" style="margin-left: 10px"><i class="fa fa-search"></i> Filter</button>  
            </div>
          </div>
        </div>
         </form>
                                          <?php  if(isMobile()){ ?>
                                           <table class="table table-hover " style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>
                                            <th style="text-align:left;">Detail</th>
                                            <th style="text-align:right;">Total</th>
                                                                                          <?php if ($_SESSION['loglevel']=="Administrator" or $_SESSION["loglevel"]=="Admin"){ ?>
                                            <th style="text-align:center;">Aksi</th><?php }?>
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
										if(!empty($filter_sampai) and !empty($filter_dari)){
											$qry=mysql_query("select * from pembelian,pembelian_detail	 where pembelian_detail.no_beli=pembelian.no_beli and tgl_beli between '".@$filter_dari."' and '".@$filter_sampai."' and nama_vendor like '%".@$filter_nama."%' and kd_gudang like '%".@$filter_gudang."%' group by pembelian.no_beli order by tgl_beli desc LIMIT $offset, $limit");
										}else{
											$qry=mysql_query("select * from pembelian,pembelian_detail	 where pembelian_detail.no_beli=pembelian.no_beli  and nama_vendor like '%".@$filter_nama."%' and kd_gudang like '%".@$filter_gudang."%' group by pembelian.no_beli order by tgl_beli desc LIMIT $offset, $limit");
										}
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
                                             <td align="left"><span style="font-size: 11px"><?php echo date("d M Y",strtotime($row['tgl_beli'])) ?></span><br><span style="border-top:1px solid #333"><?php echo $row['no_beli'];?></span><br><b ><?php echo $row['nama_vendor'];?></b></td>
                                            <td align="right"><b style="color: rgb(255, 87, 34);"><?php
											 
											   echo number_format($total_jual=$row['total']);
											   @$total_jual2=$total_jual+$total_jual2;
											    ?></b></td>
                                                <?php if ($_SESSION['loglevel']=="Administrator"  or $_SESSION["loglevel"]=="Admin"){ ?><td style="text-align:center;">
								
                                       
                                          <div class="text-center"><div class="btn-group text-left"><a type="button" class="dropdown-toggle" data-toggle="dropdown"><img src="img/9bf4705c9e.svg" alt="Action" height="18px"></a>
            <ul class="dropdown-menu pull-right" role="menu">
          
          
         
               <li><a href="?page=detail.pembelian&no_beli=<?php echo $row['no_beli'] ?>" class="sledit"><i class="fa fa-wpforms"></i> Detail</a></li>
                 
                <li><a href="?page=edit.pembelian&no_beli=<?php echo $row['no_beli']?>" class="sledit"><i class="fa fa-edit"></i> Edit </a></li>
                 <li><a href="hapus.pembelian.php?&no_beli=<?php echo $row['no_beli']?>" class="sledit hapus"><i class="fa fa-trash-o"></i> Delete </a></li>
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
                                           
											</td>
                                        </tr>
                                    </table>
                                          
                                          <?php }else{ ?>
                                    <div class="table-responsive">
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>
                                            <th style="text-align:center;">No Ref</th>
											<th style="text-align:left;">Vendor</th>
											<th style="text-align:center;">Tanggal</th>
                                            <th style="text-align:right;">Total</th>
                                                                                      
                                                                                                               <?php if ($_SESSION['loglevel']=="Administrator"  or $_SESSION["loglevel"]=="Admin"){ ?>
                                            <th style="text-align:center;">Aksi</th><?php }?>
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
										if(!empty($filter_sampai) and !empty($filter_dari)){
											$qry=mysql_query("select * from pembelian,pembelian_detail	 where pembelian_detail.no_beli=pembelian.no_beli and tgl_beli between '".@$filter_dari."' and '".@$filter_sampai."' and nama_vendor like '%".@$filter_nama."%' and kd_gudang like '%".@$filter_gudang."%' group by pembelian.no_beli order by tgl_beli desc LIMIT $offset, $limit");
										}else{
											$qry=mysql_query("select * from pembelian,pembelian_detail	 where pembelian_detail.no_beli=pembelian.no_beli  and nama_vendor like '%".@$filter_nama."%' and kd_gudang like '%".@$filter_gudang."%' group by pembelian.no_beli order by tgl_beli desc LIMIT $offset, $limit");
										}
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
                                            <td align="center"><?php echo $row['no_beli'];?></td>
                                                 <td align="left"><?php echo $row['nama_vendor'];?></td>
											 <td style="text-align:center;"><?php echo date("d-m-Y",strtotime($row['tgl_beli'])) ?></td>
                                            <td style="text-align:right;"><?php
											 
											   echo number_format($total_jual=$row['total']);
											   @$total_jual2=$total_jual+$total_jual2;
											    ?></td>
                                               
                                           
                                                                   <?php if ($_SESSION['loglevel']=="Administrator" or $_SESSION["loglevel"]=="Admin"){ ?><td style="text-align:center;">
                                                                   
                                                                   <a href="?page=detail.pembelian&no_beli=<?php echo $row['no_beli'] ?>" title="detail"><span class="fa fa-eye"></span></a>&nbsp;&nbsp;
										<a href="?page=edit.pembelian&no_beli=<?php echo $row['no_beli']?>"><span class="fa fa-edit"></span></a>&nbsp;&nbsp;
											<a href="hapus.pembelian.php?&no_beli=<?php echo $row['no_beli']?>" class="hapus"><span class="fa fa-trash-o"></span></a></td><?php } ?>
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                         <tr style="font-weight:bold">
                                            <td align="center">&nbsp;</td>
											 <td style="text-align:center;">Total</td>
                                            <td>&nbsp;</td>   <td>&nbsp;</td>
                                                 <td style="text-align:right;"><?php
											 
											   echo number_format(@$total_jual2); ?></td>
                                         <?php if ($_SESSION['loglevel']=="Administrator" or $_SESSION["loglevel"]=="Admin"){ ?><td style="text-align:center;">      
											</td><?php } ?>
                                        </tr>
                                    </table>
                                </div><!-- /.box-body --> <?php } ?>
								 </div>
                                <div class="box-footer clearfix">
								<?php 
									if(!empty($filter_sampai) and !empty($filter_dari)){
										$query  = "SELECT (pembelian_detail.no_beli) AS jumData from pembelian,pembelian_detail where pembelian_detail.no_beli=pembelian.no_beli and tgl_beli between '".@$filter_dari."' and '".@$filter_sampai."' and nama_vendor like '%".@$filter_nama."%' and kd_gudang like '%".@$filter_gudang."%' group by pembelian_detail.no_beli";
									}else{
										$query  = "SELECT (pembelian_detail.no_beli) AS jumData from pembelian,pembelian_detail where pembelian_detail.no_beli=pembelian.no_beli and nama_vendor like '%".@$filter_nama."%' and kd_gudang like '%".@$filter_gudang."%' group by pembelian_detail.no_beli";
									}
									$hasil  = mysql_query($query);
									$data  = mysql_num_rows($hasil);
									$jumData = $data;
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
