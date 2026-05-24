 <?php	 
include("koneksi.php");
											$qry=mysql_query("select * from barang where   status_barang='Y' ");
										
										while($row=mysql_fetch_array($qry)){
									
											 
											 	$qty_beli=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from pembelian_detail,pembelian where pembelian_detail.no_beli=pembelian.no_beli and kode_barang='".$row['kode_barang']."'"));
												$qty_jual=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from penjualan_detail,penjualan where penjualan.no_jual=penjualan_detail.no_jual and kode_barang='".$row['kode_barang']."'"));
											$stok_keluar=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_keluar where kode_barang='".$row['kode_barang']."'"));
											$stok_masuk=mysql_fetch_array(mysql_query("select sum(jumlah) as jum from stok_masuk where kode_barang='".$row['kode_barang']."'"));
										 	$stok=($qty_beli[0]+$row['stok']+$stok_masuk[0])-$qty_jual[0]-$stok_keluar[0]; 
											   @$stok2=$stok+$stok2;
											
												 number_format($total_beli=$row['harga_beli']*$stok);
													  @$total_beli2=$total_beli+$total_beli2;
													
											   number_format($total_jual=$row['harga_jual']*$stok);
											   @$total_jual2=$total_jual+$total_jual2;
											 
										}
										?>
                                       <?php echo number_format(@$total_beli2); ?>
                                             