  <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
 <main class="jumbotron" id="blog-hero">
	<section class="container">
		<section class="row">
			<div class="col-xs-12">
				<h1><?php echo $store['store_name'] ?> Article</h1>
				<p>Kami gemar berbagi tips dan trik untuk memperindah senyuman anda. Ikuti kami di Instagram dan Facebook.</p>
			</div>
		</section>
	</section>
</main>
	<div class="container">
 <div class="row" style="margin-right:0;padding-bottom:30px">
                      <?php 
					  	$limit = 4;
                        if(isset($_GET['hal'])){
                       	$hal = $_GET['hal'];
                        }
                        else{
                        $hal = 1;
                        }
             function limit_words($string, $word_limit)
                                          		  {
														$words = explode(" ",$string);
														return implode(" ",array_splice($words,0,$word_limit));
													}
                        $offset = ($hal - 1) * $limit;
                        $i=1;
						   if(isset($_GET['archive'])) {
                                            $qry=mysql_query("select * from berita where month(tanggal)='".$_GET['bulan']."' and year(tanggal)='".$_GET['tahun']."' order by id desc limit  $offset, $limit");}else{
						$qry=mysql_query("select * from berita order by tanggal desc limit  $offset, $limit");}
						while($row=mysql_fetch_array($qry)) {
					  ?>
					<div class="col-sm-6">
						<div class="blog-post blog-single-post">
							<div class="single-post-title">
								<a href="?page=news-details&id=<?php echo $row['id'] ?>&judul=<?php echo $row['judul'] ?>" class=""><h3><?php echo $row['judul'] ?></h3></a>
							</div>

							<div class="product-image-large" style="max-height:255.797px;overflow:hidden">
								<img src="img/blog/<?php echo $row['gambar'] ?>" alt="Post Title" style="width:100%">
							</div>
							
							<div class="single-post-info" style="padding-top:4px">
								<i class="glyphicon glyphicon-time" ></i><span style="padding-left:4px"><?php echo date("d M, Y",strtotime($row['tanggal'])) ?> </span>
							</div>
							
							<div class="single-post-content" >
								<div style="font-size:15px !important">
									<?php 
									
									$str=str_replace('<div>', '<span>', $row['isi_berita']);
									$text=str_replace('</div>', '</span>', $str);
									?>
                                    <?php echo limit_words(trim(strip_tags($text)),24); ?>
								</div>
							<a href="?page=news-details&id=<?php echo $row['id'] ?>&judul=<?php echo $row['judul'] ?>" class="btn btn-warning">Read more</a>
							</div>
						</div>
					</div>
                    <?php } ?>
					<!-- End Blog Post Excerpt -->
                    
					</div>
	</div>

<main class="jumbotron" id="cta2">
	<section class="container text-center">
	    <section class="row">
	        <div class="col-xs-12">
	            <p>Start by making an appointment today.</p>
            	<a class="btn btn-lg btn-success" href="?page=contact.us#contact">Make an Appointment</a>
	        </div>
	    </section>
	</section>
</main>
	<?php include("home.tengah.php") ?>	