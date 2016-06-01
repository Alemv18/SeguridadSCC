<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>SCC - Donaciones</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel='stylesheet' href='css/style.css'>
</head>

<?php

     
    session_start();
    require_once 'conexion.php';

    $numeroDeTarjetaErr = "";
    $codigoDeSeguridadErr = "";
    $fechaDeVencimientoErr = "";
    $montoErr = "";
    $mesErr = "";
    $anoErr = "";

    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $nombre= trim(filter_input(INPUT_POST,"nombre",FILTER_SANITIZE_STRING));
        $numeroDeTarjeta = trim(filter_input(INPUT_POST,"numeroDeTarjeta",FILTER_SANITIZE_STRING));
        $codigoDeSeguridad = trim(filter_input(INPUT_POST,"codigoDeSeguridad",FILTER_SANITIZE_STRING));
        $mes = trim(filter_input(INPUT_POST,"mes",FILTER_SANITIZE_NUMBER_INT));
        $ano = trim(filter_input(INPUT_POST,"ano",FILTER_SANITIZE_NUMBER_INT));
        $monto = trim(filter_input(INPUT_POST,"monto",FILTER_SANITIZE_NUMBER_INT));
    }

    $nombre = $numeroDeTarjeta = $codigoDeSeguridad = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $valid = true;

        if (!empty($_POST["numeroDeTarjeta"])) {
            $nombre = test_input($_POST["nombre"]);
        }
        if (empty($_POST["numeroDeTarjeta"])) {
            $numeroDeTarjetaErr = "Ingresa el número de tarjeta";
            $valid = false;
        } else {
            $numeroDeTarjeta = crypt(test_input($_POST["numeroDeTarjeta"]),"lily");
        }

        if (empty($_POST["codigoDeSeguridad"])) {
            $codigoDeSeguridadErr = "Ingresa el código de seguridad";
            $valid = false;
        } else {
            $codigoDeSeguridad = test_input($_POST["codigoDeSeguridad"]);
        }

        if (empty($_POST["mes"] && $_POST["ano"])) {
            $fechaDeVencimientoErr = "Ingresa una fecha de vencimiento";
            $valid = false;
        } else {
            $fechaDeVencimiento = test_input($_POST['mes'])."-".test_input($_POST['ano']);
        }

        if (empty($_POST["monto"])) {
            $montoErr = "Ingresa el monto a donar";
            $valid = false;
        } else {
            $monto = test_input($_POST["monto"]);
        } 

        if($valid){ 
            if(test_input($_POST["anonimoOpt"]) == "no"){
                $queryInsert="INSERT INTO donacion (nombre, numeroDeTarjeta, codigoDeSeguridad, fechaDeVencimiento, monto) VALUES (?,?,?,?,?);";
                $prep_query= $db->prepare($queryInsert);
                $prep_query->bind_param('ssssi',$nombre,$numeroDeTarjeta,$codigoDeSeguridad, $fechaDeVencimiento, $monto);
                $prep_query->execute();
                header("location: donacionExitosa.php");
            }
            else {
                $queryInsert="INSERT INTO donacion (numeroDeTarjeta, codigoDeSeguridad, fechaDeVencimiento, monto) VALUES (?,?,?,?);";
                $prep_query= $db->prepare($queryInsert);
                $prep_query->bind_param('sssi', $numeroDeTarjeta,$codigoDeSeguridad, $fechaDeVencimiento, $monto);
                $prep_query->execute();
                header("Location: donacionExitosa.php");
            }

          
        }
    }

        
    

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>



