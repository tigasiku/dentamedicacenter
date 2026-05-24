<?php
session_start();
include "koneksi.php";
koneksi_buka();
date_default_timezone_set("Asia/Makassar");

								
								
									
								 

?>



<script language="javascript">
function TampilTabel(file){
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=570,width=650');
}
</script>
<script src="js/jquery.min.js" type="text/javascript"></script>
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
                                <?php  echo $_GET['ket'] ?>
                            </h2>                            
                  </div><!-- /.col -->
            </div>
            <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          
                           
                        </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                         <div class="col-xs-12 table-responsive">
                                
								<form action="simpan.Penjualan.dirut.pengajuan.php" method="post" name="autoSumForm" enctype="multipart/form-data">
							
                                    
                                                   
                                <ul class="nav nav-tabs">
<!-- Untuk Semua Tab.. pastikan a href="#nama_id" sama dengan nama id di "Tap Pane" dibawah-->
  <li class="<?php if((@$_GET['rec'])=="entri" or !isset($_GET['rec'])){ echo "active"; } ?>" ><a href="#telat" data-toggle="tab">Detail</a></li> <!-- Untuk Tab pertama berikan li class="active" agar pertama kali halaman di load tab langsung active-->
  
</ul>  
  <div class="tab-content">
  <div class="tab-pane active" id="telat">     
	<table class="table table-striped" style="font-size:13px">
      <tr>
      <th>No</th>
    <th>Location</th>
    <th>Ip</th>
    <th>Tanggal</th>
    </tr>             <?php 
	$no=1;
													if($_GET['ket']=="Hari_ini"){
												$qry=mysql_query("select 				
												* from counter where day(tanggal)='".date("d")."' and month(tanggal)='".date("m")."' and year(tanggal)='".date("Y")."'");
												}
												elseif($_GET['ket']=="Bulan_ini"){
												$qry=mysql_query("select 				
												* from counter where month(tanggal)='".date("m")."' and year(tanggal)='".date("Y")."'");
												}else{
												$qry=mysql_query("select 				
												* from counter");
												}
													while($data2=mysql_fetch_array($qry)){
													?>
  <tr>
    <td><?php echo $no++ ?></td>
    <td><?php echo $data2['location'] ?></td>
       <td><?php echo $data2['ip'] ?></td>
    <td><?php echo $data2['tanggal'] ?></td>
     </tr> <?php } ?>
   
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