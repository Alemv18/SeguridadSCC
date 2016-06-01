<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Correo</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link href='https://fonts.googleapis.com/css?family=Montserrat|Pacifico|Viga|Damion' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>

		<?php
			session_start();
			//$_SESSION["intentos"] = array('usuario' =>, 'intentos' => );
			// define variables and set to empty values

			$usrErr = "";
			

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			   if (empty($_POST["email"])){
			   	// $_SESSION["loginErr"] = "";
			     $usrErr = "*Email requerido.";
			   } else{
			   	require_once 'validaremail.php';
			   }
			}
		?>

		<div class='sesionHeader'>
			<!--a href="index.html"><i id="homeBtn" class="fa fa-home"></i></a-->
			<a href="index.php"><img class="logo" src="img/scc2.png"></a>
			<h2 id="contrasenaLabel" class="text-center">¿Olvidó su contraseña?</h2>
		</div>
		<div class="container col-xs-4"></div>
		<div class="container col-xs-4">
			<form id="sesionForm" role="form" action= <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method= "post">
				<label id="sesionLabel">Inserta tu email: </label>
				<br>
				<input id="email" name="email" class="form-control" type="text" placeholder="Ejemplo: email@hotmail.com">
				<span class="error"> <?php echo $usrErr;?></span>
				<br><br>
				<!-- <span class="correo col-xs-12"> <?php echo $correo;?></span> -->
				<div id="buttonDiv">
					<button class="btn btn-primary" type="submit">Recuperar contraseña</button>
				</div>
				<div id="olvidoContrasena">
					<a href="sesion.php" >Cancelar</a>
				</div>
			</form>
		</div>
	</body>
</html>

<script>
  $(document).ready(function(){
    $("#frmRestablecer").submit(function(event){
      event.preventDefault();
      $.ajax({
        url:'validaremail.php',
        type:'post',
        dataType:'json',
        data:$("#frmRestablecer").serializeArray()
      }).done(function(respuesta){
        $("#mensaje").html(respuesta.mensaje);
        $("#email").val('');
      });
    });
  });
</script>

