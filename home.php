
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
   
        
             <div id="wowslider-container1" style="z-index:0">
			<div class="ws_images"><ul>
     <?php 
	 $query=mysql_query("select * from slide order by id");
	 while($data=mysql_fetch_array($query)){
	 ?>
    <li><img src="img/slides/<?php echo $data['gambar'] ?>" alt="header_images_11" title="<?php echo $data['judul'] ?>"  id="wows1_0"/></li>
     <?php } ?>
      

</ul></div>
</div>
      


<main class="container" id="featured" style="z-index:99999">
    <section class="row"  >
        <div class="col-xs-12 col-sm-3">
            <img class="img-responsive" src="img/diana-dental-care-treatments.jpg" alt="Diana Dental Care Treatments">
            <a href="?page=treatments">
                <div class="featured-text">
                    <h2><span>See Our</span>Treatments</h2>
                    <span class="arrow-right"><i class="fa fa-chevron-circle-right fa-2x"></i></span>
                </div>
            </a>
        </div>
        <div class="col-xs-12 col-sm-3">
            <img class="img-responsive" src="img/diana-dental-care-team.jpg" alt="Diana Dental Care Team">
            <a href="?page=about.us">
                <div class="featured-text">
                    <h2><span>See Our</span>Team</h2>
                    <span class="arrow-right"><i class="fa fa-chevron-circle-right fa-2x"></i></span>
                </div>
            </a>
        </div>
        <div class="col-xs-12 col-sm-3">
            <img class="img-responsive" src="img/our_fasilitas.jpg" alt="Diana Dental Care Treatment Room">
            <a href="?page=facilities">
                <div class="featured-text">
                    <h2><span>See Our</span>Facilities</h2>
                    <span class="arrow-right"><i class="fa fa-chevron-circle-right fa-2x"></i></span>
                </div>
            </a>
        </div>
        <div class="col-xs-12 col-sm-3">
            <img class="img-responsive" src="img/diana-dental-care-treatment-room.jpg" alt="Diana Dental Care Treatment Room">
            <a href="?page=contact.us">
                <div class="featured-text">
                    <h2><span>See Our</span>Location</h2>
                    <span class="arrow-right"><i class="fa fa-chevron-circle-right fa-2x"></i></span>
                </div>
            </a>
        </div>
    </section>
</main>
<main class="container text-center" id="cta1">
    <section class="row">
        <div class="col-xs-12">
            <p>Start by making an appointment today.</p>
            <a class="btn btn-lg btn-success" href="https://api.whatsapp.com/send?phone=<?php echo gantiformat($store['store_fax']) ?>">Make an Appointment</a>
        </div>
    </section>
</main>
<main class="jumbotron" id="testimonial">
    <div id="carousel-testimonial" class="carousel slide" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
                    <?php 
					$testimoni=mysql_query("select * from  testimoni order by sort_by");
					while($test2=mysql_fetch_array($testimoni)){
					?>
                    
            <div class="item <?php if($test2['sort_by']==0) echo "active" ?>">
              <img src="img/jadwal/<?php  echo $test2['isi'] ?>" alt="image" style="width:95%;max-width:370px">
               
            </div>
            <?php } ?>
                        
                        
 </div> 

        <!-- Indicators -->
        <div class="row">
            <div class="col-md-offset-6 col-md-1">
                <ol class="carousel-indicators">
                     <?php 
					$testimoni=mysql_query("select * from  testimoni order by sort_by");
					while($test2=mysql_fetch_array($testimoni)){
					?>
                    
          
         
                                        <li data-target="#carousel-testimonial" data-slide-to="<?php  echo $test2['sort_by'] ?>" <?php if($test2['sort_by']==1) echo "active" ?>></li> <?php } ?>
                                    </ol>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-testimonial" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-testimonial" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
  
</main>
	<?php include("home.tengah.php") ?>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
	<script type="text/javascript" src="engine1/wowslider.js"></script>
    	<script type="text/javascript" src="engine1/script.js"></script>