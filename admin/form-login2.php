<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
         <title><?php echo $_SESSION['judul_project_graha'] ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" href='img/logo.ico'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- Calendar-->
		<link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			var auto_refresh = setInterval(
			function ()
			{
			$('#tanggal').load('date.php');
			}, 1000);
		</script>
    </head>
    <body class="fixed skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header" style="background-image:url('img/bg_texture2.jpg');">
            <a href="index.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?php echo $_SESSION['judul_project_graha'] ?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                
                <div class="navbar-right">
                <a href="#" class="logo" style="width: 260px;" id="tanggal">
					<!-- Add the class icon to your logo image or logo icon to add the margining -->
					<?php
date_default_timezone_set('Asia/Makassar');
						echo date("D, Y M d H:i a");
					?>
				</a>    
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" style="margin-left:0px;">                
                <section class="content-header" style="text-align:center;">
				<h1>
					<img src="img/logo.png" style="width:3%;margin-top:-7px;margin-left:-15px;"> &nbsp;&nbsp;&nbsp;Selamat Datang di <?php echo $_SESSION['judul_project_graha'] ?>
				</h1>
			</section>
			<section class="content">
				<center>
				<form action="login.php" method="post">
					<?php
					if(isset($_GET['pesan'])){
					?>
					<div style="margin-top:10px;
								margin-bottom:-25px;
								padding:7px 15px;
								width:25%;
								border:solid 1px #cecece;
								background: #f36565;
								color:#fff;
								text-align:left;
								font-size:15px;
					">
					<i class="fa fa-times"></i>&nbsp;&nbsp;<i>username dan password salah</i>
					</div>
					<?php
					}
					?>
					<div style="margin-top:30px;
								padding:7px 15px;
								width:25%;
								border:solid 1px #cecece;
								background: -webkit-linear-gradient(#fff, #f5f5f5);
								background: -o-linear-gradient(#fff, #f5f5f5);
								background: -moz-linear-gradient(#fff, #f5f5f5);
								background: linear-gradient(#fff, #f5f5f5);
								color:#555;
								text-align:left;
								font-size:15px;
					">
					<i class="fa fa-lock"></i>&nbsp;&nbsp;Login 
					<?php echo $_SESSION['judul_project_graha'] ?>
			</div>
					
					<div style="margin-top:2px;
								padding:15px 15px;
								width:25%;
								border:solid 1px #cecece;
								color:#666;
								text-align:left;
								font-size:12px;
								background:#fbfbfb;
					">
					USERNAME
					<input type="text" style="border:solid 1px #cecece;
											  padding:5px 10px;
											  color:#999;
											  width:100%;
											  font-size:14px;
											  margin-bottom:10px;
					" placeholder="Username" name="username">
					PASSWORD
					<input type="password" style="border:solid 1px #cecece;
												  padding:5px 10px;
												  color:#999;
												  width:100%;
												  font-size:14px;
												  margin-bottom:20px;
					" placeholder="Password" name="password">
					<button type="submit" name="submit" style="border:solid 1px #00a65a;
															   padding:5px 10px;
															   color:#fff;
															   width:100%;
															   font-size:14px;
															   margin-bottom:10px;
															   background: #00a65a;
					"><i class="fa fa-unlock"></i> &nbsp;&nbsp;L O G I N</button>					
					</div>
					</form>
					<span style="color:#777;font-size:13px;">Create By AAA.</span>
				</center>
			</section>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
     

    </body>
</html>