<?php
session_start();
include "koneksi.php";

date_default_timezone_set("Asia/Makassar");


								$qry=mysql_query("select * from penjualan where no_jual='".$_GET['no_jual']."'");
								
								$data=mysql_fetch_array($qry);	
								 
$hari = date("D",strtotime($data['tgl_jual']));
													if ($hari=="Sun")
													   $hari='Minggu';
													else if ($hari=="Mon")
													   $hari='Senin';
													else if ($hari=="Tue")
													   $hari='Selasa';
													else if ($hari=="Wed")
													   $hari='Rabu';
													else if ($hari=="Thu")
													   $hari='Kamis';
													else if ($hari=="Fri")
													   $hari='Jumat';
													else if ($hari=="Sat")
													   $hari='Sabtu';
?><title><?php  echo $data['customer'] ?> - <?php  echo date("d F Y",strtotime($data['tgl_jual'])) ?></title>
<style>
	@page {
  size: A4;
 
	font-family: "Calibri" ;
			font-size: 11px !important;
			padding: 30px;
	
			 
}
@media print {
  html, body {
	  
    width: 210mm;
     height: 99%; 
		padding: 30px;
	
	    
         
  }
  /* ... the rest of the rules ... */
}
</style>


<script language="javascript">
function TampilTabel(file){
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=570,width=650');
}
</script>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/komentar.js" type="text/javascript"></script>
<script type="text/javascript">//<![CDATA[ 
function startCalc(){
  interval = setInterval("calc()");
}
function calc(){


 	
	 document.getElementById('pesannya').innerHTML="";
	
	
}
function stopCalc(){
  clearInterval(interval);
}
</script>
<script type="text/javascript">
$(document).ready(function(){
	$('#print').click(function(){
		$('#komen').css('display','none');
		$('#label_komen').css('display','none');
		$('#submit2').css('display','none');
		$('#print').css('display','none');
		 window.print();
	});
});
</script>
<script type="text/javascript">//<![CDATA[ 
$(window).load(function(){
	
var hasil = parseInt($('#grand').val());

 $('#total').html((hasil).toLocaleString());
	
$(document).on('keyup', '#pqty', function(){
    var $this = $(this);
    var sumpprice = $this.siblings('#pprice').val();
	var sumpqty = $this.val();
	var sumtotal = ((sumpprice * sumpqty)).toFixed(2);
	$this.siblings('#totalpprice').val( sumtotal );
});
$(document).on('keyup', '#pprice', function(){
    var $this = $(this);
    var sumpprice = $this.val();
	var sumpqty = $this.siblings('#pqty').val();
	var sumtotal = ((sumpprice * sumpqty)).toFixed(2);
	$this.siblings('#totalpprice').val( sumtotal );
});


	

});//]]>  

</script>
<script type="text/javascript">//<![CDATA[ 
$(document).ready(function(){
    var inpA = "input[rel=total]";
	 $('#hitung').click(function(){
        var avalA=0;
        
        $(inpA).each(function() {
            if(this.value !='') avalA += parseInt(this.value,10);
        });
        $('#total').html((avalA).toLocaleString());
         $('#grand').val((avalA));

    });

});
</script><link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
         <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link href="css/bs-callout.css" rel="stylesheet" type="text/css" />
<body>

<section class="content invoice">
			
           <div class="row">
                  <div class="col-xs-12"><img src="img/logo2.png" style="float: right;height: 50px;margin-top: -12px">
                            <h2 class="page-header" style="font-size:20px">
                                Detail Penjualan 
                            </h2>                            
                  </div><!-- /.col -->
            </div>
            <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          
                            <address>
                                <strong>No Ref : <?php  echo $data['no_jual'] ?></strong><br>
                                <strong>Tanggal : <?php  echo $data['tgl_jual'] ?></strong><br>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          
                            <address>
                                <strong>Nama : <?php  echo $data['customer'] ?></strong><br>
                                <strong>Gudang : <?php $qrygud=mysql_query("select * from penjualan_detail,gudang where penjualan_detail.kd_gudang=gudang.kd_gudang and no_jual='".$data['no_jual']."'");
													 $rowgud=mysql_fetch_array($qrygud); echo $rowgud['gudang'] ?></strong><br>
                            </address>
                        </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                         <div class="col-xs-12">
                                
								<form action="simpan.Penjualan.dirut.pengajuan.php" method="post" name="autoSumForm" enctype="multipart/form-data">
							
                                    
                                                   
                                <ul class="nav nav-tabs">
