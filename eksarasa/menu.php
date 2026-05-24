
<?php
if(!isset($_GET['page'])){
	$page="home";
}else{
	$page=$_GET['page'];
}
?>
<ul class="sidebar-menu">
<li class="<?php if($page=="home"){echo "active";}?>">
 		 <a href="?page=home"><i class="fa fa-dashboard"></i>Dashboard</a> </li>
<?php
if ($_SESSION['loglevel_graha3']=="Administrator"){ ?>
<li  class="treeview <?php if(  $page=="tambah.management.user"  or $page=="management.user" or $page=="store.location"){echo "active";}?>">
		<a href="#">
			<i class="fa fa-cog"></i><span>Configuration</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
         
        <li <?php if($page=="management.user" or $page=="tambah.management.user"){echo "class='active'";}?>>
				<a href="?page=management.user">
					<i class="fa fa-angle-double-right"></i><span>Management User</span>
			</a></li>       
	       <li <?php if($page=="store.location" ){echo "class='active'";}?>>
				<a href="?page=store.location">
					<i class="fa fa-angle-double-right"></i><span>Store Locations</span>
			</a></li>
 	   </ul> 
</li><?php } ?>
<?php
if ($_SESSION['loglevel_graha3']=="Administrator" ){
?>
   <li  class="treeview <?php if( $page=="kategori.in" or $page=="edit.kategori.in" or $page=="edit.kategori.out" or $page=="kategori.out"  or  $page=="sub.kategori.out"  or  $page=="gudang" or $page=="rek.perusahaan"  or  $page=="edit.sub.kategori.out"  or  $page=="edit.gudang" or $page=="edit.rek.perusahaan"){echo "active";}?>">
		<a href="#">
			<i class="fa fa-cogs"></i><span>Data Master</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
        
         <li class="<?php if($page=="kategori.in"){echo "active";}?>">
 		 <a href="?page=kategori.in"><i class="fa fa-angle-double-right"></i>Kategori Cash In</a> </li>
          <li class="<?php if($page=="kategori.out"){echo "active";}?>">
 		 <a href="?page=kategori.out"><i class="fa fa-angle-double-right"></i>Kategori Cash Out</a> </li>
         <li class="<?php if($page=="sub.kategori.out"){echo "active";}?>">
 		 <a href="?page=sub.kategori.out"><i class="fa fa-angle-double-right"></i>Sub Kategori Cash Out</a> </li>
      
         
           <li <?php if($page=="rek.perusahaan" or $page=="rek.perusahaan"){echo "class='active'";}?>>
				<a href="?page=rek.perusahaan">
					<i class="fa fa-angle-double-right"></i><span>Account Bank</span>
			</a></li>
        <li <?php if($page=="gudang" ){echo "class='active'";}?>>
				<a href="?page=gudang">
					<i class="fa fa-angle-double-right"></i><span>Gudang</span>
			</a></li>
        
        </ul>
   </li> <?php }
   ?> 

