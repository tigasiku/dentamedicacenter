 <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script><?php 
include("counter.artikel.php");
initCounter2();
$qry=mysql_query("select * from berita where id='".$_GET['id']."'");
$row=mysql_fetch_array($qry);
?>
        <!-- Page Title -->
		<link rel="stylesheet" href="css/main-artikel.css">
        
        <div class="section">
	    	<div class="container">
				<div class="row">
					<!-- Blog Post -->
					<div class="col-sm-8" style="background-color:#FFF;">
                    <div class="row" style=";padding:0px 10px 0px 10px">
						<div class="blog-post blog-single-post" style="margin-top:0">
							<div class="single-post-title">
								<h2 style="color:#333"><?php echo $row['judul'] ?></h2>
							</div>

							<div class="product-image-large">
								<img src="img/blog/<?php echo $row['gambar'] ?>" alt="<?php echo $row['judul'] ?>" width="100%">
							</div>
							<div class="row">
                           <div class="col-sm-9" style="margin-bottom:20px">  <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=186172124731714";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
                           	<div id="fb-root"></div>
	                    		
   
                             <div class="fb-like" data-href="<?php echo ($store['store_fb']) ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                                                         
                            <a style="margin-top:5px" href="<?php echo ($store['store_twitter']) ?>" class="twitter-follow-button" data-show-count="false">Follow <?php echo str_replace("https://twitter.com/","@",$store['store_twitter']); ?></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>	
							<!-- Place this tag in your head or just before your close body tag. -->
							
                            <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//<?php echo str_replace("https://","",$store['store_google']) ?>" data-rel="publisher"></div>
                            
                            <!-- Place this tag after the last widget tag. -->
                            <script type="text/javascript">
                              (function() {
                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                po.src = 'https://apis.google.com/js/platform.js';
                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                              })();
                            </script>

                            </div>
                            
                            <div class="col-sm-12" align="right"><?php echo date("d M, Y",strtotime($row['tanggal'])) ?></div>
                           </div>
<div class="col-sm-12" align="center">
        <!-----separator----->
						<?php 
                        function limit_words($string, $word_limit)
						{
							$words = explode(" ",$string);
							return implode(" ",array_splice($words,0,$word_limit));
						}
						?> 				
						<span style="color:#333;font-size:20px">Share :</span>			
                  <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $encoded_url; ?>" class="sm-share btn btn-facebook" title="Facebook" style=";font-weight:bold;font-size:15px;text-align:center"><i class="fa fa-facebook" style="color:#FFF"></i></a> 
           
        <a href="https://plus.google.com/share?url=<?php echo $encoded_url; ?>"  class="sm-share  btn btn-googleplus" title="Google+" style="font-weight:bold;font-size:15px;text-align:center"><i class="fa fa-google-plus" style="color:#FFF"></i></a>
     								
                                          
        <a href="https://twitter.com/intent/tweet?url=<?php echo $encoded_url; ?>&text=<?php echo limit_words ($row['judul'],10) ?>" class="sm-share  btn btn-twitter" title="Twitter" style="font-weight:bold;font-size:15px;text-align:center !important"><i class="fa fa-twitter" style="color:#FFF"></i></a>
     								 
                                          
        <a href="https://www.pinterest.com/pin/create/button/?url=<?php echo $encoded_url; ?>&media=<?php echo "http://www.tigasiku.com/img/".$gambar_og ?>&description=<?php echo ($deskripsi_og) ?>"   class="sm-share   btn btn-pinterest" title="Twitter" style="font-weight:bold;font-size:15px;text-align:center !important"><i class="fa fa-pinterest" style="color:#FFF"></i></a>
     								 
                                          
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $encoded_url; ?>"   class="sm-share   btn btn-linkedin" title="Linkedin" style="font-weight:bold;font-size:15px;text-align:center !important"><i class="fa fa-linkedin" style="color:#FFF"></i></a>
            
          
            					
     								  </div>
                                    
                                      
								
                                      
									
                 		  <div class="col-sm-12"><hr></div>
							<div class="single-post-content" >
								<div style="color:#404040 !important">
									<?php 
									$str=str_replace("/<\/?div[^>]*\>/i", '<span>', $row['isi_berita']);
									$text=str_replace("/<\/?div[^>]*\>/i", '</span>', $str);
									?>
                                    <?php echo ($text)  ?>
								</div>
							</div>
                          
						
                          <div class="fb-comments" data-href="<?php echo $actual_link ?>"  data-mobile="Auto-detected" data-width="100%"  data-numposts="5" ></div>
                     		  
						</div>
					</div>
                    </div>
					<!-- End Blog Post -->
					<!-- Sidebar -->
					<div class="col-sm-4 blog-sidebar" style="background-color:#FFF;">
						<h4>Search News</h4>
						<form action="?page=search-news" method="post">
							<div class="input-group">
								<input class="form-control input-md" id="appendedInputButtons" type="text" name="cari">
								<span class="input-group-btn">
									<button class="btn btn-md btn-primary"  type="submit">Search</button>
								</span>
							</div>
						</form>
						<h4>Recent Posts</h4>
						<ul class="recent-posts">
							<?php
							$qry=mysql_query("select * from berita order by tanggal desc limit 5") ;
							while($row=mysql_fetch_array($qry)){
							?>
                            <li><a href="?page=news-details&id=<?php echo ($row['id']) ?>&judul=<?php echo $row['judul'] ?>"><?php echo ($row['judul']) ?></a></li>
							<?php } ?>
						</ul>
					
						<h4>Archive</h4>
						<ul>
							<?php
							$qry=mysql_query("select * from berita group by month(tanggal) order by tanggal desc limit 12") ;
							while($row=mysql_fetch_array($qry)){
							?>
                            <li><a href="?page=news&archive&bulan=<?php echo date("m",strtotime($row['tanggal'])) ?>&tahun=<?php echo date("Y",strtotime($row['tanggal'])) ?>"><?php echo date("F Y",strtotime($row['tanggal'])) ?></a></li>
							<?php } ?>
						</ul>
					</div>
					<!-- End Sidebar -->
				</div>
			</div>
	    </div>

	    <!-- Footer -->
	    

        <!-- Javascripts -->
		
		<!-- Scrolling Nav JavaScript -->

    </body>
</html>