<?php

		require_once 'conexion.php';
		$usuario = $_POST['usuario'];
		
		$passwordInput = crypt($_POST['contrasena'], 'benji');
		
		$query = 'SELECT password FROM usuario WHERE username = ? ;';
		$prep_query= $db->prepare($query);
		$prep_query->bind_param('s', $usuario);
		$prep_query->execute();
		$prep_query->bind_result($passwordBD);
		$prep_query->fetch();

		$prep_query->close();
		

		echo "<br>";		

		$selectBloqueado = "SELECT * FROM usuario WHERE username= '".$usuario."';";
		//echo $selectBloqueado;
		$queryBloqueado= $db->query($selectBloqueado);
		$resBloqueado= $queryBloqueado->fetch_assoc();
		$bloqueado= $resBloqueado['bloqueado'];
		
		//SI EL USUARIO INGRESADO NO EXISTE (consulta regresa vacío), SE SUMA UNO A LA VARIABLE DE SESIÓN "intentos"
		if($passwordBD == ""){
			echo "<br>";
			//echo "No existe usuario";
			echo "<br>";
			$_SESSION['intentos'] = $_SESSION['intentos'] + 1;
			//echo 'Intentos con usuario inexistente: '.$_SESSION['intentos'];
			echo "<br>";
			//echo 'Intentos con usuario existente: '.$_SESSION['intentosExiste'];
			$log= "INSERT INTO tablaLog (tipoDeEvento, descripcion) VALUES ('Warning', 'Se intento iniciar sesion con un usuario inexistente(".$usuario.")');";
			$db->query($log);
			
		}
		//SI EL USUARIO SÍ EXISTE
		else {
			
			//printf('%s es la contraseña en la bd.', $passwordBD);
			//echo "<br>";
			//printf('%s es la contraseña ingresada.', $passwordInput);

			//PERO LA CONTRASEÑA ES INCORRECTA
			if($bloqueado == 1){
				header("location: paginaBloqueado.html");
				exit();

			}
			else {
				if($passwordInput != $passwordBD){
					//UPDATE INTENTOS EN LA BD
					//echo $usuario;
					$log= "INSERT INTO tablaLog (tipoDeEvento, usuario, descripcion) VALUES ('Warning', '".$usuario."', 'Se intento iniciar sesion');";
					$db->query($log);

					$queryUpdateIntentos = "UPDATE Usuario SET intentos = (intentos + 1) WHERE username = ? ;";
					$prep_queryUpdateIntentos= $db->prepare($queryUpdateIntentos);
					$prep_queryUpdateIntentos->bind_param('s', $usuario);
					$prep_queryUpdateIntentos->execute();

					$querySacarIntentos = "SELECT intentos FROM Usuario WHERE username = ? ;";
					$prep_querySacarIntentos= $db->prepare($querySacarIntentos);
					$prep_querySacarIntentos->bind_param('s', $usuario);
					$prep_querySacarIntentos->execute();
					$prep_querySacarIntentos->bind_result($intentosBD);
					$prep_querySacarIntentos->fetch();


					$_SESSION['intentosExiste'] = $intentosBD;
					$_SESSION['intentos'] = $_SESSION['intentos'] + 1;

				

					if($_SESSION['intentosExiste']==6){
						$bloqueado ="UPDATE usuario SET bloqueado = 1 WHERE usuario='".$usuario."';";
						$db->query($bloqueado);

						$log= "INSERT INTO tablaLog (tipoDeEvento, usuario, descripcion) VALUES ('Notificacion', '".$usuario."', 'Se bloqueo un usuario');";
						$db->query($log);
					}

					echo "<br>";
					//echo 'Intentos con usuario inexistente: '.$_SESSION['intentos'];
					echo "<br>";
					//echo 'Intentos con usuario existente: '.$_SESSION['intentosExiste'];

					$_SESSION["loginErr"] = "Usuario o Contraseña incorrectos";
					header("location: sesion.php?msg=failed");
				}
				//Y LA CONTRASEÑA ES CORRECTA
				else {
					//RESTABLECER INTENTOS EN BD
					//echo "Password Correcta";
					$queryRestablecerIntentos = "UPDATE Usuario SET intentos = 0 WHERE username = ? ;";
					$prep_queryRestablecerIntentos= $db->prepare($queryRestablecerIntentos);
					$prep_queryRestablecerIntentos->bind_param('s', $usuario);
					$prep_queryRestablecerIntentos->execute();
					//RESTABLECER INTENTOS VAR DE SESION 'intentos'
					$_SESSION['intentos'] = 0;
					//RESTABLECER INTENTOS VAR DE SESION 'intentosExiste'
					$_SESSION['intentosExiste'] = 0;
					$_SESSION['varPrueba'] = "ESTA ES UNA PRUEBA DE SESION";
					$_SESSION['usuario'] = $usuario;
					require_once 'navBarConSesion.php';
					//echo $usuario;

					$log= "INSERT INTO tablaLog (tipoDeEvento, usuario, descripcion) VALUES ('Notificacion', '".$usuario."', 'Se inicio sesion con exito');";
					$db->query($log);

					header("location: index.php");
					echo "<br>";
					//echo 'Intentos con usuario inexistente: '.$_SESSION['intentos'];
					echo "<br>";
					//echo 'Intentos con usuario existente: '.$_SESSION['intentosExiste'];
				}
			}
		}

		$db->close();
		
	//}


?>