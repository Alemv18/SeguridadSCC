<?php
	
	session_start();
	require_once 'navBarSinSesion.php';

	$usuario= $_SESSION['usuario'];
	$log= "INSERT INTO tablaLog (tipoDeEvento, usuario, descripcion) VALUES ('Notificacion', '".$usuario."', 'El usuario cerro sesion.');";
	$db->query($log);

	session_destroy();
	//echo "blahblah";
	header('location: index.php');

?>