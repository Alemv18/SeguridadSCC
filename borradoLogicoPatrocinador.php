<?php

	session_start();
    require_once'conexion.php';
    $idPat=$_GET['idPat'];
    $nombrePat= $_GET['nombrePat'];

    
    $sql = "UPDATE patrocinador SET visible ='0' WHERE id = '".$idPat."';";
    $query = mysqli_query($db, $sql);

    $log= "INSERT INTO tablaLog (tipoDeEvento, usuario, descripcion) VALUES ('Notificacion', '".$usuario."', 'El usuario elimino al patrocinador: ".$nombrePat."');";
    $db->query($log);	
   
    $db->close();
    header ('location: listarPatrocinadores.php');
?>