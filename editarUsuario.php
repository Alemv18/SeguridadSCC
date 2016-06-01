<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>SCC - Registro Patrocinador</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="registrarExitoso.js"></script>
    <link rel='stylesheet' href='css/style.css'>
</head>


<?php 
    
    session_start();
    require_once'conexion.php';
    $usernameParam = $_GET['username'];

    $select= "SELECT * FROM usuario WHERE username='".$usernameParam."';";
    $queryS= $db->query($select);
    $usuario= $queryS->fetch_assoc();

    $usernameActual=$usuario['username'];
    $tipoActual=$usuario['tipo'];

    //$_SESSION['tipoAnterior']= $tipoActual;

    $usernameErr = "";
    $matriculaErr = "";
    $passwordErr = "";
    $tipoErr = "";
    $confpassErr = "";
    
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $username= trim(filter_input(INPUT_POST,"username",FILTER_SANITIZE_STRING));
        $matricula = trim(filter_input(INPUT_POST,"matricula",FILTER_SANITIZE_STRING));
        $password = trim(filter_input(INPUT_POST,"password",FILTER_SANITIZE_STRING));
        $tipo= trim(filter_input(INPUT_POST,"tipo",FILTER_SANITIZE_STRING));
        $confpass= trim(filter_input(INPUT_POST,"confpass",FILTER_SANITIZE_STRING));
    }
    
        $username = $matricula = $password = $tipo = $confpass = " ";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $valid = true;

        if (empty($_POST["tipo"])) {
            $tipoErr = "Ingresa un tipo";
            $valid = false;
        } else {
            $tipo= test_input($_POST["tipo"]);
            if($tipo == 'inst') {
                if (empty($_POST["username"])) {
                    $usernameErr = "Ingresa un nombre de usuario";
                    $valid = false;
                } else {
                    $username = test_input($_POST["username"]);
                }
            }
            else {
                if (empty($_POST["matricula"])) {
                    $matriculaErr = "Ingresa una matrícula";
                    $valid = false;
                } else {
                    $matricula = test_input($_POST["matricula"]);
                }
            }
        }   

        if (empty($_POST["password"])) {
            $passwordErr = "Ingresa una contraseña";
            $valid = false;
          } else {
            $password = test_input($_POST["password"]);
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
                //echo $resQuery->num_rows;

                for ($i=0; $i < $resQuery->num_rows; $i++) { 
                    $opcion = $resQuery->fetch_assoc();
                    echo '<li><a href="'.$opcion['href'].'">'.$opcion['nombre'].'</a></li>';
                }
                

                //$db->close();

            ?>

            </ul>
        </nav>
    </header>

    <div id="pageTitle">
            <h1>Editar Usuario</h1>
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

                //echo "<p>".count($result)."</p>";       
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
                        <label>Tipo: </label>
                        <br>
                        <select id='tipo' name="tipo" onchange='showMatricula()' >
                            <option value="default" selected>----</option>
                            <option value="admin">Admin</option>
                            <option value="mesa" >Mesa</option>
                            <option value="inst" >Institucion</option>
                        </select>
                        <br><br>
                    </div>

                    <div id='divUsuario' class="container col-xs-12" <?php if ($tipoErr == "") echo "style='display:none'"?>>
                    <!-- <h3 class="error"> <?php echo $nombrepatrocinadorErr;?></h3> -->
                        <label for="username">Nombre de usuario:</label>
                        <br>
                        <input id="username" name="username"  class="form-control" type="text" placeholder="i.e. Juan Carlos"
                        value= "<?php echo $usernameActual;?>">>
                        <span class="error"><?php echo $usernameErr;?></span>
                        <br><br>
                    </div>

                    <div id='matDiv'class="container col-xs-12" <?php if ( $matriculaErr == "") echo "style='display:none'"?>>
                        <label id='matLabel'>Matricula:</label>
                        <br>
                        <input id="matricula" name="matricula" 
                        class="form-control" type="text" placeholder="A01231234" value= "<?php echo $matriculaActual;?>">> 
                        <span class="error"><?php echo $matriculaErr;?></span>
                        <br><br>
                    </div>


                    <div id="buttonDiv"><button class="btn btn-primary container col-xs-12 botonEliminar" type="button" 
                    onclick="location.href='borradoLogicoVoluntario.php?matricula=<?php echo $matriculaParam; ?>'">Eliminar</button></div>

                    <div id="buttonDiv"><button class="btn btn-primary container col-xs-12 botonEditar" type="submit" >Editar</button></div>
                </form>
            </div>
        </div>

    </div>
</body>
<footer>Proyecto de Seguridad Informática</footer>
</html>

<script type="text/javascript">

    function showMatricula(){
        var tipoElement = document.getElementById('tipo');
        var valTipo = tipoElement.options[tipoElement.selectedIndex].value;

        if(valTipo === 'inst'){
            document.getElementById('matDiv').style.display = 'none';
            document.getElementById('divUsuario').style.display = 'block';
        }
        else{
            document.getElementById('matDiv').style.display = 'block';
            document.getElementById('divUsuario').style.display = 'none';
        }
    }

</script>








