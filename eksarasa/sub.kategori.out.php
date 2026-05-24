<?php

?>
<script language="javascript">
   function setBrg(vkd){
     window.opener.document.getElementById('satuan').value = vkd;
     window.self.close();
   }
</script>

<section class="content-header">
	<h1>
		Sub Kategori Cash Out</h1>
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
								<form action="simpan.sub.kategori.out.php" method="post" enctype="multipart/form-data">
								<div class="box-body">		
								
									
                                      <div class="form-group" id="status">
										<label>Kategori<b style="color:red;">*</b></label>	
                                        <select name="kategori" class="form-control">
                                        <?php $qry=mysql_query("select * from kategori_uang_keluar order by nomor_akun");while($row=mysql_fetch_array($qry)){?>
										   	<option value="<?php echo $row['0'] ?>" <?php if($data['kode_kategori_uang_keluar']==$row['0']) echo "selected" ?>><?php echo $row['nomor_akun'] ?> - <?php echo $row['1'] ?></option>
                                            <?php } ?>
                                        </select>
									</div>
                                    <div class="form-group" id="status">
										<label>Sub Kategori<b style="color:red;">*</b></label>	
										    <input type="text" class="form-control" name="sub_kategori"  required="required"  value="<?php echo $data['sub_kategori_uang_keluar'] ?>"/>
									</div>
                                     <div class="form-group" id="status">
										<label>Nomor<b style="color:red;">*</b></label>	
                                      
										    <input type="text" class="form-control" name="nomor"   value="<?php echo $data['nomor_akun_sub'] ?>"/>
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
									
                                        <form action="?page=sub.kategori" method="post">
										<div class="input-group">
                                            <input type="text" name="cari" class="form-control input-sm pull-right" style="width: 20%;" placeholder="Search" value="<?php echo @$_POST['cari']?>"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
										</form>
                                        <table class="table table-hover table-bordered" style="margin-top:10px;">
                                          <tr>
                                            <th colspan="2" style="text-align:center;">Nomor Akun</th>
                                            <th width="50%" style="text-align:center;">Akun Nominal</th>
                                            <th width="100%" style="text-align:center;">Kelompok</th>
                                            <th width="100%" style="text-align:center;">Aksi</th>
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
										$qry=mysql_query("select * from kategori_uang_keluar,kategori where kategori_uang_keluar.kode_klasifikasi=kategori.kode and  kategori_uang_keluar like '%".@$_POST['cari']."%' order by nomor_akun  asc LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                          <tr  onclick="javascript:setBrg('<?php echo $row['1'] ?>')">
                                            <td width="10" align="center"><?php echo $row['kode'] ?></td>
                                            <td width="50%" style="text-align:center;"><?php echo $row['nomor_akun'] ?></td>
                                            <td style="text-align:left;"><?php echo $row['1'] ?></td>
                                            <td style="text-align:center;"><?php echo $row['klasifikasi'] ?></td>
                                            <td style="text-align:center;white-space: nowrap"></td>
                                          </tr>
                                          <?php
											$qry_sub=mysql_query("select * from sub_kategori_uang_keluar,kategori_uang_keluar where sub_kategori_uang_keluar.kode_kategori_uang_keluar=kategori_uang_keluar.kode_kategori_uang_keluar and kategori_uang_keluar.kode_kategori_uang_keluar='".$row[0]."' and  sub_kategori_uang_keluar like '%".@$_POST['cari']."%' order by nomor_akun_sub  ");
										while($row_sub=mysql_fetch_array($qry_sub)){
										?>
                                          <tr  onclick="javascript:setBrg('<?php echo $row_sub['1'] ?>')">
                                            <td align="center"></td>
                                            <td style="text-align:right;"><?php echo $row_sub['nomor_akun_sub'] ?></td>
                                            <td style="text-align:left;"><span style="padding-left: 50px"><?php echo $row_sub['sub_kategori_uang_keluar'] ?></span></td>
                                            <td style="text-align:center;"><?php echo $row['klasifikasi'] ?></td>
                                            <td style="text-align:center;"><a href="?page=edit.sub.kategori.out&id=<?php echo $row_sub['kode_sub_kategori_uang_keluar']?>" ><span class="fa fa-edit"></span></a></td>
                                          </tr>
                                          <?php
										$i++;
										}
										?>
                                          <?php
										$i++;
										}
										?>
                                        </table>
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
									$query  = "SELECT COUNT(sub_kategori_uang_keluar) AS jumData from sub_kategori_uang_keluar where sub_kategori_uang_keluar like '%".@$_POST['cari']."%'";
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
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=sub.kategori.out&hal=".$i."'>".$i."</a></li>";
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
  <script>
$( ".hapus" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin ?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script>