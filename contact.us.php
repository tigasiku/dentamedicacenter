<script src='https://www.google.com/recaptcha/api.js' async defer></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>

<section class="jumbotron mega-menu" id="mega-menu-location">
        <section class="row">
            <div class="col-md-4 col-md-offset-2 col-lg-4 col-lg-offset-1" id="text">
              <?php // <h3>We are located in the center of South Jakarta.</h3> ?>
                <p class="mega-menu-links"><a href="http://dianadentalcare.com/location/">See our location detail <i class="fa fa-chevron-circle-right"></i></a></p>
            </div>
            <div class="col-md-6 col-lg-7">
                <img class="img-responsive" src="./Diana Dental Care Location_files/mega-menu-location.jpg" alt="Diana Dental Care Location">
            </div>
        </section>
    </section>
    <main class="jumbotron" >
	<section class="container-fluid " >
    <div class="row">
		<div id="google-maps">
			<div id="map-overlay" onclick="style.pointerEvents=&#39;none&#39;"></div>
			<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php
						 
						   echo $store['store_geocode'];
						  ?>"></iframe>
							<br />
							<small>
								<a href="<?php  echo $store['store_geocode'];;?>"></a>
							</small>
							</iframe>
		</div></div>
	</section>
	<section class="container"	style="padding:30px">
		<section class="row">
			<div class="col-xs-12">
			  <?php // 	<h1>We are located in the middle of South Jakarta.</h1> ?>
			  <?php //	<p class="visible-xs text-center">Optik Melawai Building 1st Floor,<br>Jalan Wijaya 1 No.65,<br>Jakarta Selatan.</p>?>
			</div>
		</section>
	</section>
</main>
<main class="container" id="cta3" >
	<section class="row">
		<div class="col-xs-12">
	
            <p class="text-center">Datang ke klinik kami dengan reservasi terlebih dahulu, telepon <?php echo $store['store_telp'] ?>7 atau isi form di bawah ini dan biarkan kami yang menghubungi anda:</p>
           
			<div   lang="en-US" dir="ltr">
<div ></div>
<?php /*
<form action="simpan.contact.php" method="post" >

<div class="col-sm-6" id="first">
    <span class="wpcf7-form-control-wrap your-name"><input type="text" name="nama" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" required id="name" aria-required="true" aria-invalid="false" placeholder="Your name"></span><br><p></p>
<div class="col-xs-6 sub-first">
        <span class="wpcf7-form-control-wrap your-phone"><input type="tel" name="hp" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-tel" required id="phone" aria-invalid="false" placeholder="Your phone"></span>
    </div>
<div class="col-xs-6 sub-first second-sub-first">
	<span class="wpcf7-form-control-wrap your-email">
    
    <input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" id="email" aria-required="true" aria-invalid="false" required placeholder="Your email"></span>
    </div>
</div>
<div class="col-sm-3" id="second">
    <span class="wpcf7-form-control-wrap reason"><textarea name="deskripsi" cols="0" rows="0" class="wpcf7-form-control wpcf7-textarea" id="reason" aria-invalid="false" required placeholder="Reason for appointment"></textarea></span>
</div>
<div class="col-sm-3"  id="third">
    
        <div class="g-recaptcha" data-sitekey="6Lf6LY4UAAAAACWFL1rBFg_StXqwJNBSHjYx3dvX"></div>
    <input type="button" value="Make an Appointment" class="wpcf7-form-control wpcf7-submit btn btn-md btn-success"id="submitButton" > </div><p></p>
<p id="disclaimer">Your information would not be shared to others.</p>
</div>
<div class="clearfix"></div> <?php /*?>

<script src="admin/js/scriptcap.js"></script>

</form></div>		</div>
	</section>
	<section class="row">
		<div class="col-xs-12">
		
		</div>
	</section>
</main>
	<?php include("home.tengah.php") ?>