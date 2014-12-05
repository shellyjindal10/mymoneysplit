<?php 
    session_start();
	include "common/databaseConnected.php";
	include "../resourses/config.php";


	$url=$_SERVER['REQUEST_URI'];
	$email = $_GET['email'];
	$description = $_GET['description'];
	$amount = $_GET['amount'];
	$person_who_paid_money = $_SESSION['login_username'];
	$message =" ";
	$doesEmailIdExists = "";
	$dbConn=connectToDb();
	$kind_of_user = "";

	echo $url;echo "<br/>";
	echo $email;echo "<br/>";
	echo $description;echo "<br/>";
	echo $amount;echo "<br/>";
	echo $person_who_paid_money;echo "<br/>";

	
	class MessageForSplitsWise {
	    public $check_for_dublicate_entry = "";
	    public $check_for_emailExists_In_System  = "";
	}

	$jsonMessage = new MessageForSplitsWise();
	$moneyDistributionTableName = USER_MONEY_DISTRIBUTION_TABLE;
	$userVerificationTable = USER_VERIFICATION_TABLE;

	echo $moneyDistributionTableName;
	echo "<br/>";
	echo $userVerificationTable;
	echo "<br/>";


	
	if (strpos($email,',') !== false) {// multilpe email id are there 
									echo "MOre than one email id ";
    								$myArray = explode(',', $email);
									for ($i = 0; $i < count($myArray); $i++){
										$doesEmailIdExists=checkEmailIdExistsInDatabaseSystem($myArray[$i],$userVerificationTable);
										if($doesEmailIdExists=='true'){
											$check=mysqli_query($dbConn,"select * from $moneyDistributionTableName where Person_who_Paid_the_Money='$person_who_paid_money' 
												                         and amount_to_be_Returned='$amount' 
												                         and Person_who_needs_To_ReturnMoney='$myArray[$i]'
												                         and Description_ofTheBill = '$description'");
    										$checkrows=mysqli_num_rows($check);
   											if($checkrows>0){
   												$jsonMessage->check_for_dublicate_entry = "dublicate entry";
   											}  
											else{ 
													    $query = "insert into $moneyDistributionTableName(Person_who_Paid_the_Money, amount_to_be_Returned, Person_who_needs_To_ReturnMoney,Description_ofTheBill) 
									  							  values ('$person_who_paid_money', '$amount', '$myArray[$i]','$description')";
														$result = mysqli_query($dbConn,$query);
														//$jsonMessage->check_for_dublicate_entry="new entry";
										    }
										}else{
														$jsonMessage->check_for_emailExists_In_System="Email Id does not exits in the system";
										}
									}
	}else{// single email id 
									//echo "one email id ";
						            $doesEmailIdExists=checkEmailIdExistsInDatabaseSystem($email,$userVerificationTable);
						            if($doesEmailIdExists=='true'){
						            	echo "Email id exists";echo "<br/>";
						            	$check=mysqli_query($dbConn,"select * from $moneyDistributionTableName where Person_who_Paid_the_Money='$person_who_paid_money' 
												                         and amount_to_be_Returned='$amount' 
												                         and Person_who_needs_To_ReturnMoney='$email'
												                         and Description_ofTheBill = '$description'");
    									$checkrows=mysqli_num_rows($check);
   										if($checkrows>0){
   											$jsonMessage->check_for_dublicate_entry = "dublicate entry";
   										}  
										else{ 
											      
											       				$query = "insert into $moneyDistributionTableName(Person_who_Paid_the_Money, amount_to_be_Returned, Person_who_needs_To_ReturnMoney,Description_ofTheBill) 
															  			  values ('$person_who_paid_money', '$amount', '$email','$description')";
																$result = mysqli_query($dbConn,$query);
											       
													
													//$jsonMessage->check_for_dublicate_entry="new entry";
										}
						            }else{
						            			    $message = "Email Id does not exits in the system";
						            			    $jsonMessage->check_for_emailExists_In_System="Email Id does not exits in the system";
						            }						            
	}

	echo json_encode($jsonMessage);


	function checkEmailIdExistsInDatabaseSystem($emailId,$userVerificationTable){
									echo "Inside the function checkEmailIdExistsInDatabaseSystem ".$emailId;
									echo "<br/>";
									$databaseConn = connectToDb();
									$sql = "select * from $userVerificationTable where Username = '$emailId'";
									echo $sql;
									echo "<br/>";
									$sql_result = mysqli_query($databaseConn,$sql);
									$number_of_rows = mysqli_num_rows($sql_result);
									if($number_of_rows!=0){
											return 'true';			
									}else{
							                return 'false';
									}		
	}


	function checkForSameEmailIdAsLoginPerson($emailId){
									$login_user = $person_who_paid_money;
									if($emailId!=$login_user){
											return "unique_user";
									}else{
										    return "login_user";
									}
	}

																	





?>