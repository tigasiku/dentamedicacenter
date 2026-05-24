<?php
session_start();
include("../koneksi.php");
$store=mysql_fetch_array(mysql_query("select * from stores"));
$_SESSION['judul_project_graha']="Cpanel";
$_SESSION['judul_graha']=$store['store_name'];

if(!isset($_SESSION['user_graha2']) and !isset($_SESSION['pass_graha2'])){
	include "form-login.php";
}else{

?>
<!DOCTYPE html>
<html>
    <head> 
    <script>
	function valid(){
	document.getElementById('notif').innerHTML=document.getElementById('notifikasi').value;
	document.getElementById('label').innerHTML=document.getElementById('notifikasi').value;
	}
	
	</script>
        <meta charset="UTF-8">
        <title><?php echo $_SESSION['judul_project_graha'] ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" href='../img/ico/icon.ico'>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
		<link href="css/datepicker/datepicker.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="fixed skin-blue" onload="validate2()">
        <header class="header">
            <a href="index.php" class="logo">
                <img src="../img/dentamedica.png" style="width:56%;margin-top:-5px;margin-left:-15px;"> &nbsp;</a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <!-- Notifications: style can be found in dropdown.less -->
                        
                        
                        <!-- User Account: style can be found in dropdown.less -->
                      				<?php
									/*
									include "koneksi_menu.php";
									
									
									?>
                      <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-danger"><label id="label"></label></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have <label id="notif"></label> notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                    <?php 
									$qry=mysql_query("select * from cash_out_plan_history,login_finance where cash_out_plan_history.user=login_finance.username and tanggal_history='".date("Y-m-d")."'");
									$num=mysql_num_rows($qry);
									?>
                                
                                    <?php
									while($data=mysql_fetch_array($qry)){
										
									?>
                                        <li><!-- start message -->
                                        
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php 
									if(!empty($data['photo'])){
										echo 
										"../hrd/photo_karyawan/".$data['photo']."";
									}else{
										echo "img/avatar2.png";
									}
									?>" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    <?php echo $data['user'] ?>
                                                    <small><i class="fa fa-clock-o"></i> <?php echo date("H:i",strtotime($data['tanggal_history'])) ?></small>
                                                </h4>
                                                <p><?php echo $data['status']." ".$data['no_co_plan'] ?> cast out plan</p>
                                            </a>
                                        </li><!-- end message -->
                                       <?php } ?>
                                        <?php 
									$qry=mysql_query("select * from cash_in_plan_history,login_finance where cash_in_plan_history.user=login_finance.username and tanggal_history='".date("Y-m-d")."'");
									$num2=mysql_num_rows($qry);
									?>
                                
                                    <?php
									while($data=mysql_fetch_array($qry)){
										
									?>
                                        <li><!-- start message -->
                                        
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php 
									if(!empty($data['photo'])){
										echo 
										"../hrd/photo_karyawan/".$data['photo']."";
									}else{
										echo "img/avatar2.png";
									}
									?>" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    <?php echo $data['user'] ?>
                                                    <small><i class="fa fa-clock-o"></i> <?php echo date("H:i",strtotime($data['tanggal_history'])) ?></small>
                                                </h4>
                                                <p><?php echo $data['status']." ".$data['no_co_plan'] ?> cast in plan</p>
                                            </a>
                                        </li><!-- end message -->
                                       <?php } ?>
                                           <input type="hidden" name="notif" id="notifikasi" value="<?php echo $num+$num2 ?>">
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less --><
						*/?> 
                      
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span> <?php 
						
											
											echo $_SESSION['nama_graha'];
										
										?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php 
									if(!empty($_SESSION['photo'])){
										echo 
										"photo/".$_SESSION['photo']."";
									}else{
										echo "img/avatar2.png";
									}
									?>" class="img-circle" alt="User Image" onclick="window.open('?page=ganti.photo','_top')" />
                                    <p>
                                        <?php 
									
										
											echo $_SESSION['nama_graha'];?> - <?php echo $_SESSION['loglevel_graha'];
									
										?>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
									<a href='?page=ganti.pass' class='btn btn-default btn-flat'>Ganti Password</a>
									</div>
                                    <div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar" >
                    <!-- Sidebar user panel -->
                    <div class="user-panel" >
                        <div class="pull-left image" 
						<?php
						if($_SESSION['loglevel_graha']!="Administrator"){

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
                   
                    
                    <!-- sidebar menu: : style can be found in sidebar.less --><script src="js/jquery.min.js"></script>
				
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <?php
					include "konten.php";
				?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
<!--Start of Zopim Live Chat Script-->

		<script>
		
		
		$(function(){
		$('#dp1').datepicker({
				format: 'yyyy-mm-dd'
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
        
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<!-- InputMask -->
        <script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
		<script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
		
		<script src="js/plugins/datepicker/bootstrap-datepicker.js"></script>
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