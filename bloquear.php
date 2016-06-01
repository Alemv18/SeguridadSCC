<?php
	
	require_once 'conexion.php';
	$username= $_GET['username'];

	$select = "SELECT * FROM usuario WHERE username = '".$username."';";
	$query= $db->query($select);
	$res = $query->fetch_assoc();
	$bloqueado = $res['bloqueado'];

	if($bloqueado == 0){
		$sql= "UPDATE usuario SET bloqueado = 1 WHERE username = '".$username."';";

	}
	else {
		$sql= "UPDATE usuario SET bloqueado = 0 WHERE username = '".$username."';";
	}
	$db->query($sql);
	
	header ("location: listarUsuarios.php");

?>

