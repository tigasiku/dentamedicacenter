<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $store['store_name'] ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href='img/icon.png'>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header" style="background-color: #f35227;"><?php echo $store['store_name'] ?></div>
            <form action="login.php" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="User ID"/>
                        <input type="hidden" name="page" class="form-control" value="<?php if(isset($_GET['page'])){ echo $_GET['page']; }else{ echo "home";} ?>"/>
                        
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                   
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block" style="font-weight:bold;color:#222 !important;background-color: #f35227 !important; ">Login</button>  
                    
                    
                </div>
            </form>

           
        </div>

    </body>
</html>