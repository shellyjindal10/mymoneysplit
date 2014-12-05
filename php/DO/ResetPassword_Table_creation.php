 <?php

	   include "../../resourses/config.php";
       
 	   $dbConn=connectToDb();
       $Table_creation_query="CREATE TABLE ResetPassword(Username VARCHAR(100) NOT NULL,Activation_Code VARCHAR(500) NOT NULL)";


       if (mysqli_query($dbConn,$Table_creation_query)) {
       	        echo "<br/>";
		  	 echo "Table ResetPassword created successfully";
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