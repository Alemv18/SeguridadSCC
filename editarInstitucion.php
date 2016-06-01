<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>SCC - Editar Institucion</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="registrarExitoso.js"></script>
    <link rel='stylesheet' href='css/style.css'>
</head>

<?php 
    session_start();
    require_once'conexion.php';
    $idInstParam = $_GET['id'];
     

    $select = 'SELECT * FROM institucion WHERE id="'.$idInstParam.'";';
    $queryS= $db->query($select);
    $institucion= $queryS->fetch_assoc();

    $nombreInstitucionActual= $institucion['nombre'];
    $direccionInstitucionActual= $institucion['direccion'];
    $contactoInstitucionActual= $institucion['contacto'];
    $telefonoInstitucionActual= $institucion['telefono']; 
    $id = $institucion['id'];

    $nombreInstitucionErr = "";
    $direccionErr = "";
    $nombreContactoErr = "";
    $telefonoErr = "";

    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $nombreInstitucion = trim(filter_input(INPUT_POST,"nombreInstitucion",FILTER_SANITIZE_STRING));
        $direccion = trim(filter_input(INPUT_POST,"direccion",FILTER_SANITIZE_STRING));
        $nombreContacto = trim(filter_input(INPUT_POST,"nombreContacto",FILTER_SANITIZE_STRING));
        $telefono= trim(filter_input(INPUT_POST,"telefono",FILTER_SANITIZE_NUMBER_INT));

    }

    $nombreInstitucion = $direccion = $nombreContacto= $telefono = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $valid = true;

        if (empty($_POST["nombreInstitucion"])) {
            $nombreInstitucionErr = "Ingresa el nombre de la Institucion";
            $valid = false;
        }else {
            $nombreInstitucion= test_input($_POST["nombreInstitucion"]);
        }

        if (empty($_POST["nombreContacto"])) {
            $nombreContactoErr = "Ingresa un nombre";
            $valid = false;
        }else {
            $nombreContacto = test_input($_POST["nombreContacto"]);
        }
        if (empty($_POST["direccion"])) {
            $direccionErr = "Ingresa una direccion";
            $valid = false;
        } else {
            $direccion = test_input($_POST["direccion"]);
        }
        if (empty($_POST["telefono"])) {
            $telefonoErr = "Ingresa un telefono";
            $valid = false;
        } else {
            $telefono= test_input($_POST["telefono"]);
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
    <header class='header'>
        <nav>
            <a href="index.php"><img class="logo" src="img/scc2.png"></a>
            <ul id ='navBar' class='mainMenu'>
             <?php
                require_once 'conexion.php';


                $query = 'SELECT * FROM opcionesNavegacion WHERE display = "1"';
                $resQuery = $db->query($query);

                for ($i=0; $i < $resQuery->num_rows; $i++) { 
                    $opcion = $resQuery->fetch_assoc();
                    echo '<li><a href="'.$opcion['href'].'">'.$opcion['nombre'].'</a></li>';
                }
            ?>

        
            </ul>
        </nav>
    </header>
        <div id="pageTitle">
            <h1>Editar Institución</h1>
            <br>
        </div>
    <div class='mainDiv'>

        <div class='sideMenu container col-xs-3'>
            <h3>Menú Administrativo</h3>
            <?php

                require_once 'conexion.php';

                $query = 'SELECT nombre, href FROM opcionesAdministracion oa JOIN usuarioPermiso up ON oa.permiso = up.id WHERE up.username = ?;';

                $prep_query= $db->prepare($query);
                $prep_query->bind_param('s', $_SESSION['usuario']);
                $prep_query->execute();
                $resultSet = $prep_query->get_result();
                $result = $resultSet->fetch_all();    
                for ($i=0; $i < count($result); $i++) { 
                    echo '<a href="'.$result[$i][1].'"><p>'.$result[$i][0].'</p></a>';
                }

                $db->close();
            ?>
        </div>


        <div class='mainContent'>
            <div class='registroForm container col-xs-6'>
                <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> " role="form" method="post">
                    <div class="container col-xs-12">
                        <label for="nombrepatrocinador">Nombre de la institución:</label>
                        <br>
                        <input id="nombreInstitucion" name="nombreInstitucion" class="form-control" type="text" placeholder="i.e. Ver contigo" value= "<?php echo htmlspecialchars($nombreInstitucionActual);?>">
                        <span class="error"><?php echo $nombreInstitucionErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-12">
                        <label for="email">Direccion:</label>
                        <br>
                        <input id="direccion" name="direccion" class="form-control" type="text" placeholder="i.e. Calle de los Olivos"
                        value= "<?php echo htmlspecialchars($direccionInstitucionActual);?>">
                        <span class="error"><?php echo $direccionErr;?></span>
                        <br><br>
                    </div>

                        <div class="container col-xs-12">
                        <label for="apellidoPaterno">Nombre del contacto:</label>
                        <br>
                        <input id="nombreContacto" name="nombreContacto" class="form-control" type="text" placeholder="i.e. Alejandro"
                        value= "<?php echo htmlspecialchars($contactoInstitucionActual);?>">
                        <span class="error"><?php echo $nombreContactoErr;?></span>
                        <br><br>
                    </div>
                
                    <div class="container col-xs-12">
                        <label for="semestre">Telefono: </label>
                        <br>
                        <input id="telefono" name="telefono" class="form-control" type="text" placeholder="example. 871 1453061"
                        value= "<?php echo htmlspecialchars($telefonoInstitucionActual);?>" >
                        <span class="error"><?php echo $telefonoErr;?></span>
                        <br><br>
                    </div>
                     <div id="buttonDiv"><button class="btn btn-primary container col-xs-12 botonEliminar" type="button" 
                    onclick="location.href='borradoLogicoInstitucion.php?id=<?php echo $id; ?>&nombreInstitucion=<?php echo $nombreInstitucionActual; ?> '">Eliminar</button></div>

                    <div id="buttonDiv"><button class="btn btn-primary container col-xs-12 botonEditar" type="submit" >Editar</button></div>
                </form>
            </div>
        </div>
    </div>
</body>
<footer>Proyecto de Seguridad Informática</footer>
</html>



