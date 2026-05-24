<style>
	.img_profile {
		border:8px solid #FFf ;border-radius:150px ;  -moz-box-shadow: 0px 6px 10px  #000;-webkit-box-shadow: 0px 6px 10px  #000;
	}
</style>
 <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<main class="jumbotron" id="blog-hero">
	<section class="container">
		<section class="row">
			<div class="col-xs-12">
				<h1><?php echo str_replace("dan",'&',$_GET['judul']) ?></h1>
			
			</div>
		</section>
	</section>
</main>	<main class="container" id="team-list">
		<?php
						$qry=mysql_query("select * from dokter where divisi='".$_GET['id']."' order by sort_by");
						while($row=mysql_fetch_array($qry)){
						?>
        <section class="row">
		<div class="col-sm-offset-2 col-sm-3">
			<img class="img-responsive img_profile" src="img/dentist/thumb/<?php echo $row['gambar'] ?>" alt="<?php echo $row['nama'] ?> - <?php echo $store['store_name'] ?> <?php echo $store['profesi'] ?>" style="">
		</div>
		<div class="col-sm-5" >
			<a href="?page=team&id=<?php echo $row['id'] ?>&judul=<?php echo $row['nama'] ?>&divisi=<?php echo $_GET['judul'] ?>"><h2 style="padding-top:15%"><?php echo $row['nama'] ?></h2></a>
			
			
		</div>
	</section><?php } ?>
		
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