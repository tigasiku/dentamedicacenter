<?php
include "koneksi.php";
$row=mysql_fetch_array(mysql_query("select * from  piutang where 	piutang.kode_piutang='".$_GET['id']."'"));
?>

<script language="javascript">
   function setBrg(vkd,vnm){
     window.opener.document.getElementById('kode_user2').value = vkd;
	 window.opener.document.getElementById('nama2').value = vnm;



     window.self.close();
   }
  </script>
	
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
         <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- Calendar-->
		<script src="js/jquery.min.js" type="text/javascript"></script> 
<section class="content-header">
	<h1 style="color:#ccc">
		Piutang : <?php echo $row['nama'] ?>
    </h1>
</section>

<section class="content">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                   
                                </div><!-- /.box-header -->
                              <div class="box-body" style="padding-top:0px;">
							
                                  <table class="table table-hover table-bordered" style="margin-top:10px;">
                                      <tr>
                                          <th style="text-align:center;">Tanggal</th>
										 
                                          <th >Jumlah Bayar</th>
                                      
                                           <th >Keterangan</th> <th >Aksi</th>
                                      </tr>
									  <?php
										
										
									
										 
										
										$qry=mysql_query("select * from  bayar_piutang where kode_piutang='".$row[0]."'");
										while($jumlah_bayar=mysql_fetch_array($qry)){
										?>
                                        
                                 
                                      <tr >
                                          <td align="center"><?php echo date("d F Y",strtotime($jumlah_bayar['tanggal_bayar']))?></td>
										 
                                          <td>Rp. <span style="float: right"><?php echo  number_format($jumlah_bayar['jumlah_bayar']) ?></span></td>
                                           
                                           <td><?php echo  $jumlah_bayar['keterangan'] ?></td>
                                               <td><a  href="hapus.bayar.piutang.php?id=<?php echo $jumlah_bayar['kode_bayar_piutang'] ?>&kode_piutang=<?php echo $row[0] ?>" class="btn btn-danger hapus" ><i class="fa fa-trash-o"></i></a></td>
                                           
                                      </tr>
                                      <?php
										
										}
										?>   <tr style="font-weight: bold">
                                          <td align="center">Total</td>
										 
                                          <td>Rp. <span style="float: right"><?php   
	$num_byr=(mysql_fetch_array(mysql_query("select sum(jumlah_bayar) as jumlah_bayar from bayar_piutang where kode_piutang='".$row[0]."'")));
echo	number_format($num_byr['jumlah_bayar']) ?></span></td>
                                           
                                           <td></td> <td></td>
                                      </tr>
                                  </table>
                                </div><!-- /.box-body -->
								
                              
                            </div><!-- /.box -->
                        </div>
                    </div>
</section><!-- /.content -->
 <script>
$( ".hapus" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin ?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script> 