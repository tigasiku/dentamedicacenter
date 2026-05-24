<?php
if(isset($_GET['kd_bank'])){
			
	
	$kode_bank=$_GET['kd_bank'];	
}
elseif(isset($_POST['kd_bank'])){
	$kode_bank=$_POST['kd_bank'];	
}else{
	
	$kode_bank="";
}
$qrybank=mysql_query("select * from gudang where kd_gudang='".$kode_bank."'");
						$bank=mysql_fetch_array($qrybank);
?>

<section class="content-header">
 <?php if($_SESSION["loglevel_graha3"]=="Administrator" or $_SESSION["loglevel_graha3"]=="Admin"){ ?>	 <div class="pull-right" style="padding-right:5px"><a href="?page=mutasi.stok" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i> Mutasi Stok</a>
        
      </div><?php } ?>
	<h1>
		Arus Stok   <?php if(!empty($kode_bank)){ echo $bank[1] ?> <?php if(!empty($bank[2])) echo " - ".$bank[2] ?> <?php if(!empty($bank[3])) echo " - ".$bank[3] ; }?></h1>
</section>
<script type="text/javascript">
$(document).ready(function()
{
	$('table .save').click(function()
	{
		
		
			var id2 = $(this).parents().attr('id');
			var data3 = 'id=' + id2;
			var parent = $(this).parents()

			$.ajax(
			{
				   type: "POST",
				   url: "userInfo_material.php",
				   data:data3,
				   cache: false
				  
			 });
		
	});

	// style the table with alternate colors
	// sets specified color for every odd row
	$('table tr:odd');
});
</script>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary" style="border-top-color: #34495e">
                                <div class="box-header">
                                 
                                    
                              </div><!-- /.box-header -->
                                <?php 				
					if(isset($_GET['pesan'])){?>  
                           	<div class="small-box bg-<?php if(($_GET['pesan']=="success")){ echo "green";}else{ echo  "red";} ?>">
                                		<div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                             			</div>
                        	</div><?php }?>
                                <div class="box-body" style="padding-top:0px;">
								<form action="?page=<?Php echo $page ?>" method="post">
        <div class="well">
          <div class="row">
           
            <div class="col-sm-4">
              <div class="form-group">
	                <label class="control-label" for="input-price">Dari Tanggal</label>
    	            <div class="input-group">
        	        	<input type="text" name="filter_dari" value="<?php echo @$filter_dari ?>" placeholder="Dari Tanggal" id="dp1" class="form-control">
                    	<div class="input-group-addon">
                        	<i class="fa fa-calendar"></i>
                        </div>
                    </div>
              </div>
               <div class="form-group">
	                <label class="control-label" for="input-price">Sampai Tanggal</label>
    	            <div class="input-group">
        	        	<input type="text" name="filter_sampai" value="<?php echo @$filter_sampai ?>" placeholder="Sampai Tanggal" id="dp2" class="form-control">
                   	<input type="hidden" name="user" value="<?php echo @$usernya ?>" class="form-control">
                   		<input type="hidden" name="nama" value="<?php echo @$namanya ?>" class="form-control">
                    	<div class="input-group-addon">
                        	<i class="fa fa-calendar"></i>
                        </div>
                    </div>
              </div>
            </div>
             <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-name">Gudang Dari</label>
                 <select name="kd_bank"   class="form-control" id="pembayaran" required onChange="func2()">
                                                     <option>Pilih</option>
                                    	<?php 
												$qrybank=mysql_query("select * from bank_perusahaan order by kd_bank");
												while($bank=mysql_fetch_array($qrybank)){
										?>
                                    	<option value="<?php echo $bank[0] ?>" <?php if($bank[0]==$kode_bank) echo "selected"  ?>><?php echo $bank[1] ?> <?php if(!empty($bank[2])) echo " - ".$bank[2] ?> <?php if(!empty($bank[3])) echo " - ".$bank[3] ?></option><?php } ?>
                                    	
									</select>
              </div>
             
            </div>
            <div class="col-sm-4">
           
              <div class="form-group">
                <label class="control-label" for="input-name">Uraian</label>
                <input type="text" name="filter_uraian" value="<?php echo @$filter_uraian ?>" placeholder="Uraian" id="input-name" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
              </div>
              <button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
            </div>
          </div>
        </div>
         </form> 
                                     <h3>Stok <?php     if(!empty($filter_sampai) and !empty($filter_dari)){ echo date("d F Y",strtotime($filter_dari))." s/d "; echo date("d F Y",strtotime($filter_sampai)); }else{ echo date("F Y"); } ?></h3>  
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>
                                                <th style="text-align:center;">Barang</th>
                                                   <th style="text-align:center;">Gudang </th>
                                            <th style="text-align:center;">Masuk</th>
                                            <th style="text-align:center;">Keluar</th>
                                        
                                        
                                            <th style="text-align:center;">Aksi</th>
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
										$qry=mysql_query("select * from mutasi_gudang where tanggal between '".$filter_dari."' and '".$filter_sampai."'  and mutasi_gudang.keterangan like '%".@$filter_uraian."%' and  kode_barang like '%".$kode_bank."%'  group by day(tanggal),month(tanggal),year(tanggal) order by tanggal ");
									   }else{
										   $qry=mysql_query("select * from mutasi_gudang  where  keterangan like '%".@$filter_uraian."%'  and  kode_barang like '%".$kode_bank."%' group by day(tanggal),month(tanggal),year(tanggal) order by tanggal ");
									   }
										while($row2=mysql_fetch_array($qry)){
										?>
                                        
                                        <tr>
                                           
										   
                                            <td style="text-align:left;" colspan="6"><?php echo date("d F Y",strtotime($row2['tanggal'])); ?></td>
                                            
                            
                                        </tr>
                                        <?php 
											
											 if(!empty($filter_sampai) and !empty($filter_dari)){
												 
												 	$qry_detil=mysql_query("select * from mutasi_gudang,barang where mutasi_gudang.kode_barang=barang.kode_barang and day(tanggal)='".date("d",strtotime($row2['tanggal']))."' and month(tanggal)='".date("m",strtotime($row2['tanggal']))."' and year(tanggal)='".date("Y",strtotime($row2['tanggal']))."' and mutasi_gudang.keterangan like '%".@$filter_uraian."%' and  mutasi_gudang.kode_barang like '%".$kode_bank."%' order by tanggal asc ");
												 
											 }else{
												 
											 
										$qry_detil=mysql_query("select * from mutasi_gudang,barang where  day(tanggal)='".date("d",strtotime($row2['tanggal']))."' and month(tanggal)='".date("m",strtotime($row2['tanggal']))."' and year(tanggal)='".date("Y",strtotime($row2['tanggal']))."' and mutasi_gudang.kode_barang=barang.kode_barang and  mutasi_gudang.keterangan like '%".@$filter_uraian."%'  and  mutasi_gudang.kode_barang like '%".$kode_bank."%' order by tanggal asc ");
											
											}
										while($row=mysql_fetch_array($qry_detil)){
											
											
										?>
                                        <tr class=" <?php if($_SESSION['loglevel_graha']=="Administrator"){ echo 'save'; } if($num1>0){ echo " active"; }?> " id="<?php echo $row['kd_kas'] ?>">
                                           
										    <td style="text-align:center;" class="<?php if($_SESSION['loglevel_graha']=="Administrator"){ echo 'save'; } ?>"><?php echo $i; ?></td>
                                            <td style="text-align:center;" class="<?php if($_SESSION['loglevel_graha']=="Administrator"){ echo 'save'; } ?>"><?php echo ($row['nama_barang']);  ?></td>
                                             <td style="text-align:center;" class="<?php if($_SESSION['loglevel_graha']=="Administrator"){ echo 'save'; } ?>"><?php echo $row['kd_gudang'] ?> <?php if(!empty($row['no_rek'])) echo " <br> ".$row['no_rek'] ?> <?php if(!empty($row['atas_nama'])) echo " <br> ".$row['atas_nama'] ?></td>
                                       
                                             <td style="text-align:center;" class="<?php if($_SESSION['loglevel_graha']=="Administrator"){ echo 'save'; } ?>"><?php 
											 if($row['tipe']=="masuk"){
											 echo number_format($nilai_masuk=$row['jumlah']);} ?></td>
                                             
                                              <td style="text-align:center;" class="<?php if($_SESSION['loglevel_graha']=="Administrator"){ echo 'save'; } ?>"><?php  if($row['tipe']=="keluar"){
											 echo number_format($nilai_keluar=$row['jumlah']);} ?></td>
                                             
                                        
               <td style="text-align:center;">
                                           
											<a href="?page=edit.mutasi.stok&id=<?php echo $row['0']?>"><span class="fa fa-edit"></span></a> <a href="hapus.mutasi.stok.php?id=<?php echo $row['0']?>" class="hapus"><span class="fa fa-trash-o"></span></a></td> 
                                        <?php
										$i++;
											$saldo_awalan=0;
										}$saldo_awalan=0;
										}$saldo_awalan=0;
										?>
                                    <tr>
                                            <th style="text-align:center;">&nbsp;</th>
                                                <th style="text-align:center;">&nbsp;</th>
                                                   <th style="text-align:center;">&nbsp;</th>
                                            <th style="text-align:center;"><?php 
												
												
											 if(!empty($filter_sampai) and !empty($filter_dari)){
												 
												 	$debet=mysql_fetch_array(mysql_query("select sum(jumlah) as total from mutasi_gudang where tanggal between '".$filter_dari."' and '".$filter_sampai."'  and keterangan like '%".@$filter_uraian."%'  and tipe='masuk'  "));
												 
											 }else{
												 
											 
												$debet=mysql_fetch_array(mysql_query("select sum(jumlah) as total from mutasi_gudang where  keterangan like '%".@$filter_uraian."%' and  tipe='keluar'   "));
											
											 }
												echo number_format($debet['total']);
												
												 ?></th>
                                            <th style="text-align:center;"><?php 
												
												
											 if(!empty($filter_sampai) and !empty($filter_dari)){
												 
												 	$kredit=mysql_fetch_array(mysql_query("select sum(jumlah) as total from mutasi_gudang where tanggal between '".$filter_dar."' and '".$filter_sampai."' and keterangan like '%".@$filter_uraian."%' and tipe='masuk' "));
												 
											 }else{
												 
											 
												$kredit=mysql_fetch_array(mysql_query("select sum(jumlah) as total from mutasi_gudang where  keterangan like '%".@$filter_uraian."%'  and tipe='keluar'  "));
											
											 }
												echo number_format($kredit['total']);
												
												 ?></th>
                                        
                                            <th style="text-align:center;" colspan="2">&nbsp;</th>
                                            
                                      </tr>
                                    </table>
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								
                                </div>
                            </div><!-- /.box -->
                        </div>
                    </div>
</section><!-- /.content -->
<style type="text/css">
table tr.active {background-color: #ffc892 !important;}
	
table, table tr, table tr td {margin: 0; padding: 0; border: 0; cursor: pointer;}
table tr.active td {background-color: #ffc892 !important; }
.table>thead>tr>.active, .table>tbody>tr>.active, .table>tfoot>tr>.active, .table>thead>.active>td, .table>tbody>.active>td, .table>tfoot>.active>td, .table>thead>.active>th, .table>tbody>.active>th, .table>tfoot>.active>th {
    background-color: #ffc892;
}
</style>
<?php

?>
<script>
$( ".hapus" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin Untuk Menghapus Data?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script>