<?php
include "koneksi.php";
$row=mysql_fetch_array(mysql_query("select * from barang,kategori_barang,sub_kategori_barang where barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and barang.kode_barang = '".@$_GET['kode_barang']."' "));
							
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
                                            <th style="text-align:center;">No</th>	
                                           
											<th style="text-align:center;">Kategori</th>
                                         
                                            <th >Nama Barang </th>
                                            <th >Satuan</th>
                                                                
                                            <th  style="text-align:center;">Kredit</th> 
                                          
                                                                                    
                                           	<th  style="text-align:center;">Debet</th> 
                                           	<th  style="text-align:center;">Saldo</th> 
                                        </tr>
                                        
                                        <?php 
											if(!empty($filter_sampai) and !empty($filter_dari)){
											
											$qry_debet_all=mysql_fetch_array(mysql_query("select sum(nilai) as nilai from arus_kas where keterangan like '%".@$filter_uraian."%' and  kd_bank like '%".$kode_bank."%' and tipe_kas='debet'  and kd_bank<>'' and kd_bank<>'Pilih'"));
											$qry_kredit_all=mysql_fetch_array(mysql_query("select sum(nilai) as nilai  from arus_kas where  keterangan like '%".@$filter_uraian."%' and  kd_bank like '%".$kode_bank."%' and tipe_kas='kredit'  and kd_bank<>'' and kd_bank<>'Pilih'"));
											
											
											$qry_debet=mysql_fetch_array(mysql_query("select sum(nilai) as nilai from arus_kas where tanggal between '".$filter_dari." 00:00:00"."' and '".$filter_sampai." 23:59:00"."'  and keterangan like '%".@$filter_uraian."%' and  kd_bank like '%".$kode_bank."%' and tipe_kas='debet'  and kd_bank<>'' and kd_bank<>'Pilih'"));
											$qry_kredit=mysql_fetch_array(mysql_query("select sum(nilai) as nilai  from arus_kas where tanggal between '".$filter_dari." 00:00:00"."' and '".$filter_sampai." 23:59:00"."'  and keterangan like '%".@$filter_uraian."%' and  kd_bank like '%".$kode_bank."%' and tipe_kas='kredit'  and kd_bank<>'' and kd_bank<>'Pilih'"));
									
											
									    }else{
											
										
											$qry_debet_all=mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from barang,kategori_barang,sub_kategori_barang,pembelian,pembelian_detail where pembelian_detail.kode_barang=barang.kode_barang and pembelian_detail.no_beli=pembelian.no_beli  and barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and barang.kode_barang = '".@$_GET['kode_barang']."'"));
										
											$qry_kredit_all=mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from barang,kategori_barang,sub_kategori_barang,penjualan,penjualan_detail where penjualan_detail.kode_barang=barang.kode_barang and penjualan_detail.no_jual=penjualan.no_jual  and barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and barang.kode_barang = '".@$_GET['kode_barang']."' "));
										
											$qry_debet=mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from barang,kategori_barang,sub_kategori_barang,pembelian,pembelian_detail where pembelian_detail.kode_barang=barang.kode_barang and pembelian_detail.no_beli=pembelian.no_beli  and barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and barang.kode_barang = '".@$_GET['kode_barang']."' and month(tgl_beli)='".date('m')."' and year(tgl_beli)='".date('Y')."'"));
										
											$qry_kredit=mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from barang,kategori_barang,sub_kategori_barang,penjualan,penjualan_detail where penjualan_detail.kode_barang=barang.kode_barang and penjualan_detail.no_jual=penjualan.no_jual  and barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and barang.kode_barang = '".@$_GET['kode_barang']."' and month(tgl_jual)='".date('m')."' and year(tgl_jual)='".date('Y')."'  "));
											
													$qry_masuk_all=mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from barang,kategori_barang,sub_kategori_barang,stok_masuk where stok_masuk.kode_barang=barang.kode_barang and barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and barang.kode_barang = '".@$_GET['kode_barang']."'"));
											
												$qry_keluar_all=mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from barang,kategori_barang,sub_kategori_barang,stok_keluar where stok_keluar.kode_barang=barang.kode_barang and barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and barang.kode_barang = '".@$_GET['kode_barang']."'"));
												
												$qry_masuk=mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from barang,kategori_barang,sub_kategori_barang,stok_masuk where stok_masuk.kode_barang=barang.kode_barang and barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and barang.kode_barang = '".@$_GET['kode_barang']."' and month(tanggal)='".date('m')."' and year(tanggal)='".date('Y')."'"));
											
												$qry_keluar=mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from barang,kategori_barang,sub_kategori_barang,stok_keluar where stok_keluar.kode_barang=barang.kode_barang and barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and barang.kode_barang = '".@$_GET['kode_barang']."' and month(tanggal)='".date('m')."' and year(tanggal)='".date('Y')."'"));
												
										}
											$saldo_awalan=($qry_debet_all[0]+$qry_masuk_all[0])-$qry_debet[0]-$qry_masuk[0]+$row['stok'];
											
										$saldo_kredit=($qry_kredit_all[0]+$qry_keluar_all[0])-$qry_kredit[0]-$qry_keluar[0];
										$hari=date("d");
                                        for ( $x = 1; $x <= $hari; $x++) {
										?>
                                        <tr>
                                           
										   
                                            <td style="text-align:left;" colspan="8"><?php echo $x; ?> <?php echo date("F") ?> <?php echo date("Y");   ?></td>
                                            
                            
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
										
								
										
										
											
							
										?>
                                
                                      <?php if($saldo_awalan > 0){ ?>
                                      <tr >
                                           
										    <td style="text-align:center;" >&nbsp;</td>
                                            <td style="text-align:center;" >Saldo Awal</td>
                                             <td style="text-align:center;" >&nbsp;</td>
                                           <td style="text-align:center;" >&nbsp;</td>
                                             <td style="text-align:center;" ><?php 
											
											 echo number_format($nilai_masuk=$saldo_awalan); ?></td>
                                             
                                              <td style="text-align:center;" ><?php 
											
											 echo number_format($nilai_keluar=$saldo_kredit); ?></td>
                                             
                                         <td style="text-align:center;" ><span class="" style="text-align:center;">
                                           <?php 
										 
										
											 $saldo2=$nilai_masuk-$nilai_keluar; 
									
										 echo number_format($saldo2);
										?>
                                         </span></td>
                                                               
                                      
                                       
                                      
                                      
                                      </tr><?php }  ?>   <tr>
                                            <td align="center"><?php echo $i;?></td>
									    <td style="text-align:left;">- <?php echo $row['kategori_barang'] ?> <br>
                                          									-- <?php echo $row['sub_kategori'] ?>
                                           </td> 
                                            <td><?php echo $row['nama_barang']  ?></td>
                                              <td><?php  echo $row['satuan']; ?></td>
                                               <td  align="center"><?php  
											
											$row_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from barang,kategori_barang,sub_kategori_barang,pembelian,pembelian_detail where pembelian_detail.kode_barang=barang.kode_barang and pembelian_detail.no_beli=pembelian.no_beli  and barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and barang.kode_barang = '".@$_GET['kode_barang']."' and day(tgl_beli)='".$x."' and month(tgl_beli)='".date('m')."' and year(tgl_beli)='".date('Y')."'"));
											
											 echo number_format($row_beli['jumlah']);
											@$jumlah_beli=$row_beli['jumlah']+$jumlah_beli;
												
												?></td>                      
                                            <td  align="center"><?php 
											
											$row_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from barang,kategori_barang,sub_kategori_barang,penjualan,penjualan_detail where penjualan_detail.kode_barang=barang.kode_barang and penjualan_detail.no_jual=penjualan.no_jual  and barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and barang.kode_barang = '".@$_GET['kode_barang']."' and day(tgl_jual)='".$x."' and month(tgl_jual)='".date('m')."' and year(tgl_jual)='".date('Y')."' order by tgl_jual desc "));
											
											 echo number_format($row_jual['jumlah']);
											@$jumlah=$row_jual['jumlah']+$jumlah; ?></td>
                                           
                                           <td  align="center"><?php  
											
										echo number_format($row_beli['jumlah']-$row_jual['jumlah']+$saldo2);
											
											
											@$saldo=$row_beli['jumlah']-$row_jual['jumlah'];
												
											$saldo2=$saldo2+$saldo;
											
												?></td>   
                                      </tr>
                                        <?php
										$i++;
										$saldo_awalan=0;
										?><?php } ?>
                                         <tr style="font-weight:bold">
                                            <td align="center">&nbsp;</td>
											 <td style="text-align:center;">Total</td>
                                            <td>&nbsp;</td><td>&nbsp;</td>
                                              <td>&nbsp;</td>
                                                                   <?php if ($_SESSION['loglevel']=="Administrator"){ ?>
                                            <td>&nbsp;</td><?php }?>
                                            <td  align="center"><?php
											 
											   echo number_format(@$saldo2); ?></td>
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
