<?php 
session_start();
session_unset();
    $_SESSION['FBID'] = NULL;
    $_SESSION['USERNAME'] = NULL;
    $_SESSION['FULLNAME'] = NULL;
    $_SESSION['EMAIL'] =  NULL;
    $_SESSION['LOGOUT'] = NULL;
$_SESSION['do_not_auto_login'] = true;
header("Location: http://localhost/MoneySplit/php/LoginPage.php");        // you can enter home page here ( Eg : header("Location: " ."http://www.krizna.com"); 
?>
