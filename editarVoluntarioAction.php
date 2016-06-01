<?php

	echo $_POST['nombreVoluntario']."<br>";
	echo $_POST['apellidoPaterno']."<br>";
	echo $_POST['apellidoMaterno']."<br>";
	echo $_POST['matricula']."<br>";
	echo $_POST['email']."<br>";
	echo $_POST['dia']."<br>";
	echo $_POST['mes']."<br>";
	echo $_POST['ano']."<br>";
	echo $_POST['celular']."<br>";
	echo $_POST['telefono']."<br>";
	echo $_POST['carrera']."<br>";
	echo $_POST['semestre']."<br>";
	echo $_POST['talla']."<br>";

	$nombreNuevo = $_POST['nombreVoluntario'];
	$apellidoPatNuevo = $_POST['apellidoPaterno'];
	$apellidoMatNuevo = $_POST['apellidoMaterno'];
	$matriculaActual = $_POST['matricula'];
	$emailNuevo = $_POST['email'];
	$diaNuevo = $_POST['dia'];
	$mesNuevo = $_POST['mes'];
	$anoNuevo = $_POST['ano'];
	$celularNuevo = $_POST['celular'];
	$telefonoNuevo = $_POST['telefono'];
	$carreraNueva = $_POST['carrera'];
	$semestreNuevo = $_POST['semestre'];
	$tallaNueva = $_POST['talla'];

	$fechaDeNacNueva = $anoNuevo."-".$mesNuevo."-".$diaNuevo;

	require_once 'conexion.php';

	$sql = "UPDATE voluntario SET nombres = ?, apellidoPat = ?, apellidoMat = ?, fechaDeNac = ?, email = ?, celular = ?, telefono = ?, escolaridad = ?, semestre = ?, talla = ? WHERE matricula = ? ;";

	$prep_query= $db->prepare($sql);
    $prep_query->bind_param('ssssssssiss', $nombreNuevo, $apellidoPatNuevo, $apellidoMatNuevo, $fechaDeNacNueva, $emailNuevo, $celularNuevo, $telefonoNuevo, $carreraNueva, $semestreNuevo, $tallaNueva, $matriculaActual);

    $prep_query->execute();

    $log= "INSERT INTO tablaLog (tipoDeEvento, usuario, descripcion) VALUES ('Notificacion', '".$usuario."', 'El usuario edito al voluntario: ".$matriculaActual."');";
    $db->query($log);

    header("Location: listarVoluntarios.php");
    exit();

?>






