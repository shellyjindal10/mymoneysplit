<html>
<head>
		<script language="Javascript" type="text/javascript" src="../lib/jquery-1.11.1.js"></script>
		<script language="Javascript" type="text/javascript" src="../lib/jquery-1.11.1.min.js"></script>
		<script src ="../lib/js/bootstrap.js"></script>
		<link rel="stylesheet" href="../lib/alertify/alertify.core.css" />
		<link rel="stylesheet" href="../lib/alertify/alertify.default.css" />
		<script src="../lib/alertify/alertify.js"></script>	
		<link type ="text/css" rel="stylesheet" href="../lib/css/bootstrap.css" />
		<link type ="text/css" rel="stylesheet" href="../css/ForgetPassword.css" />		
</head>
<script type="text/javascript">

	function validateEmailId(){
										var email = $('#email-enter').val();
										var request = new XMLHttpRequest();
										request.open('GET', '../php/FormValuesVerfication.php?email='+email, false);  // `false` makes the request synchronous
										request.send(null);

										if (request.status == 200) {
											resp = request.responseText;
												    if (resp == 1){
												    	    alertify.alert("No such User exists");
													    	return false;
												    }else if(resp == 0){
													     	return true;
													}
										}
								
	}


</script>


<body>
		<div id="forget_password_main_div">
			<div class="Section">
				<div class = "PageHeader">Find your Moneywise account
			</div>
			<p>Enter your email.</p>
			<form class="Form" action="../php/Reset-Password.php" method="post" onsubmit='return validateEmailId()'>
        		<input type="hidden" name="authenticity_token">
        		<input type="text" name="account_identifier" id="email-enter" class="Form-textbox is-required is-validatedRemotely " autofocus="" autocorrect="off" autocapitalize="off">
        		<span class="Form-message">
         			 <span class="Form-title" data-key="required"><p>We need this information to find your account.</p></span>
        		</span>
        		<input type="submit" class="Button" value="Search">
      		</form>
		</div>

</body>

</html>
