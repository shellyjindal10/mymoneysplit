<?php 
		ob_start();
		session_start();
		include "common/databaseConnected.php";
		include "../resourses/config.php";


		$userVerificationTable = USER_VERIFICATION_TABLE;
		$signUpTable = USER_SIGNUP_TABLE;
		$firtName  =  $_POST['firstName'];
		$lastName  =  $_POST['lastName'];
		$emailId   =  $_POST['userEmailId'];
		$password  =  $_POST['userPassword'];
		$pwdConfirmation = $_POST['passwordConfirmation'];
		$emailIdFlag = "false";
		$finalSecuredPassword="";
		$activationCode = "";

		if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
    		$salt = substr($emailId, 0, 5);
    		$securedPassword = crypt($password, $salt);
    		$finalSecuredPassword= hash('sha512',$securedPassword);
		}else {
			echo "CRYPT_BLOWFISH is not available";
		}

		$dbConn=connectToDb();	
		$emailCheckSql = "SELECT * FROM $signUpTable WHERE Email = '$emailId'";
		$emailCheckSqlResult = mysqli_query($dbConn,$emailCheckSql);
		$checkrows=mysqli_num_rows($emailCheckSqlResult);
		if($checkrows==0){
						$sql="INSERT INTO $signUpTable (FirstName,LastName,Email,Password)
			  				  VALUES ('$firtName','$lastName','$emailId','$finalSecuredPassword')";
			  			$login_information_sql = "INSERT INTO $userVerificationTable (Username,Password,Activation_Code) 
			  									  VALUES ('$emailId','$finalSecuredPassword','$activationCode')";
						$sqlResult = mysqli_query($dbConn,$sql) or 
									 trigger_error("Query Failed! SQL: $conn - Error: ".mysqli_error(), E_USER_ERROR);
					    $login_information_sqlResult = mysqli_query($dbConn,$login_information_sql) or 
									 trigger_error("Query Failed! SQL: $conn - Error: ".mysqli_error(), E_USER_ERROR);

						header("Refresh: 0; URL=".BASE_PATH."php/LoginPage.php");							
		}else{
						$emailIdFlag="true";
						$_SESSION['emailIdFlag'] = 'true';
						$msg = $_SESSION['emailIdFlag'];
						$flag = "true";
						header("Refresh: 0; URL=".BASE_PATH."php/SignUp.php");
		}

?>