<?php 
	session_start();

?>

<html>
<head>
		<script language="Javascript" type="text/javascript" src="../lib/jquery-1.11.1.js"></script>
		<script language="Javascript" type="text/javascript" src="../lib/jquery-1.11.1.min.js"></script>
		<script src ="../lib/js/bootstrap.js"></script>
		<script src ="../lib/test.js"></script>	
		<script src ="../js/SignUpValidatior.js"></script>
		<link type ="text/css" rel="stylesheet" href="../lib/css/bootstrap.css" />
		<link rel="stylesheet" href="../lib/alertify/alertify.core.css" />
		<link rel="stylesheet" href="../lib/alertify/alertify.default.css" />
		<script src="../lib/alertify/alertify.js"></script>	
		<link rel="stylesheet" type="text/css" href="../css/Sign_Up.css" media="screen" />	
		<script language="Javascript" type="text/javascript" src="../lib/alertPlugins/jquery.bootstrap-growl.min.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css"/>

</head>
 <script type="text/javascript">
			    function myFunction() {
    									$("#sign_up_body_hidden").show();
				}

				function validateMyForm(){
										var email = $('#email-enter').val();
										var request = new XMLHttpRequest();
										request.open('GET', '../php/FormValuesVerfication.php?email='+email, false);  // `false` makes the request synchronous
										request.send(null);

										if (request.status === 200) {
											resp = request.responseText;
												    if (resp == 1){
													    	return true;
												    }else if(resp == 0){
												    		alertify.alert("User Already exists");
													     	//alert('User Already exists');
													     	return false;
													}
										  			console.log(request.responseText);
										}
								
				}
				

				function checkPass(){
    				var pass1 = document.getElementById('password-enter');
    				var pass2 = document.getElementById('reconfirm-password-enter');
				    var message = document.getElementById('confirmMessage');
				    var goodColor = "#66cc66";
				    var badColor = "#ff6666";
				    if(pass1.value == pass2.value){
				        pass2.style.backgroundColor = goodColor;
				        message.style.color = goodColor;
				        message.innerHTML = "Passwords Match!"
				    }else{
				        pass2.style.backgroundColor = badColor;
				        message.style.color = badColor;
				        message.innerHTML = "Passwords Do Not Match!"
				    }
				}

				


</script>

<body>

			<div id ="sign_up_main_div">
				<div id="Money_wise_theme_symbol">
					<img id="image_money_split" src="../image/Money-Split-icon.jpg">
				</div>
				<div id ="introduce_yoursellf_title">
					<p id="introduction_title">INTRODUCE YOURSELF</p>
				</div>
				<div id="my_name_title">
					<p id="name_title">Hi there! My name is</p>
				</div>
				<div class="sign_up_div">
					<form id="signUpForm" role="form" action ="../php/SignUpVerification.php" method="POST" onsubmit='return validateMyForm()'>
						  <div class="nameMainDiv">
						     <input id="first-name-enter" type="name" class="name-enter form-control" name="firstName" onkeyup="myFunction()" placeholder="first name" >					     
						     <input id="last-name-enter" type="name" class="name-enter form-control"  name="lastName" onkeyup="myFunction()" placeholder="last name" >
						  </div>					  
						  <div id ="sign_up_body_hidden">
						  		<div class="form-group has-feedback">
	    								<label for="exampleInputEmail1" for="inputSuccess2" id="email_label">Here is my email address: </label>
	    								<input id="email-enter" type="email" class="form-control" id="exampleInputEmail1" name="userEmailId">

	  							</div>
	  							<div class="form-group has-feedback">
	    								<label for="exampleInputPassword1" id="password_label">And here is my password: </label>
	    								<input id="password-enter" type="password" class="form-control" id="exampleInputPassword1" name="userPassword">
	  							</div>
	  							<div class="form-group has-feedback">
	    								<label for="exampleInputPassword1" id="password_label">Password confirmation: </label>
	    								<input id="reconfirm-password-enter" type="password" class="form-control" id="exampleInputPassword1" name="passwordConfirmation" onkeyup="checkPass(); return false;">
	    								<span id="confirmMessage" class="confirmMessage"></span>
	  							</div>
						  </div>
						  <button id="sign_uo_button" type="submit" class="btn btn-success">Sign me up!</button>
					</form>	
				</div>		

			</div>

</body>
</html>