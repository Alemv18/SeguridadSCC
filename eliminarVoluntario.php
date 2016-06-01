<?php
	//echo "eliminar";
	session_start();
    require_once'conexion.php';
    $matricula=$_GET['matricula'];

    mysqli_query($db, "START TRANSACTION;");
    $sql1 = "DELETE FROM usuarioPermiso WHERE username = '".$matricula."';";
    $sql2 = "DELETE FROM usuario WHERE username = '".$matricula."';";
    $sql3 = "DELETE FROM voluntarioEvento WHERE voluntario = '".$matricula."';";
    $sql4 = "DELETE FROM voluntario WHERE matricula = '".$matricula."';";


    $query1 = mysqli_query($db, $sql1);  
    $query2 = mysqli_query($db, $sql2);
    $query3 = mysqli_query($db, $sql3);
    $query4 = mysqli_query($db, $sql4);
   
    if($query1 && $query2 && $query3 && $query4){
        $db->commit();
        echo "Commit";
    } else {
         echo "Rollback";
        $db->rollback();
    }

    $db->close();
    header ('location: listarVoluntarios.php');
?>