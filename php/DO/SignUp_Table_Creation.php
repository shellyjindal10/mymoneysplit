<?php 

	//include "../common/databaseConnected.php";
	include "../../resourses/config.php";
	$dbConn=connectToDb();

    $sign_Up_Table_Name = USER_SIGNUP_TABLE;
    
       $SignUp_Table_creation_query="CREATE TABLE signUp_Table(FirstName VARCHAR(100) NOT NULL ,LastName VARCHAR(100) NOT NULL, Email VARCHAR(100) NOT NULL,Password VARCHAR(500) NOT NULL,
       	PRIMARY KEY (Email))"; 
       
       
       if (mysqli_query($dbConn,$SignUp_Table_creation_query)) {
       	        echo "<br/>";
		  	 echo "Table jinshelly_signup created successfully";
	}

	function connectToDb(){
	                    
                       	$con=mysqli_connect(localhost,DB_USER,DB_PASSWORD,DB_NAME);
						if (mysqli_connect_errno()) {
							//echo "<br/>";
							// "DB Connection Failed";
						}
						return $con;
	}

?>