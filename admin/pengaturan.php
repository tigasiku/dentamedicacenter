<?php
include "koneksi.php";
koneksi_buka(); 
?>
<section class="content-header">
	<h1>
		Pengaturan
       <small><?php echo $_SESSION['judul_graha'] ?></small>
    </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                              </div><!-- /.box-header -->
                                <div class="box-body" style="padding-top:0px;">
								
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th style="text-align:center;">No</th>
											<th style="text-align:center;">Pengaturan</th>
                                            
                                            <th >Isi</th>
                                            <th style="text-align:center;">Aksi</th>
                                        </tr>
										<?php
										
										$i=1;
										
										$qry=mysql_query("select * from pengaturan ");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
											 <td style="text-align:center;">
												<?php echo ($row['kode']);?>
											</td>
                                          
                                            <td><?php 
											
											$str=str_replace('<div>', '<span>', $row['isi']);
									$str=str_replace('<b>', ' ', $str);
									$str=str_replace('</b>', ' ', $str);
									$str=str_replace('<strong>', ' ', $str);
									$text=str_replace('</div>', '</span>', $str);
									?>
                                    <?php echo substr(trim(strip_tags($text)), 0, 500) .((strlen(trim(strip_tags($text))) > 500) ? '.....' : ''); ?></td>
                                            <td style="text-align:center;"><br /><?php ?>
											<a href="?page=post.pengaturan&action=edit&id=<?php echo $row['kode']?>"><span class="fa fa-edit"></span></a>  
										</td>   
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                    </table>
                                </div><!-- /.box-body -->
								
                             
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