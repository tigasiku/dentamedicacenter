<?php
$jumlah=0;
if(isset($_POST['filter_dari'])){
$filter_dari=$_POST['filter_dari'];
$filter_sampai=$_POST['filter_sampai'];

}
elseif(isset($_GET['filter_dari'])){
$filter_dari=$_GET['filter_dari'];
$filter_sampai=$_GET['filter_sampai'];

}

else{
$filter_sampai=date("Y-m-d");
$filter_dari=date("Y-m-01");
	$filter_jenis="";
}
?>
<section class="content-header"><div class="pull-right" style="padding-right:5px">	<a href="?page=barang&filter_kategori=<?php echo @$filter_kategori ?>&filter_sub_kategori=<?php echo @$filter_sub_kategori ?>&filter_nama=<?php echo @$filter_nama ?>" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-mail-reply"></i> Cancel </a>
        
      </div>
	<h1>
		Histori Transaksi Pembelian Barang<small></small>
    </h1>
</section>

<div class="container-fluid" style="padding-right:5px;padding-left:5px;padding-top: 20px">
            <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title" style="max-width: 250px;display: inline-block"><i class="fa fa-list"></i> Order List </h3> <button class="btn btn-default pull-right" id="myelement" ><i class="fa fa-search"></i></button>
      </div>
      <div class="panel-body">
      <form action="?page=<?Php echo $page ?>" method="post">
        <div class="well" id="another-element" style="<?php if(isset($_POST['submit'])) {echo "display:block";}else{ echo "display:none"; }  ?>">
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
                <label class="control-label" for="input-name">Customer</label>
                <input type="text" name="filter_nama" value="<?php echo @$filter_nama ?>" placeholder="Customer" id="input-name" class="form-control" autocomplete="off">  <input type="hidden" name="filter_kode_barang" value="<?php echo @$filter_kode_barang ?>" >
              </div>
              	 
              <button type="submit" id="button-filter" class="btn btn-primary pull-right"  name="submit" style="margin-left: 10px"><i class="fa fa-search"></i> Filter</button>   
            </div>
          </div>
        </div>
         </form>
			<div class="row">
                        <div class="col-xs-12">
									
                                   <?php  if(isMobile()){ ?>
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                         <tr>
                                            <th style="text-align:center;">No</th>	<th style="text-align:left;">Tanggal</th>
                                            <th >Nama Barang </th>
                                            <th  style="text-align:center;">Jumlah</th> 
                                           
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
										
										$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang,pembelian,pembelian_detail where pembelian_detail.kode_barang=barang.kode_barang and pembelian_detail.no_beli=pembelian.no_beli  and barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and  barang.kode_barang = '".@$filter_kode_barang."' and tgl_beli between '".@$filter_dari."' and '".@$filter_sampai."' and nama_vendor like '%".@$filter_nama."%' order by tgl_beli desc ");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                      
                                        
                                                   <td align="center"><?php echo $i;?></td>
                                                   <td><?php echo date("d F Y",strtotime($row['tgl_beli']))  ?><br><br><b><?php echo $row['nama_vendor']  ?></b><br>
                                                   Gudang : <b><?php echo $row['kd_gudang']  ?></b>
                                                   </td>
                                                   
                                                 
                                          <td>
                                           - <?php echo $row['kategori_barang'] ?> <br>
                                       									 -- <?php echo $row['sub_kategori'] ?><br>
                                          <b> <?php echo $row['nama_barang']  ?></b></td>
                                                                 
                                            <td  align="center"><?php  echo number_format($row['jumlah']);@$jumlah=$row['jumlah']+$jumlah; ?></td>
                                               
                                          
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                         <tr style="font-weight:bold">
                                            <td align="center">&nbsp;</td>
											 <td style="text-align:center;">Total</td>
                                         
                                              <td>&nbsp;</td>
                                                                  
                                            <td  align="center"><?php
											 
											   echo number_format(@$jumlah); ?></td>
                                        </tr>
                                    </table><?php }else{ ?>
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>	<th style="text-align:left;">Tanggal</th>
                                            <th style="text-align:left;">Vendor</th>
											<th style="text-align:center;">Kategori</th>
                                         
                                            <th >Nama Barang </th>
                                            <th >Satuan</th>
                                                               
                                            <th  style="text-align:center;">Jumlah</th> 
                                               <th  style="text-align:center;">Gudang</th> 
                                                                                    
                                         
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
										
										$qry=mysql_query("select * from barang,kategori_barang,sub_kategori_barang,pembelian,pembelian_detail where pembelian_detail.kode_barang=barang.kode_barang and pembelian_detail.no_beli=pembelian.no_beli  and barang.kode_kategori=kategori_barang.kode_kategori_barang and barang.kode_sub_kategori=sub_kategori_barang.id and  barang.kode_barang = '".@$filter_kode_barang."' and tgl_beli between '".@$filter_dari."' and '".@$filter_sampai."' and nama_vendor like '%".@$filter_nama."%' order by tgl_beli desc ");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                      
                                            <td align="center"><?php echo $i;?></td>
                                                   <td><?php echo date("d F Y",strtotime($row['tgl_beli']))  ?></td>
										 <td><?php echo $row['nama_vendor']  ?></td>	 <td style="text-align:left;">- <?php echo $row['kategori_barang'] ?> <br>
                                          									-- <?php echo $row['sub_kategori'] ?>
                                           </td> 
                                            <td><?php echo $row['nama_barang']  ?></td>
                                              <td><?php  echo $row['satuan']; ?></td>
                                                                 
                                            <td  align="center"><?php  echo number_format($row['jumlah']);@$jumlah=$row['jumlah']+$jumlah; ?></td>
                                               
                                           <td  align="center"><?php  echo  $row['kd_gudang']; ?></td>
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                         <tr style="font-weight:bold">
                                            <td align="center">&nbsp;</td>
											 <td style="text-align:center;">Total</td>
                                            <td>&nbsp;</td><td>&nbsp;</td>
                                              <td>&nbsp;</td>
                                                                 
                                            <td>&nbsp;</td>
                                            <td  align="center"><?php
											 
											   echo number_format(@$jumlah); ?></td><td>&nbsp;</td>
                                        </tr>
                                    </table><?php } ?>
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
