<?php
	//echo "eliminar";
	session_start();
    require_once'conexion.php';
    $matricula=$_GET['matricula'];

    
    $sql = "UPDATE voluntario SET visible ='0' WHERE matricula = '".$matricula."';";
    $query = mysqli_query($db, $sql);

    $log= "INSERT INTO tablaLog (tipoDeEvento, usuario, descripcion) VALUES ('Notificacion', '".$usuario."', 'El usuario elimino al voluntario: ".$matricula."');";
    $db->query($log);

    $db->close();
    header ('location: listarVoluntarios.php');
?>