<script language="javascript">
   function setBrg(vkd){
     window.opener.document.getElementById('satuan').value = vkd;
     window.self.close();
   }
</script>

<section class="content-header">
	<h1>
		Kategori Cash Out</h1>
</section>

<section class="content">
  <div class="row">
  					<div class="col-sm-3">
							<div class="box box-solid box-primary">
								<div class="box-header">
									
								</div>  <?php 
									if(isset($_GET['pesan'])){?>  
                                  <div class="small-box bg-green">
                                <div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                                </div>
                              </div><?php }?>
								<form action="?page=simpan.kategori.out" method="post" enctype="multipart/form-data">
								<div class="box-body">		
								
									 <div class="form-group" id="status">
										<label>Kategori<b style="color:red;">*</b></label>	
										    <select name="kategoripusat" class="form-control" id="cmbKategoriPusat">
              			    <option value="">Pilih</option>
              			<?php
						
															$qry_kategory=mysql_query("select *  from kategori where kode >=5");	
							while($kategori=mysql_fetch_array($qry_kategory)){
						?>
              			<option value="<?php echo $kategori['kode'] ?>" <?php if(@$_GET['kat']==@$kategori['kode']) echo "selected" ?>><?php echo $kategori['kode'] ?> - <?php echo $kategori['klasifikasi'] ?></option><?php } ?>
              	</select>
									</div>
                                    <div class="form-group" id="status">
										<label>Kategori<b style="color:red;">*</b></label>	
										    <input type="text" class="form-control" name="kategori"  required="required"  />
									</div>
                                    <div class="form-group" id="status">
										<label>Nomor<b style="color:red;">*</b></label>	
                                      
										    <input type="text" class="form-control" name="nomor"  required="required"  value=""/>
									</div>
                                    <div class="form-group" id="status">
										<label>By. Penjualan<b style="color:red;">*</b></label>	
										      <select name="by_penjualan"   class="form-control"  required >
                                               
                                
                                    	<option value="Tidak">Tidak</option>
                                    	<option value="Ya">Ya</option>
									</select>
									</div>
                                    
<button "submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-save"></i> &nbsp;Simpan</button>
								</div>
								</form>
								<div class="clearfix"></div>
							</div>
						</div>
                        
                        <div class="col-sm-9">
                            <div class="box box-primary">
                                <div class="box-header">
                              
                            </div><!-- /.box-header -->
                                <div class="box-body" style="padding-top:0px;">
									
                                        <form action="?page=kategori.out" method="post">
										<div class="input-group">
                                            <input type="text" name="cari" class="form-control input-sm pull-right" style="width: 20%;" placeholder="Search" value="<?php echo @$_POST['cari']?>"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
										</form>
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th colspan="2"  style="text-align:center;">Nomor</th>
										  <th style="text-align:center;">Akun Nominal</th>
                                          <th  style="text-align:center;">Kelompok</th>
                                       <th  style="text-align:center;">aksi</th>
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
										$qry=mysql_query("select * from kategori_uang_keluar,kategori where kategori_uang_keluar.kode_klasifikasi=kategori.kode and kategori_uang_keluar like '%".@$_POST['cari']."%' order by kategori.kode,kategori_uang_keluar.nomor_akun  asc LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr  onclick="javascript:setBrg('<?php echo $row['1'] ?>')">
                                             <td align="center"><?php echo $row['kode'] ?></td>
                                                                       <td style="text-align:center;"><?php echo $row['3'] ?></td> 
											 <td style="text-align:center;"><?php echo $row['1'] ?></td>
                                            
                                                                           <td style="text-align:center;"><?php echo $row['klasifikasi'] ?></td> 
                                                           <td style="text-align:center;white-space: nowrap"> <?php ?><a href="?page=edit.kategori.out&id=<?php echo $row['0']?>" ><span class="fa fa-edit"></span></a>
                                             
                                              <a href="?page=hapus.kategori.out&id=<?php echo $row[0]?>" class="hapus"><span class="fa fa-trash-o"></span></a><?php  ?>
                                             </td>
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                    </table>
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
									$query  = "SELECT COUNT(kategori_uang_keluar) AS jumData from kategori_uang_keluar where kategori_uang_keluar like '%".@$_POST['cari']."%'";
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
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=kategori.out&hal=".$i."'>".$i."</a></li>";
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

?>