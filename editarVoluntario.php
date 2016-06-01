<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SCC - Editar Voluntario</title>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel='stylesheet' href='css/style.css'>
    </head>

    <?php 
        session_start();
        require_once'conexion.php';

        $matriculaParam = $_GET['matricula'];
        // echo "hoola: ".$matriculaParam;
        $select = 'SELECT * FROM voluntario WHERE matricula="'.$matriculaParam.'";';

        $queryS= $db->query($select);
        $voluntario= $queryS->fetch_assoc();

        $matriculaActual=$voluntario['matricula'];
        $nombreActual=$voluntario['nombres'];
        $apellidoPatActual=$voluntario['apellidoPat'];
        $apellidoMatActual=$voluntario['apellidoMat'];
        $fechaDeNacActual=$voluntario['fechaDeNac'];
            $diaActual= substr ($fechaDeNacActual , 8 , 2);
            $mesActual=substr ($fechaDeNacActual , 6, 2);
            $anoActual= substr ($fechaDeNacActual , 0 , 4);
        $emailActual=$voluntario['email'];
        $celularActual=$voluntario['celular'];
        $telefonoActual=$voluntario['telefono'];
        $escolaridadActual=$voluntario['escolaridad'];
        $semestreActual=$voluntario['semestre'];
        $tallaActual=$voluntario['talla'];

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

                $sql = 'UPDATE voluntario
                        SET matricula = ?, 
                        SET nombres = ?, 
                        SET apellidoPat = ?, 
                        SET apellidoMat = ?, 
                        SET fechaDeNac = ?, 
                        SET email = ?, 
                        SET celular = ?, 
                        SET telefono = ?, 
                        SET escolaridad = ?, 
                        SET semestre = ?, 
                        SET talla = ? 
                        WHERE matricula ='.$_GET['matricula'].';';
                $prep_query= $db->prepare($sql);
                $prep_query->bind_param('sssssssssis',$matricula, $nombreVoluntario, $apellidoPaterno, $apellidoMaterno, $fechaDeNac, $email, 
                $celular, $telefono, $carrera, $semestre, $talla);
                $prep_query->execute();

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
                     
                     for ($i=0; $i < $resQuery->num_rows; $i++) { 
                          $opcion = $resQuery->fetch_assoc();
                          echo '<li><a href="'.$opcion['href'].'">'.$opcion['nombre'].'</a></li>';
                      }

                ?>
                
                </ul>
            </nav>
        </header>

        <div id="pageTitle">
            <h1>Editar Voluntario</h1>
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
            ?>
        </div>


        <div class='mainContent'>
            <div class='registroForm container col-xs-6'>
                <form action= "editarVoluntarioAction.php" role="form" method="post">
                    <div class="container col-xs-12">
                        <!-- <h3 class="error"> <?php echo $nombreVoluntarioErr;?></h3>-->
                        <label for="nombreVoluntario">Nombre(s): </label>
                        <br>
                        <input id="nombreVoluntario" name="nombreVoluntario" 
                        class="form-control" type="text" placeholder="i.e. Ricardo"
                        value= "<?php echo $nombreActual;?>">
                        <span class="error"><?php echo $nombreVoluntarioErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-12">
                        <!-- <h3 class="error"> <?php echo $apellidoPaternoErr;?></h3> -->
                        <label for="apellidoPaterno">Apellido Paterno: </label>
                        <br>
                        <input id="apellidoPatVoluntario" name="apellidoPaterno" 
                               class="form-control" type="text" placeholder="i.e. Hernández"
                               value= "<?php echo htmlspecialchars($apellidoPatActual);?>">
                        <span class="error"><?php echo $apellidoPaternoErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-12">
                        <!-- <h3 class="error"> <?php echo $apellidoMaternoErr;?></h3> -->
                        <label for="apellidoMaterno">Apellido Materno: </label>
                        <br>
                        <input id="apellidoMatVoluntario" name="apellidoMaterno"
                               class="form-control" type="text" placeholder="i.e. López"
                               value= "<?php echo htmlspecialchars($apellidoMatActual);?>">
                        <span class="error"><?php echo $apellidoMaternoErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-6" style='display:none'>
                        <!-- <h3 class="error"> <?php echo $matriculaErr;?></h3> -->
                        <label for="matricula">Matrícula: </label>
                        <br>
                        <input id="matriculaVoluntario" name="matricula"  
                            class="form-control" type="text" 
                            value= "<?php echo htmlspecialchars($matriculaActual);?>" placeholder="i.e. A01233188">
                        <span class="error"><?php echo $matriculaErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-6">
                        <!-- <h3 class="error"> <?php echo $emailErr;?></h3> -->
                        <label for="email">E-mail: </label>
                        <br>
                        <input id="emailVoluntario" name="email" class="form-control" type="email"
                        value= "<?php echo htmlspecialchars($emailActual);?>" placeholder="i.e. juanhernandez@hotmail.com">
                        <span class="error"><?php echo $emailErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-12">
                        <!-- <h3 class="error"> <?php echo $fechaDeNacErr;?></h3> -->
                        <label for="fechaNac">Fecha de Nacimiento: </label>
                        <br>

                        <div id='divFechaNac' class="container col-xs-4">
                            <select name="dia">
                                <option value="-">Día</option>
                                <?php
                                    for ($i=1; $i<=31; $i++){
                                        if ($i==$diaActual)
                                            echo "<option value='".$i."'selected>".$i."</option>";
                                        else
                                            echo "<option value='".$i."'>".$i."</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div id='divFechaNac' class="container col-xs-4">
                            <select name="mes">
                                <option value="-" >Mes</option>
                                <option value="01" <?php if(1==$mesActual) echo "selected";?> >Enero</option>
                                <option value="02" <?php if(2==$mesActual) echo "selected";?> >Febrero</option>
                                <option value="03" <?php if(3==$mesActual) echo "selected";?> >Marzo</option>
                                <option value="04" <?php if(4==$mesActual) echo "selected";?> >Abril</option>
                                <option value="05" <?php if(5==$mesActual) echo "selected";?> >Mayo</option>
                                <option value="06" <?php if(6==$mesActual) echo "selected";?> >Junio</option>
                                <option value="07" <?php if(7==$mesActual) echo "selected";?> >Julio</option>
                                <option value="08" <?php if(8==$mesActual) echo "selected";?> >Agosto</option>
                                <option value="09" <?php if(9==$mesActual) echo "selected";?> >Septiembre</option>
                                <option value="10" <?php if(10==$mesActual) echo "selected";?> >Octubre</option>
                                <option value="11" <?php if(11==$mesActual) echo "selected";?> >Noviembre</option>
                                <option value="12" <?php if(12==$mesActual) echo "selected";?> >Diciembre</option>
                            </select>
                        </div>

                        <div id='divFechaNac' class="container col-xs-4">
                            <select name="ano">
                                <option value="-" >Año</option>
                                <?php
                                    for ($i=1985; $i<=2002; $i++){                                       
                                        if ($i==$anoActual)
                                            echo "<option value='".$i."'selected>".$i."</option>";
                                        else
                                            echo "<option value='".$i."'>".$i."</option>";
                                    }
                                ?>
                            </select>                        
                        </div>
                        <br>
                        <span class="error"><?php echo $fechaDeNacErr;?></span>
                        <br><br>
                    </div>

                   
                   <div class="container col-xs-6">
                        <!-- <h3 class="error"> <?php echo $telefonoErr;?></h3> -->
                        <label for="celular">Celular: </label>
                        <br>
                        <input id="celular" name="celular" 
                               class="form-control" type="text" placeholder="i.e. 8711444878"
                               value= "<?php echo htmlspecialchars($celularActual);?>">
                        <span class="error"><?php echo $celularErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-6">
                        <!-- <h3 class="error"> <?php echo $telefonoErr;?></h3> -->
                        <label for="telefono">Teléfono: </label>
                        <br>
                        <input id="telefonoVoluntario" name="telefono"
                               class="form-control" type="text" placeholder="i.e. 7567890"
                               value= "<?php echo htmlspecialchars($telefonoActual);?>">
                        <span class="error"><?php echo $telefonoErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-6">
                        <!-- <h3 class="error"> <?php echo $carreraErr;?></h3> -->
                        <label for="carrera">Carrera/Prepa: </label>
                        <br>
                        <input id="carreraVoluntario" name="carrera" 
                               class="form-control" type="text" placeholder="i.e. ITIC"
                               value= "<?php echo htmlspecialchars($escolaridadActual);?>">
                        <span class="error"><?php echo $carreraErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-6">
                        <!-- <h3 class="error"> <?php echo $semestreErr;?></h3> -->
                        <label for="semestre">Semestre: </label>
                        <br>
                        <input id="semestreVoluntario" name="semestre" 
                                  class="form-control" type="text" placeholder="i.e. 6"
                        value= "<?php echo htmlspecialchars($semestreActual);?>" >
                        <span class="error"><?php echo $semestreErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-12">
                        <!-- <h3 class="error"> <?php echo $tallaErr;?></h3> -->
                        <label for="semestre">Talla:</label>
                        <br>
                        <input id="semestreVoluntario" name="talla" 
                               class="form-control" type="text" placeholder="i.e. XS"
                               value= "<?php echo htmlspecialchars($tallaActual);?>">
                        <span class="error"><?php echo $tallaErr;?></span>
                        <br><br>
                    </div>

                    <!-- <?php echo $matriculaParam; ?> -->
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





 