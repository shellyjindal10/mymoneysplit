<?php

		session_start();
		include "../resourses/config.php";
		require '../lib/facebook/src/facebook.php';

		
		$dbConn="";		
		$url = $_SERVER["REQUEST_URI"];
		$type=$_GET['type'];
		$userVerificationTable = USER_VERIFICATION_TABLE;

		// For the Internal Users 
		if($type=='internal'){
							$email = $_POST['Email'];
							$password=$_POST['Password'];
							$_SESSION['emailId'] = $email;			
							$dbConn=connectToDb();
							$sql = "UPDATE $userVerificationTable SET Type='internal' WHERE Username='$email'";
							mysqli_query($dbConn, $sql);
							mysqli_close($dbConn);
							$check = validateData($email,$password,$userVerificationTable);
							if($check == 'success'){
								header("Refresh: 0; URL=".BASE_PATH."php/MoneySplit.php");			
							}
							if($check == 'failure'){
								header("Refresh: 0; URL=".BASE_PATH."php/LoginPage.php?login=failure");	
							}
		}

		// For the Facebook Users
		if($type=='FB'){ 
							$facebook = new Facebook(array(
											  'appId'  => FACEBOOK_APP_ID,
											  'secret' => FACEBOOK_SECRET_ID,
											));

							
							$user=null;
							$user = $facebook->getUser();
							$_SESSION['FACEBOOK_USER_ID']=$user;
							if (!$user) {
						  		$loginUrl = $facebook->getLoginUrl();
						  		header("Location:$loginUrl");
							}if ($user) {
								try {
								    // Proceed knowing you have a logged in user who's authenticated.
								    $user_profile = $facebook->api('/me');
								    $_SESSION['emailId'] = $user_profile['email'];
								    $_SESSION['moneyWiseApp']="fb_user";
								    $_SESSION['fb_uid']=$user;
								    $_SESSION['emailId'] = $user_profile['email'];
									header("Refresh: 0; URL=".BASE_PATH."php/MoneySplit.php");
								}catch (FacebookApiException $e) {
								    error_log($e);
								    $user = null;
								}
							}
		}

		

		function validateData($email,$password,$userVerificationTable){
							$dbConn=connectToDb();
							$salt = substr($email, 0, 5);
    						$securedPassword = crypt($password, $salt);
    						$finalSecuredPassword= hash('sha512',$securedPassword);

			 	 			$check_query = "SELECT * FROM $userVerificationTable WHERE Username='$email' and Password='$finalSecuredPassword'";
			 	 			//echo $check_query;
			 	 			$result = mysqli_query($dbConn,$check_query);
				 			$row_cnt = mysqli_num_rows($result);

				 			if($row_cnt!=0){
				 	        		return "success";
				 			}else{				  	            
				  	        		return "failure";
				 			}
		}


		function connectToDb(){
	                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
						if (mysqli_connect_errno()) {
						}
						return $con;
		}


?>