<?php
include "koneksi.php";

?>
<section class="content-header">
	<h1>
		Histori Transaksi Penjualan Barang<small></small>
    </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                  
                            </div><!-- /.box-header -->
                                <div class="box-body" style="padding-top:0px;">
									
                                 
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>	<th style="text-align:left;">Tanggal</th>
                                            <th style="text-align:left;">Customer</th>
											<th style="text-align:center;">Kategori</th>
                                         
                                            <th >Nama Barang </th>
                                            <th >Satuan</th>
                                                                
                                            <th  style="text-align:center;">Debet</th> 
                                          
                                                                                    
                                           	<th  style="text-align:center;">Kredit</th> 
                                        </tr>
                                        
                                        <?php 
										$hari=date("d");
                                        for ( $x = 1; $x <= $hari; $x++) {
										?>
                                        <tr>
                                           
										   
                                            <td style="text-align:left;" colspan="8"><?php echo $x; ?> <?php echo date("F") ?> <?php echo date("Y"); ?></td>
                                            
                            
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
										
										$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang,penjualan,penjualan_detail where penjualan_detail.kode_barang=barang.kode_barang and penjualan_detail.no_jual=penjualan.no_jual  and barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and barang.kode_barang = '".@$_GET['kode_barang']."' and day(tgl_jual)='".$x."' and month(tgl_jual)='".date('m')."' and year(tgl_jual)='".date('Y')."' order by tgl_jual desc ");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                      
                                            <td align="center"><?php echo $i;?></td>
                                                   <td><?php echo date("d F Y",strtotime($row['tgl_jual']))  ?></td>
										 <td><?php echo $row['customer']  ?></td>	 <td style="text-align:left;">- <?php echo $row['kategori_barang'] ?> <br>
                                          									-- <?php echo $row['sub_kategori'] ?>
                                           </td> 
                                            <td><?php echo $row['nama_barang']  ?></td>
                                              <td><?php  echo $row['satuan']; ?></td>
                                                                 
                                            <td  align="center"><?php  echo number_format($row['jumlah']);@$jumlah=$row['jumlah']+$jumlah; ?></td>
                                               
                                         
                                        </tr>
                                        <?php
										$i++;
										}
										?><?php }?>
                                         <tr style="font-weight:bold">
                                            <td align="center">&nbsp;</td>
											 <td style="text-align:center;">Total</td>
                                            <td>&nbsp;</td><td>&nbsp;</td>
                                              <td>&nbsp;</td>
                                                                   <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <td>&nbsp;</td><?php }?>
                                            <td  align="center"><?php
											 
											   echo number_format(@$jumlah); ?></td>
                                                                          <?php if ($_SESSION['loglevel']=="Administrator"){ ?> <?php } ?>
                                               <?php if ($_SESSION['loglevel']=="Administrator"){ ?>  
                                            <?php }?>
                                        </tr>
                                    </table>
                                </div><!-- /.box-body -->
								
                               
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
