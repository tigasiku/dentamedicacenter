<?php
@session_start();
	if (!isset($_SESSION['masuk_lagi']) and !isset($_SESSION['password_lagi']) and !isset($_SESSION["level_lagi"])) {

		header("Location:404-error.php");
	}
?>