<?php
if ($_SESSION['loglevel_graha3']=="Administrator" or $_SESSION['loglevel_graha3']=="Admin"){
?>
   <li  class="treeview <?php if( $page=="barang" or $page=="tambah.barang" or $page=="edit.barang" or $page=="kategori" or $page=="sub.kategori" or $page=="satuan" or $page=="histori.transaksi.pembelian"  or $page=="histori.transaksi.penjualan"){echo "active";}?>">
		<a href="#">
			<i class="fa fa-cubes"></i><span>Data Barang</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
        <?php
if ($_SESSION['loglevel_graha3']=="Administrator" ){
?>
         <li class="<?php if($page=="kategori"){echo "active";}?>">
 		 <a href="?page=kategori"><i class="fa fa-angle-double-right"></i>Kategori</a> </li>
         <li class="<?php if($page=="sub.kategori"){echo "active";}?>">
 		 <a href="?page=sub.kategori"><i class="fa fa-angle-double-right"></i>Sub Kategori</a> </li>
         <li class="<?php if($page=="satuan" or $page=="tambah.satuan" or $page=="edit.satuan"){echo "active";}?>">
 		 <a href="?page=satuan"><i class="fa fa-angle-double-right"></i>Satuan</a> </li><?php } ?>
       	 <li class="<?php if($page=="barang" or $page=="tambah.barang" or $page=="histori.transaksi.pembelian" or $page=="histori.transaksi.penjualan"  or $page=="edit.barang"){echo "active";}?>">
 		 <a href="?page=barang"><i class="fa fa-angle-double-right"></i>Barang</a> </li>
         
         
        
        </ul>
   </li> <?php }
   ?> 
    <li  class="treeview <?php if( $page=="stok" or $page=="stok.kosong"  or $page=="stok.keluar"  or $page=="tambah.stok.keluar"  or $page=="stok.masuk"  or $page=="tambah.stok.masuk" or $page=="daftar.mutasi.stok" or $page=="mutasi.stok"){echo "active";}?>">
		<a href="#">
			<i class="fa fa-database"></i><span>Data Stok</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
        
         <li class="<?php if($page=="stok"){echo "active";}?>">
 		 <a href="?page=stok"><i class="fa fa-angle-double-right"></i>Stok</a> </li>
       
             <li class="<?php if($page=="stok.kosong"){echo "active";}?>">
 		 <a href="?page=stok.kosong"><i class="fa fa-angle-double-right"></i>Stok Kosong</a> </li>
           <li class="<?php if($page=="stok.masuk"){echo "active";}?>">
 		 <a href="?page=stok.masuk"><i class="fa fa-angle-double-right"></i>Stok Masuk</a> </li>
         <li class="<?php if($page=="stok.keluar"){echo "active";}?>">
 		 <a href="?page=stok.keluar"><i class="fa fa-angle-double-right"></i>Stok Keluar</a> </li>
     	    <li class="<?php if($page=="daftar.mutasi.stok" or $page=="mutasi.stok"){echo "active";}?>">
 		 <a href="?page=daftar.mutasi.stok"><i class="fa fa-angle-double-right"></i>Mutasi Stok</a> </li>
        </ul>
   </li>
  <?php
