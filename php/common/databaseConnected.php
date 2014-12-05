<?php

include "../resourses/config.php";

function connectToDb(){
	                    
                       	$con=mysqli_connect(localhost,DB_USER,DB_PASSWORD,DB_NAME);
						if (mysqli_connect_errno()) {
						}
						return $con;
}


?>

