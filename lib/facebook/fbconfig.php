<?php
session_start();
require 'src/facebook.php';  // Include facebook SDK file
//require 'functions.php';  // Include functions

              $facebook = new Facebook(array(
              'appId'  => '362266920616777',   // Facebook App ID 
              'secret' => 'a614e7621dddd9e6231aefa350e9867c',  // Facebook App Secret
              'cookie' => true, 
            ));
            $user = $facebook->getUser();
            if ($user) {
              try {
                    $_SESSION['FACEBOOK_USER_ID']=$user;
                    $user_profile = $facebook->api('/me');
                    $fbid = $user_profile['id'];                 // To Get Facebook ID
                    $fbuname = $user_profile['username'];  // To Get Facebook Username
                    $fbfullname = $user_profile['name']; // To Get Facebook full name
                    $femail = $user_profile['email'];    // To Get Facebook email ID
                    $_SESSION['emailId'] = $user_profile['email'];
                   /* ---- Session Variables -----*/
                   $_SESSION['FBID'] = $fbid;           
                   $_SESSION['USERNAME'] = $fbuname;
                   $_SESSION['FULLNAME'] = $fbfullname;
                   $_SESSION['EMAIL'] =  $femail;
                  
                //       checkuser($fbid,$fbuname,$fbfullname,$femail);    // To update local DB
              } catch (FacebookApiException $e) {
                error_log($e);
               $user = null;
              }
            }
            if ($user) {
              header("Location: index.php");
              $logoutUrl = $facebook->getLogoutUrl();
              header("Location: ".$logoutUrl);
            } else {
             $loginUrl = $facebook->getLoginUrl(array(
                'scope'   => 'email', // Permissions to request from the user
                ));
             header("Location: ".$loginUrl);
            }






?>