<!-- Untuk Semua Tab.. pastikan a href="#nama_id" sama dengan nama id di "Tap Pane" dibawah-->
  <li class="<?php if((@$_GET['rec'])=="entri" or !isset($_GET['rec'])){ echo "active"; } ?>" ><a href="#telat" data-toggle="tab">Items</a></li> <!-- Untuk Tab pertama berikan li class="active" agar pertama kali halaman di load tab langsung active-->
  
</ul>  
  <div class="tab-content">
  <div class="tab-pane active" id="telat">     
	<table class="table table-striped" style="font-size:13px">
      <tr>
       	<th >Kategori</th>
    <th>Nama Barang</th>
     <th class="text-center">Qty</th>
    <th class="text-center">Satuan</th>
    <th class="text-right"> Harga Jual</th>
    <th class="text-right">Sub Total</th>

  </tr>             <?php 
													$qry2=mysql_query("select *,penjualan_detail.harga_beli as harga_beli,penjualan_detail.harga_jual as harga_jual from penjualan_detail,barang where  penjualan_detail.kode_barang=barang.kode_barang and no_jual='".$data['no_jual']."'");
													while($data2=mysql_fetch_array($qry2)){
													?>
  <tr>
    <td><?php 
														
		$kat=mysql_query("select * from kategori_barang,sub_kategori_barang where kategori_barang.kode_kategori_barang=sub_kategori_barang.kategori and  id='".$data2['kode_sub_kategori']."'");
		$katnya=mysql_fetch_array($kat);												
		?>
		- <?php echo $katnya['kategori_barang'] ?> <br>
        -- <?php echo $katnya['sub_kategori'] ?>
		
		</td>
    <td><?php echo $data2['nama_barang'] ?></td>
       <td class="text-center"><?php echo number_format($data2['jumlah'],2);
	   @$jumlah=$data2['jumlah']+$jumlah; ?></td>
    <td class="text-center"><?php echo $data2['satuan'] ?></td>
    <td class="text-right"><?php echo number_format($data2['harga_jual']) ?></td>    
 	<td class="text-right"><?php echo number_format($data2['sub_total']);
	@$total=$data2['sub_total']+$total;
	 ?></td>
  
  </tr> <?php } ?>
   <tr style="font-weight:bold">
    <td>Total</td>
       <td>&nbsp;</td>   <td class="text-center"><?php echo number_format(@$jumlah,2);

	 ?></td><td>&nbsp;</td>
    <td>&nbsp;</td>
    <td class="text-right"><?php echo number_format(@$total);
	$total=0;
	 ?></td>
  </tr>
</table>
 </div>
</div>

                                                 
                                                   
                                                     <hr />   
                                  
                                    <div class="col-xs-12">
                                   <p ><b>Keterangan</b></p>
                                         <p class="well well-sm no-shadow" style="margin-top: 10px;">
                                               <?php echo preg_replace("/<br>/","".chr(13)."",$data['ket']) ?>
                                  		 	</p>
                                      
                                  </div>
								
													
                                    
                                </div><!-- /.box-body -->

                              
											<div class="box-footer">                                
                               
														</form>
													<div class="clearfix"></div>		
                       						</div>
                                   </div>
                  
	
</section><!-- /.content -->
</body>
<?php

?>
<script>
function pemberitahuan(){

setuju=document.getElementById('grand').value;


if (setuju.length == 0){
	
	var msg="Anda belum menghitung total !";
var setuju=confirm(msg);
	
	
	return false;
	}
	
}
</script><script src="js/jquery.min.js"></script> <script src="js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
    document.title = "<?php  echo $data['customer'] ?> - <?php  echo date("d F Y",strtotime($data['tgl_jual'])) ?>";
    window.print();
</script>