<!DOCTYPE html>
<html>
<?php									
session_start();
date_default_timezone_set('Asia/Makassar');
include("koneksi.php");
include("function.php");
$_SESSION['judul_project_graha']="Tiga Siku";
$_SESSION['judul_graha']=$store['store_name'];
if(!isset($_COOKIE["type"])){
	include "form-login.php";
}else{

?>
<head> 
    <script type="text/javascript"> 
function chat(){
nama="<?php echo $_SESSION['nama_graha'] ?>";
if(document.getElementById('set').click()){
	document.getElementById('chatuser').value=nama;
}
}
</script>
    <script>
	function valid(){
	document.getElementById('notif').innerHTML=document.getElementById('notifikasi').value;
	document.getElementById('label').innerHTML=document.getElementById('notifikasi').value;
	}
	
window.onload=valid;
	</script>
       <script>
 function ShowLoading(e) {
        var div = document.createElement('div');
        var img = document.createElement('img');
		img.width = "50";
        img.src = 'page-loader.gif';
        div.innerHTML = "Loading...<br />";
        div.style.cssText = 'position: fixed; top: 2px; z-index: 5000; width: 100%; height:100% ;text-align: center; background-color: rgba(0, 0, 0, 0.50)';
        div.appendChild(img);
        document.body.appendChild(div);
        return true;
        // These 2 lines cancel form submission, so only use if needed.
        //window.event.cancelBubble = true;
        //e.stopPropagation();
    }


</script>
  <noscript><style type="text/css">#loading { display: none; }</style></noscript>
  
        <meta charset="UTF-8">
        <title><?php echo $_SESSION['judul_project_graha'] ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" href='img/icon.png'>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.css" integrity="sha512-OGEqg3WzzTepW16E0a9vF4cqgSJK13Y795hk5pyAXyb9hftBZ3q6DiqXsSHmuCWTkNuq8jt09erCDfkXYCdxDw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.0.1/css/datepicker.min.css" integrity="sha512-aC0a6+fMXUtxpvh4lfVpfLxES0n1SzDdyym7WXH2AJ9MBjkLbfHc+fgeqaKjeMKHJosOlKi9JxvuRFK5eMbG4g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    
    <body class="fixed skin-black" onload="validate2()">
       <div id="loading"></div> <header class="header"> <style>
		#loading {
    background: url(download.gif) no-repeat scroll 50% 10% #FFF;
    height: 100%;
    left: 0;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 999999;
}
				   @media screen and (max-width: 560px){
					.logo {
					   display:none !important;

					}}
		 @media screen and (min-width: 560px){
					.logo2 {
					   display:none !important;

					}}
			   </style>
           <a href="index.php" class="logo">
               
              
               
                <img src="img/logo2.png" style="height:45px;margin-top:-5px;margin-left:-15px;" > &nbsp;</a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>	<a href="index.php" class="logo2">   <img src="img/logo2.png" style="height: 30px;
    margin-top: -8px;
    margin-left: -9px;" > &nbsp;</a>
                <style>
			
				   @media screen and (min-width: 300px and max-width: 559px)
				   
				   {
					.logo2 {
					   display:inline-block !important;

					}}
		
			   </style>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <!-- Notifications: style can be found in dropdown.less -->									
							
                        
                        <!-- User Account: style can be found in dropdown.less --> 
                     
                     <!-- <li class="dropdown  ">
                        <a class="btn tip dropdown" title=""  href="#"  data-original-title="Calculator" >
                            <i class="fa fa-calculator"></i>
                        </a>
                        <ul class="dropdown-menu pull-right ">
                          <div class="dropdown-content"  id="basicCalculator">
                     
						  </div>
                       
                        </ul>
                    </li>--> 
                        <li class="dropdown user user-menu hilang2" >
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php  echo $_SESSION['nama_graha']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-black">
                                    <img src="<?php 
									if(!empty($_SESSION['photo'])){
										echo 
										"photo/".$_SESSION['photo']."";
									}else{
										echo "img/avatar2.png";
									}
									?>" class="img-circle" alt="User Image" onclick="window.open('?page=ganti.photo','_top')" />
                                    <p><?php echo $_SESSION['nama_graha'];?> - <?php echo $_SESSION['loglevel_graha3']; ?>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
									<a href='?page=ganti.pass' class='btn btn-default btn-flat'>Ganti Password</a>
									</div>
                                    <div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat" onclick="delCookie('name_c')"> Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left"      >
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar" >
                    <!-- Sidebar user panel -->
                    <div class="user-panel" >
                        <div class="pull-left image" 
						<?php
						if($_SESSION['loglevel_graha3']!="Administrator"){

							if (strlen($_SESSION['nama_graha'])>10){
							echo "style='padding-top:10px;'";
							}else{
							echo "style='padding-top:2px;'";
							}
						}else{
							echo "style='padding-top:2px;'";
						}
						?>
						><img src="<?php 
									if(!empty($_SESSION['photo'])){
										echo 
										"photo/".$_SESSION['photo']."";
									}else{
										echo "img/avatar2.png";
									}
									?>" class="img-circle" alt="User Image" /></div>
                        <div class="pull-left info">
                            <p>Hello, 
							<?php 
						
								if (strlen($_SESSION['nama_graha'])>10){ echo "<br>";}
								echo $_SESSION['nama_graha'];
						
							?> 
							</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div> </div>
                      <?php
						include "menu.php";
					?>
                   
                    
                       <!-- sidebar menu: : style can be found in sidebar.less --><script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js" integrity="sha512-qp27nuUylUgwBZJHsmm3W7klwuM5gke4prTvPok3X5zi50y3Mo8cgpeXegWWrdfuXyF2UdLWK/WCb5Mv7CKHcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
			
                </section>		
                <!-- /.sidebar -->  
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->

            <?php  if(isMobile()){ ?>   <style>
			.small-box h3 {
						font-size: 30px !important;
						font-weight: 700;
						margin: 0 0 10px;
						white-space: nowrap;
						padding: 0;
					}
			</style><?php } ?>
            <aside class="right-side">                
                <?php
					include "konten.php";
				?>
            </aside><!-- /.right-side -->
           
            <script>
 $(document).ready(function() {
        $('.hilang').click(function() {
                $('.hilang2').slideToggle("fast");
        });
    });
