<style>
	@media (min-width: 768px) {
	.navbar-header { float:none;
	}}
	.menu_bawah a{
		color: #c7c7c7 !important;
	}
	.menu_bawah a:hover{
		color: #f39c12 !important;
		font-weight: bold
	}
	.menu_bawah .active {
		color: #f39c12 !important;
		font-weight: bold
	}
</style>
 <div style="height:50px"></div><header class="navbar  navbar-fixed-bottom" role="banner" id="headernya" style="background:#000;box-shadow: 0 1px 10px rgba(0,0,0,.1);;border-bottom:0px;border-top: 1px solid #333;">

            <div class="navbar-header menu_bawah" align="center" style="">
            <div class="row" style="margin-top: 6px "> 
              
               	<div class="col-xs-2">
               	
                <a href="?page=home"  data-toggle="collapse" data-target=".navbar-collapse" class="<?php if($page=="home") echo "active";?> ">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="fa fa-dashboard " style="font-weight:bold;font-size: 20px"></span><br />
                    <span  >Home</span></a>
                </div> 
              	<div class="col-xs-2">
                 <a   data-toggle="collapse" data-target=".navbar-collapse"  href="?page=stok" class="<?php if($page=="stok") echo "active";?> ">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="fa fa-envelope-o fa-2" style="font-weight:bold;font-size: 20px"></span><br />
                    <span  >Stok</span></a>
                </div>
            	<div class="col-xs-2">
                 <a  data-toggle="collapse" data-target=".navbar-collapse"   href="?page=tambah.penjualan" class="<?php if($page=="tambah.penjualan") echo "active";?> ">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="fa fa-shopping-cart fa-2" style="font-weight:bold;font-size: 20px"></span><br />
                    <span  >Sales</span>
                    
                    </a>
                </div>
              	<div class="col-xs-2">
                 <a  data-toggle="collapse" data-target=".navbar-collapse"  href="?page=report.orders&filter_dari=<?php echo date("Y-m-01") ?>&filter_sampai=<?php echo date("Y-m-d") ?>" class="<?php if($page=="report.orders") echo "active";?> ">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="fa fa-share-square-o fa-2" style="font-weight:bold;font-size: 20px"></span><br />
                    <span  >Report</span>
                    </a>
                    
                    
                   
              
                    
                </div>
                <div class="col-xs-2">
                 <a  data-toggle="collapse" data-target=".navbar-collapse"  href="?page=grafik.omset" class="<?php if($page=="grafik.omset") echo "active";?> ">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="fa fa-bar-chart fa-2" style="font-weight:bold;font-size: 20px"></span><br />
                    <span  >Grafik</span>
                    </a>
                    
                    
                </div>  	     <div class="col-xs-2">
                 <a  data-toggle="collapse" data-target=".navbar-collapse"  href="?page=laporan.labarugi" class="<?php if($page=="laba.rugi") echo "active";?> ">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="fa fa-book fa-2" style="font-weight:bold;font-size: 20px"></span><br />
                    <span  >L-(R)</span>
                    </a>
                    
                    
                </div>
            </div>
            </div>
   		
    </header><!--/header-->
