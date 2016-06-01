<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SCC - Registro Voluntario</title>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel='stylesheet' href='css/style.css'>
    </head>

    <?php 

        session_start();
        require_once'conexion.php';


        $nombreVoluntarioErr = "";
        $apellidoPaternoErr = "";
        $apellidoMaternoErr = "";
        $matriculaErr = "";
        $emailErr = "";
        $fechaDeNacErr = "";
        $celularErr = "";
        $telefonoErr = "";
        $carreraErr = "";
        $semestreErr = "";
        $tallaErr = "";
        $diaErr = "";
        $mesErr = "";
        $anoErr = "";

        if ($_SERVER["REQUEST_METHOD"]=="POST"){
            $nombreVoluntario = trim(filter_input(INPUT_POST,"nombreVoluntario",FILTER_SANITIZE_STRING));
            $apellidoPaterno = trim(filter_input(INPUT_POST,"apellidoPaterno",FILTER_SANITIZE_STRING));
            $apellidoMaterno = trim(filter_input(INPUT_POST,"apellidoMaterno",FILTER_SANITIZE_STRING));
            $matricula = trim(filter_input(INPUT_POST,"matricula",FILTER_SANITIZE_STRING));
            $celular = trim(filter_input(INPUT_POST,"celular",FILTER_SANITIZE_STRING));
            $telefono = trim(filter_input(INPUT_POST,"telefono",FILTER_SANITIZE_NUMBER_INT));
            $carrera = trim(filter_input(INPUT_POST,"carrera",FILTER_SANITIZE_STRING));
            $semestre = trim(filter_input(INPUT_POST,"semestre",FILTER_SANITIZE_NUMBER_INT));
            $email = trim(filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL));
            $talla = trim(filter_input(INPUT_POST,"talla",FILTER_SANITIZE_STRING));
            $ano = trim(filter_input(INPUT_POST,"ano",FILTER_SANITIZE_STRING));
            $mes = trim(filter_input(INPUT_POST,"mes",FILTER_SANITIZE_STRING));
            $dia = trim(filter_input(INPUT_POST,"dia",FILTER_SANITIZE_STRING));
            
            
        }

        $nombreVoluntario = $apellidoPaterno = $apellidoMaterno = $matricula = 
        $telefono = $carrera = $semestre = $email = $talla = $celular = "";



        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $valid = true;

            if (empty($_POST["nombreVoluntario"])) {
                $nombreVoluntarioErr = "Ingresa nombre";
                // echo $nombreVoluntario;
                $valid = false;
            } else {
                $nombreVoluntario = test_input($_POST["nombreVoluntario"]);
            }

            if (empty($_POST["apellidoPaterno"])) {
                $apellidoPaternoErr = "Ingresa apellido";
                $valid = false;
            } else {
                $apellidoPaterno = test_input($_POST["apellidoPaterno"]);
            }

            if (empty($_POST["apellidoMaterno"])) {
                $apellidoMaternoErr = "Ingresa apellido";
                $valid = false;
            } else {
                $apellidoMaterno = test_input($_POST["apellidoMaterno"]);
            }

            if (empty($_POST["matricula"])) {
                $matriculaErr = "Ingresa matricula";
                $valid = false;
            } else {
                $matricula = test_input($_POST["matricula"]);
            }

            if (empty($_POST["email"])) {
                $emailErr = "Ingresa email";
                $valid = false;
            } else {
                $email = test_input($_POST["email"]);
            }

             if (empty($_POST["dia"] && $_POST["mes"] && $_POST["ano"])) {
                $fechaDeNacErr = "Ingresa una fecha de nacimiento";
                $valid = false;
            } else {
                $fechaDeNac = test_input($_POST['ano'])."-".test_input($_POST['mes'])."-".test_input($_POST['dia']);
                echo $fechaDeNac;
            }

            if (empty($_POST["celular"])) {
                $celularErr = "Ingresa celular";
                $valid = false;
            } else {
                $celular = test_input($_POST["celular"]);
            } 

            if (empty($_POST["telefono"])) {
                $telefonoErr = "Ingresa telefono";
                $valid = false;
            } else {
                $telefono = test_input($_POST["telefono"]);
            }  

            if (empty($_POST["carrera"])) {
                $carreraErr = "Ingresa carrera";
                $valid = false;
            } else {
                $carrera = test_input($_POST["carrera"]);
            } 

            if (empty($_POST["semestre"])) {
                $semestreErr = "Ingresa semestre";
                $valid = false;
            } else {
                $semestre = test_input($_POST["semestre"]);
            } 

            if (empty($_POST["talla"])) {
                $tallaErr = "Ingresa talla";
                $valid = false;
            } else {
                $talla = test_input($_POST["talla"]);
            } 
            
                
            if($valid){ 

                $sql = 'INSERT INTO voluntario(matricula, nombres, apellidoPat, apellidoMat, fechaDeNac, email, celular,telefono, escolaridad, 
                semestre, talla) VALUES (?,?,?,?,?,?,?,?,?,?,?)';
                $prep_query= $db->prepare($sql);
                $prep_query->bind_param('sssssssssis',$matricula, $nombreVoluntario, $apellidoPaterno, $apellidoMaterno, $fechaDeNac, $email, 
                $celular, $telefono, $carrera, $semestre, $talla);
                $prep_query->execute();
                // $prep_query->bind_result($passwordInput);
                $prep_query->fetch();

                header("Location: listarVoluntarios.php");
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
            <h1>Registro de Voluntario</h1>
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
                        <label for="nombreVoluntario">Nombre(s): </label>
                        <br>
                        <input id="nombresVoluntario" name="nombreVoluntario" <?php if (isset($_POST['nombreVoluntario'])) echo 'value="'.$_POST['nombreVoluntario'].'"';?> class="form-control" type="text" placeholder="i.e. Juan Ricardo"
                        value= "<?php echo htmlspecialchars($nombreVoluntario);?>">
                        <span class="error"><?php echo $nombreVoluntarioErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-12">
                        <!-- <h3 class="error"> <?php echo $apellidoPaternoErr;?></h3> -->
                        <label for="apellidoPaterno">Apellido Paterno: </label>
                        <br>
                        <input id="apellidoPatVoluntario" name="apellidoPaterno" <?php if (isset($_POST['apellidoPaterno'])) echo 'value="'.$_POST['apellidoPaterno'].'"';?>  class="form-control" type="text" placeholder="i.e. Hernández"
                        value= "<?php echo htmlspecialchars($apellidoPaterno);?>">
                        <span class="error"><?php echo $apellidoPaternoErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-12">
                        <!-- <h3 class="error"> <?php echo $apellidoMaternoErr;?></h3> -->
                        <label for="apellidoMaterno">Apellido Materno: </label>
                        <br>
                        <input id="apellidoMatVoluntario" name="apellidoMaterno" <?php if (isset($_POST['apellidoMaterno'])) echo 'value="'.$_POST['apellidoMaterno'].'"';?>  class="form-control" type="text" placeholder="i.e. López"
                        value= "<?php echo htmlspecialchars($apellidoMaterno);?>">
                        <span class="error"><?php echo $apellidoMaternoErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-6">
                        <!-- <h3 class="error"> <?php echo $matriculaErr;?></h3> -->
                        <label for="matricula">Matrícula: </label>
                        <br>
                        <input id="matriculaVoluntario" name="matricula" <?php if (isset($_POST['matricula'])) echo 'value="'.$_POST['matricula'].'"';?> class="form-control" type="text" placeholder="i.e. A01233188"
                        value= "<?php echo htmlspecialchars($matricula);?>">
                        <span class="error"><?php echo $matriculaErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-6">
                        <!-- <h3 class="error"> <?php echo $emailErr;?></h3> -->
                        <label for="email">E-mail: </label>
                        <br>
                        <input id="emailVoluntario" name="email" <?php if (isset($_POST['email'])) echo 'value="'.$_POST['email'].'"';?> class="form-control" type="email" placeholder="i.e. juanhernandez@hotmail.com"
                        value= "<?php echo htmlspecialchars($email);?>">
                        <span class="error"><?php echo $emailErr;?></span>
                        <br><br>
                    </div>

    <!------------------------------------------------------------------------------>
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
                                    for ($i=1985; $i<=2002; $i++){
                                        echo "<option value='".$i."''>".$i."</option>";
                                    }
                                ?>
                            </select>                        
                        </div>
                        <br>
                        <span class="error"><?php echo $fechaDeNacErr;?></span>
                    </div>

                   
                   <div class="container col-xs-6">
                        <!-- <h3 class="error"> <?php echo $telefonoErr;?></h3> -->
                        <label for="celular">Celular: </label>
                        <br>
                        <input id="celular" name="celular" <?php if (isset($_POST['celular'])) echo 'value="'.$_POST['celular'].'"';?> class="form-control" type="text" placeholder="i.e. 8711444878"
                        value= "<?php echo htmlspecialchars($celular);?>">
                        <span class="error"><?php echo $celularErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-6">
                        <!-- <h3 class="error"> <?php echo $telefonoErr;?></h3> -->
                        <label for="telefono">Teléfono: </label>
                        <br>
                        <input id="telefonoVoluntario" name="telefono" <?php if (isset($_POST['telefono'])) echo 'value="'.$_POST['telefono'].'"';?> class="form-control" type="text" placeholder="i.e. 7567890"
                        value= "<?php echo htmlspecialchars($telefono);?>">
                        <span class="error"><?php echo $telefonoErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-6">
                        <!-- <h3 class="error"> <?php echo $carreraErr;?></h3> -->
                        <label for="carrera">Carrera/Prepa: </label>
                        <br>
                        <input id="carreraVoluntario" name="carrera" <?php if (isset($_POST['carrera'])) echo 'value="'.$_POST['carrera'].'"';?> class="form-control" type="text" placeholder="i.e. ITIC"
                        value= "<?php echo htmlspecialchars($carrera);?>">
                        <span class="error"><?php echo $carreraErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-6">
                        <!-- <h3 class="error"> <?php echo $semestreErr;?></h3> -->
                        <label for="semestre">Semestre: </label>
                        <br>
                        <input id="semestreVoluntario" name="semestre" <?php if (isset($_POST['semestre'])) echo 'value="'.$_POST['semestre'].'"';?> class="form-control" type="text" placeholder="i.e. 6"
                        value= "<?php echo htmlspecialchars($semestre);?>" >
                        <span class="error"><?php echo $semestreErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-6">
                        <!-- <h3 class="error"> <?php echo $tallaErr;?></h3> -->
                        <label for="semestre">Talla:</label>
                        <br>
                        <input id="semestreVoluntario" name="talla" <?php if (isset($_POST['talla'])) echo 'value="'.$_POST['talla'].'"';?>  class="form-control" type="text" placeholder="i.e. XS"
                        value= "<?php echo htmlspecialchars($talla);?>">
                        <span class="error"><?php echo $tallaErr;?></span>
                        <br><br>
                    </div>

                    <div id="buttonDiv"><button class="btn btn-primary" type="submit" value="submit" >Registrar</button></div>
                </form>
            </div>
        </div>
    </div>
</body>
<footer>Proyecto de Seguridad Informática</footer>
</html>





