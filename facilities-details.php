
	<script type="text/javascript" src="fb/jquery.js"></script>
   <link rel="stylesheet" href="fb/jquery.fancybox.css?v=2.1.0" type="text/css" media="screen" />
		<script type="text/javascript" src="fb/jquery.fancybox.pack.js?v=2.1.0"></script>
		<script type="text/javascript">$(document).ready(function() {
				/*
				 *  Simple image gallery. Uses default settings
				 */

				$('.fancybox').fancybox();
			});
		</script>		
        		
<main class="jumbotron" id="blog-hero">
	<section class="container">
		<section class="row">
			<div class="col-xs-12">
				<h1><?php echo $_GET['judul'] ?></h1>
				
			</div>
		</section>
	</section>
</main>
<main class="container" id="treatments">
	<div class="container">
				 <div class="row" style="margin-right:0;padding-bottom:50px;padding-top:30px">
<?php
                                    $gallery=mysql_query("SELECT file FROM fasilitas_detail where fasilitas ='".$_GET['id']."'");
                                    $i=1;
										$no=1;$i=1;
                                    while($photo=mysql_fetch_array($gallery)){
                                    ?>
                                 
                                    <div class="col-sm-3 " style="max-height:170px;overflow:hidden;padding-left:3px;padding-right:3px;margin-bottom:6px;">
                                        
                                        <div  >
                                            <!-- Team Member Photo -->
                                            <a class="fancybox" href='img/fasilitas/full/<?php echo $photo['file'] ?>'
                        data-fancybox-group="gallery" ><img src="img/fasilitas/thumb/<?php echo ''.$photo['file'] ?>"  style="width:100%;height:100%;overflow:hidden" ></a>
                        				</div>
                                    </div>
						<?php } ?>                  		</div>
	</div>
</main>
    
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
<?php include("home.tengah.php"); ?>
       <script src="js/bootstrap.min.js"></script>
		
		<!-- Scrolling Nav JavaScript -->
		<script src="js/jquery.easing.min.js"></script>
		<script src="js/scrolling-nav.js"></script>		
		
		<!-- Portfolio Thumbnail Hover Effect JavaScript -->
		<script type="text/javascript" src="js/jquery.hoverdir.js"></script>	
		<script type="text/javascript">
			$(function() {
			
				$(' #da-thumbs > li ').each( function() { $(this).hoverdir(); } );

			});
		</script>
		
