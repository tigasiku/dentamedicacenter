
	
<footer id="main-footer" class="jumbotron">
		<section class="container">
			<section class="row">
				<div class="col-sm-4">
					<img src="img/logo_footer.png" alt="Diana Dental Care Logo">
					<!-- <p>Diana dental care is </p> -->
				
				</div>
				<div class="col-sm-4">
					<h3>Be in the know</h3>
					<p>Sign up for news & updates.</p>
                    	<a href="<?php echo $store['store_fb'] ?>" target="_blank"><img src="img/icons/facebook.png" width="42" alt="Facebook"></a>
                                                            <a href="<?php echo $store['store_twitter'] ?>" target="_blank"><img src="img/icons/twitter.png" width="42" alt="Twitter"></a>
                                                      
                                                            <?php if(!empty($store['store_linkedin'])){ ?>
                                                            <a href="<?php echo $store['store_linkedin'] ?>" target="_blank" ><img src="img/icons/linkedin.png" height="45" alt="Linkedin"></a><?php } ?>
                                                            <?php if(!empty($store['store_pinterest'])){ ?>
                                                            <a href="<?php echo $store['store_pinterest'] ?>" target="_blank" ><img src="img/icons/pinterest.png" height="45" alt="Pinterest"></a><?php } ?>
                                                             <?php if(!empty($store['store_instagram'])){ ?>
                                                            <a href="<?php echo $store['store_instagram'] ?>" target="_blank" ><img src="img/icons/Instagram.png" height="45" alt="Instagramt"></a><?php } ?>
				</div>
				<div class="col-sm-4">
					<address>
						<h3>Mailing Address</h3>
						<em><?php echo $store['store_name'] ?></em><br>
						<?php echo $store['store_address'] ?><br><br>
					
						Telephone: <?php echo $store['store_telp'] ?><br>
                        WA: <a href="https://api.whatsapp.com/send?phone=<?php echo gantiformat($store['store_fax']) ?>" style="font-weight:bold"><?php echo ($store['store_fax']) ?></a><br>
						Email: <a href="mailto:<?php echo $store['store_email'] ?>" target="_top"><?php echo $store['store_email'] ?></a>
					</address>
				</div>
			</section>
		</section>
	</footer>