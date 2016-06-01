<?php
	echo $_POST['idPat']."<br>";
	echo $_POST['nombrePatrocinador']."<br>";
	echo $_POST['nombreContacto']."<br>";
	echo $_POST['direccion']."<br>";
	echo $_POST['email']."<br>";
	echo $_POST['telefono']."<br>";

	$idPatrocinador= $_POST['idPat'];
	$nombrePatrocinadorNuevo = $_POST['nombrePatrocinador'];
	$contactoPatrocinadorNuevo = $_POST['nombreContacto'];
	$direccionNuevo = $_POST['direccion'];
	$telefonoNuevo = $_POST['telefono'];
	$emailNuevo = $_POST['email'];

	require_once 'conexion.php';

	$sql = "UPDATE patrocinador SET nombrePatrocinador = ?, nombreContacto = ?, direccion = ?, email = ?, telefono = ? WHERE id = ? ;";

	$prep_query= $db->prepare($sql);
    $prep_query->bind_param('sssssi', $nombrePatrocinadorNuevo, $contactoPatrocinadorNuevo, $direccionNuevo, $emailNuevo, $telefonoNuevo, 
    	$idPatrocinador);

    $prep_query->execute();

    $log= "INSERT INTO tablaLog (tipoDeEvento, usuario, descripcion) VALUES ('Notificacion', '".$usuario."', 'El usuario edito al patrocinador: ".$nombrePatrocinadorNuevo."');";
    $db->query($log);

    header("Location: listarPatrocinadores.php");
    exit();


?>