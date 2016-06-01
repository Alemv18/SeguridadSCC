<?php
	//echo "eliminar";
	session_start();
    require_once'conexion.php';
    
    $username=$_GET['username'];
    echo $username;

    $selectInst= "SELECT * FROM institucion JOIN usuario ON id=institucion WHERE username =  '".$username."';";

    $resInst= $db->query($selectInst);
    $ress= $resInst->fetch_assoc();
    $idInstitucion = $ress['id'];


    $selectNino= "SELECT * FROM nino WHERE institucion = '".$idInstitucion."';";
    $resNino= $db->query($selectNino);

    $numNinos = 0;

    mysqli_query($db, "START TRANSACTION;");
    for ($i=0; $i<$resNino->num_rows; $i++){
        $nino = $resNino->fetch_assoc();
        $idNino= $nino['id'];
        echo $idNino."<br>";
        $sql0 = "DELETE FROM ninoEvento WHERE nino = ".$idNino.";";

        $sql1 = "DELETE FROM nino WHERE id = ".$idNino.";";
        echo $sql1."<br>";

        $query0 = mysqli_query($db,$sql0);    
        $query1 = mysqli_query($db,$sql1); 
        echo "Q0: ".$query0."<br>";
        echo "Q1: ".$query1."<br>";
        if($query0 && $query1) 
            $numNinos = $numNinos + 1;
    }
       
    $sql2 = "DELETE FROM usuarioPermiso WHERE username = '".$username."';";
    $sql3 = "DELETE FROM usuario WHERE institucion = ".$idInstitucion.";";
    $sql4 = "DELETE FROM institucionEvento WHERE institucion = ".$idInstitucion.";";
    $sql5 = "DELETE FROM institucion WHERE id = ".$idInstitucion.";";

    $query2 = mysqli_query($db, $sql2);  
    $query3 = mysqli_query($db, $sql3);
    $query4 = mysqli_query($db, $sql4);
    $query5 = mysqli_query($db, $sql5);
    
    echo "<br>";
    echo "Q2: ".$query2."<br>";
    echo "Q3: ".$query3."<br>";
    echo "Q4: ".$query4."<br>";
    echo "Q5: ".$query5."<br>";

   
    if($query2 && $query3 && $query4 && $numNinos == $resNino->num_rows && $query5){
        $db->commit();
        echo "Commit";
    } else {
        echo "Rollback";
        $db->rollback();
    }

    $db->close();
    header ('location: listarInstitucion.php');
?>