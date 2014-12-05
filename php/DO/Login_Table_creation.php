 <?php

		//include "../common/databaseConnected.php";
		include "../../resourses/config.php";


       
       
 	   $dbConn=connectToDb();
       $Table_creation_query="CREATE TABLE login_information(Username VARCHAR(100) NOT NULL,Password VARCHAR(500) NOT NULL,Type VARCHAR(30)
       						  ,Activation_Code VARCHAR(10))";

 	   $alter_creation = "ALTER TABLE login_information MODIFY Activation_Code VARCHAR(100)";


       if (mysqli_query($dbConn,$Table_creation_query)) {
       	        echo "<br/>";
		  	 echo "Table jinshelly_signup created successfully";
	   }
	   if (mysqli_query($dbConn,$alter_creation)) {
       	        echo "<br/>";
		  	 echo "Table jinshelly_signup altered  successfully";
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