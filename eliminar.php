<?php
	echo "eliminar";
	session_start();
    require_once'conexion.php';
    $matricula=$_GET['matricula'];

    $sql = "DELETE FROM voluntario WHERE matricula = '".$matricula."';";
    $db->query($sql);
    $db->close();

    header ('location: listarVoluntarios.php');
?>