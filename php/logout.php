<?php

		include "../resourses/config.php";
		require '../lib/facebook/src/facebook.php';
		session_start();
		session_unset($_SESSION['emailId']);
		session_unset($_SESSION['FACEBOOK_USER_ID']);  		
		session_destroy();
  		header("Refresh: 0; URL=".BASE_PATH."php/LoginPage.php");
?>