<?php
	session_start();
    require_once'conexion.php';
    $idNino=$_GET['idNino'];
    $nombreNino= $_GET['nombreNino']." ".$_GET['apellidoNino'];
    
    $sql = "UPDATE nino SET visible ='0' WHERE id = '".$idNino."';";
    $query = mysqli_query($db, $sql);
   

    $log= "INSERT INTO tablaLog (tipoDeEvento, usuario, descripcion) VALUES ('Notificacion', '".$usuario."', 'El usuario elimino al nino: ".$nombreNino."');";
    $db->query($log);	

    $db->close();
    header ('location: listarNinos.php');
?>