</script>
        </div><!-- ./wrapper -->
<!--Start of Zopim Live Chat Script-->
		  <?php
					if(isMobile()){	include "menu-bottom.php"; }
					?>
				
		<script>
	
 

						  $('a.dropdown').on('click', function () {
 $(this).parent().toggleClass('open'); 
});
						  
					
						 
        $(window).load(function () {
            $("#loading").fadeOut("slow");
        });
   
		
		$(function(){
		$('#dp1').datepicker({
				format: 'yyyy-mm-dd'
		});
        $("[data-mask]").inputmask();
		
		});
		$(function(){
			$("#datepicker1").datepicker( {
			format: "yyyy-mm",
			viewMode: "months", 
			minViewMode: "months"
			});
			 $("[data-mask]").inputmask();
		});	
		$(function(){
		$('#dp2').datepicker({
				format: 'yyyy-mm-dd'
		});
        $("[data-mask]").inputmask();
		
		});
		$(function(){
		$('#mk').datepicker({
				format: 'yyyy-mm-dd'
		});
        $("[data-mask]").inputmask();
		
		});
		$(function(){
		$('#kb').datepicker({
				format: 'yyyy-mm-dd'
		});
        $("[data-mask]").inputmask();
		
		});
		$(function(){
		$('#bk').datepicker({
				format: 'yyyy-mm-dd'
		});
        $("[data-mask]").inputmask();
		
		});
			$(function(){
		$('#tis').datepicker({
				format: 'yyyy-mm-dd'
		});
        $("[data-mask]").inputmask();
		
		});
			 $(".timepicker").timepicker({
                    showInputs: false ,showMeridian: false 
					 
 });

		function readURL(input) {
			if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			//document.getElementById("img_prev").style.display = "";
			
			reader.onload = function (e) {
			$('#img_prev')
			.attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
			}
		}
		</script>
        <!-- jQuery 2.0.2 -->
        <script type="text/javascript">

$(window).load(function(){
    var nama="<?php echo $_SESSION['nama_graha'] ?>";
	$('#chatuser').focus();
	$('#chatuser').focus(function(){
	$('#chatuser').val(nama);
	$('#set').click()
	});
});
</script>
	
<script>
	$( document ).ready(function() {
			$( "#myelement" ).click(function() {     
				if($('#another-element:visible').length)
					$('#another-element').hide("slide", { direction: "up" }, 300);
				else
					$('#another-element').show("slide", { direction: "up" }, 300);        
			});
	});	
</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js" integrity="sha512-vO6PFSXNczuXHhdvGbOIXm67ZQlaRFjp4Wh+ARLfqPT1bVlmO1kyGrB1+7c2clk58XnsD/Cye9EJubT5B8BCgQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<!-- InputMask -->
   
       <script   src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"   integrity="sha256-lnH4vnCtlKU2LmD0ZW1dU7ohTTKrcKP50WA9fa350cE="   crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.0.0/min/jquery.inputmask.js" integrity="sha512-f+cuCxMOegonZRzV4uwGVLZkcSo8ocy8OQrAKT6EdYNMUqBKV2GbIE6Wy6+g3QwoXeuvdscJ0CjuIEhZCkhKcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.0.0/min/jquery.inputmask.date.extensions.js" integrity="sha512-F3hoiF5/ATiH06kYu82ZZfLjR/WQGVQRt4FdlnfxaTPyU06KCzWzmXMH891dgP87cswPNPEps+UfsgRN14cyRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.0.0/min/jquery.inputmask.extensions.js" integrity="sha512-9N6D7t4lQ5CKd+p3Tjrp0pVuVwQVbGk++15BrFRz6xnQI4Buxavc5qkbuNMHuUJTDo7R+DT39G/q4cAUIt12CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.js" type="text/javascript"></script>
	
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.0.1/js/bootstrap-datepicker.min.js" integrity="sha512-W6IVSxOJ7D3Kog0tWiELCpBDmt/+410JVGE2c7BXHrbDur6uLA1TTlbzZ9PesXtutbniMU4vsgR3EPiDfLH+5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
<script src="js/jskasgudang.js"></script>
        <script>
$( ".hapus" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin ?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script>
    </body>
</html>
<?php
}
?>