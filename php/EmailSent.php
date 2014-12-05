<?php 
		session_start();
		$email=$_SESSION['Reset-password-email'];
		$first= "";	
		$last="";

		$first= substr($email, 0, 2);
		if (($pos = strpos($email, "@")) !== FALSE) { 
		    $lastletters = substr($email, $pos+1); 
		    $last= substr($lastletters, 0, 1);
		}

	



?>

<html>
<head>
		<script language="Javascript" type="text/javascript" src="../lib/jquery-1.11.1.js"></script>
		<script language="Javascript" type="text/javascript" src="../lib/jquery-1.11.1.min.js"></script>
		<script src ="../lib/js/bootstrap.js"></script>
		<link type ="text/css" rel="stylesheet" href="../lib/css/bootstrap.css" />
		<link type ="text/css" rel="stylesheet" href="../css/ResetPassword.css" />
		<link type ="text/css" rel="stylesheet" href="../css/EmailSend.css"/>
				
</head>
<script type="text/javascript">
</script>
<body>
		<div id="reset_password_main_div">
			<div class="Section">
      			<div class="PageHeader">Check your email</div>
      				<p>
      					We've sent an email to <strong><?php echo $first?>**@<?php echo $last?>***.**</strong>. Click the link in the email to reset your password.
      				</p>
      				<p>
      					If you don't see the email, check other places it might be, like your junk, spam, social, or other folders.
     				</p>
    			</div>
        	</div>
		</div>
</body>

</html>