if ($_SESSION['loglevel_graha3']<>"Logistik"){
?>
   <li class="<?php if($page=="penjualan" or $page=="tambah.penjualan" or $page=="edit.penjualan" ){echo "active";}?>">
    <a href="?page=penjualan"><i class="fa fa-shopping-cart"></i>Penjualan</a></li>
    <li class="<?php if($page=="pembelian" or $page=="tambah.pembelian" or $page=="edit.pembelian" ){echo "active";}?>">
    <a href="?page=pembelian"><i class="fa fa-cart-plus"></i>Pembelian</a></li>
     <li class="<?php if($page=="piutang" or $page=="piutang.rincian"  ){echo "active";}?>">
            <a href="?page=piutang">
          	<i class="fa fa-address-book"></i>
            <span>Piutang</span>
			
        </a>
        </li>
           <li class="<?php if($page=="hutang" ){echo "active";}?>">
            <a href="?page=hutang">
          	<i class="fa fa-money"></i>
            <span>Hutang</span>
			
        </a>
        </li>
    <li class="<?php if($page=="cash.in"  or $page=="tambah.cash.in" or $page=="edit.cash.in"  ){echo "active";}?>">
            <a href="?page=cash.in">
          	<i class="fa fa-usd"></i><i class="fa fa-reply"></i>
            <span>Cash In</span>
			
        </a>
		</li>
	   	<li class="<?php if($page=="cash.out" or $page=="tambah.cash.out" or $page=="edit.cash.out" ){echo "active";}?>">
            <a href="?page=cash.out">
          	<i class="fa fa-usd"></i><i class="fa fa-share"></i>
            <span>Cash Out</span>
			
        </a>
        </li>
   
  
  
    <li class="treeview <?php if($page=="report.penjualan" or $page=="grafik.barang" or $page=="grafik.customer" or $page=="report.orders" or $page=="grafik.omset" or $page=="laporan.labarugi" or $page=="grafik.kategori" or $page=="report.barang"){echo "active";}?>">
    		<a href="#"><i class="fa fa-book"></i>Report Penjualan<i class="fa fa-angle-left pull-right"></i></a>
    		<ul class="treeview-menu">
          	 	<li class="<?php if($page=="report.orders" ){echo "active";}?>">
 		 <a href="?page=report.orders"><i class="fa fa-angle-double-right"></i>Order</a> </li>
           	<li class="<?php if($page=="grafik.barang" ){echo "active";}?>">
 		 <a href="?page=grafik.barang"><i class="fa fa-angle-double-right"></i>Grafik Barang</a> </li>
         		       	<li class="<?php if($page=="report.barang" ){echo "active";}?>">
 		 <a href="?page=report.barang"><i class="fa fa-angle-double-right"></i>Report Barang</a> </li>
          		<li class="<?php if($page=="grafik.omset" ){echo "active";}?>">
 		 <a href="?page=grafik.omset"><i class="fa fa-angle-double-right"></i>Grafik Omset</a> </li>
           		<li class="<?php if($page=="grafik.customer" ){echo "active";}?>">
 		 <a href="?page=grafik.customer"><i class="fa fa-angle-double-right"></i>Grafik Customer</a> </li>
           	<li class="<?php if($page=="grafik.kategori" ){echo "active";}?>">
 		 <a href="?page=grafik.kategori"><i class="fa fa-angle-double-right"></i>Grafik Kategori</a> </li>
           	<li class="<?php if($page=="laporan.labarugi" ){echo "active";}?>">
 		 <a href="?page=laporan.labarugi"><i class="fa fa-angle-double-right"></i>Laba-rugi</a> </li>
           	
            	<?php /*  <li class="<?php if($page=="report.penjualan" ){echo "active";}?>">
 		 <a href="?page=report.penjualan"><i class="fa fa-angle-double-right"></i>Report Penjualan</a> </li>
            	 <li class="<?php if($page=="report.pembelian" ){echo "active";}?>">
 		 <a href="?page=report.pembelian"><i class="fa fa-angle-double-right"></i>Report Pembelian</a> </li> */?>
            </ul>
    </li>
	 <li class="<?php if($page=="report.pembelian" ){echo "active";}?>">
 		 <a href="?page=report.pembelian"><i class="fa fa-calendar-check-o"></i>Report Pembelian</a> </li>
	<?php /*
    <li class="treeview <?php if($page=="grafik.bulan" or $page=="grafik.hari"){echo "active";}?>">
    		<a href="#"><i class="fa fa-book"></i>Report Cash<i class="fa fa-angle-left pull-right"></i></a>
    		<ul class="treeview-menu">
          	 	<li class="<?php if($page=="grafik.hari" ){echo "active";}?>">
 		 <a href="?page=grafik.hari"><i class="fa fa-angle-double-right"></i> Hari</a> </li>
           	<li class="<?php if($page=="grafik.bulan" ){echo "active";}?>">
 		 <a href="?page=grafik.bulan"><i class="fa fa-angle-double-right"></i> Bulan</a> </li>
          	
           	
            	<?php /*  <li class="<?php if($page=="report.penjualan" ){echo "active";}?>">
 		 <a href="?page=report.penjualan"><i class="fa fa-angle-double-right"></i>Report Penjualan</a> </li>
            	 <li class="<?php if($page=="report.pembelian" ){echo "active";}?>">
 		 <a href="?page=report.pembelian"><i class="fa fa-angle-double-right"></i>Report Pembelian</a> </li> 
            </ul>
    </li>*/ ?>
  <?php } ?>
	<li>
	  <a href="logout.php">
	    <i class="fa fa-sign-out"></i><span>Logout</span>
      </a>
  </li>
   	<li>
	 <a >
	  &nbsp;
      </a>
  </li>
   
</ul>

