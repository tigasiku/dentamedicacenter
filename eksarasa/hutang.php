<?php include "checker.php"; ?>
<section class="content-header">
<?php if($_SESSION["loglevel_graha3"]=="Administrator" or $_SESSION["loglevel"]=="Admin"){ ?>	 <div class="pull-right" style="padding-right:5px">	<a href="?page=tambah.hutang" class="btn btn-danger btn-flat" style="float:left;"><i class="fa fa-plus"></i> Tambah</a>
        
      </div><?php } ?>
	<h1>
		Hutang<small></small>
    </h1>
</section>
  
  <script language="javascript">
function TampilTabel(file){
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=570,width=650');
}
</script>   
 <?php 
 if(isset($_GET['pesan']))
 {
 ?> 
<style type="text/css">
	
		@-webkit-keyframes color_change {
		  from { background-color: white; }
		  to { background-color: #ff5454; }
		}
		@-moz-keyframes color_change {
		  from { background-color: white; }
		  to { background-color: #ff5454; }
		}
		@-ms-keyframes color_change {
		  from { background-color: white; }
		  to { background-color: #ff5454; }
		}
		@-o-keyframes color_change {
		  from { background-color: white; }
		  to { background-color: #ff5454; }
		}
		@keyframes color_change {
		  from { background-color: white; }
		  to { background-color: #ff5454; }
		}
	
	.warna {
	
		
		   -webkit-animation: color_change 1s infinite alternate;
		   -moz-animation: color_change 1s infinite alternate;  
		   -ms-animation: color_change 1s infinite alternate;  
		   -o-animation: color_change 1s infinite alternate;  
		   animation: color_change 1s infinite alternate;   
  	
	}
	
.tiga{ 
background-color:#a0c8f7;
		}
.dua{
	background-color:#FCFFB9;}
.satu{
	background-color:#A8F09F;}

	
</style>
<style type="text/css">
table tr.active {background-color: #ffc892 !important;}
</style>
<div class="container-fluid" style="padding-right:5px;padding-left:5px">
        					<div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Pesan</h3>
                                   <div class="box-tools pull-right">
                                        
                                        <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    Data <code><?php echo $_GET['pesan'] ?></code> berhasil dieksekusi                                    
                                </div><!-- /.box-body -->
                            </div>
</div><?php } ?>                            
<div class="container-fluid" style="padding-right:5px;padding-left:5px;padding-top: 20px">
            <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title" style="max-width: 250px;display: inline-block"><i class="fa fa-list"></i> List </h3> <button class="btn btn-default pull-right" id="myelement" ><i class="fa fa-search"></i></button>
      </div>
      <div class="panel-body">
      <form action="?page=<?Php echo $page ?>" method="post">
        <div class="well" id="another-element" style="<?php if(isset($_POST['submit'])) {echo "display:block";}else{ echo "display:none"; }  ?>">
          <div class="row">
            <div class="col-sm-3">
        
              <div class="form-group">
                <label class="control-label" for="input-model">Nama</label>
                <input type="text" name="filter_nama" value="<?php echo @$filter_nama ?>" placeholder="Nama" id="input-model" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
	                <label class="control-label" for="input-price">Dari Tanggal</label>
    	            <div class="input-group">
        	        	<input type="text" name="filter_dari" value="<?php echo @$filter_dari ?>" placeholder="Dari Tanggal" id="dp1" class="form-control" readonly>
                    	<div class="input-group-addon">
                        	<i class="fa fa-calendar"></i>
                        </div>
                    </div>
              </div>
              <div class="form-group">
							<label class="control-label" for="input-price">Sampai Tanggal</label>
							<div class="input-group">
								<input type="text" name="filter_sampai" value="<?php echo @$filter_sampai ?>" placeholder="Sampai Tanggal" id="dp2" class="form-control" readonly>
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
							</div>
						 </div>
            </div>
                <div class="col-sm-3">
						<div class="form-group">
                <label class="control-label" for="input-model">Status</label>
                                
                                   	  <select name="filter_status" class="form-control" >
                                   	      <option value="">Pilih</option>
              			    <option value="N" <?php if("N"==@$filter_status) echo "selected" ?>>Lunas</option>
              			
              			<option value="Y" <?php if("Y"==$filter_status) echo "selected" ?>>Belum</option>
              	</select>
              </div>
              </div>
           <div class="col-sm-3">
             <div class="form-group">
                <label class="control-label" for="input-model">Kategori</label>
                                
                                   	  <select name="filter_kategoripusat" class="form-control" id="cmbKategoriPusat">
              			    <option value="">Pilih</option>
              			<?php
						
															$qry_kategorypus=mysql_query("select *  from kategori where kode >=2 and kode < 3");	
							while($kategoripus=mysql_fetch_array($qry_kategorypus)){
						?>
              			<option value="<?php echo $kategoripus['kode'] ?>" <?php if($kategoripus['kode']==@$filter_kategori_pusat) echo "selected" ?>><?php echo $kategoripus['kode'] ?> - <?php echo $kategoripus['klasifikasi'] ?></option><?php } ?>
              	</select>
              </div>
            <div class="form-group">
                <label class="control-label" for="input-model">Kategori</label>
              	<select name="filter_kategori" class="form-control" id="cmbKategori">
              				<option value="">Semua</option>
              		
					<?php
							if(!empty($filter_kategori_pusat)){
						
															$qry_kategory=mysql_query("select *  from kategori_hutang where kode_klasifikasi ='".$filter_kategori_pusat."' order by nomor_akun");
							while($kategori=mysql_fetch_array($qry_kategory)){
						?>
              			<option value="<?php echo $kategori['kode_kategori_hutang'] ?>" <?php if($kategori['kode_kategori_hutang']==@$filter_kategori) echo "selected" ?>><?php echo $kategori['nomor_akun'] ?> - <?php echo $kategori['kategori_hutang'] ?></option><?php } }?>
              	</select>
              </div>
            
              <button type="submit" id="button-filter" class="btn btn-primary pull-right" name="submit"><i class="fa fa-search"></i> Filter</button>
            </div>
          </div>
        </div>
         </form>
        <form action="http://localhost/opencart/upload/admin/index.php?route=catalog/product/delete&amp;token=TvthUB0fpnYKRqAYZYgsYn3RFzeFJBMC" method="post" enctype="multipart/form-data" id="form-product">
             <?php  if(isMobile()){ ?>
             
          <table style="float: right;margin-bottom: 5px"><tr>
    <td bgcolor="#a0c8f7" style="width:20px">&nbsp;</td>
    <td align="right"><span style="text-align:right">-3H </span></td>
    <td align="right"  bgcolor="#FCFFB9" style="width:20px">&nbsp;</td>
    <td align="right"><span style="text-align:right">-2H </span></td>
    <td align="right" bgcolor="#A8F09F" style="width:20px">&nbsp;</td>
    <td align="right"><span style="text-align:right">-1H </span></td>
    <td align="right" bgcolor="#ff5454" style="width:20px">&nbsp;</td>
    <td align="right"><span style="text-align:right"><em> Dead</em> line</span></td>
    </tr></table>
            <table class="table  table-hover">
              <thead>
                <tr>
                 
                     <th class="text-left">Keterangan</th>
                     <th class="text-left">           Total
                    </th>
                  <th class="text-right">Aksi</th>
                </tr>
              </thead>
              <tbody>
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
												 	if(!empty($filter_kategori)){
														$qry=mysql_query("select * from hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and kode_kategori_hutang='".@$filter_kategori."' and 
														tgl_jatuh_tempo between '".$filter_dari."' and '".$filter_sampai."' and nama like '%".@$filter_nama."%' and status = '".$filter_status."'
														order by tgl_jatuh_tempo asc LIMIT $offset, $limit");
													}else{
														if(!empty($filter_kategori_pusat)){
														 	$qry=mysql_query("select * from hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and  kode_klasifikasi='".@$filter_kategori_pusat."' and 
														tgl_jatuh_tempo between '".$filter_dari."' and '".$filter_sampai."' and nama like '%".@$filter_nama."%' and status = '".$filter_status."'
														order by tgl_jatuh_tempo asc LIMIT $offset, $limit");
													 }else{
														$qry=mysql_query("select * from hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and 
														tgl_jatuh_tempo between '".$filter_dari."' and '".$filter_sampai."' and nama like '%".@$filter_nama."%' and status = '".$filter_status."'
														order by tgl_jatuh_tempo asc LIMIT $offset, $limit");
													 }
														
													}	
												 }else{
													
												 	
													 if(!empty($filter_kategori)){
															$qry=mysql_query("select * from hutang,kategori_hutang where 
															tipe=kategori_hutang.kode_kategori_hutang and kode_kategori_hutang='".@$filter_kategori."' and 
															 nama like '%".@$filter_nama."%' and status = '".$filter_status."'
															order by tgl_jatuh_tempo asc LIMIT $offset, $limit");
													}else{
															if(!empty($filter_kategori_pusat)){
																$qry=mysql_query("select * from hutang,kategori_hutang where 
															tipe=kategori_hutang.kode_kategori_hutang and  kode_klasifikasi='".@$filter_kategori_pusat."' and 
															 nama like '%".@$filter_nama."%' and status = '".$filter_status."'
															order by tgl_jatuh_tempo asc LIMIT $offset, $limit");
															 }else{
																$qry=mysql_query("select * from hutang,kategori_hutang where 
																tipe=kategori_hutang.kode_kategori_hutang and 
																 nama like '%".@$filter_nama."%' and status = '".$filter_status."'
																order by tgl_jatuh_tempo asc LIMIT $offset, $limit");
															 }
														
													}	
												}
									
										while($row=mysql_fetch_array($qry)){
											
											$tglnya=date("Ymd",strtotime($row['tgl_jatuh_tempo']));
											$skrg=date("Ymd");
											$bg=$tglnya-$skrg;
											$jumlah_bayar=mysql_fetch_array(mysql_query("select sum(jumlah_bayar) as jumlah_bayar from bayar_hutang where kode_hutang='".$row['kode_hutang']."'"));
											$sisa=$row['total_hutang']-$jumlah_bayar['jumlah_bayar'];
										?>
                                                <tr  bgcolor="<?php
 if($bg==3 and $sisa > 0){  
  	echo "#a0c8f7";}
  	elseif($bg==2 and $sisa > 0){
	echo "#FCFFB9";}
	elseif($bg==1 and $sisa > 0){
  	echo "#A8F09F";}
	elseif($bg<=0 and $sisa > 0){
  	echo "#FFCECF";} ?>" class="<?php
	

		if($bg==3 and $sisa > 0){  
  		echo "tiga";}
  		elseif($bg==2 and $sisa > 0){
		echo "dua";}
		elseif($bg==1 and $sisa > 0){
  		echo "satu";}
		
			elseif($bg<=0 and $sisa > 0){
			
				echo " ";
		}

		
		?>" >
             
                <td class="text-left"><?php echo $row['0'] ?><br>
            		 TR : <b><?php echo date("d-m-Y",strtotime($row['tgl_transaksi'])) ?> </b><br>
            		 TP : <b><?php echo date("d-m-Y",strtotime($row['tgl_jatuh_tempo'])) ?> </b><br>
            		  <b><?php echo ($row['nama']); ?> </b><br>- <?php echo $row['kategori_hutang'] ?><br>
                    <?php	if($row['1']=="1") { ?>
                 		 <a onclick="window.open('?page=detail.pembelian&no_beli=<?php echo $row['keterangan'] ?>','mywindow','scrollbars=1,width=800,height=500')" style="cursor:pointer;font-weight: bold"><?php echo ($row['keterangan']); ?></a>
                  <?php }else{ ?>
                  		<?php echo ($row['keterangan']); ?>
                  <?php } ?>
                </td>
                 
                  <td class="text-right"><a href="javascript:TampilTabel('list_pembayaran_hutang.php?id=<?php echo ($row[0]); ?>')" style="font-weight: bold"> Rp. <?php echo number_format($row['total_hutang']-$jumlah_bayar['jumlah_bayar'])?></a></td> 
       <td class="text-right">
                
                <?php 
if($_SESSION["loglevel"]=="Administrator" or $_SESSION["loglevel"]=="Admin"){ ?>
                   <div class="text-center"><div class="btn-group text-left"><a type="button" class="dropdown-toggle" data-toggle="dropdown"><img src="img/9bf4705c9e.svg" alt="Action" height="18px"></a>
            <ul class="dropdown-menu pull-right" role="menu">
          
          
         
             
                 
                <?php if($row['total_hutang'] > $jumlah_bayar['jumlah_bayar']){ ?>   <li><a href="?page=bayar.hutang&id=<?php echo $row['0'] ?>" class="sledit"><i class="fa fa-money"></i> Bayar </a></li><?php } ?>
                 <li><a href="hapus.hutang.php?id=<?php echo $row['0'] ?>" class="sledit hapus"><i class="fa fa-trash-o"></i> Delete </a></li>
                   <li><a href="lunas.hutang.php?id=<?php echo $row['kode_hutang'] ?>" class="sledit"><i class="fa fa-check"></i> Lunas</a></li>
            </ul>
        </div></div>
           <?PHP } ?>
              
                </td>
                </tr><?PHP } ?>
                   <?php if($_SESSION['loglevel']=="Administrator"){ ?> 
                   <tr style="font-weight:bold">
                   		<td colspan="1">Grandtotal </td>
                        
                           <td align="right" style="white-space: nowrap"><?php 
							
								if(!empty($_POST['filter_dari']) and !empty($_POST['filter_sampai'])){
										 if(!empty($filter_kategori)){
														$num=(mysql_fetch_array(mysql_query("select sum(total_hutang) as subtotal from hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and kode_kategori_hutang='".@$filter_kategori."' and    tgl_jatuh_tempo between '".$filter_dari."' and '".$filter_sampai."' and nama like '%".@$filter_nama."%' and status = '".$filter_status."'")));
										 }else{
											 	if(!empty($filter_kategori_pusat)){
											 			$num=(mysql_fetch_array(mysql_query("select sum(total_hutang) as subtotal from hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and kode_klasifikasi='".@$filter_kategori_pusat."' and    tgl_jatuh_tempo between '".$filter_dari."' and '".$filter_sampai."' and nama like '%".@$filter_nama."%' and status = '".$filter_status."'")));
												 }else{
														$num=(mysql_fetch_array(mysql_query("select sum(total_hutang) as subtotal from hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang  and    tgl_jatuh_tempo between '".$filter_dari."' and '".$filter_sampai."' and nama like '%".@$filter_nama."%' and status = '".$filter_status."'")));
												}		
										}
								 }else{
														if(!empty($filter_kategori)){
														$num=(mysql_fetch_array(mysql_query("select sum(total_hutang) as subtotal from hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and kode_kategori_hutang='".@$filter_kategori."' and nama like '%".@$filter_nama."%' and status = '".$filter_status."'")));
														 }else{
																if(!empty($filter_kategori_pusat)){
																		$num=(mysql_fetch_array(mysql_query("select sum(total_hutang) as subtotal from hutang,kategori_hutang where 
																		tipe=kategori_hutang.kode_kategori_hutang and kode_klasifikasi='".@$filter_kategori_pusat."'  and nama like '%".@$filter_nama."%' and status = '".$filter_status."'")));
																 }else{
																		$num=(mysql_fetch_array(mysql_query("select sum(total_hutang) as subtotal from hutang,kategori_hutang where 
																		tipe=kategori_hutang.kode_kategori_hutang   and nama like '%".@$filter_nama."%' and status = '".$filter_status."'")));
																}		
														}
							   }
						
											
											
										
						 number_format($num['subtotal']);?>
                             <?php 
															if(!empty($filter_kategori_pusat)){
																		$num_byr=(mysql_fetch_array(mysql_query("select sum(jumlah_bayar) as jumlah_bayar from bayar_hutang,hutang,kategori_hutang where 
																			tipe=kategori_hutang.kode_kategori_hutang and kode_klasifikasi='".@$filter_kategori_pusat."' and bayar_hutang.kode_hutang=hutang.kode_hutang  and nama like '%".@$filter_nama."%' and status = '".$filter_status."'")));  
																 }else{
																		$num_byr=(mysql_fetch_array(mysql_query("select sum(jumlah_bayar) as jumlah_bayar from bayar_hutang,hutang,kategori_hutang where 
																			tipe=kategori_hutang.kode_kategori_hutang and bayar_hutang.kode_hutang=hutang.kode_hutang  and nama like '%".@$filter_nama."%' and status = '".$filter_status."'")));  
																}	
								
										
					 number_format($num_byr['jumlah_bayar']);?>
                             Rp. <?php echo number_format($num['subtotal']-$num_byr['jumlah_bayar'])?></td>
                             <td></td> 
                        
                            
                   </tr>  <?php } ?>
                                              </tbody>
            </table>
            <?php }else{ ?>
           
           <div class="table-responsive">
            
            
            <table style="float: right;margin-bottom: 5px"><tr>
    <td bgcolor="#a0c8f7" style="width:20px">&nbsp;</td>
    <td align="right"><span style="text-align:right">-3H </span></td>
    <td align="right"  bgcolor="#FCFFB9" style="width:20px">&nbsp;</td>
    <td align="right"><span style="text-align:right">-2H </span></td>
    <td align="right" bgcolor="#A8F09F" style="width:20px">&nbsp;</td>
    <td align="right"><span style="text-align:right">-1H </span></td>
    <td align="right" bgcolor="#ff5454" style="width:20px">&nbsp;</td>
    <td align="right"><span style="text-align:right"><em> Dead</em> line</span></td>
    </tr></table>
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                 
                     <th class="text-left">       No Ref
                    </th>
                     <th class="text-left">         Tanggal Transaksi
                    </th>
          <th class="text-left">Kategori</th>
                    
             <th class="text-left">Nama Vendor</th>
                    <th class="text-left">Keterangan</th>
                     <th class="text-left">         Tanggal Jth Tempo
                    </th>
                     <th class="text-left">           Total
                    </th>
            		      <th class="text-left">          Jumlah Bayar
                    </th>
                        <th class="text-left">        Sisa
                    </th>
                  <th class="text-right">Action</th>
                </tr>
              </thead>
              <tbody>
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
												 	if(!empty($filter_kategori)){
														$qry=mysql_query("select * from hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and kode_kategori_hutang='".@$filter_kategori."' and 
														tgl_jatuh_tempo between '".$filter_dari."' and '".$filter_sampai."' and nama like '%".@$filter_nama."%' and status = '".$filter_status."'
														order by tgl_jatuh_tempo asc LIMIT $offset, $limit");
													}else{
														if(!empty($filter_kategori_pusat)){
														 	$qry=mysql_query("select * from hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and  kode_klasifikasi='".@$filter_kategori_pusat."' and 
														tgl_jatuh_tempo between '".$filter_dari."' and '".$filter_sampai."' and nama like '%".@$filter_nama."%' and status = '".$filter_status."'
														order by tgl_jatuh_tempo asc LIMIT $offset, $limit");
													 }else{
														$qry=mysql_query("select * from hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and 
														tgl_jatuh_tempo between '".$filter_dari."' and '".$filter_sampai."' and nama like '%".@$filter_nama."%' and status = '".$filter_status."'
														order by tgl_jatuh_tempo asc LIMIT $offset, $limit");
													 }
														
													}	
												 }else{
													
												 	
													 if(!empty($filter_kategori)){
															$qry=mysql_query("select * from hutang,kategori_hutang where 
															tipe=kategori_hutang.kode_kategori_hutang and kode_kategori_hutang='".@$filter_kategori."' and 
															 nama like '%".@$filter_nama."%' and status = '".$filter_status."'
															order by tgl_jatuh_tempo asc LIMIT $offset, $limit");
													}else{
															if(!empty($filter_kategori_pusat)){
																$qry=mysql_query("select * from hutang,kategori_hutang where 
															tipe=kategori_hutang.kode_kategori_hutang and  kode_klasifikasi='".@$filter_kategori_pusat."' and 
															 nama like '%".@$filter_nama."%' and status = '".$filter_status."'
															order by tgl_jatuh_tempo asc LIMIT $offset, $limit");
															 }else{
																$qry=mysql_query("select * from hutang,kategori_hutang where 
																tipe=kategori_hutang.kode_kategori_hutang and 
																 nama like '%".@$filter_nama."%' and status = '".$filter_status."'
																order by tgl_jatuh_tempo asc LIMIT $offset, $limit");
															 }
														
													}	
												}
									
										while($row=mysql_fetch_array($qry)){
											
											$tglnya=date("Ymd",strtotime($row['tgl_jatuh_tempo']));
											$skrg=date("Ymd");
											$bg=$tglnya-$skrg;
											$jumlah_bayar=mysql_fetch_array(mysql_query("select sum(jumlah_bayar) as jumlah_bayar from bayar_hutang where kode_hutang='".$row['kode_hutang']."'"));
											$sisa=$row['total_hutang']-$jumlah_bayar['jumlah_bayar'];
										?>
                                                <tr  bgcolor="<?php
 if($bg==3 and $sisa > 0){  
  	echo "#a0c8f7";}
  	elseif($bg==2 and $sisa > 0){
	echo "#FCFFB9";}
	elseif($bg==1 and $sisa > 0){
  	echo "#A8F09F";}
	elseif($bg<=0 and $sisa > 0){
  	echo "#FFCECF";} ?>" class="<?php
	

		if($bg==3 and $sisa > 0){  
  		echo "tiga";}
  		elseif($bg==2 and $sisa > 0){
		echo "dua";}
		elseif($bg==1 and $sisa > 0){
  		echo "satu";}
		
			elseif($bg<=0 and $sisa > 0){
			
				echo " ";
		}

		
		?>" >
             
                <td class="text-left"><?php echo $row['0'] ?>
                
                </td>
                  <td class="text-left"><b><?php echo date("d-m-Y",strtotime($row['tgl_transaksi'])) ?> 
                  
                  </td>
                  <td class="text-left"><?php echo $row['kategori_hutang'] ?>
                
                </td>
               
               <td class="text-left" align="right"><?php echo ($row['nama']); ?></td>
              
                 <td class="text-left" align="right"> <?php	if($row['1']=="1" ) { ?>
                 		 <a onclick="window.open('?page=detail.pembelian&no_beli=<?php echo $row['keterangan'] ?>','mywindow','scrollbars=1,width=800,height=500')" style="cursor:pointer;font-weight: bold"><?php echo ($row['keterangan']); ?></a>
                  <?php }else{ ?>
                  		<?php echo ($row['keterangan']); ?>
                  <?php } ?></td>
                   <td class="text-left"><b><?php echo date("d-m-Y",strtotime($row['tgl_jatuh_tempo'])) ?> 
                  
                  </td>
                  
                  <td class="text-right">Rp. <?php echo number_format($row['total_hutang'])?></td> 
       <td class="text-right"><a href="javascript:TampilTabel('list_pembayaran_hutang.php?id=<?php echo ($row[0]); ?>')" >Rp. <?php 
							
							
							echo number_format($jumlah_bayar['jumlah_bayar'])?></a></td>
                 
                  <td class="text-right">Rp. <?php echo number_format($row['total_hutang']-$jumlah_bayar['jumlah_bayar'])?></td> 
                  <td class="text-right">
                
                <?php 
if($_SESSION["loglevel"]=="Administrator" or $_SESSION["loglevel"]=="Admin"){ ?>
                 
           
                    <?php if($row['total_hutang'] > $jumlah_bayar['jumlah_bayar']){ ?>
                 <a href="?page=bayar.hutang&id=<?php echo $row['0'] ?>" data-toggle="tooltip" title="" class="btn btn-default btn-xs" data-original-title="Bayar"><i class="fa fa fa-money"></i> Bayar</a><?php } /* ?>
               
                  <a href="?page=edit.cash.in&id=<?php echo $row['kode_pemasukan'] ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                   <?php if($_SESSION["loglevel"]=="Administrator") { ?>
                  <a  href="hapus.hutang.php?id=<?php echo $row['kd_piutang'] ?>" class="btn btn-danger hapus" ><i class="fa fa-trash-o"></i></a>	
                  
                  <?php }*/ } ?>
                    <a  href="hapus.hutang.php?id=<?php echo $row['0'] ?>" class="btn btn-danger hapus" ><i class="fa fa-trash-o"></i></a>	       <a href="lunas.hutang.php?id=<?php echo $row['kode_hutang'] ?>" data-toggle="tooltip" title="" class="btn btn-success btn-xs" data-original-title="Lunas"><i class="fa fa fa-check"></i> Lunas</a>
                  </td>
                </tr><?PHP } ?>
                   <?php if($_SESSION['loglevel']=="Administrator"){ ?> 
                   <tr style="font-weight:bold">
                   		<td colspan="1">Grandtotal </td>
                        <td></td>
                         <td></td> <td></td>
                <td></td>
                        
                         <td></td>
                       
                           <td align="right"><?php 
							
								if(!empty($_POST['filter_dari']) and !empty($_POST['filter_sampai'])){
										 if(!empty($filter_kategori)){
														$num=(mysql_fetch_array(mysql_query("select sum(total_hutang) as subtotal from hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and kode_kategori_hutang='".@$filter_kategori."' and    tgl_jatuh_tempo between '".$filter_dari."' and '".$filter_sampai."' and nama like '%".@$filter_nama."%' and status = '".$filter_status."'")));
										 }else{
											 	if(!empty($filter_kategori_pusat)){
											 			$num=(mysql_fetch_array(mysql_query("select sum(total_hutang) as subtotal from hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and kode_klasifikasi='".@$filter_kategori_pusat."' and    tgl_jatuh_tempo between '".$filter_dari."' and '".$filter_sampai."' and nama like '%".@$filter_nama."%' and status = '".$filter_status."'")));
												 }else{
														$num=(mysql_fetch_array(mysql_query("select sum(total_hutang) as subtotal from hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang  and    tgl_jatuh_tempo between '".$filter_dari."' and '".$filter_sampai."' and nama like '%".@$filter_nama."%' and status = '".$filter_status."'")));
												}		
										}
								 }else{
														if(!empty($filter_kategori)){
														$num=(mysql_fetch_array(mysql_query("select sum(total_hutang) as subtotal from hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and kode_kategori_hutang='".@$filter_kategori."' and nama like '%".@$filter_nama."%' and status = '".$filter_status."'")));
														 }else{
																if(!empty($filter_kategori_pusat)){
																		$num=(mysql_fetch_array(mysql_query("select sum(total_hutang) as subtotal from hutang,kategori_hutang where 
																		tipe=kategori_hutang.kode_kategori_hutang and kode_klasifikasi='".@$filter_kategori_pusat."'  and nama like '%".@$filter_nama."%' and status = '".$filter_status."'")));
																 }else{
																		$num=(mysql_fetch_array(mysql_query("select sum(total_hutang) as subtotal from hutang,kategori_hutang where 
																		tipe=kategori_hutang.kode_kategori_hutang   and nama like '%".@$filter_nama."%' and status = '".$filter_status."'")));
																}		
														}
							   }
						
	
						echo number_format($num['subtotal']);?></td>
                             <td align="right"><?php 
							  						if(!empty($filter_kategori)){
											
											
																$num_byr=(mysql_fetch_array(mysql_query("select sum(jumlah_bayar) as jumlah_bayar from bayar_hutang,hutang,kategori_hutang where 
																			tipe=kategori_hutang.kode_kategori_hutang and kode_kategori_hutang='".@$filter_kategori."' and bayar_hutang.kode_hutang=hutang.kode_hutang  and nama like '%".@$filter_nama."%' and status = '".$filter_status."'")));  
														
													}else{
														if(!empty($filter_kategori_pusat)){
																		$num_byr=(mysql_fetch_array(mysql_query("select sum(jumlah_bayar) as jumlah_bayar from bayar_hutang,hutang,kategori_hutang where 
																			tipe=kategori_hutang.kode_kategori_hutang and kode_klasifikasi='".@$filter_kategori_pusat."' and bayar_hutang.kode_hutang=hutang.kode_hutang  and nama like '%".@$filter_nama."%' and status = '".$filter_status."'")));  
																 }else{
																		$num_byr=(mysql_fetch_array(mysql_query("select sum(jumlah_bayar) as jumlah_bayar from bayar_hutang,hutang,kategori_hutang where 
																			tipe=kategori_hutang.kode_kategori_hutang and bayar_hutang.kode_hutang=hutang.kode_hutang  and nama like '%".@$filter_nama."%' and status = '".$filter_status."'")));  
																}	
													}
						echo number_format($num_byr['jumlah_bayar']);?></td>   <td class="text-right">Rp. <?php echo number_format($num['subtotal']-$num_byr['jumlah_bayar'])?></td> <td></td> 
                        
                            
                   </tr>  <?php } ?>
              </tbody>
            </table><?php } ?>
          </div>
        </form>
        <div class="row" style="padding-right:5px;padding-left:5px">
         <div class="box-footer clearfix">
								<?php 
			 					
									if(!empty($filter_dari) and !empty($filter_sampai)){	
							
										
										
										 if(!empty($filter_kategori)){
														$query  = "SELECT COUNT(total_hutang) AS jumData FROM hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and kode_kategori_hutang='".@$filter_kategori."' and  nama like '%".@$filter_nama."%' and tgl_tempo between '".$filter_dari."' and '".$filter_sampai."' and status = '".$filter_status."'";
										 }else{
											 	if(!empty($filter_kategori_pusat)){
											 			$query  = "SELECT COUNT(total_hutang) AS jumData FROM hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and kode_klasifikasi='".@$filter_kategori_pusat."' and  nama like '%".@$filter_nama."%' and tgl_tempo between '".$filter_dari."' and '".$filter_sampai."' and status = '".$filter_status."'";
												 }else{
														$query  = "SELECT COUNT(total_hutang) AS jumData FROM hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and   nama like '%".@$filter_nama."%' and tgl_tempo between '".$filter_dari."' and '".$filter_sampai."' and status = '".$filter_status."'";
												}		
										}
										
										
									}else{
									 if(!empty($filter_kategori)){
														$query  = "SELECT COUNT(total_hutang) AS jumData FROM hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and kode_kategori_hutang='".@$filter_kategori."' and  nama like '%".@$filter_nama."%'  and status = '".$filter_status."'";
										 }else{
											 	if(!empty($filter_kategori_pusat)){
											 			$query  = "SELECT COUNT(total_hutang) AS jumData FROM hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and kode_klasifikasi='".@$filter_kategori_pusat."' and  nama like '%".@$filter_nama."%'  and status = '".$filter_status."'";
												 }else{
														$query  = "SELECT COUNT(total_hutang) AS jumData FROM hutang,kategori_hutang where 
														tipe=kategori_hutang.kode_kategori_hutang and   nama like '%".@$filter_nama."%'  and status = '".$filter_status."'";
												}		
										}
									}
								
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
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=".$_GET['page']."&filter_dari=".@$filter_dari."&filter_sampai=".@$filter_sampai."&filter_uraian=".@$filter_uraian."&filter_status=".@$filter_status."&hal=".$i."'>".$i."</a></li>";
										 }
								}
								?>
                                </ul>
								<label style="float:right;margin-top:5px;">
									Page :&nbsp;&nbsp;
								</label>
                                </div>
        </div>
      </div>
    </div>
  </div><style>

@-webkit-keyframes color_change {
		  from { background-color: white; }
		  to { background-color: #ff5454; }
		}
		@-moz-keyframes color_change {
		  from { background-color: white; }
		  to { background-color: #ff5454; }
		}
		@-ms-keyframes color_change {
		  from { background-color: white; }
		  to { background-color: #ff5454; }
		}
		@-o-keyframes color_change {
		  from { background-color: white; }
		  to { background-color: #ff5454; }
		}
		@keyframes color_change {
		  from { background-color: white; }
		  to { background-color: #ff5454; }
		}
.warna{
	
		
		   -webkit-animation: color_change 1s infinite alternate;
		   -moz-animation: color_change 1s infinite alternate;  
		   -ms-animation: color_change 1s infinite alternate;  
		   -o-animation: color_change 1s infinite alternate;  
		   animation: color_change 1s infinite alternate;   
  	
	}
	
.tiga{ 
background-color:#a0c8f7;
		}
.dua{
	background-color:#FCFFB9;}
.satu{
	background-color:#A8F09F;}

	
</style>
  <script>
$( ".hapus" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin ?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script> <script src="js/kategorihutang.js" type="text/javascript"></script> 
