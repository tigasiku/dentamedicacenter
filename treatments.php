 <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script><main class="container" id="treatments">
	<section class="row" id="treatments-header">
		<h1>Memberikan pelayanan yang tepat untuk berbagai masalah kesehatan Anda.</h1>
		
	</section>
    <section class="row">
    	<ul>
    		    		<?php
						$qry=mysql_query("select * from service order by sort_by");
						while($row=mysql_fetch_array($qry)){
						?>
	            		<li class="col-xs-12 col-sm-4">
	            <img class="img-responsive" src="img/service/<?php echo $row['gambar'] ?>" alt="">
	            <a href="?page=treatments-details&id=<?php echo $row['id'] ?>&judul=<?php echo $row['judul'] ?>"><!-- data-toggle="modal" data-target="#myModal" -->
	                <div class="featured-text">
	                    <p class="treatment-name"><?php echo $row['judul'] ?></p>
	                    <span class="arrow-right"><i class="fa fa-external-link fa-2x"></i></span>
	                </div>
	            </a>
	         
	        </li><?php } ?>
	        		        	</ul>
    </section>
</main>
<main class="jumbotron" id="cta2">
	<section class="container text-center">
	    <section class="row">
	        <div class="col-xs-12">
	            <p>Mulai dengan membuat reservasi.</p>
            	<a class="btn btn-lg btn-success" href="?page=contact.us#contact">Buat Reservasi</a>
	        </div>
	    </section>
	</section>
</main>
	<?php include("home.tengah.php") ?>