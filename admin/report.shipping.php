<?php 
@date_default_timezone_set("Asia/Makassar");
include("../koneksi.php");
$row=mysql_fetch_array(mysql_query("select * from penjualan where kd_penjualan='".$_GET['inv']."'"));
?>
<html lang="en" id="top" class="no-js"><!--<![endif]--><head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Gramedia - Order #100021407</title>
<meta name="description" content="Graha Media Online offering Buku, Audio Video, Musik and Sport, Stationary, Fancy, Komputer, and Elektronik.">
<meta name="keywords" content="Graha Media, Graha Media online, Buku, Toko Buku, Audio Video, Musik and Sport, Stationary, Fancy, Komputer, and Elektronik">
<meta name="robots" content="INDEX,FOLLOW">
<link rel="shortcut icon" href="../img/ico/icon.ico">

<link rel="stylesheet" type="text/css" href="../css_report/styles.css" media="all">
<link rel="stylesheet" type="text/css" href="../css_report/print.css" media="print">

<script type="text/javascript">//<![CDATA[
        var Translator = new Translate([]);
        //]]></script></head>
<body class="page-print sales-order-print">
<div>
  
        <?php
		$store=mysql_fetch_array(mysql_query("select * from stores"));
		?>
  <h2> <?php echo $store['store_name'] ?></h2>
<p class="order-date">Order Date: <?php echo date("d F Y",strtotime($row['tgl_penjualan'])) ?></p>
<div class="col2-set">
        <div class="col-1">
    
<b>Address : </b><?php echo $store['store_address'] ?><br>
<br>
<b>Telephone : </b><?php echo $store['store_telp'] ?><br>
<b>E-Mail : </b><?php echo $store['store_email'] ?><br>
<b>Web Site: : </b>http://www.blibuku.com
</address>
    </div>
    <div class="col-2">
      
        <address><b>Date Added : </b> <?php echo date("d F Y",strtotime($row['tgl_penjualan'])) ?><br>

<b>Order ID : </b> <?php echo $row['kd_penjualan'] ?><br>




</address>
</address>
    </div>
</div>
<div class="col2-set">
        <div class="col-1">
        <h2>Shipping Address</h2>
        <address><?php echo $row['si_nama'] ?><br>

<?php echo $row['si_alamat'] ?><br>



<?php echo $row['si_kota'] ?>,  <?php echo $row['si_provinsi'] ?>, <?php echo $row['si_kode_pos'] ?><br>
Indonesia<br>
T: <?php echo $row['si_telp'] ?>

</address>
    </div>
    <div class="col-2">
            <h2>Billing Address</h2>
        <address><?php echo $row['bi_nama'] ?><br>

<?php echo $row['bi_alamat'] ?><br>



<?php echo $row['bi_kota'] ?>,  <?php echo $row['bi_provinsi'] ?>, <?php echo $row['bi_kode_pos'] ?><br>
Indonesia<br>
T: <?php echo $row['bi_telp'] ?>

</address>
</address>
    </div>
</div>
<div class="col2-set">
    <div class="col-1">
        <h2>Shipping Method</h2>
         <?php echo $row['shipping'] ?> - <?php echo $row['servicenya'] ?> (<?php echo $row['weight'] ?> gram) <?php echo $row['keterangan'] ?>    </div>
    
</div>
<h2>Items Ordered</h2>
<table class="data-table" id="my-orders-table">
    <colgroup><col>
    <col width="80px">
    <col width="100px">
    <col width="35px">
    <col width="100px">
      
    </colgroup><thead>
        <tr class="first last">
            <th>Product Name</th>
            <th class="a-center">ISBN</th>
            <th class="a-right">Kategory</th>
            <th class="a-right">Qty</th>
             <th class="a-right">Publisher</th>

         
        </tr>
    </thead>
    
            <tbody class="odd">
           <?php 
					  	
          
 $qry=mysql_query("select * from produk,penjualan_detail where produk.id=penjualan_detail.kd_produk and kd_penjualan='".$row["kd_penjualan"]."'");
$jumlah_keranjang=mysql_num_rows($qry);
                                           
						while($row=mysql_fetch_array($qry)) {
					  ?>  
                          <?php if($row['diskon']>0){  
											$harga=($row['harga']-($row['harga']*$row['diskon']/100));
											}else{ 
											$harga=($row['harga']); } ?>
        <tr class="border first" id="order-item-row-61224">
    <td style="white-space:nowrap"><h3 class="product-name"><?php echo $row['judul'] ?></h3>
                
                                            <?php echo ($row['penulis']) ?>                                                   </td>
    <td data-rwd-label="SKU" class="a-center" style="white-space:nowrap"><?php echo $row['isbn'] ?></td>
    <td class="a-right td-price" data-rwd-label="Price">
                    <span class="price-excl-tax">
                                                    <span class="cart-price">
                
                                            <span class="price"><b><?php echo ($row['kategori']) ?></b><br><?php echo ($row['sub_kategori']) ?></span>                    
                </span>


                            </span>
            <br>
                    </td>
    <td class="a-right td-qty" data-rwd-label="Qty" align="center">
        <span class="nobr">
                            <!--:--> <strong><?php echo $row['qty'] ?></strong><br>
                        </span>
    </td>
    <td class="a-right td-price" data-rwd-label="Price">
                    <span class="price-excl-tax">
                                                    <span class="cart-price">
                
                                            <span class="price"><?php echo ($row['publishernya']) ?></span>                    
                </span>


                            </span>
            <br>
                    </td>
                   
   
    <!--
        <th class="a-right"><span class="price">Rp 20.000</span></th>
            -->
</tr>
    <?php } ?>
        </tbody>
</table>
<script type="text/javascript">decorateTable('my-orders-table', {'tbody' : ['odd', 'even'], 'tbody tr' : ['first', 'last']})</script>
<script type="text/javascript">
    document.title = "Graha Media - Order #<?php echo $_GET['inv'] ?>";
    window.print();
</script>
        </div>
<script type="text/javascript">window.NREUM||(NREUM={});NREUM.info={"beacon":"bam.nr-data.net","licenseKey":"7c25058c40","applicationID":"15953619","transactionName":"ZVFaMUtZDBcHAk1ZVlwbeQZNUQ0KSRJYXFxBG1cXXV0QSxYTUF5N","queueTime":0,"applicationTime":533,"atts":"SRZZRwNDHxk=","errorBeacon":"bam.nr-data.net","agent":"js-agent.newrelic.com\/nr-686.min.js"}</script>

</body></html>