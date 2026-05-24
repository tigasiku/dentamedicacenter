<?php 
function limit_words2($string, $word_limit)
                                          		  {
														$words = explode(" ",$string);
														return implode(" ",array_splice($words,0,$word_limit));
													}
                                                    ?>
<main class="container" id="social">
		<section class="row">
			<div class="col-sm-12 col-md-6">
             	<h1 style="font-size:30px">Facebook <?php echo $store['store_name'] ?></h1>
            <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=425629260979839";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
            		
                         
                         <div class="fb-page" data-href="<?php echo ($store['store_fb']) ?>" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?php echo ($store['store_fb']) ?>"><a href="<?php echo ($store['store_fb']) ?>"><?php echo ($store['store_name']) ?></a></blockquote></div></div>             
            </div>
            </div>
            <div class="col-sm-12 col-md-6" >
            
            <section class="row">
            	<div class="col-sm-12">
               	<h1 style="font-size:30px"><?php echo $store['store_name'] ?> Article</h1>
                </div>
            </section>
            	 <?php 
					  
						$qry=mysql_query("select * from berita order by tanggal desc limit 3");
						while($row=mysql_fetch_array($qry)) {
					  ?>
            		<section class="row blog">
                    <div class="col-sm-5">
                        	<img src="img/blog/<?php echo $row['gambar'] ?>" alt="Post Title" style="width:100%;margin-top: 20px;">		</div>
                    <div class="col-sm-7">
                        <a href="?page=news-details&id=<?php echo $row['id'] ?>&judul=<?php echo $row['judul'] ?>" class=""><h2 class="blog-title" style="font-size:20px"><?php echo $row['judul'] ?></h2></a>
                        <p class="title" style="font-size:11px">Published in <?php echo date("d M, Y",strtotime($row['tanggal'])) ?> .</p>
                        <p class="description"><?php 
									
									$str=str_replace('<div>', '<span>', $row['isi_berita']);
									$text=str_replace('</div>', '</span>', $str);
									?>
                                    <?php echo limit_words2(trim(strip_tags($text)),14); ?></p>
                        <p><a href="?page=news-details&id=<?php echo $row['id'] ?>&judul=<?php echo $row['judul'] ?>" class="btn btn-primary btn-xs">Read More »</a></p>
                    </div>
                </section><?php } ?>
            </div>
		</section>
</main>