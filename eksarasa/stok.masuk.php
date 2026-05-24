<?php
include "koneksi.php";

?>
<section class="content-header">
	  <div class="pull-right" style="padding-right:5px"><a href="?page=tambah.stok.masuk" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i> Tambah</a>
        
      </div><h1>
		Stok
    Masuk</h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                  	
                            </div><!-- /.box-header -->
                                <div class="box-body" style="padding-top:0px;">
									
                                  <form action="?page=<?Php echo $page ?>" method="post">
        <div class="well">
          <div class="row">
        
            <div class="col-sm-4">
              
            
              <div class="form-group">
                <label class="control-label" for="input-model">Nama Barang</label>
                <input type="text" name="filter_nama" value="<?php echo @$filter_nama ?>" placeholder="Barang" id="input-model" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
              </div>
            </div>
           
            <div class="col-sm-4">
             <div class="form-group">
                <label class="control-label" for="input-model">Kategori Barang</label>
             
    		         	<select name="filter_kategori" class="form-control" id="cmbKategori">
              				<option value="">Semua</option>
              			<?php
					
							$qry_kategory=mysql_query("select *  from kategori_barang");
							while($kategori=mysql_fetch_array($qry_kategory)){
						?>
              			<option value="<?php echo $kategori['kode_kategori_barang'] ?>" <?php if($kategori['kode_kategori_barang']==@$filter_kategori) echo "selected" ?>><?php echo $kategori['kategori_barang'] ?></option><?php } ?>
              	</select>
              </div>
              
           
            </div>
            <div class="col-sm-4">
             <div class="form-group">
                <label class="control-label" for="input-model">Sub Kategori Barang</label>
             
    		         	<select name="filter_sub_kategori" class="form-control" id="subKategori">
              				<option value="">Semua</option>
              			
					<?php
							if(!empty($filter_kategori)){
							$qry_kategory=mysql_query("select *  from  sub_kategori_barang where kategori='".$filter_kategori."'");
							while($kategori=mysql_fetch_array($qry_kategory)){
						?>
              			<option value="<?php echo $kategori['id'] ?>" <?php if($kategori['id'] == @$filter_sub_kategori) echo "selected" ?>><?php echo $kategori['sub_kategori'] ?></option><?php } } ?>
              	</select>
              </div>
              
              <button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
            </div>
          </div>
        </div>
         </form>  <div class="table-responsive">
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                           
                                                <th style="text-align:center;">No</th>
                                             <th >Tanggal</th>  
											<th style="text-align:left;">Kategori</th>
                                         
                                            <th >Nama Barang </th>
                                            <th >Satuan</th>
                                                                 
                                            <th style="text-align: center">Jumlah</th>
                                              
                                             <th >Keterangan</th>     
                                                <th >Gudang</th>     
                                             
                                                             
                                        </tr>
										<?php
										$limit = 1000;
										if(isset($_GET['hal'])){
											$hal = $_GET['hal'];
										}
										else{
											$hal = 1;
										}

										$offset = ($hal - 1) * $limit;
										$i=1;
										
											if(!empty($filter_sub_kategori)){
																$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang,stok_masuk where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and barang.kode_sub_kategori= '".@$filter_sub_kategori."' and  barang.kode_barang=stok_masuk.kode_barang order by stok_masuk.tanggal desc LIMIT $offset, $limit");}
											  elseif(!empty($filter_kategori)){
																$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang,stok_masuk where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$filter_nama."%' and barang.kode_kategori= '".@$filter_kategori."' and  barang.kode_barang=stok_masuk.kode_barang order by stok_masuk.tanggal desc LIMIT $offset, $limit");  
											  }else{
										$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang,stok_masuk where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and nama_barang like '%".@$_POST['cari']."%' and  barang.kode_barang=stok_masuk.kode_barang order by stok_masuk.tanggal desc LIMIT $offset, $limit");
											  }
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
                                             <td><?php echo date("d-m-Y",strtotime($row['tanggal']))  ?></td>
											 <td style="text-align:left;">- <?php echo $row['kategori_barang'] ?> <br>
                                          									-- <?php echo $row['sub_kategori'] ?>
                                           </td>
                                            <td><?php echo $row['nama_barang']  ?></td>
                                              <td><?php  echo $row['satuan']; ?></td>
                                                                <td style="text-align: center"><?php echo $row['jumlah'];@$stok2=$stok2+$row['jumlah'];  ?></td>
                                            <td><?php echo $row['keterangan']  ?></td>
                                                     <th ><?php echo $row['kd_gudang']  ?></th>                      
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                         <tr style="font-weight:bold">
                                            <td align="center">&nbsp;</td>
											 <td style="text-align:center;">Total</td>  <td colspan="3" align="center">&nbsp;</td>  
										    <td style="text-align: center"><?php
											 
											   echo number_format(@$stok2); ?></td>
                                                                
                                            <td colspan="2">&nbsp;</td>                          
                                        </tr>
                                    </table></div>
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
								
									
									
									if(!empty($filter_sub_kategori)){
												  
												
										 	$query  = "SELECT COUNT(nama_barang) AS jumData from barang,stok_masuk where kode_kategori = '".@$filter_kategori."' and nama_barang like '%".@$filter_nama."%' and barang.kode_sub_kategori= '".@$filter_sub_kategori."'  and  barang.kode_barang=stok_masuk.kode_barang";
										}
									  elseif(!empty($filter_kategori)){
												  	
												  	$query  = "SELECT COUNT(nama_barang) AS jumData from barang,stok_masuk where kode_kategori = '".@$filter_kategori."' and nama_barang like '%".@$filter_nama."%'  and  barang.kode_barang=stok_masuk.kode_barang ";
											  }else{
									$query  = "SELECT COUNT(nama_barang) AS jumData from barang,stok_masuk where nama_barang like '%".@$filter_nama."%'  and  barang.kode_barang=stok_masuk.kode_barang";}
									
									
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
