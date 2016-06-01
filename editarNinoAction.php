<?php
	echo $_POST['idNino']."<br>";
	echo $_POST['nombres']."<br>";
	echo $_POST['apellidoPat']."<br>";
	echo $_POST['apellidoMat']."<br>";
	echo $_POST['dia']."<br>";
	echo $_POST['mes']."<br>";
	echo $_POST['ano']."<br>";
	echo $_POST['institucion']."<br>";
	echo $_POST['discapacidad']."<br>";
	echo $_POST['genero']."<br>";
	echo $_POST['grupo']."<br>";

	$idNino= $_POST['idNino'];
	$nombresNuevo = $_POST['nombres'];
	$apellidoPatNuevo = $_POST['apellidoPat'];
	$apellidoMatNuevo = $_POST['apellidoMat'];
	$diaNuevo = $_POST['dia'];
	$mesNuevo = $_POST['mes'];
	$anoNuevo = $_POST['ano'];
	$institucionNuevo = $_POST['institucion'];
	$discapacidadNuevo = $_POST['discapacidad'];
	$generoNuevo = $_POST['genero'];
	$grupoNuevo = $_POST['grupo'];

	$fechaDeNacNuevo=$anoNuevo."-".$mesNuevo."-".$diaNuevo;

	require_once 'conexion.php';

	$sql = "UPDATE nino SET nombres = ?, apellidoPat = ?, apellidoMat = ?, fechaDeNac = ?, institucion = ?, discapacidad = ?, genero = ?,
	grupo = ? WHERE id = ? ;";

	$prep_query= $db->prepare($sql);
    $prep_query->bind_param('ssssiissi', $nombresNuevo, $apellidoPatNuevo, $apellidoMatNuevo, $fechaDeNacNuevo, $institucionNuevo, $discapacidadNuevo, $generoNuevo, $grupoNuevo, $idNino );

    $prep_query->execute();


    $usuario=
    $log= "INSERT INTO tablaLog (tipoDeEvento, usuario, descripcion) VALUES ('Notificacion', '".$usuario."', 'El usuario edito al patrocinador: ".$nombrePatrocinadorNuevo."');";
    $db->query($log);

    header("Location: listarNinos.php");
    exit();


?>