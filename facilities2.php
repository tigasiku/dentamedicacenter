<main class="jumbotron" id="blog-hero">
	<section class="container">
		<section class="row">
			<div class="col-xs-12">
				<h1>Our Facilities</h1>
				<p>kami menyediakan fasilitas terbaik untuk customer.</p>
			</div>
		</section>
	</section>
</main>
<main class="container" id="treatments">
	<div class="container">
				 <div class="row" style="margin-right:0;padding-bottom:30px;padding-top:30px">
                 <ul>
    		    		<?php
						$qry=mysql_query("select * from fasilitas order by sort_by");
						while($row=mysql_fetch_array($qry)){
						?>
	            		<li class="col-xs-12 col-sm-4">
	            <img class="img-responsive" src="img/fasilitas/<?php echo $row['gambar'] ?>" alt="">
	            <a href="?page=fasilitas.detail&id=<?php echo $row['id'] ?>&judul=<?php echo $row['fasilitas'] ?>"><!-- data-toggle="modal" data-target="#myModal" -->
	                <div class="featured-text" style="background:#999">
	                    <p class="treatment-name"><?php echo $row['fasilitas'] ?></p>
	                    <span class="arrow-right"><i class="fa fa-external-link fa-2x"></i></span>
	                </div>
	            </a>
	         
	        </li><?php } ?>
	        		        	</ul>
                  		</div>
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
	<?php include("home.tengah.php") ?>	