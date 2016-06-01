<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SCC - Registro de Niños</title>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel='stylesheet' href='css/style.css'>
    </head>

    <?php 

        session_start();
        require_once'conexion.php';

        $valid = false;

        $nombresErr = "";
        $apellidoPatErr = "";
        $apellidoMatErr = "";
 

        if ($_SERVER["REQUEST_METHOD"]=="POST"){
            $nombres= trim(filter_input(INPUT_POST,"nombres",FILTER_SANITIZE_STRING));
            $apellidoPat = trim(filter_input(INPUT_POST,"apellidoPat",FILTER_SANITIZE_STRING));
            $apellidoMat = trim(filter_input(INPUT_POST,"apellidoMat",FILTER_SANITIZE_STRING));
  
        }

        // $nombres = $apellidoPat = $apellidoMat = $grupo = "";
        // $nombresParam = $apellidoPatParam = $apellidoMatParam =$grupoParam = " ";



        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $valid = true;

            if (empty($_POST["nombres"])) {
                $nombresErr = "Ingresa nombre";
                // echo $nombreVoluntario;
                $valid = false;
            } else {
                $nombres = test_input($_POST["nombres"]);
                // echo $nombres;
            }

            if (empty($_POST["apellidoPat"])) {
                $apellidoPatErr = "Ingresa apellido paterno";
                $valid = false;
            } else {
                $apellidoPat = test_input($_POST["apellidoPat"]);
            }

            if (empty($_POST["apellidoMat"])) {
                $apellidoMatErr = "Ingresa apellido";
                $valid = false;
            } else {
                $apellidoMat = test_input($_POST["apellidoMat"]);
            }
        }
           
            if($valid){ 
               
                $edadQuery= "SELECT getNiñoGrupo(?,?,?) AS grupo";
                echo $edadQuery;
                $prep_query= $db->prepare($edadQuery);
                echo $prep_query;
                $prep_query->bind_param('sss', 'Lupita', 'Perez', 'Sanchez');
                $prep_query->execute();
                $res=$prep_query->get_result();
                echo$ees[]
                $prep_query->fetch();
                echo "Hooola: ".$grupo;



                $nombresParam = $_REQUEST['nombres'];
                $apellidoPatParam = $_REQUEST['apellidoPat'];
                $apellidoMatParam = $_REQUEST['apellidoMat'];  
                // $grupoParam = $_REQUEST['grupo'];  
                $select = 'SELECT grupo FROM nino WHERE nombres = "'.$nombresParam.'" AND apellidoPat = "'.$apellidoPatParam.'"AND apellidoMat = "'.$apellidoMatParam.'
                "';
                // echo "<td >$grupo</td>";
                $queryS= $db->query($select);
                $nino= $queryS->fetch_assoc();

                // echo "<td >$grupo</td>";

                exit();
            }


        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }


        ?>
                    
    <body>
       <!--  <header class='header'>
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

                      // $db->close();
                ?>
                
                </ul>
            </nav>
        </header> -->
        <br><br><br><br>
        <div id="pageTitle">
            <h1>Buscar el grupo al que pertenece el niño:</h1>
            <br>
            <!-- <h2 id="bienvenido">Registro de Voluntario</h2> -->
        </div>
    <div class='mainDiv'>

        <div class='sideMenu container col-xs-3'>
            <h3>Menú Administrativo</h3>
            <?php
                //echo "<p>hola</p>";
                //session_start();
                //echo "<p>:".$_SESSION['usuario']."</p>";
                mysql_query("SET NAMES 'utf8'");
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

                // $db->close();
            ?>
        </div>


        <div class='mainContent'>
            <div class='registroForm container col-xs-6'>
                <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> " role="form" method="post">
                    <div class="container col-xs-12">
                        <!-- <h3 class="error"> <?php echo $nombreVoluntarioErr;?></h3> -->
                        <label for="nombres">Nombre(s): </label>
                        <br>
                        <input id="nombres" name="nombres" <?php if (isset($_POST['nombres'])) echo 'value="'.$_POST['nombres'].'"';?> class="form-control" type="text" placeholder="i.e. Juan Ricardo"
                        value= "<?php echo htmlspecialchars($nombres);?>">
                        <span class="error"><?php echo $nombresErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-12">
                        <!-- <h3 class="error"> <?php echo $apellidoPaternoErr;?></h3> -->
                        <label for="apellidoPat">Apellido Paterno: </label>
                        <br>
                        <input id="apellidoPat" name="apellidoPat" <?php if (isset($_POST['apellidoPat'])) echo 'value="'.$_POST['apellidoPat'].'"';?>  class="form-control" type="text" placeholder="i.e. Hernández"
                        value= "<?php echo htmlspecialchars($apellidoPat);?>">
                        <span class="error"><?php echo $apellidoPatErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-12">
                        <!-- <h3 class="error"> <?php echo $apellidoMaternoErr;?></h3> -->
                        <label for="apellidoMat">Apellido Materno: </label>
                        <br>
                        <input id="apellidoMat" name="apellidoMat" <?php if (isset($_POST['apellidoMat'])) echo 'value="'.$_POST['apellidoMat'].'"';?>  class="form-control" type="text" placeholder="i.e. López"
                        value= "<?php echo htmlspecialchars($apellidoMat);?>">
                        <span class="error"><?php echo $apellidoMatErr;?></span>
                        <br><br>
                    </div>


                    <div id="buttonDiv"><button class="btn btn-primary" type="submit" value="submit" >Submit </button></div>
                </form>
            </div>
        </div>
    </div>
</body>
<footer>Proyecto de Seguridad Informática</footer>
</html>





