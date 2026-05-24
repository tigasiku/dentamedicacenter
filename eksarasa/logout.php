<?php
session_start();
session_destroy();
setcookie("type", "", time()-3600);
  header ("location:index.php");
?>
