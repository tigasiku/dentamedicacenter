<?php include "checker.php"; ?>

  <section class="content-header">
<?php if($_SESSION["loglevel_graha3"]=="Administrator" or $_SESSION["loglevel"]=="Admin"){ ?>	 <div class="pull-right" style="padding-right:5px">	<a href="?page=tambah.cash.out" class="btn btn-danger btn-flat" style="float:left;"><i class="fa fa-plus"></i> Tambah</a>
        
      </div><?php } ?>
	<h1>
		Cash Out<small></small>
    </h1>
</section>
 <?php 
 if(isset($_GET['pesan']))
 {
 ?> 


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
          <div class="row" >
            <div class="col-sm-4 col-xs-6">
            
              <div class="form-group">
                <label class="control-label" for="input-name">No Ref</label>
                <input type="text" name="filter_id" value="<?php echo @$_POST['filter_id'] ?>" placeholder="Order Id" id="input-name" class="form-control" autocomplete="off">
              </div>
              <div class="form-group">
                <label class="control-label" for="input-model">Vendor</label>
                <input type="text" name="filter_customer" value="<?php echo @$_POST['filter_customer'] ?>" placeholder="Vendor" id="input-model" class="form-control" autocomplete="off">
              </div>
                <div class="form-group">
                <label class="control-label" for="input-name">Uraian</label>
                <input type="text" name="filter_uraian" value="<?php echo @$filter_uraian ?>" placeholder="Uraian" id="input-name" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
              </div>
            </div>
            <div class="col-sm-4 col-xs-6">
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
            <div class="col-sm-4 col-xs-12">
            <div class="form-group">
                <label class="control-label" for="input-model">Kategori</label>
                                
                                   	  <select name="filter_kategoripusat" class="form-control" id="cmbKategoriPusat">
              			    <option value="">Pilih</option>
              			<?php
						
															$qry_kategorypus=mysql_query("select *  from kategori where kode >=5");	
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
						
															$qry_kategory=mysql_query("select *  from kategori_uang_keluar where kode_klasifikasi ='".$filter_kategori_pusat."' order by nomor_akun"); 
							while($kategori=mysql_fetch_array($qry_kategory)){
						?>
              			<option value="<?php echo $kategori['kode_kategori_uang_keluar'] ?>" <?php if($kategori['kode_kategori_uang_keluar']==@$filter_kategori) echo "selected" ?>><?php echo $kategori['nomor_akun'] ?> - <?php echo $kategori['kategori_uang_keluar'] ?></option><?php } }?>
              	</select>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-model">Sub Kategori</label>
              	<select name="filter_sub_kategori" class="form-control" id="subKategori">
              				<option value="">Semua</option>
              				<?php
							if(!empty($filter_kategori)){
												
															$qry_kategory=mysql_query("select *  from sub_kategori_uang_keluar where kode_kategori_uang_keluar ='".$filter_kategori."' order by nomor_akun_sub"); 
													
							while($kategori=mysql_fetch_array($qry_kategory)){
						?>
              			<option value="<?php echo $kategori['kode_sub_kategori_uang_keluar'] ?>" <?php if($kategori['kode_sub_kategori_uang_keluar']==@$filter_sub_kategori) echo "selected" ?>><?php echo $kategori['nomor_akun_sub'] ?> - <?php echo $kategori['sub_kategori_uang_keluar'] ?></option><?php } } ?>
              	</select>
              </div>
             
              <button type="submit" id="button-filter" class="btn btn-primary pull-right"  name="submit"><i class="fa fa-search"></i> Filter</button>
            </div>
          </div>
        </div>
         </form>
        <form action="http://localhost/opencart/upload/admin/index.php?route=catalog/product/delete&amp;token=TvthUB0fpnYKRqAYZYgsYn3RFzeFJBMC" method="post" enctype="multipart/form-data" id="form-product">
          <?php  if(isMobile()){ ?>
     
            <table class="table table-bordered table-hover" style="font-size: 12px !important">
              <thead>
                <tr>
                  <th class="text-left"> Keterangan</th>
               
                  <th class="text-right"> Total </th>
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
					   
					   					
										
											/*
											if(!empty($filter_sampai) and !empty($filter_dari)){
												if(!empty($filter_kategori)){
													if(!empty($filter_sub_kategori)){
														$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar where pengeluaran.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and akses='Admin' and 
														tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%' and pengeluaran.kode_kategori_uang_keluar = '".@$filter_kategori."'  and pengeluaran.kode_sub_kategori_uang_keluar = '".@$filter_sub_kategori."'  and nama_vendor like '%".@$filter_customer."%'
														order by tanggal desc,kode_pengeluaran desc LIMIT $offset, $limit");
													}else{
														$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar where pengeluaran.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and akses='Admin' and
														tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%' and pengeluaran.kode_kategori_uang_keluar = '".@$filter_kategori."' and nama_vendor like '%".@$filter_customer."%'
														order by tanggal desc,kode_pengeluaran desc desc LIMIT $offset, $limit");
													}
												}else{
													$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar where pengeluaran.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and akses='Admin' and 
													tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%' and nama_vendor like '%".@$filter_customer."%'
													order by tanggal desc,kode_pengeluaran desc LIMIT $offset, $limit");
												}
											 }else{
													if(!empty($filter_kategori)){
														if(!empty($filter_sub_kategori)){
															$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar where pengeluaran.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and akses='Admin' and  kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%' and pengeluaran.kode_kategori_uang_keluar = '".@$filter_kategori."'  and pengeluaran.kode_sub_kategori_uang_keluar = '".@$filter_sub_kategori."' and nama_vendor like '%".@$filter_customer."%'  order by tanggal desc,kode_pengeluaran desc LIMIT $offset, $limit");
														}else{
															$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar where pengeluaran.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and akses='Admin' and  kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%' and pengeluaran.kode_kategori_uang_keluar = '".@$filter_kategori."'  and nama_vendor like '%".@$filter_customer."%' order by tanggal desc,kode_pengeluaran desc desc LIMIT $offset, $limit");
														}
													}else{
														$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar where pengeluaran.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and akses='Admin' and kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%'  and nama_vendor like '%".@$filter_customer."%' order by tanggal desc,kode_pengeluaran desc LIMIT $offset, $limit");
													}
											}
										
										}else{
											
											if(!empty($filter_sampai) and !empty($filter_dari)){
												if(!empty($filter_kategori)){
													if(!empty($filter_sub_kategori)){
														$qry=mysql_query("select * from pengeluaran where 
														tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%' and kode_kategori_uang_keluar = '".@$filter_kategori."'  and kode_sub_kategori_uang_keluar = '".@$filter_sub_kategori."' and nama_vendor like '%".@$filter_customer."%'
														order by tanggal desc,kode_pengeluaran desc LIMIT $offset, $limit");
													}else{
														$qry=mysql_query("select * from pengeluaran where 
														tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%' and kode_kategori_uang_keluar = '".@$filter_kategori."' and nama_vendor like '%".@$filter_customer."%'
														order by tanggal desc,kode_pengeluaran desc LIMIT $offset, $limit");
													}
												}else{
													$qry=mysql_query("select * from pengeluaran where 
													tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%' and nama_vendor like '%".@$filter_customer."%'
													order by tanggal desc,kode_pengeluaran desc LIMIT $offset, $limit");
												}
											 }else{
													if(!empty($filter_kategori)){
														if(!empty($filter_sub_kategori)){
															$qry=mysql_query("select * from pengeluaran where  kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%' and kode_kategori_uang_keluar = '".@$filter_kategori."'  and kode_sub_kategori_uang_keluar = '".@$filter_sub_kategori."'  and nama_vendor like '%".@$filter_customer."%'  order by tanggal desc,kode_pengeluaran desc LIMIT $offset, $limit");
														}else{
															$qry=mysql_query("select * from pengeluaran where  kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%' and kode_kategori_uang_keluar = '".@$filter_kategori."' and nama_vendor like '%".@$filter_customer."%'   order by tanggal desc,kode_pengeluaran desc LIMIT $offset, $limit");
														}
													}else{
														$qry=mysql_query("select * from pengeluaran where  kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%' and nama_vendor like '%".@$filter_customer."%'   order by tanggal desc,kode_pengeluaran desc LIMIT $offset, $limit");
													}
											}
											
										}
										*/
	//BATAS
										if(!empty($filter_sampai) and !empty($filter_dari)){
												if(!empty($filter_kategori)){
													if(!empty($filter_sub_kategori)){
														$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and 
														tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$filter_id."%' and keterangan like  '%".@$filter_uraian."%' and kategori_uang_keluar.kode_kategori_uang_keluar = '".@$filter_kategori."'  and sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar = '".@$filter_sub_kategori."'  and nama_vendor like '%".@$filter_customer."%' 
														order by tanggal desc LIMIT $offset, $limit");
													}else{
														$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and 
														tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%' and sub_kategori_uang_keluar.kode_kategori_uang_keluar = '".@$filter_kategori."'  and nama_vendor like '%".@$filter_customer."%' 
														order by tanggal desc LIMIT $offset, $limit");
													}
												}else{
													 if(!empty($filter_kategori_pusat)){
																$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and kode_klasifikasi='".@$filter_kategori_pusat."' and  
													tanggal between '".$filter_dari."' and '".$filter_sampai."' and  kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%'  and nama_vendor like '%".@$filter_customer."%'  order by tanggal desc LIMIT $offset, $limit");
														 }else{
													$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and  
													tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%'  and nama_vendor like '%".@$filter_customer."%' 
													order by tanggal desc LIMIT $offset, $limit");}
												}
											 }else{
													
													if(!empty($filter_kategori)){
														if(!empty($filter_sub_kategori)){
															$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and   kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%' and sub_kategori_uang_keluar.kode_kategori_uang_keluar = '".@$filter_kategori."'  and sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar = '".@$filter_sub_kategori."'  and nama_vendor like '%".@$filter_customer."%'   order by tanggal desc LIMIT $offset, $limit");
														}else{
															$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and   kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%' and sub_kategori_uang_keluar.kode_kategori_uang_keluar = '".@$filter_kategori."'  and nama_vendor like '%".@$filter_customer."%'  order by tanggal desc LIMIT $offset, $limit");
														}
													}else{
													     if(!empty($filter_kategori_pusat)){
																$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and kode_klasifikasi='".@$filter_kategori_pusat."' and  kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%'  and nama_vendor like '%".@$filter_customer."%'  order by tanggal desc LIMIT $offset, $limit");
														 }else{
															 	$qry=mysql_query("select * from pengeluaran where  kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%'  and nama_vendor like '%".@$filter_customer."%'  order by tanggal desc LIMIT $offset, $limit");
														 }
													}
											}				
										 
					   					if(isset($_GET['tanggal'])){
											$qry=mysql_query("select * from pengeluaran where 	tanggal = '".$_GET['tanggal']."' ");
										}
					   
										while($row=mysql_fetch_array($qry)){
												$qry_kategory=mysql_fetch_array(mysql_query("select * from kategori_uang_keluar,sub_kategori_uang_keluar where
											kategori_uang_keluar.kode_kategori_uang_keluar=sub_kategori_uang_keluar.kode_kategori_uang_keluar and
											kode_sub_kategori_uang_keluar='".$row['kode_sub_kategori_uang_keluar']."'"));
		
											$kategori=$qry_kategory['kategori_uang_keluar'];
											$subkategori=$qry_kategory['sub_kategori_uang_keluar'];
												if($kategori=="Pembelian"){
														 	$row2=mysql_fetch_array(mysql_query("select kd_bank from arus_kas where kode='".$row['keterangan']."'"));}else{$row2=mysql_fetch_array(mysql_query("select kd_bank from arus_kas where kode='$row[0]'"));}
														 
												$qrybank=mysql_query("select * from bank_perusahaan where kd_bank='".$row2[0]."'");
												$bank=mysql_fetch_array($qrybank);
										?>
                <tr>
                     <td class="text-left" style="white-space: nowrap;border:0px !important;padding: 0px !important;padding-left: 4px !important"><b><?php echo $row[0]?><b> - <?php echo date("d-m-Y",strtotime($row['tanggal'])) ?></td>
                
                  <td rowspan="4" class="text-right">Rp. <?php echo number_format($row['jumlah'])?><br><br><b><?php echo $bank[1] ?> <?php if(!empty($bank[2])) echo " - ".$bank[2] ?> <?php if(!empty($bank[3])) echo " - ".$bank[3] ?></b></td>
                  <td rowspan="4" class="text-right"><?php 
if($_SESSION["loglevel"]=="Administrator" or $_SESSION["loglevel"]=="Admin"){ ?>
                  
                    
                        <div class="text-center"><div class="btn-group text-left"><a type="button" class="dropdown-toggle" data-toggle="dropdown"><img src="img/9bf4705c9e.svg" alt="Action" height="18px"></a>
            <ul class="dropdown-menu pull-right" role="menu">
          
          
         
             
                 
                 <li><a href="?page=edit.cash.out&id=<?php echo $row['kode_pengeluaran'] ?>" class="sledit"><i class="fa fa-pencil"></i> Edit </a></li>
                 <li><a href="hapus.cash.out.php?id=<?php echo $row['kode_pengeluaran'] ?>" class="sledit hapus"><i class="fa fa-trash-o"></i> Delete </a></li>
                  
            </ul>
        </div></div>
                    
                    
                    <?php } ?></td>
                </tr>
                <tr>
                  <td class="text-left" style="white-space: nowrap;border:0px !important;padding: 0px !important;padding-left: 4px !important">-
                    <?php
										
											echo ($kategori); ?>
                    <br>
-- <?php echo ($subkategori); ?></td>
                </tr>
                <tr>
                  <td class="text-left" style="white-space: nowrap;border:0px !important;padding: 0px !important;padding-left: 4px !important"><b><?php if(!empty($row['nama_vendor'])) { echo "".($row['nama_vendor']);} ?></b></td>
                </tr>
                <tr>
                  <td class="text-left" style="border-top:0px !important;padding: 0px !important;padding-left: 4px !important">"<?php echo ($row['keterangan']); ?>"</td>
                </tr>
                <?PHP } ?>
                <?php if($_SESSION['loglevel']=="Administrator" or $_SESSION["loglevel"]=="Admin"){ ?>
                <tr style="font-weight:bold">
                  <td>Grandtotal </td>
               
                  <td align="right"><?php 
							   if(!empty($filter_dari) and !empty($filter_sampai)){	
									   if(!empty($filter_kategori)){
										   		if(!empty($filter_sub_kategori)){
													$num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran where tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%' and kode_kategori_uang_keluar = '".@$filter_kategori."' and kode_sub_kategori_uang_keluar = '".@$filter_sub_kategori."' and nama_vendor like '%".@$filter_customer."%' ")));
												}else{
													$num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran where tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%' and kode_kategori_uang_keluar = '".@$filter_kategori."' and nama_vendor like '%".@$filter_customer."%'")));
												}
									   }else{
										   
												$num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran where tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%' and nama_vendor like '%".@$filter_customer."%'")));
									   }
								   }else{
								   		if(!empty($filter_kategori)){
											if(!empty($filter_sub_kategori)){
											 	$num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran where kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%' and kode_kategori_uang_keluar = '".@$filter_kategori."' and kode_sub_kategori_uang_keluar = '".@$filter_sub_kategori."' and nama_vendor like '%".@$filter_customer."%'")));  
											}else{
												$num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran where kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%' and kode_kategori_uang_keluar = '".@$filter_kategori."' and nama_vendor like '%".@$filter_customer."%'")));  
											}
										}else{
											$num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran where kode_pengeluaran like '%".@$_POST['filter_id']."%' and keterangan like '%".@$filter_uraian."%'  and nama_vendor like '%".@$filter_customer."%'")));  
										}
							   }
	
	
						if(isset($_GET['tanggal'])){

											$num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran where tanggal = '".$_GET['tanggal']."'"))); 
										}
						echo number_format($num['subtotal']);?></td>
                  <td></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
         
          <?php }else{ ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                 
                     <th class="text-left">       No Ref
                    </th>
                    <th class="text-left">         Tanggal
                    </th>
                     
                       <th class="text-left">Kategori</th>
                    
          
                
                 
                   
                     <th class="text-left">            Uraian
                    </th>
                     <th class="text-left">           Total
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
													if(!empty($filter_sub_kategori)){
														$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and 
														tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$filter_id."%' and keterangan like  '%".@$filter_uraian."%' and kategori_uang_keluar.kode_kategori_uang_keluar = '".@$filter_kategori."'  and sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar = '".@$filter_sub_kategori."'  and nama_vendor like '%".@$filter_customer."%' 
														order by tanggal desc LIMIT $offset, $limit");
													}else{
														$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and 
														tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%' and sub_kategori_uang_keluar.kode_kategori_uang_keluar = '".@$filter_kategori."'  and nama_vendor like '%".@$filter_customer."%' 
														order by tanggal desc LIMIT $offset, $limit");
													}
												}else{
													 if(!empty($filter_kategori_pusat)){
																$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and kode_klasifikasi='".@$filter_kategori_pusat."' and  
													tanggal between '".$filter_dari."' and '".$filter_sampai."' and  kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%'  and nama_vendor like '%".@$filter_customer."%'  order by tanggal desc LIMIT $offset, $limit");
														 }else{
													$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and  
													tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%'  and nama_vendor like '%".@$filter_customer."%' 
													order by tanggal desc LIMIT $offset, $limit");}
												}
											 }else{
													
													if(!empty($filter_kategori)){
														if(!empty($filter_sub_kategori)){
															$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and   kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%' and sub_kategori_uang_keluar.kode_kategori_uang_keluar = '".@$filter_kategori."'  and sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar = '".@$filter_sub_kategori."'  and nama_vendor like '%".@$filter_customer."%'   order by tanggal desc LIMIT $offset, $limit");
														}else{
															$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and   kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%' and sub_kategori_uang_keluar.kode_kategori_uang_keluar = '".@$filter_kategori."'  and nama_vendor like '%".@$filter_customer."%'  order by tanggal desc LIMIT $offset, $limit");
														}
													}else{
													     if(!empty($filter_kategori_pusat)){
																$qry=mysql_query("select * from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and kode_klasifikasi='".@$filter_kategori_pusat."' and  kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%'  and nama_vendor like '%".@$filter_customer."%'  order by tanggal desc LIMIT $offset, $limit");
														 }else{
															 	$qry=mysql_query("select * from pengeluaran where  kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%'  and nama_vendor like '%".@$filter_customer."%'  order by tanggal desc LIMIT $offset, $limit");
														 }
													}
											}		
										 
					   					if(isset($_GET['tanggal'])){
											$qry=mysql_query("select * from pengeluaran where 	tanggal = '".$_GET['tanggal']."' ");
										}
					   
										while($row=mysql_fetch_array($qry)){
										?>
                                                <tr>
             
                   <td class="text-left"><?php echo $row[0]?><br>
                    
                  <b> <?php 
											$qry_kategory=mysql_fetch_array(mysql_query("select * from kategori_uang_keluar,sub_kategori_uang_keluar where
											kategori_uang_keluar.kode_kategori_uang_keluar=sub_kategori_uang_keluar.kode_kategori_uang_keluar and
											kode_sub_kategori_uang_keluar='".$row['kode_sub_kategori_uang_keluar']."'"));
		
											$kategori=$qry_kategory['kategori_uang_keluar'];
											$subkategori=$qry_kategory['sub_kategori_uang_keluar'];
		
										
											
											if($kategori=="Pembelian"){
														 	$row2=mysql_fetch_array(mysql_query("select kd_bank from arus_kas where kode='".$row['keterangan']."'"));}else{$row2=mysql_fetch_array(mysql_query("select kd_bank from arus_kas where kode='$row[0]'"));}
														 
												$qrybank=mysql_query("select * from bank_perusahaan where kd_bank='".$row2[0]."'");
												$bank=mysql_fetch_array($qrybank);
										?><?php echo $bank[1] ?> <?php if(!empty($bank[2])) echo " <br>".$bank[2] ?> <?php if(!empty($bank[3])) echo " <br> ".$bank[3] ?></b> </td>
                 <td class="text-left"><b><?php echo date("d-m-Y",strtotime($row['tanggal'])) ?></b> </td>
                
                              <td class="text-left" align="right">- <?php
											
											echo ($kategori); ?><br>
                 							-- <?php echo ($subkategori); ?>
                 							<?php if(!empty($row['nama_vendor'])) { echo "<br>--- ".($row['nama_vendor']);} ?>
                 							</td>
                  
                  
                       <td class="text-left" align="right"><?php echo ($row['keterangan']); ?></td>
                  
              
                  
                  
                  <td class="text-right"><?php echo number_format($row['jumlah'])?></td> 
      
                  <td class="text-right">
                
                <?php 
if($_SESSION["loglevel"]=="Administrator" or $_SESSION["loglevel"]=="Admin"){ ?>
               
                  
                
               
                  <a href="?page=edit.cash.out&id=<?php echo $row['kode_pengeluaran'] ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                
                  <a  href="hapus.cash.out.php?id=<?php echo $row['kode_pengeluaran'] ?>" class="btn btn-danger hapus" ><i class="fa fa-trash-o"></i></a>	
                  
                  <?php } ?>
                  </td>
                </tr><?PHP } ?>
                <?php if($_SESSION['loglevel']=="Administrator"or $_SESSION["loglevel"]=="Admin"){ ?>
                   <tr style="font-weight:bold">
                   		<td colspan="2">Grandtotal </td>
                        <td></td>
                        
                     <td>
                      	
                     </td>
                        
                           <td align="right"><?php 
							   if(!empty($filter_dari) and !empty($filter_sampai)){	
									   if(!empty($filter_kategori)){
										   		if(!empty($filter_sub_kategori)){
													$num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%' and sub_kategori_uang_keluar.kode_kategori_uang_keluar = '".@$filter_kategori."' and sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar = '".@$filter_sub_kategori."'  and nama_vendor like '%".@$filter_customer."%' ")));
												}else{
													$num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and tanggal between '".$filter_dari."' and '".$filter_sampai."' and tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%' and sub_kategori_uang_keluar.kode_kategori_uang_keluar = '".@$filter_kategori."'  and nama_vendor like '%".@$filter_customer."%' ")));
												}
									   }else{
										    if(!empty($filter_kategori_pusat)){
													 $num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
													 sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and kode_klasifikasi='".@$filter_kategori_pusat."' and tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%'   and nama_vendor like '%".@$filter_customer."%' ")));
												 
														 }else{
												$num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran where tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%'  and nama_vendor like '%".@$filter_customer."%' ")));}
									   }
								   }else{
								   		if(!empty($filter_kategori)){
											if(!empty($filter_sub_kategori)){
											 	$num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and  kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%' and sub_kategori_uang_keluar.kode_kategori_uang_keluar = '".@$filter_kategori."' and sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar = '".@$filter_sub_kategori."'  and nama_vendor like '%".@$filter_customer."%' ")));  
											}else{
												$num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%' and sub_kategori_uang_keluar.kode_kategori_uang_keluar = '".@$filter_kategori."'  and nama_vendor like '%".@$filter_customer."%' ")));  
											}
										}else{
											 if(!empty($filter_kategori_pusat)){
													 $num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
													 sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and kode_klasifikasi='".@$filter_kategori_pusat."' and kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%'   and nama_vendor like '%".@$filter_customer."%' ")));
												 
														 }else{
											$num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran where kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%'   and nama_vendor like '%".@$filter_customer."%' ")));  }
										}
							   }
	
	
						if(isset($_GET['tanggal'])){

											$num=(mysql_fetch_array(mysql_query("select sum(jumlah) as subtotal from pengeluaran where tanggal = '".$_GET['tanggal']."'"))); 
										}
						echo number_format($num['subtotal']);?></td>
                           <td></td> 
                        
                            
                   </tr>  <?php } ?>
                                              </tbody>
            </table>
          </div> <?php } ?>
        </form>
         <?php if(!isset($_GET['tanggal'])){ ?>
        <div class="row" style="padding-right:5px;padding-left:5px">
         <div class="box-footer clearfix">
								<?php 
									
			 				if(!empty($filter_dari) and !empty($filter_sampai)){	
										if(!empty($filter_kategori)){
											if(!empty($filter_sub_kategori)){
												$query  = "SELECT COUNT(kode_pengeluaran) AS jumData FROM pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and  tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%' and sub_kategori_uang_keluar.kode_kategori_uang_keluar = '".@$filter_kategori."' and sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar = '".@$filter_sub_kategori."'  and nama_vendor like '%".@$filter_customer."%' ";
											}else{
												$query  = "SELECT COUNT(kode_pengeluaran) AS jumData FROM pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and  tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%' and sub_kategori_uang_keluar.kode_kategori_uang_keluar = '".@$filter_kategori."'  and nama_vendor like '%".@$filter_customer."%' ";
											}
										}else{
											if(!empty($filter_kategori_pusat)){
													  $query  = "SELECT COUNT(kode_pengeluaran) AS jumData FROM pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
													 sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and kode_klasifikasi='".@$filter_kategori_pusat."' and tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%'  and nama_vendor like '%".@$filter_customer."%' ";
												}else{
											$query  = "SELECT COUNT(kode_pengeluaran) AS jumData FROM pengeluaran where tanggal between '".$filter_dari."' and '".$filter_sampai."' and kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%'   and nama_vendor like '%".@$filter_customer."%' ";
											}
										}
									}else{
										if(!empty($filter_kategori)){
											if(!empty($filter_sub_kategori)){
												$query  = "SELECT COUNT(kode_pengeluaran) AS jumData FROM pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and  kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%' and sub_kategori_uang_keluar.kode_kategori_uang_keluar = '".@$filter_kategori."' and sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar = '".@$filter_sub_kategori."'  and nama_vendor like '%".@$filter_customer."%' ";
											}else{
												$query  = "SELECT COUNT(kode_pengeluaran) AS jumData FROM pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
														sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and   kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%' and sub_kategori_uang_keluar.kode_kategori_uang_keluar = '".@$filter_kategori."'  and nama_vendor like '%".@$filter_customer."%' ";
											}
										}else{
											 if(!empty($filter_kategori_pusat)){
													  $query  = "SELECT COUNT(kode_pengeluaran) AS jumData FROM pengeluaran,kategori_uang_keluar,sub_kategori_uang_keluar where sub_kategori_uang_keluar.kode_sub_kategori_uang_keluar=pengeluaran.kode_sub_kategori_uang_keluar and
													 sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and kode_klasifikasi='".@$filter_kategori_pusat."' and  kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%'  and nama_vendor like '%".@$filter_customer."%' ";
												}else{
											$query  = "SELECT COUNT(kode_pengeluaran) AS jumData FROM pengeluaran where  kode_pengeluaran like '%".@$filter_id."%' and keterangan like '%".@$filter_uraian."%'  and nama_vendor like '%".@$filter_customer."%' ";}
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
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=".$_GET['page']."&filter_dari=".@$filter_dari."&filter_sampai=".@$filter_sampai."&filter_uraian=".@$filter_uraian."&filter_kategori=".@$filter_kategori."&filter_sub_kategori=".@$filter_sub_kategori."&filter_proyek=".@$filter_proyek."&filter_customer=".@$filter_customer."&hal=".$i."'>".$i."</a></li>";
										 }
								}
								?>
                                </ul>
								<label style="float:right;margin-top:5px;">
									Page :&nbsp;&nbsp;
								</label>
                                </div>
        </div><?php } ?>
      </div>
    </div>
  </div>
  <script>
$( ".hapus" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin ?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script> <script src="js/kategorifilter.js" type="text/javascript"></script> 
