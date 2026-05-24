<?php
session_start();
if (isset($_POST['submit'])){
		$old=md5($_POST['old']);
		$new=$_POST['new'];
		$rnew=$_POST['rnew'];
		
		if ($old==$_SESSION['pass_graha3']){
			if ($new==$rnew){
				
					
						mysql_query("update admin set pass=md5('$new') where username='$_SESSION[user_graha3]' and level='$_SESSION[loglevel_graha3]'");
						session_start();	
						session_destroy();
						setcookie("type", "", time()-3600);	
				?>		
		<script>
      	 window.location.href = 'index.php';
         
       </script>
      <?Php
					
					
			} else {
				header("location:index.php?page=ganti.pass&pesan=failed");
			}
		}else {
			header("location:index.php?page=ganti.pass&pesan=failed");
		}
		}else{
			header("location:index.php?page=404");
}

?>