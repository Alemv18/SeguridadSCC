<?php
	session_start();
    require_once'conexion.php';
    $idInst=$_GET['id'];
    $nombreInstitucion= $_GET['nombreInstitucion'];
    echo $idInst;
    
    $sql = "UPDATE institucion SET visible ='0' WHERE id = ".$idInst.";";
    echo $sql;
    $query = mysqli_query($db, $sql);

    $usuario = $_SESSION['usuario'];
    $log= "INSERT INTO tablaLog (tipoDeEvento, usuario, descripcion) VALUES ('Notificacion', '".$usuario."', 'El usuario elimino a la insitucion: ".$nombreInstitucion."');";
    $db->query($log);
   
    $db->close();
    header ('location: listarInstitucion.php');
?>