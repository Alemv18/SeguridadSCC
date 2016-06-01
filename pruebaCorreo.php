<?php
	
	require_once 'PHPMailer-master/PHPMailerAutoload.php';


	//Create a new PHPMailer instance
	$mail = new PHPMailer;
	// Set PHPMailer to use the sendmail transport
	$mail->isSendmail();
	//Set who the message is to be sent from
	$mail->setFrom('supercompucampo.dev@gmail.com', 'SCC');
	//Set who the message is to be sent to
	$mail->addAddress('benjis_95@hotmail.com', 'Benjamin');
	//Set the subject line
	$mail->Subject = 'PHPMailer sendmail test';
	//Replace the plain text body with one created manually
	$mail->AltBody = 'This is a plain-text message body';
	$mail->Body = "Mail contents";
	//Attach an image file
	$mail->addAttachment('img/scc2.png');

	//send the message, check for errors
	if (!$mail->send()) {
	    echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	    echo "Message sent!";
	}


?>

