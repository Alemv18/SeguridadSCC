		<?php
			function generarLinkTemporal($username){
			   //echo $matricula;
			   // Se genera una cadena para validar el cambio de contraseña
			   $cadena = $username.rand(1,9999999).date('Y-m-d');
			   //echo "<br>";
			   //echo $cadena;
			   $token = sha1($cadena);
			 
			   $conexion = new mysqli('localhost', 'root', '', 'seguridad');

			   // Se inserta el registro en la tabla tblreseteopass
			   $sql = "INSERT INTO tblreseteopass (username, token, creado) VALUES('".$username."','".$token."',NOW());";
			   $resultado = $conexion->query($sql);
			   //echo "<br>";
			   //echo "resultado: ".json_encode ($resultado);
			   if($resultado){
			    // echo "<br>";
			    // echo "Entra al if de resultado";
			      // Se devuelve el link que se enviara al usuario
			      $enlace = $_SERVER["SERVER_NAME"].'/pass/restablecer.php?matricula='.$username.'&token='.$token;
			      return $enlace;
			   }
			   else
			      return FALSE;
			    
			}
			 
			function enviarEmail( $email, $link ){
			  //echo "<br>";
			  //echo "entro a la funcion enviar";
			  //echo "<br>";
			   $mensaje = '<html>
			     <head>
			        <title>Restablece tu contraseña</title>
			     </head>
			     <body>
			       <p>Hemos recibido una petición para restablecer la contraseña de tu cuenta.</p>
			       <p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
			       <p>
			         <strong>Enlace para restablecer tu contraseña</strong><br>
			         <a href="'.$link.'"> Restablecer contraseña </a>
			       </p>
			     </body>
			    </html>';
			 
			   $cabeceras = 'MIME-Version: 1.0' . "\r\n";
			   $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			   $cabeceras .= 'From: Codedrinks <mimail@codedrinks.com>' . "\r\n";
			   //Se envia el correo al usuario
			   $bool = mail($email, "Recuperar contraseña", $mensaje, $cabeceras);
			   if($bool) echo "mensaje enviado";
			}




			$email = $_POST['email'];
			 
			$respuesta = new stdClass();
			 
			if( $email != "" ){
			  //echo "entro al primer if";
			   $conexion = new mysqli('localhost', 'root', '', 'seguridad');
			   $sql = " SELECT * FROM voluntario WHERE email = '".$email."';";
			   $sql2= "TRUNCATE seguridad.tblreseteopass;";
			   //printf( "%s", $sql);
			   $resultado = $conexion->query($sql);
			   $conexion->query($sql2);
			   if($resultado->num_rows > 0){
			    //echo "<br>";
			    //echo "entro al segundo if";
			      $usuario = $resultado->fetch_assoc();
			       //printf("%s",$usuario['matricula']);
			      $linkTemporal = generarLinkTemporal($usuario['username'] );
			      if($linkTemporal){
			        //echo "entro al tercer if";
			        enviarEmail( $email, $linkTemporal );
			        echo '<div class="alert alert-info"> Un correo ha sido enviado a su cuenta de email con las instrucciones para restablecer la contraseña </div>';
			        //$correo= "Un correo ha sido enviado para reestablecer la contraseña <br><br> ";
			      }
			   }
			   else{
			      echo '<div class="alert alert-warning"> No existe una cuenta asociada a ese correo. </div>';

				  //$correo = "No existe mail asociado a una cuenta. Intente de nuevo.<br><br>";	
				}
			}
			else{
			   $respuesta->mensaje= "Debes introducir el email de la cuenta";

			}
			 
		?>
