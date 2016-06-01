<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>SCC - Registro Patrocinador</title>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="registrarExitoso.js"></script>
	<link rel='stylesheet' href='css/style.css'>
</head>


<?php 
	session_start();
	require_once'conexion.php';
	$idPatrocinadorParam = $_GET['idPatrocinador'];

	$select= "SELECT * FROM patrocinador WHERE id=".$idPatrocinadorParam.";";
	$queryS= $db->query($select);
    $patrocinador= $queryS->fetch_assoc();

    $nombrePatrocinadorActual = $patrocinador['nombrePatrocinador'];
    $nombreContactoActual = $patrocinador['nombreContacto'];
    $direccionActual = $patrocinador['direccion'];
    $emailActual = $patrocinador['email'];
    $telefonoActual= $patrocinador['telefono'];

	$nombrepatrocinadorErr = "";
	$nombreContactoErr = "";
	$direccionErr = "";
	//$telefonoPatrocinadorErr = "";
	$emailpatrocinadorErr = "";
	$telefonoPatrocinadorErr = "";
	
	if ($_SERVER["REQUEST_METHOD"]=="POST"){
		$nombrepatrocinador = trim(filter_input(INPUT_POST,"nombrepatrocinador",FILTER_SANITIZE_STRING));
		$nombreContacto = trim(filter_input(INPUT_POST,"nombreContacto",FILTER_SANITIZE_STRING));
		$direccion = trim(filter_input(INPUT_POST,"direccion",FILTER_SANITIZE_STRING));
		$emailpatrocinador = trim(filter_input(INPUT_POST,"emailpatrocinador",FILTER_SANITIZE_EMAIL));
		//$text= trim(filter_input(INPUT_POST,"text",FILTER_SANITIZE_NUMBER_INT));
		$telefonoPatrocinador = trim(filter_input(INPUT_POST,"telefonoPatrocinador",FILTER_SANITIZE_STRING));
	}
	
	$nombrepatrocinador = $nombreContacto = $direccion = $emailpatrocinador = $telefonoPatrocinador = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$valid = true;

	  	if (empty($_POST["nombrepatrocinador"])) {
		    $nombrepatrocinadorErr = "Ingresa un nombre";
		    $valid = false;
	  	} else {
	    	$nombrepatrocinador = test_input($_POST["nombrepatrocinador"]);
	  	}

		  if (empty($_POST["nombreContacto"])) {
		    $nombreContactoErr = "Ingresa un nombre";
		    $valid = false;
		  } else {
		    $nombreContacto = test_input($_POST["nombreContacto"]);
		  }

	    if (empty($_POST["direccion"])) {
		    $direccionErr = "Ingresa una direccion";
		    $valid = false;
		  } else {
		    $direccion = test_input($_POST["direccion"]);
		  }

		  if (empty($_POST["emailpatrocinador"])) {
		    $emailpatrocinadorErr = "Ingresa email";
		    $valid = false;
		  } else {
		    $emailpatrocinador= test_input($_POST["emailpatrocinador"]);
		  }

		  if (empty($_POST["telefonoPatrocinador"])) {
		    //$telefonoPatrocinadorErr = "Ingresa información";
		    $valid = false;
		  } else {
		    $telefonoPatrocinador = test_input($_POST["telefonoPatrocinador"]);
		  }
	  
	}


	function test_input($data) {
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
?>

<body>
	<header class='header'>
        <nav>
            <a href="index.php"><img class="logo" src="img/scc2.png"></a>
            <ul id ='navBar' class='mainMenu'>
             <?php
                require_once 'conexion.php';


                $query = 'SELECT * FROM opcionesNavegacion WHERE display = "1"';
                $resQuery = $db->query($query);
                //echo $resQuery->num_rows;

                for ($i=0; $i < $resQuery->num_rows; $i++) { 
                    $opcion = $resQuery->fetch_assoc();
                    echo '<li><a href="'.$opcion['href'].'">'.$opcion['nombre'].'</a></li>';
                }
                

            ?>

            </ul>
        </nav>
    </header>
		<div id="pageTitle">
			<h1>Registro de Patrocinador </h1>
			<br>

		</div>
	<div class='mainDiv'>
		
		

		<div class='sideMenu container col-xs-3'>
            <h3>Menú Administrativo</h3>
            <?php

                
                require_once 'conexion.php';

                $query = 'SELECT nombre, href FROM opcionesAdministracion oa JOIN usuarioPermiso up ON oa.permiso = up.id WHERE up.username = ?;';

                $prep_query= $db->prepare($query);
                $prep_query->bind_param('s', $_SESSION['usuario']);
                $prep_query->execute();
                $resultSet = $prep_query->get_result();
                $result = $resultSet->fetch_all();

                //echo "<p>".count($result)."</p>";       
                for ($i=0; $i < count($result); $i++) { 
                    echo '<a href="'.$result[$i][1].'"><p>'.$result[$i][0].'</p></a>';
                }

                $db->close();
            ?>
        </div>


		<div class='mainContent'>
			<div class='registroForm container col-xs-6'>
				<form action= "editarPatrocinadorAction.php" role="form" method="post">
					<div class="container col-xs-12">
					<!-- <h3 class="error"> <?php echo $nombrepatrocinadorErr;?></h3> -->
						<label for="nombrepatrocinador">Nombre del patrocinador:</label>
						<br>
						<input id="nombrepatrocinador" name="nombrePatrocinador" class="form-control" type="text" placeholder="i.e. Coca Cola"
						value= "<?php echo $nombrePatrocinadorActual;?>">
						<span class="error"><?php echo $nombrepatrocinadorErr;?></span>
						<br><br>
					</div>

					<div class="container col-xs-12">
					<!-- <h3 class="error"> <?php echo $apellidoPaternoErr;?></h3> -->
						<label for="nombreContacto">Nombre del contacto:</label>
						<br>
						<input id="nombreContacto" name="nombreContacto" class="form-control" type="text" placeholder="i.e. Alejandro"
						value= "<?php echo $nombreContactoActual;?>">
						<span class="error"><?php echo $nombreContactoErr;?></span>
						<br><br>
					</div>

					<div class="container col-xs-12">
					<!-- <h3 class="error"> <?php echo $emailErr;?></h3> -->
						<label for="direccion">Direccion:</label>
						<br>
						<input id="direccion" name="direccion" class="form-control" type="text" placeholder="i.e. Calle de los Olivos"
						value= "<?php echo $direccionActual;?>">
						<span class="error"><?php echo $direccionErr;?></span>
						<br><br>
					</div>

					<div class="container col-xs-6">
					<!-- <h3 class="error"> <?php echo $emailErr;?></h3> -->
						<label for="email">Email:</label>
						<br>
						<input id="emailpatrocinador" name="email" class="form-control" type="email" placeholder="i.e. alejandro@cocacola.mx"
						value= "<?php echo $emailActual;?>">
						<br><br>
					</div>
					<div class="container col-xs-6">
					<!-- <h3 class="error"> <?php echo $emailErr;?></h3> -->
						<label for="telefono">Telefono:</label>
						<br>
						<input id="telefono" name="telefono" class="form-control" type="text" placeholder="i.e. 7123344"
						value= "<?php echo $telefonoActual;?>">
						
						<br><br>
					</div>

					<input name="idPat" type="number" value= "<?php echo $idPatrocinadorParam;?>" style='display:none'>
				
					<div id="buttonDiv"><button class="btn btn-primary container col-xs-12 botonEliminar" type="button" 
                    onclick="location.href='borradoLogicoPatrocinador.php?idPat=<?php echo $idPatrocinadorParam; ?>&nombrePat=<?php echo $nombrePatrocinadorActual; ?>'">Eliminar</button></div>

                    <div id="buttonDiv"><button class="btn btn-primary container col-xs-12 botonEditar" type="submit" >Editar</button></div>
				</form>
			</div>
		</div>



	</div>
</body>
<footer>Proyecto de Seguridad Informática</footer>
</html>