<body>
    <header>
        <nav>
            <a href="index.php"><img class="logo" src="img/scc2.png"></a>
            <ul class='mainMenu'>
                 <?php
                    require_once 'conexion.php';


                    $query = 'SELECT * FROM opcionesNavegacion WHERE display = "1"';
                    $resQuery = $db->query($query);
                    //echo $resQuery->num_rows;


                    for ($i=0; $i < $resQuery->num_rows; $i++) { 
                        $opcion = $resQuery->fetch_assoc();
                        echo '<li><a href="'.$opcion['href'].'">'.$opcion['nombre'].'</a></li>';
                    }


                ?>

            </ul>
        </nav>
    </header>


    <div class='mainDiv'> 
        <div class='container col-xs-3'></div>
        
        <div class='donacionForm container col-xs-6'>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" role="form" method="post">
                <div class="container col-xs-12">
                    <label for="Anonimo" style="display: block">Anonimo: </label>
                    <select id='anonimoOpt' name="anonimoOpt" onchange='showNombre()' >
                        <option value="si" selected>Sí</option>
                        <option value="no" >No</option>
                    </select>
                    <br> 
                    <br> 
                </div>

                <div id="divDonacion" class="container col-xs-12" style="display: none">
                    <!-- <h3 class="error"> <?php echo $nombreVoluntarioErr;?></h3> -->
                    <label for="nombre">Nombre Completo: </label>
                    <br>
                    <input id="nombre" name="nombre" <?php if (isset($_POST['nombre'])) echo 'value="'.$_POST['nombre'].'"';?> class="form-control" type="text" placeholder="i.e. Juan Manuel Lópetz Hernándetz" value="<?php echo htmlspecialchars($nombre);?>">
                    <br><br>
                </div>

                <div class="container col-xs-6">
                    <!-- <h3 class="error"> <?php echo $matriculaErr;?></h3> -->
                    <label for="numeroDeTarjeta">Número de tarjeta: </label>
                    <br>
                    <input id="numeroDeTarjeta" name="numeroDeTarjeta" <?php if (isset($_POST['numeroDeTarjeta'])) echo 'value="'.$_POST['numeroDeTarjeta'].'"';?> class="form-control" type="text" placeholder="i.e. 1111-2222-3333-4444"  value= "<?php echo htmlspecialchars($numeroDeTarjeta);?>">
                        <span class="error"><?php echo $numeroDeTarjetaErr;?></span>
                    <br><br>
                </div>

                <div class="container col-xs-6">
                    <!-- <h3 class="error"> <?php echo $emailErr;?></h3> -->
                    <label for="CódigoDeSeguridad">Código de seguridad: </label>
                    <br>
                    <input id="codigoDeSeguridad" name="codigoDeSeguridad" <?php if (isset($_POST['codigoDeSeguridad'])) echo 'value="'.$_POST['codigoDeSeguridad'].'"';?> class="form-control" type="text" placeholder="i.e 123" value= "<?php echo htmlspecialchars($codigoDeSeguridad);?>">
                        <span class="error"><?php echo $codigoDeSeguridadErr;?></span>
                    <br><br>
                </div>


                <div class="container col-xs-12">
                    <!-- <h3 class="error"> <?php echo $fechaDeNacErr;?></h3> -->
                    <label for="fechaDeVencimiento">Fecha de Vencimiento: </label>
                    <br>
                </div>
                     
                <div class="container col-xs-4">
                    <select name="mes">
                        <option value="-" selected>Mes</option>
                        <option value="01">Enero</option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>

                </div>

                <div class="container col-xs-4">
                    <select name="ano">
                        <option value="-" selected>Año</option>
                        <?php
                            for ($i=2016; $i<=2022; $i++){
                                echo "<option value='".$i."''>".$i."</option>";
                            }
                        ?>
                    </select> 
                    <br> 
                    <br>
                    <br>  
                    <span class="error"><?php echo $fechaDeVencimientoErr;?></span>                      
                </div>
               

                <div class="container col-xs-6">
                    <!-- <h3 class="error"> <?php echo $carreraErr;?></h3> -->
                    <label for="monto">Monto a donar: </label>
                    <br>
                    <input id="monto" name="monto" <?php if (isset($_POST['monto'])) echo 'value="'.$_POST['monto'].'"';?>  class="form-control" type="text" placeholder="i.e. 1000000.00" >
                        <span class="error"><?php echo $montoErr;?></span>
                    <br><br>
                </div>


                <div id="buttonDiv"><button class="btn btn-primary" type="submit" value="submit" >Donar</button></div>
            </form>
        </div>
    </div>
</body>
<!--<footer>Proyecto de Seguridad Informática</footer>-->
</html>

<script type="text/javascript">

    function showNombre(){
        var tipoElement = document.getElementById('anonimoOpt');
        var anonChoice = tipoElement.options[tipoElement.selectedIndex].value;

        if(anonChoice === 'si'){
            document.getElementById('divDonacion').style.display = 'none';
        }
        else{
            document.getElementById('divDonacion').style.display = 'block';
        }
    }

</script>



<?php



?>

