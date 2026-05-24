
<?php

date_default_timezone_set('Asia/Makassar');
include "koneksi.php";
koneksi_buka();
?>
<script language="javascript">
   function setBrg(vkd){
     window.opener.document.getElementById('satuan').value = vkd;
     window.self.close();
   }
</script>
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<section class="content-header">
	<h1>
		Pengunjung</h1>
</section>

<section class="content">

  <div class="row">
  					<div class="col-xs-12">
								
									
                                    <div class="col-lg-3 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-aqua">
                                            <div class="inner">
                                                <h3>
                                                    <?php 
													$num=(mysql_num_rows(mysql_query("select id from counter where day(tanggal)='".date("d")."' and month(tanggal)='".date("m")."' and year(tanggal)='".date("Y")."'")));
													echo number_format($num);
													?>
                                                </h3>
                                                <p>
                                                    Hari Ini
                                                </p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-load-a"></i>
                                            </div>
                                            <a onclick="window.open('detail.counter.php?ket=Hari_ini','mywindow','scrollbars=1,width=800,height=500')" class="small-box-footer" style="cursor:pointer">
                                                More info <i class="fa fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div><!-- ./col -->
                                    <div class="col-lg-3 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-green">
                                            <div class="inner">
                                                <h3>
                                                    <?php 
													$num=(mysql_num_rows(mysql_query("select id from counter where month(tanggal)='".date("m")."' and year(tanggal)='".date("Y")."'")));
													echo number_format($num);
													?>
                                                </h3>
                                                <p>
                                                    Bulan Ini
                                                </p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-calendar"></i>
                                            </div>
                                            <a onclick="window.open('detail.counter.php?ket=Bulan_ini','mywindow','scrollbars=1,width=800,height=500')" class="small-box-footer" style="cursor:pointer">
                                                More info <i class="fa fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div><!-- ./col -->
                                    <div class="col-lg-3 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-yellow">
                                            <div class="inner">
                                                <h3>
                                                    <?php 
													$num=(mysql_num_rows(mysql_query("select id from counter ")));
													echo number_format($num);
													?>
                                                </h3>
                                                <p>
                                                    Total Pengunjung
                                                </p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-pie-graph"></i>
                                            </div>
                                            <a onclick="window.open('detail.counter.php?ket=Total Pengunjung','mywindow','scrollbars=1,width=800,height=500')" class="small-box-footer" style="cursor:pointer">
                                                More info <i class="fa fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div><!-- ./col -->
								</div>
								</form>
								<div class="clearfix"></div>
							</div>
						
                        
</section><!-- /.content -->
<?php
koneksi_tutup();
?>