 	
    <meta name="description" content="<?php
		 if(isset($_GET['produk'])){  $str=str_replace('<div>', '<span>', $row['spesifikasi']);
									$str=str_replace('<b>', ' ', $str);
									$str=str_replace('<p>', ' ', $str);
									$str=str_replace('</p>', ' ', $str);
									$str=str_replace('</b>', ' ', $str);
									$str=str_replace('<br>', ' ', $str);
									$str=str_replace('</br>', ' ', $str);
									$str=str_replace('<strong>', ' ', $str);
									$text=str_replace('</div>', '</span>', $str);
	 		echo $_GET['produk']." - ".substr(trim(strip_tags($text)), 0, 250) .((strlen(trim(strip_tags($text))) > 250) ? '' : ''); }
		   elseif(isset($_GET['judul'])){
			if($_GET['page']=="latest.news"){
			
				echo "Blibuku"." - ".substr(trim(strip_tags($text_news)), 0, 250) .((strlen(trim(strip_tags($text_news))) > 250) ? '' : '');;
			 }
			 elseif($_GET['page']=="iklan-details"){ 
		  			 echo "Blibuku"." - ".substr(trim(strip_tags($keterangan_iklan)), 0, 250) .((strlen(trim(strip_tags($keterangan_iklan))) > 250) ? '' : '');
		 	    }
			 elseif(@$_GET['page']=="lowongan-details") {
				echo "Blibuku"." - ".substr(trim(strip_tags($keterangan_lowongan)), 0, 250) .((strlen(trim(strip_tags($keterangan_lowongan))) > 250) ? '' : ''); 
			 }
			 else{
		    echo "Blibuku"." - ".substr(trim(strip_tags($text)), 0, 250) .((strlen(trim(strip_tags($text))) > 250) ? '' : ''); }}	
		 elseif(($_GET['page']=="design.logo")){
			 echo "Logo adalah identitas, logo adalah kesan pertama brand anda! Belum ada cerita sebuah brand besar tanpa logo. Logo adalah jaminan bagi customer bahwa ia memiliki brand.";
		 }
		elseif(($_GET['page']=="keuangan")){
			 echo "Blibuku - Segala permasalahan laporan keuangan, system akuntansi dan keuangan usaha  / bisnis anda akan kami selesaikan dengan lebih cepat dan lebih spesifik sesuai dengan kebutuhan serta keinginan anda, team kami dengan pengalaman yang memadai akan sangat membantu anda dalam menyelesaikan segala permasalahan yang timbul dalam bisnis anda.";
	}
	else{ echo $title." - ".$tag_line;}?>">
    <meta name="author" content="">
    <meta name="keywords" content="<?php  if(isset($_GET['produk'])){
		 echo $_GET['produk']; }else{ echo "Buku,Blibuku, Buku Islam,Buku Teknologi,Graha Media"; }?>" />
   <title><?php
    if(isset($_GET['page'])) { 
	
	if(($_GET['page']=="produk-details")) { echo "".ucfirst($_GET['produk'])." | "; }
	
	elseif(isset($session_sub_kategori)){
	echo $session_sub_kategori." | ";
	}
	
	elseif(isset($session_kategori)){
	echo $session_kategori." | ";
	}
	elseif(($_GET['page']=="produk")){
	echo "WEB & TOKO ONLINE | ";
	}
	
	elseif(($_GET['page']=="news")){
			echo "Artikel | ";
	}
	
	elseif(($_GET['page']=="news-details")){
			echo "".ucfirst(str_replace('-', ' ',$_GET['judul']))." | Artikel ";
			}
	elseif(($_GET['page']=="about-us")){
			echo "Tentang Kami | ";
			}
		
	else{ 
	
	echo "".ucfirst(str_replace("."," ",($_GET['page'])))." | ";} }
	
	 ?>
    <?php echo $title ?></title>