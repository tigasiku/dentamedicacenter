<?php
session_start();
include "koneksi.php";
koneksi_buka();
date_default_timezone_set("Asia/Makassar");


								$qry=mysql_query("select 				
								* from member_user where username='".$_GET['username']."'");
								
								$data=mysql_fetch_array($qry);	
								 

?>



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
			 <div class="row no-print">
                        
                    </div>
           <div class="row">
                  <div class="col-xs-12">
                            <h2 class="page-header" style="font-size:20px">
                                Detail Keranjang
                            </h2>                            
                  </div><!-- /.col -->
            </div>
            <div class="row invoice-info">
                        <div class="col-sm-5 invoice-col">
                          
                            <address>
                           		
                                <strong>Usename : <?php  echo $data['username'] ?></strong><br>
                                <strong>Nama : <?php  echo $data['nama'] ?></strong><br>
                                
                                
                            </address>
                        </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                         <div class="col-xs-12 table-responsive">
                                
								<form action="simpan.Penjualan.dirut.pengajuan.php" method="post" name="autoSumForm" enctype="multipart/form-data">
							
                                    
                                                   
                                <ul class="nav nav-tabs">
<!-- Untuk Semua Tab.. pastikan a href="#nama_id" sama dengan nama id di "Tap Pane" dibawah-->
  <li class="<?php if((@$_GET['rec'])=="entri" or !isset($_GET['rec'])){ echo "active"; } ?>" ><a href="#telat" data-toggle="tab">Detail Keranjang</a></li> <!-- Untuk Tab pertama berikan li class="active" agar pertama kali halaman di load tab langsung active-->
  
</ul>  
  <div class="tab-content">
  <div class="tab-pane active" id="telat">     
	<table class="table table-striped" style="font-size:13px">
      <tr>
    <th>Nama Barang</th>
    <th>Qty</th>
    <th>Satuan</th>
    <th> Harga Jual</th>
    <th>Sub Total</th>

  </tr>             <?php 
													$qry2=mysql_query("select * from keranjang,produk where  keranjang.kd_produk=produk.id and username='".$data['username']."'");
													while($data2=mysql_fetch_array($qry2)){
													?>
  <tr>
    <td><?php echo $data2['judul'] ?></td>
       <td><?php echo number_format($data2['qty'],2) ?></td>
    <td><?php echo $data2['satuan'] ?></td>

 <td><?php echo number_format($data2['harga']) ?></td>    <td>
 <?php echo number_format($data2['harga']*$data2['qty']);
 
	@$total=($data2['harga']*$data2['qty'])+$total;
	 ?></td>
  
  </tr> <?php } ?>
   <tr style="font-weight:bold">
    <td>Total</td>
       <td>&nbsp;</td>
    <td>&nbsp;</td> 
    <td>&nbsp;</td>
    <td><?php echo number_format(@$total);
	$total=0;
	 ?></td>
  </tr>
</table>
 </div>
</div>

                                                 
                                                   
                                                     <hr />   
                                  
                                    
								
													
                                    
                                </div><!-- /.box-body -->

                              
											<div class="box-footer">                                
                               
														</form>
													<div class="clearfix"></div>		
                       						</div>
                                   </div>
                  
	
</section><!-- /.content -->
</body>
<?php
koneksi_tutup();
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