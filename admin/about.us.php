 <script type="text/javascript" src="engine1/jquery.js"></script><style>
	.img_profile {
		border:8px solid #FFf ;border-radius:150px ;  -moz-box-shadow: 0px 6px 10px  #000;-webkit-box-shadow: 0px 6px 10px  #000;
	}
</style>
<main class="jumbotron" id="about-hero" style="display:none">
	<section class="container">
		<section class="row">
			<div class="col-xs-12">
				<h1 style="color:#333">Kami adalah para profesional yang berdedikasi tinggi.</h1>
			</div>
		</section>
	</section>
	<img class="img-responsive " src="img/team-diana-dental-care.jpg" alt="Diana Dental Care Team" style="">
</main>
<main class="jumbotron" id="blog-hero">
	<section class="container">
		<section class="row">
			<div class="col-xs-12">
				<h1>Divisi</h1>
				
			</div>
		</section>
	</section>
</main>
<main class="container" id="treatments">
	<div class="container">
				 <div class="row" style="margin-right:0;padding-bottom:30px;padding-top:30px">
                 <ul>
    		    		<?php
						$qry=mysql_query("select * from divisi order by sort_by");
						while($row=mysql_fetch_array($qry)){
						?>
	            		<li class="col-xs-12 col-sm-4">
	         
	            <a href="?page=divisi&id=<?php echo $row['id'] ?>&judul=<?php echo $row['divisi'] ?>"><!-- data-toggle="modal" data-target="#myModal" -->
	                <div class="featured-text" style="background:#0082cb">
	                    <p class="treatment-name"><?php echo $row['divisi'] ?></p>
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