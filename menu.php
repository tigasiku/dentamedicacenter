<?php
if(!isset($_GET['page'])){
	$page="home";
}else{
	$page=$_GET['page'];
}
?>
<nav class="jumbotron" id="nav-mobile" style="display: none;">
        <section class="container">
            <section class="row">
                <ul>
                   
                 <li><a class="<?php if($page=="home") echo "active" ?>" href="?page=home">Home</a></li>
                                <li>
                                    <a class="<?php if($page=="treatments" or $page=="treatments-details") echo "active" ?>" href="?page=treatments">Treatments</a>
                                    
                                </li>
                                <li>
                                    <a class="<?php if($page=="facilities" ) echo "active" ?> " href="?page=facilities">Our Facilities</a>
                                   
                                </li>
                                <li>
                                    <a class="<?php if($page=="about.us"  or $page=="team") echo "active" ?> " href="?page=about.us">About Us</a>
                                   
                                </li>
                                <li>
                                    <a class="<?php if($page=="contact.us") echo "active" ?>" href="?page=contact.us">Location</a>
                                    
                                </li>
                                <!-- <li><a class="" href="http://dianadentalcare.com/question-answer">Q & A</a></li> -->
                                <li><a class="<?php if($page=="news" or $page=="news-details") echo "active" ?>" href="?page=news">Article</a></li>
                </ul>
            </section>
        </section>
    </nav>
    <header class="jumbotron">
        <section class="row">
            <div class="col-xs-4" id="head-logo">
                <a href="http://<?php echo $store['website'] ?>"><img class="img-responsive" id="logo_menu" src="img/dentamedica.png" alt="Diana Dental Care Logo" ></a>
                <!-- <a class="lang-switcher hidden-xs" href="http://dianadentalcare.com/beranda/">ID <i class="fa fa-toggle-on"></i> EN</a> -->
            </div>
            <div class="col-sm-8 hidden-xs">
                <div class="row">
                    <div class="col-sm-12" id="head-cta">
                        <i class="fa fa-phone-square fa-2x"></i> <span><?php echo $store['store_telp'] ?></span>&nbsp; or &nbsp;<a class="btn btn-md btn-success" href="https://api.whatsapp.com/send?phone=<?php echo gantiformat($store['store_fax']) ?>">Make an Appointment</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <nav>
                            <ul>
                                <li><a class="<?php if($page=="home") echo "active" ?>" href="?page=home">Home</a></li>
                                <li>
                                    <a class="<?php if($page=="treatments"  or $page=="treatments-details") echo "active" ?>" href="?page=treatments">Treatments</a>
                                    
                                </li>
                                   <li>
                                    <a class="<?php if($page=="facilities" ) echo "active" ?> " href="?page=facilities">Our Facilities</a>
                                   
                                </li>
                           
                                <li>
                                    <a class="<?php if($page=="about.us" or $page=="team") echo "active" ?> " href="?page=about.us">About Us</a>
                                   
                                </li>
                                <li>
                                    <a class="<?php if($page=="contact.us") echo "active" ?>" href="?page=contact.us">Location</a>
                                    
                                </li>
                                <!-- <li><a class="" href="http://dianadentalcare.com/question-answer">Q & A</a></li> -->
                                <li><a class="<?php if($page=="news" or $page=="news-details") echo "active" ?>" href="?page=news">Article</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-xs-8 visible-xs text-right" id="hamburger">
                <i class="fa fa-bars fa-4x"></i>
            </div>
        </section>
    </header>