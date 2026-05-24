<?php
include "koneksi.php";

if(isset($_POST['bulan']))
	{
		$cari=$_POST['bulan']."-01";
		$bulan=date('F',strtotime($cari));
		$tahun=date('Y',strtotime($cari));
			
	}else{
		$cari=date('Y-m-d');
		$bulan=date('F');
		$tahun=date('Y');
	}
?>
<section class="content-header">
	<h1>
		Laporan<small></small>
    </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Laporan Penjualan Bulan <?php echo $bulan?> <?php echo $tahun ?></h3>
                            </div><!-- /.box-header -->
                            <form name="autoSumForm" method="POST" action="?page=<?php echo $_GET['page'] ?>" >
<table width="200" border="0" cellpadding="0" cellspacing="0" style="float:right" 	 >


    <tr>
      <td ><div class="input-group">
                                        			<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
										</div><input name="bulan" type="text"  class="form-control"  size="7" readonly="readonly" required placeholder="Dari" value="<?php echo @$_POST['bulan']  ?>" id="datepicker1"></div></td>
     
      <td ><button class="btn btn-md btn-default"><i class="fa fa-search"></i></button></td>
    </tr>
    <tr>
      <td colspan="4" > </td>
    </tr>
</table>
</form>

                                <div class="box-body" style="padding-top:0px;">
								
                                    <table class="table table-hover " style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>
											<th style="text-align:center;">&nbsp;</th>
                                            <th style="text-align:center;">Nama Barang</th>
                                           
                                         
                                            
                                            <th >Harga Beli</th>
                                            <th >Harga Jual</th>
                                           
                                            <th >Jumlah</th>   <th >Satuan</th>
                                             <th >Total Beli</th>
                                                                                        <th >Total Jual</th>
                                                                                          <th >Selisih</th>
                                                                                        
                                         
                                        </tr>
                                        <?php
									
										$query=mysql_query("select * from penjualan where month(tgl_jual)='".date('m',strtotime($cari))."' and year(tgl_jual)='".date('Y',strtotime($cari))."' ");
										while($data=mysql_fetch_array($query)){
										?>
                                        <tr style="font-weight:bold">
                                            <td align="center">&nbsp;</td>
											 <td style="text-align:left;"><?php echo $data['no_jual'] ?></td>
											 <td colspan="7" style="text-align:left;">&nbsp;</td>
											 <td style="text-align:left;">Tanggal : <?php echo date("d-m-Y",strtotime($data['tgl_jual'])) ?></td>
                                        </tr>
										<?php
									
										$qry=mysql_query("select * from penjualan_detail,barang where penjualan_detail.kode_barang=barang.kode_barang and no_jual='".$data['no_jual']."'");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"></td>
											 <td style="text-align:center;"></td>
                                             <td style="text-align:center;"><?php echo $row['nama_barang'] ?></td>
                                           
                                              
                                            
                                            <td><?php
											 
											   echo number_format($row['harga_beli']); ?></td>
                                            <td><?php 
													  echo number_format($row['harga_jual']); ?></td>
                                                      <td><?php
											 
											 
											 	
											echo 	$stok=$row['jumlah']; 
											   @$stok2=$stok+$stok2; ?></td><td><?php  echo $row['satuan']; ?></td>
                                                <td><?php 
													  echo number_format($total_beli=$row['harga_beli']*$row['stok']);
													  @$total_beli2=$total_beli+$total_beli2;
													   ?></td>
                                                       <td><?php
											 
											   echo number_format($total_jual=$row['harga_jual']*$row['stok']);
											   @$total_jual2=$total_jual+$total_jual2;
											    ?></td>
                                                <td><?php
											 
											   echo number_format(@$grand_total=$total_jual-$total_beli);
											   @$grand_total2=@$grand_total+@$grand_total2;
											    ?></td>
                                           
                                           
                                        </tr>
                                        <?php
									
										}
										}
										?>
                                         <tr style="font-weight:bold">
                                            <td align="center">&nbsp;</td>
											 <td style="text-align:center;">Total</td>
                                            <td>&nbsp;</td>
                                              <td>&nbsp;</td>
                                            
                                            <td>&nbsp;</td>
                                            <td><?php
											 
											   echo number_format(@$stok); ?></td>
                                                      <td>&nbsp;</td>
                                                    <td><?php
											 
											   echo number_format(@$total_beli2); ?></td>
                                                    <td><?php
											 
											   echo number_format(@$total_jual2); ?></td>
                                                 <td><?php
											 
											   echo number_format(@$grand_total2); ?></td>
                                         
                                        </tr>
                                    </table>
</div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								
								
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
