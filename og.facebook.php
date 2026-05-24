	<?php 
	$title=$store['store_name'];
	$tag_line=$store['store_tagline'];
					function getUrl() {
					$url  = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
					$url .= '://' . $_SERVER['SERVER_NAME'];
					$url .= in_array( $_SERVER['SERVER_PORT'], array('80', '443') ) ? '' : ':' . $_SERVER['SERVER_PORT'];
					$url .= $_SERVER['REQUEST_URI'];
					return $url;
					}
					// Print Share link on Page
					$encoded_url = urlencode( getUrl() );
	?>
    <meta property='og:site_name' content='<?php echo $title ?>'/>
    <meta property='og:image' content="http://<?php echo  $store['website'] ?>/img/<?php if(isset($_GET['produk'])){ 
			$qry=mysql_query("select file,spesifikasi from produk where id='".$_GET['id']."'");
           ($row=mysql_fetch_array($qry)); echo $gambar_og="portfolio/thumb/".$row['file'];  }
	 		elseif(isset($_GET['judul'])){
				   if($_GET['page']=="latest.news"){
						 echo $gambar_og="tiga-siku-footer.png";}
			  		elseif(@$_GET['page']=="ebook") {
			 	 		$qry=mysql_query("select gambar from ebook order by rand()");
          	 			($row=mysql_fetch_array($qry));
						echo $gambar_og="ebook/cover/".$row['gambar'];
		  			}
		  			elseif(@$_GET['page']=="iklan-details") {
			 			 $qry=mysql_query("select gambar1,keterangan from pasang_iklan where id_iklan='".$_GET['id']."'");
          	 			($row=mysql_fetch_array($qry));
						$keterangan_iklan=$row['keterangan'];
						echo $gambar_og="iklan_gratis/full/".$row['gambar1'];
					}
					
					else{
						$qry=mysql_query("select gambar,isi_berita from berita where id='".$_GET['id']."'");
			            ($row=mysql_fetch_array($qry));
						echo $gambar_og="blog/".$row['gambar'];}
		    		 
		 			
		  }
		   elseif(($_GET['page']=="produk-detail")){
							$qry=(mysql_query("select gambar,kategori from kategori_website where kd_kategori='".$_GET['kd_kategori']."'"));
							$row = mysql_fetch_array($qry);
							echo $gambar_og="kategori_website/".$row['gambar']."";		
			}
			elseif(($_GET['page']=="keuangan")){
						
							echo $gambar_og="banner_keuangan_tigasiku.png";		
			}
			elseif(($_GET['page']=="design.logo")){
						
							echo $gambar_og="banner_design2.png";		
			}
					
		  else{  echo $gambar_og="dentamedica2.png"; }?>" />
          
       <?php if(!isset($_GET['page']) or (@$_GET['page']=="home") ){ 
	     						 $query=mysql_query("select * from slide order by tanggal desc");
                                 while($data=mysql_fetch_array($query)){
                                 ?>
       		 
          <meta property='og:image' content="http://<?php echo  $store['website'] ?>/img/slides/<?php echo $data['gambar'] ?>"/>
          
           <?php }
		   } ?>
           
           <meta name="twitter:image:src" content="<?php echo "http://".$store['website']."/img/".$gambar_og ?>">          
		  <meta itemprop="image"  content="<?php echo "http://".$store['website']."/img/".$gambar_og ?>">        
	<meta property='og:title' content='<?php if(isset($_GET['produk'])){ echo $_GET['produk']; }
		   elseif(isset($_GET['judul'])){
			   	if((@$_GET['page'])=="iklan-details"){ 
		   			echo $judul_og=str_replace('-', ' ',$_GET['judul'])." | Iklan Gratis";}
				elseif(($_GET['page']=="theme")){
					echo $judul_og="".@str_replace('-', ' ',$_GET['judul']).@str_replace('-', ' ',$_POST['judul'])." | ".@$_GET['kategori']."";
					}	
					else{
			    	echo $judul_og=str_replace('-', ' ',$_GET['judul']);}
			}
		 	 elseif(($_GET['page']=="keuangan")){
			echo $judul_og="Laporan Keuangan ";
			}
				
		 
			
		   elseif(@$_GET['page']=="pasang.iklan" or @$_GET['page']=="iklan"){ 
		   echo $judul_og='Iklankan Bisnis anda "GRATIS"';}
		   
		   else{ echo $judul_og=$title;}?>'/>    
              <meta name="twitter:title" content="<?php echo $judul_og ?>">  
     <meta itemprop="name"  content="<?php echo $judul_og ?>"> 
	<meta property='og:description' content='<?php
		 	if(isset($_GET['produk'])){  
			$text=$row['spesifikasi'];
			echo $deskripsi_og="Deskripsi: ".trim(strip_tags($text)); }
		    elseif(isset($_GET['judul'])){
			   
				if($_GET['page']=="latest.news"){
					$qry=mysql_query("select isi_berita from news where id='".$_GET['id']."'");
           			($row=mysql_fetch_array($qry));	
					$text_news=$row['isi_berita'];

		 			echo $deskripsi_og=$title." - ".substr(trim(strip_tags($text_news)), 0, 250) .((strlen(trim(strip_tags($text_news))) > 250) ? '' : '');}
		  		elseif($_GET['page']=="iklan-details"){ 
		  			 echo $deskripsi_og=$title." - ".substr(trim(strip_tags($keterangan_iklan)), 0, 250) .((strlen(trim(strip_tags($keterangan_iklan))) > 250) ? '' : '');
		 	    }
				elseif($_GET['page']=="lowongan-details"){ 
		  			 echo $deskripsi_og=$title." - ".substr(trim(strip_tags($keterangan_lowongan)), 0, 250) .((strlen(trim(strip_tags($keterangan_lowongan))) > 250) ? '' : ''); 
		 	    }
				elseif(($_GET['page']=="theme")){
				echo $deskripsi_og=$title." - ".$tag_line;}
				
				else{ 
		  			 $text=$row['isi_berita'];
		   
		   			echo $deskripsi_og=$title." - ".substr(trim(strip_tags($text)), 0, 250) .((strlen(trim(strip_tags($text))) > 250) ? '' : ''); }
			}	
			elseif(($_GET['page']=="keuangan")){
			 echo $deskripsi_og="CBS - Segala permasalahan laporan keuangan, system akuntansi dan keuangan usaha  / bisnis anda akan kami selesaikan dengan lebih cepat dan lebih spesifik sesuai dengan kebutuhan serta keinginan anda, team kami dengan pengalaman yang memadai akan sangat membantu anda dalam menyelesaikan segala permasalahan yang timbul dalam bisnis anda.";
				} 
				 elseif(($_GET['page']=="design.logo")){
			 echo $deskripsi_og="Logo adalah identitas, logo adalah kesan pertama brand anda! Belum ada cerita sebuah brand besar tanpa logo. Logo adalah jaminan bagi customer bahwa ia memiliki brand.";
		 }
			else{ echo $deskripsi_og=$title." - ".$tag_line;}?>'/>
                <meta name="twitter:description" content="<?php echo $deskripsi_og ?>">
            <meta itemprop="description" content="<?php echo $deskripsi_og ?>">
 
     <meta property='og:type' content='website'/>   
    
       
     <meta property="og:url"
content="<?Php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

 echo $actual_link ?>" />
 <meta name="twitter:card" content="summary_large_image">