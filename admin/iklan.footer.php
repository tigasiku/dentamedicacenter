<?php
include "koneksi.php";
koneksi_buka();
?>
<section class="content-header">
	<h1>
		Iklan Footer 
        <small><?php echo $_SESSION['judul_graha'] ?></small>
    </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Iklan Footer </h3>
                              </div><!-- /.box-header --> <?php 
									if(isset($_GET['pesan'])){?>  
                                  	<div class="small-box bg-<?php if($_GET['pesan']=="success"){ echo "green";}else{ echo "red";}?> ">
                                		<div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                             			</div>
                        			</div><?php }?>
                                <div class="box-body" style="padding-top:0px;">
									
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">Kiri </th>
                                    
                                            <th >Kanan</th>
                                          
                                        </tr>
										<?php
										
									
										?>
                                        <tr>
                                            <td style="text-align:center;">
											  
											      <a href="?page=edit.iklan.footer&posisi=kiri"><img src="../iklan_footer/<?php
											   $qry=mysql_query("select * from iklan_footer where posisi='kiri'");$row=mysql_fetch_array($qry);
											    echo $row['gambar'];?>" style="border:solid 4px #fff;box-shadow:0px 0px 2px #999;" width="100%"></a>
											</td>
                                          
                                            <td>   <a href="?page=edit.iklan.footer&posisi=kanan"><img src="../iklan_footer/<?php
											   $qry=mysql_query("select * from iklan_footer where posisi='kanan'");$row=mysql_fetch_array($qry);
											    echo $row['gambar'];?>" style="border:solid 4px #fff;box-shadow:0px 0px 2px #999;" width="100%"></a></td>
                                          
                                        </tr>
                                         <tr>
                                            <td colspan="2" style="text-align:center;">                                             <a href="?page=edit.iklan.footer&posisi=bawah"><img src="../iklan_footer/<?php
											   $qry=mysql_query("select * from iklan_footer where posisi='bawah'");$row=mysql_fetch_array($qry);
											    echo $row['gambar'];?>" style="border:solid 4px #fff;box-shadow:0px 0px 2px #999;" width="100%">                                              </a></td>
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
koneksi_tutup();
?>
<script>
function pemberitahuan(){

var msg="Apakah Anda Yakin Untuk Menghapus Data?";
var setuju=confirm(msg);
if (setuju)
	return true;
	else
	return false;
	
}
</script>
