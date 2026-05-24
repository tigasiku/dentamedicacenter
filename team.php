 <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<style>
	.img_profile {
		border:8px solid #FFf ;border-radius:10px ;  -moz-box-shadow: 0px 6px 10px  #000;-webkit-box-shadow: 0px 6px 10px  #000;
	}
	.img_profile2 {
		border:8px solid #FFf ;border-radius:110px ;  -moz-box-shadow: 0px 6px 10px  #000;-webkit-box-shadow: 0px 6px 10px  #000;
	}
</style>

<main class="jumbotron" id="blog-hero">
	<section class="container">
		<section class="row">
			<div class="col-xs-12">
				<h1><?php echo $_GET['divisi'] ?></h1>
			
			</div>
		</section>
	</section>
</main>
	<main class="container" id="team-list">
		<?php
						$qry=mysql_query("select * from dokter where id='".$_GET['id']."' order by sort_by");
						$row=mysql_fetch_array($qry);
						?>
        <section class="row">
        <div class="col-sm-12"  align="center">
			<h2 style="padding-bottom:30px"><?php echo $row['nama'] ?></h2>
			
			
		</div>
		<div class="col-sm-12" align="center">
			<img class="img-responsive img_profile" src="img/dentist/full/<?php echo $row['gambar_body'] ?>" alt="<?php echo $row['nama'] ?> - <?php echo $store['store_name'] ?> <?php echo $store['profesi'] ?>" style="">
		</div>
		
        	
	</section>
		
</main>
<main class="container" id="team-list">
<legend style="font-size:34px">Other</legend>
		<?php
						$qry=mysql_query("select * from dokter where divisi='".$row['divisi']."' and id<>'".$_GET['id']."'  order by sort_by");
						while($row=mysql_fetch_array($qry)){
						?>
      <div class="col-sm-6">
		<div class="col-sm-4">
			<img class="img-responsive img_profile2" src="img/dentist/thumb/<?php echo $row['gambar'] ?>" alt="<?php echo $row['nama'] ?> - <?php echo $store['store_name'] ?> <?php echo $store['profesi'] ?>" style="">
		</div>
		<div class="col-sm-8">
			<a href="?page=team&id=<?php echo $row['id'] ?>&judul=<?php echo $row['nama'] ?>&divisi=<?php echo $_GET['judul'] ?>"><h2 style="padding-top:10%"><?php echo $row['nama'] ?></h2></a>
			
		</div>
        </div>
	<?php } ?>
		
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
	
    