<?php 


		include "../resourses/config.php";
		include "common/databaseConnected.php";
		
		$emailId = $_GET['email'];
		$signUpTable = USER_SIGNUP_TABLE;
		$dbConn=connectToDb();
		$emailCheckSql = "SELECT * FROM $signUpTable WHERE Email = '$emailId'";
		$emailCheckSqlResult = mysqli_query($dbConn,$emailCheckSql);
		$checkrows=mysqli_num_rows($emailCheckSqlResult);

		if($checkrows!=0){
			echo "0";
		}
		else{
			echo "1";
		}










?>