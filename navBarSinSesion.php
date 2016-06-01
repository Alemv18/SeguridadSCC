<?php

	$query1 = "SET SQL_SAFE_UPDATES = 0;";
	$query2 = "UPDATE opcionesNavegacion SET display = '1' WHERE nombre = 'Iniciar Sesi&oacuten';";
	$query3 = "UPDATE opcionesNavegacion SET display = '0' WHERE nombre = 'Cerrar Sesi&oacuten' OR nombre = 'Administraci&oacuten';";
	$query4 = "SET SQL_SAFE_UPDATES = 1;";
			
			
	require_once 'conexion.php';
	$db->query($query1);
	$db->query($query2);
	$db->query($query3);
	$db->query($query4);

	//$db->close();
?>