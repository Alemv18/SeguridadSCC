<?php

	if($_POST['usuario'] !='' && $_POST['contrasena'] !=''){
		
		if( $_SESSION['intentos'] > 2 || $_SESSION['intentosExiste'] > 2  ) {
			$captcha = false;
			$secretKey = '6LclgR0TAAAAAPpr5Gf4uBWbo-2ccUzMO9ivVT5h';
			$ip = $_SERVER['REMOTE_ADDR'];	
			if($_POST['g-recaptcha-response']){
				$captcha=$_POST['g-recaptcha-response'];
			}
			if(!$captcha){
				echo "<h1>Pícale al Captcha, plis.</h1>";
			}
			else {
				$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
				$responseKeys = json_decode($response, true);
				if(intval($responseKeys["success"]) !== 1) {
					require_once 'login.php';
				}
			}
		}
		else {
			require_once 'login.php';
		}
	}
?>