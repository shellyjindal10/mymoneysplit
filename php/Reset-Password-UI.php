<html>
<head>
    <script language="Javascript" type="text/javascript" src="../lib/jquery-1.11.1.js"></script>
    <script language="Javascript" type="text/javascript" src="../lib/jquery-1.11.1.min.js"></script>
    <script src ="../lib/js/bootstrap.js"></script>
    <link type ="text/css" rel="stylesheet" href="../lib/css/bootstrap.css" />
    <link type ="text/css" rel="stylesheet" href="../css/ResetPassword.css" />
    <link type ="text/css" rel="stylesheet" href="../css/Reset-Password-UI.css" />
    <link rel="stylesheet" href="../lib/alertify/alertify.core.css" />
    <link rel="stylesheet" href="../lib/alertify/alertify.default.css" />
    <script src="../lib/alertify/alertify.js"></script>
    <script src="../resourses/rootConfig.js"></script>
</head>
<script type="text/javascript">
            var count=30;
            var counter=setInterval(timer, 1000); //1000 will  run it every 1 second
                   function timer(){
                              count=count-1;
                              if (count <= 0){
                                 clearInterval(counter);
                                 return;
                              }
                             document.getElementById("timer").innerHTML=count + " secs"; // watch for spelling
                    }
</script>

<body>
    <div id="reset_password_main_div">
        <div class="Section">
        <form action="#" method="POST">
              <p id="new-password-title">New Password:</p>
              <input type="password" name="pass" class="form-control reset-pass-input-text-area"/>
              <input type="submit"  class="Button reset-password-button" name="submit" value="Reset Password" />
        </form>

             
        </div>
    </div>
    <div class="timer-login-page-redirect">
         <p id="redirect-page">Redirecting to Login Page in <span id="timer"></span>..... </p>
    </div> 
</body>
</html>

<?php

              include "common/databaseConnected.php";
              include "../resourses/config.php";

              $userVerificationTable = USER_VERIFICATION_TABLE;
              $dbConn=connectToDb();
              $acode="";



              if(isset($_GET['email'])) {
                  $email = $_GET['email'];
              }

              if(isset($_GET['code'])) {
                  $acode = $_GET['code'];
              }

              if(isset($_POST['pass'])){
                  $pass = $_POST['pass'];
                  if (mysqli_connect_errno()){
                              //echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }
                  $query = mysqli_query($dbConn,"select * from $userVerificationTable where Activation_Code='$acode'")
                  or die(mysqli_error($dbConn));

                  if (mysqli_num_rows($query)==1){
                              $salt = substr($email, 0, 5);
                              $securedPassword = crypt($pass, $salt);
                              $finalSecuredPassword= hash('sha512',$securedPassword);

                              $updateQuery = mysqli_query($dbConn,"update $userVerificationTable set Password='$finalSecuredPassword' where Activation_Code='$acode'") or die(mysqli_error($dbConn));
                              ?>
                               <script type="text/javascript">
                                   alertify.success('Password Changed');
                               </script>
                              <?php
                              $destroyLinksql = mysqli_query($dbConn,"update $userVerificationTable set Activation_Code='-1' where Username='$email'") or die(mysqli_error($dbConn));
                  }else{
                              ?>
                               <script type="text/javascript">
                                   alertify.alert("Password Already Reset");
                                   document.getElementById('redirect-page').style.display = "block";
                                   window.setTimeout(function() {
                                                location.href = constants.base_path+"php/LoginPage.php";
                                    }, 10000);
                               </script>
                              <?php 

                  }
             }

?>





    