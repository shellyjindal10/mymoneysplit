<?php 

include "../resourses/config.php";

/*
Function sendMail- sends Mail 


*/


function sendMail($email_id,$message){

	    	require_once("../lib/PHPMailer/class.phpmailer.php");
	    	include "../resourses/config.php";

	    	$mail = new PHPMailer();
	    	

            $mail->IsSMTP();  // telling the class to use SMTP

			$mail->Host     = HOST; // SMTP SERVER
			$mail->Port = PORT;
			$mail->SMTPAuth = true;
			$mail->SMTPDebug = 1;
			$mail->SMTPSecure = SMTPSECURE;
			$mail->Username = MAIL_USER;
			$mail->Password = MAIL_PASSWORD;
			$mail->From     = MAIL_FROM;
			$mail->AddReplyTo($email_id);
			$mail->AddAddress($email_id);
			$mail->Subject  = MAIL_SUBJECT;
			$mail->Body     = $message;
			$mail->WordWrap = MAIL_WORD_WRAP;

			if(!$mail->Send()) {
				    echo "<br/>";
					echo 'Message was not sent.';
					echo "<br/>";
					echo 'Mailer error: ' . $mail->ErrorInfo;
			}
	    };

       /*Functions crypto_rand_secure and getToken 
         used to generate a random number for the secure link 

       */

		function crypto_rand_secure($min, $max) {
					        $range = $max - $min;
					        if ($range < 0) return $min; // not so random...
					        $log = log($range, 2);
					        $bytes = (int) ($log / 8) + 1; // length in bytes
					        $bits = (int) $log + 1; // length in bits
					        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
					        do {
					            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
					            $rnd = $rnd & $filter; // discard irrelevant bits
					        } while ($rnd >= $range);
					        return $min + $rnd;
				}

		function getToken($length){
						    $token = "";
						    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
						    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
						    $codeAlphabet.= "0123456789";
						    for($i=0;$i<$length;$i++){
						        $token .= $codeAlphabet[crypto_rand_secure(0,strlen($codeAlphabet))];
						    }
		    				return $token;
		}


?>