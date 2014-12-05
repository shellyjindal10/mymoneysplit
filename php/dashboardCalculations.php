<?php

	session_start();
	include "common/databaseConnected.php";
	include "../resourses/config.php";

	$userName = $_SESSION['login_username'];
	$action=$_GET['action'];

	$signUp_Table=USER_SIGNUP_TABLE;
	$moneyDistribution = USER_MONEY_DISTRIBUTION_TABLE;

	if($action=='youOwed'){
				$dbConn=connectToDb();										
				$youOweQuery="select a.amir , a.total , a.garib, b.firstname , b.lastname from (select Person_who_paid_the_Money as amir ,sum(amount_to_be_Returned) as 
							  total ,Person_who_needs_To_ReturnMoney as garib from $moneyDistribution where Person_who_needs_To_ReturnMoney = '$userName' group by 
							  Person_who_needs_To_ReturnMoney) a INNER JOIN (Select FirstName as firstname ,LastName as lastname ,Email as em from $signUp_Table)b  ON b.em = a.garib";
					
			    $youOweQueryResult = mysqli_query($dbConn,$youOweQuery) or trigger_error("Query Failed! SQL: $conn - Error: ".mysqli_error(), E_USER_ERROR);
				$checkrows=mysqli_num_rows($youOweQueryResult);
				if($checkrows==0){
						echo "<br/>"."You do not owe any money.";						
				}else{	
						while ($row = mysqli_fetch_array($youOweQueryResult)){
							echo "<br/>".'You Owe '.$row['firstname']." ".$row['lastname']." ".' $ '.$row['total'];
						}
				}				
	}
	else{// for action youAreOwed
				$db=connectToDb();
				$sql="select a.amir , a.total , a.garib, b.firstname,b.lastname  from (select Person_who_paid_the_Money as amir ,sum(amount_to_be_Returned) as total ,      
					 	Person_who_needs_To_ReturnMoney as garib from $moneyDistribution where Person_who_Paid_the_Money = '$userName' group by Person_who_needs_To_ReturnMoney)
					 	a INNER JOIN (Select FirstName as firstname ,LastName as lastname,Email as em from $signUp_Table)b  ON b.em = a.garib";
				$sqlResult = mysqli_query($db,$sql);
				$checkrows=mysqli_num_rows($sqlResult);
				if($checkrows==0){
						echo "<br/>"."You are not owed any money.";
				}else{
						while ($row = mysqli_fetch_array($sqlResult)){
							echo "<br/>".$row['firstname']." ".$row['lastname']." ". " owes you ".'$ '.$row['total'];

						}
				}
	}


?>