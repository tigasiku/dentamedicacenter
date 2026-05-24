<?php
include "koneksi.php";
koneksi_buka();
?>
<section class="content-header">
	<h1>
		Best Seller
        <small><?php echo $_SESSION['judul_graha'] ?></small>
    </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                   
                              </div><!-- /.box-header --> <?php 
									if(isset($_GET['pesan'])){?>  
                                  	<div class="small-box bg-<?php if($_GET['pesan']=="success"){ echo "green";}else{ echo "red";}?> ">
                                		<div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                             			</div>
                        			</div><?php }?>
                                <div class="box-body" style="padding-top:0px;">
									
                                        <form action="?page=product" method="post">
										<div class="input-group">
                                            <input type="text" name="cari" class="form-control input-sm pull-right" style="width: 20%;" placeholder="Search"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
										</form>
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                       <td class="text-center">Image</td>
                  <td class="text-left">                    <a href="?page=product&orderby=judul&urut=<?php if($urut=="asc") { echo "desc" ; } else { echo "asc";} ?>" class="asc">Product Name</a>
                    </td>
                      <td class="text-left">                    <a href="?page=product&orderby=kategori&urut=<?php if($urut=="asc") { echo "desc" ; } else { echo "asc";} ?>">Kategori</a>
                    </td>
                  <td class="text-left">                    <a href="?page=product&orderby=isbn&urut=<?php if($urut=="asc") { echo "desc" ; } else { echo "asc";} ?>">ISBN</a>
                    </td>
                    <td class="text-right">                    <a href="?page=product&orderby=weight&urut=<?php if($urut=="asc") { echo "desc" ; } else { echo "asc";} ?>">Weight</a>
                    </td>
                  <td class="text-right">                    <a href="?page=product&orderby=harga_jual&urut=<?php if($urut=="asc") { echo "desc" ; } else { echo "asc";} ?>">Price</a>
                    </td>
                
                 
                  <td class="text-right">Action</td>
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
										$qry=mysql_query("select * from produk,produk_best where produk.id=produk_best.id  order by produk.id asc LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td class="text-center">
                 								<?php
												if ($row['file']==""){
													$photo="../img/no-image.jpg";
												}else{
													$photo="../img/portfolio/thumb/".$row['file']."";
												}
												$harga=$row['harga'];
												?>
                  <img src="<?php echo $photo;?>" alt="<?php echo "$row[judul]"; ?>" style="width:50px;height:60px" class="img-thumbnail">
                    </td>
                  <td class="text-left"><?php echo "$row[judul]"; ?></td>
                      <td class="text-left"><?php echo $row['kategori']."<br>".
					  								" &nbsp;&nbsp;&nbsp;- ".$row['sub_kategori']
					  ; ?></td>
                  <td class="text-left"><?php echo "<b>ISBN : </b>".$row['isbn']."<br><br>
				  <b>Penulis : </b>".$row['penulis']."<br>
				  <b>Publisher : </b>".$row['publishernya']
				  ; ?></td>
                   <td class="text-left"><?php echo $row['weight']; ?></td>
                  <td class="text-right">                   
                  <?php if($row['diskon']>0){?>
                   <span style="text-decoration: line-through;"><?php echo number_format($row['harga']) ?></span><br><?php } ?>
                   
                    <div class="text-danger">   <?php if($row['diskon']>0){ echo number_format(($harga)-(($harga*$row['diskon'])/100));echo " <br>save ".$row['diskon']."%"; }else{echo number_format($harga);} ?></div>
                 
                    </td>
              
                                            <td style="text-align:center;"><br /><?php ?>
										
											<a href="?page=hapus.product.rekomendasi&id=<?php echo $row['id']?>&gambar=<?php echo $row['file']?>" onclick="pemberitahuan()" class="hapus"><span class="fa fa-trash-o"></span></a></td>   
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                    </table>
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
									$query  = "SELECT COUNT(produk.id) AS jumData FROM produk,recent where produk.id=recent.id  ";
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
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=".$_GET['page']."&hal=".$i."'>".$i."</a></li>";
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
koneksi_tutup();
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
