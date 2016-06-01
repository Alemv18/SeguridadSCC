<?php
	/**
	 * This example shows sending a message using a local sendmail binary.
	 */

	require 'PHPMailer-master/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	// Set PHPMailer to use the sendmail transport
	//$mail->isMail();
	$mail->Host= 'smtp.gmail.com';
	$mail->SMTPAuth= true;
	$mail->Username='supercompucampo.dev@gmail.com';
	$mail->Password= 'supercompucampo123';
	$mail->From = 'supercompucampo.dev@gmail.com';
	//$mail->FromName -> 'Super Compucampo';
	$mail->addAddress('supercompucampo.dev@gmail.com','Super');
	$mail->addReplyTo('supercompucampo.dev@gmail.com','SCC');
	$mail->WordWrap =50;
	$mail->isHTML(true);
	$mail->Subjetc= 'Using PHPMailer';
	$mail->Body = 'This is a test';

	$mail->send();

	if (!$mail->send()) {
	    echo "Mailer Error: ".$mail->ErrorInfo;
	} else {
	    echo "Message sent!";
	}

?>
