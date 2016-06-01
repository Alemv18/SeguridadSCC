<?php

	$query1 = "SET SQL_SAFE_UPDATES = 0;";
	$query2 = "UPDATE opcionesNavegacion SET display = '0' WHERE nombre = 'Iniciar Sesi&oacuten';";
	$query3 = "UPDATE opcionesNavegacion SET display = '1' WHERE nombre = 'Cerrar Sesi&oacuten' OR nombre = 'Administraci&oacuten';";
	$query4 = "SET SQL_SAFE_UPDATES = 1;";
			
	echo "estoy en nav bar con sesion";			

	require_once 'conexion.php';
	echo "primero".$db->query($query1);
	echo "segundo".$db->query($query2);
	echo "tercero".$db->query($query3);
	echo "cuarto".$db->query($query4);

	//$db->close();
?>