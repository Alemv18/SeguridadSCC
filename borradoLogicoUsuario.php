<?php
	//echo "eliminar";
	session_start();
    require_once'conexion.php';
    $username=$_GET['username'];

    
    $sql = "UPDATE usuario SET visible ='0' WHERE username = '".$username."';";
    $query = mysqli_query($db, $sql);
   
    $usuario = $_SESSION['usuario'];
    $log= "INSERT INTO tablaLog (tipoDeEvento, usuario, descripcion) VALUES ('Notificacion', '".$usuario."', 'El usuario elimino al usuario: ".$username."');";
    $db->query($log);	

    $db->close();
    header ('location: listarUsuarios.php');
?>