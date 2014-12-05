<?php 
		session_start();
		include "common/databaseConnected.php";
		include "../resourses/config.php";
		include "common/commonFunctions.php";
		include "../resourses/constant.php";
		

		$userVerificationTable = USER_VERIFICATION_TABLE;
		$email = $_POST['account_identifier'];//echo $email;
		$_SESSION['Reset-password-email']=$email;
		$dbConn=connectToDb();
		$first= "";	
		$last="";

		$first= substr($email, 0, 2);		
		if (($pos = strpos($email, "@")) !== FALSE) { 
		    $lastletters = substr($email, $pos+1); 
		    $last= substr($lastletters, 0, 1);
		}

		$query = mysqli_query($dbConn,"select * from $userVerificationTable where Username='$email'")
				 or die(mysqli_error($dbConn)); 
		if (mysqli_num_rows ($query)==1){
				 $code= getToken(24);
				 $message="You activation link is: ".BASE_PATH."php/Reset-Password-UI.php?email=$email&code=$code";
				 $subject = MAIL_SUBJECT;
				 sendMail($email,$message);
				 $query2 = mysqli_query($dbConn,"update $userVerificationTable set Activation_Code='$code' where Username='$email'")
						   or die(mysqli_error($con)); 
		}else{
				 echo 'No user exist with this email id';

		}		


?>
<html>
<head>
		<script language="Javascript" type="text/javascript" src="../lib/jquery-1.11.1.js"></script>
		<script language="Javascript" type="text/javascript" src="../lib/jquery-1.11.1.min.js"></script>
		<script src ="../lib/js/bootstrap.js"></script>
		<link type ="text/css" rel="stylesheet" href="../lib/css/bootstrap.css" />
		<link type ="text/css" rel="stylesheet" href="../css/ResetPassword.css" />		
</head>
<script type="text/javascript">
</script>
<body>
		<div id="reset_password_main_div">
		<div class="Section">



        <div class="PageHeader">
          How do you want to reset your password?
        </div>
        <p>
          We found the following information associated with your account.
            <a href="../php/ForgetPassword.php"><p>Click here if this isn't your account.</p></a>
        </p>

      <form action="../php/EmailSent.php" method="post" class="Form">
        <input type="hidden" name="authenticity_token" value="79d38ee47ec9b47a6b58a33d06b4bca4cfe78931">
        <ul class="Form-radioList">
              <li>
			    <label>
			      <input type="hidden" name="method_hint[-1]" value="email">
			      <input type="radio" name="method" value="-1" checked="">
			      Email a link to <strong><?php echo $first?>**@<?php echo $last?>***.**</strong>
			    </label>
   			 </li>
   		</ul>
   		<input type="submit" class="Button" value="Continue">
			
		</div>

</body>

</html>
