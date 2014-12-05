<?php 
				require '../lib/facebook/src/facebook.php';
				include "../resourses/config.php";
				session_start();

				$_SESSION['emailId'] = $_GET['emailId'];

				$facebook = new Facebook(array(
       						  'appId'  => FACEBOOK_APP_ID,
							  'secret' => FACEBOOK_SECRET_ID,
							));

				$user = $facebook->getUser();
				$_SESSION['FACEBOOK_USER_ID']=$user;
?>