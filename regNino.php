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


        $nombresErr = "";
        $apellidoPatErr = "";
        $apellidoMatErr = "";
        $fechaDeNacErr = "";
        $discapacidadErr = "";
        $institucionErr = "";
        $generoErr = "";
        $grupoErr = "";
        $diaErr = "";
        $mesErr = "";
        $anoErr = "";

        if ($_SERVER["REQUEST_METHOD"]=="POST"){
            $nombres= trim(filter_input(INPUT_POST,"nombres",FILTER_SANITIZE_STRING));
            $apellidoPat = trim(filter_input(INPUT_POST,"apellidoPat",FILTER_SANITIZE_STRING));
            $apellidoMat = trim(filter_input(INPUT_POST,"apellidoMat",FILTER_SANITIZE_STRING));
            $discapacidad = trim(filter_input(INPUT_POST,"discapacidad",FILTER_SANITIZE_STRING));
            $genero= trim(filter_input(INPUT_POST,"genero",FILTER_SANITIZE_STRING));
            $institucion = trim(filter_input(INPUT_POST,"institucion",FILTER_SANITIZE_STRING));
            $grupo = trim(filter_input(INPUT_POST,"grupo",FILTER_SANITIZE_NUMBER_INT));
            $ano = trim(filter_input(INPUT_POST,"ano",FILTER_SANITIZE_STRING));
            $mes = trim(filter_input(INPUT_POST,"mes",FILTER_SANITIZE_NUMBER_INT));
            $dia = trim(filter_input(INPUT_POST,"dia",FILTER_SANITIZE_EMAIL));
  
        }

        $nombres = $apellidoPat = $apellidoMat = $discapacidad = $genero = $grupo = $institucion = "";



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

            if (empty($_POST["institucion"])) {
                $institucionErr = "Ingresa una institucion";
                $valid = false;
            } else {
                $institucion = test_input($_POST["institucion"]);
            }

            if (empty($_POST["discapacidad"])) {
                $discapacidadErr = "Elige una discapacidad";
                $valid = false;
            } else {
                $discapacidad = test_input($_POST["discapacidad"]);
            }

            if (empty($_POST["genero"])) {
                $generoErr = "Ingresa un genero";
                $valid = false;
            } else {
                $genero = test_input($_POST["genero"]);
            }

             if (empty($_POST["dia"] && $_POST["mes"] && $_POST["ano"])) {
                $fechaDeNacErr = "Ingresa una fecha de nacimiento";
                $valid = false;
            } else {            
                $fechaDeNac = test_input($_POST['ano'])."-".test_input($_POST['mes'])."-".test_input($_POST['dia']);
            }

            if (empty($_POST["grupo"])) {
                $grupoErr = "Ingresa un grupo";
                $valid = false;
            } else {
                $grupo = test_input($_POST["grupo"]);
            } 
    
            if($valid){ 

                $sql = 'INSERT INTO nino(nombres, apellidoPat, apellidoMat, fechaDeNac, institucion, discapacidad, genero, grupo) VALUES (?,?,?,?,?,?,?,?)';
                $prep_query= $db->prepare($sql);
                $prep_query->bind_param('sssssiis',$nombres, $apellidoPat, $apellidoMat, $fechaDeNac, $institucion, $discapacidad, $genero, $grupo);
                $prep_query->execute();
                $prep_query->fetch();

                header("Location: listarNinos.php");
                exit();
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

                      // $db->close();
                ?>
                
                </ul>
            </nav>
        </header>

        <div id="pageTitle">
            <h1>Registro de Niño</h1>
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

                    <div class="container col-xs-12">
                        <!-- <h3 class="error"> <?php echo $fechaDeNacErr;?></h3> -->
                        <label for="fechaNac">Fecha de Nacimiento: </label>
                        <br>

                        <div class="container col-xs-4">
                            <select name="dia">
                                <option value="-"selected>Día</option>
                                <?php
                                    for ($i=1; $i<=31; $i++){
                                        echo "<option value='".$i."''>".$i."</option>";
                                    }
                                ?>
                            </select>
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
                                    for ($i=2001; $i<=2013; $i++){
                                        echo "<option value='".$i."''>".$i."</option>";
                                    }
                                ?>
                            </select>                        
                        </div>
                        <br>
                        <span class="error"><?php echo $fechaDeNacErr;?></span>
                    </div>


                       <div class="container col-xs-12">
                    <!--    <h3 class="error"> <?php echo $fechaDeNacErr;?></h3> -->
                        <label for="discapacidad">Institucion: </label>
                        <br>

                        <div class="container col-xs-4">
                            <select input type="text"  id="institucion" name="institucion" maxlength = "10" value="<?php echo $_SESSION['institucion'] ?>">
                                <option value="0" >--Seleccione una--</option>

                                <?php
                                    require_once 'conexion.php';
                                    $query = 'SELECT * FROM institucion';
                                    $resQuery = $db->query($query);
                                    

                                    //echo "<p>".count($result)."</p>";       
                                    for ($i=0; $i < $resQuery->num_rows; $i++) { 
                                        $result = $resQuery->fetch_assoc();
                                        echo '<option value="'.$result['id'].'">'.$result['nombre'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <br>
                        <span class="error"><?php echo $institucionErr;?></span>
                        <br>
                    </div>  

                   
                   <div class="container col-xs-12">
                    <!--    <h3 class="error"> <?php echo $fechaDeNacErr;?></h3> -->
                        <label for="discapacidad">Discapacidad: </label>
                        <br>

                        <div class="container col-xs-4">
                            <select input type="text"  id="discapacidad"name="discapacidad" maxlength = "10" value="<?php echo $_SESSION['discapacidad'] ?>">
                                <option value="0" >--Seleccione una--</option>

                                <?php
                                    require_once 'conexion.php';
                                    $query = 'SELECT * FROM discapacidad';
                                    $resQuery = $db->query($query);
                                    

                                    //echo "<p>".count($result)."</p>";       
                                    for ($i=0; $i < $resQuery->num_rows; $i++) { 
                                        $result = $resQuery->fetch_assoc();
                                        echo '<option value="'.$result['id'].'">'.$result['descripcion'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <br>
                        <span class="error"><?php echo $discapacidadErr;?></span>
                        <br>
                    </div>  


                    <div class="container col-xs-12">
                    <!--    <h3 class="error"> <?php echo $fechaDeNacErr;?></h3> -->
                        <label for="genero">Género:</label>
                        <br>

                        <div class="container col-xs-4">
                            <select id="genero" name="genero" maxlength = "10" value="<?php echo $_SESSION['genero'] ?>">
                                <option value="-" selected>--Seleccione uno--</option>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                        </div>
                        <br>
                        <span class="error"><?php echo $generoErr;?></span>
                        <br>
                    </div>  

                        <div class="container col-xs-12">
                    <!-- <h3 class="error"> <?php echo $apellidoPaternoErr;?></h3> -->
                        <label for="grupo">Grupo:</label>
                        <br>
                        <input id="grupo" name="grupo" <?php if (isset($_POST['grupo'])) echo 'value="'.$_POST['grupo'].'"';?>  class="form-control" type="text" 
                        placeholder="i.e. 5"
                        value= "<?php echo htmlspecialchars($grupo);?>">
                        <span class="error"><?php echo $grupoErr;?></span>
                        <br><br>
                    </div>


                    <div id="buttonDiv"><button class="btn btn-primary" type="submit" value="submit" >Registrar Niño</button></div>
                </form>
            </div>
        </div>
    </div>
</body>
<footer>Proyecto de Seguridad Informática</footer>
</html>





