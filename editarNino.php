<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Editar Nños</title>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel='stylesheet' href='css/style.css'>
    </head>

    <?php 

        session_start();
        require_once'conexion.php';
        $idNinoParam = $_GET['idNino'];
        $select = "SELECT * FROM institucion i JOIN nino n ON (i.id = n.institucion) JOIN discapacidad d ON (d.id = n.discapacidad) WHERE n.id=".$idNinoParam;

        $queryS= $db->query($select);
        $nino= $queryS->fetch_assoc();

        $nombresActual= $nino['nombres'];
        $apellidoPatActual= $nino['apellidoPat'];
        $apellidoMatActual= $nino['apellidoMat'];
        $fechaDeNacActual=$nino['fechaDeNac'];
            $diaActual= substr ($fechaDeNacActual , 8 , 2);
            $mesActual=substr ($fechaDeNacActual , 6, 2);
            $anoActual= substr ($fechaDeNacActual , 0 , 4);
        $institucionActual= $nino['institucion'];
        $discapacidadActual= $nino['discapacidad'];
        $generoActual= $nino['genero'];
        $grupoActual= $nino['grupo'];
        
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

                      for ($i=0; $i < $resQuery->num_rows; $i++) { 
                          $opcion = $resQuery->fetch_assoc();
                          echo '<li><a href="'.$opcion['href'].'">'.$opcion['nombre'].'</a></li>';
                      }
                ?>
                
                </ul>
            </nav>
        </header>

        <div id="pageTitle">
            <h1>Editar Niño</h1>
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
            ?>
        </div>


        <div class='mainContent'>
            <div class='registroForm container col-xs-6'>
                <form action= "editarNinoAction.php" role="form" method="post">
                    <div class="container col-xs-12">
                        <label for="nombres">Nombre(s): </label>
                        <br>
                        <input id="nombres" name="nombres" class="form-control" type="text" placeholder="i.e. Juan Ricardo"
                        value= "<?php echo $nombresActual;?>">
                        <span class="error"><?php echo $nombresErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-12">
                        <label for="apellidoPat">Apellido Paterno: </label>
                        <br>
                        <input id="apellidoPat" name="apellidoPat" class="form-control" type="text" placeholder="i.e. Hernández"
                        value= "<?php echo $apellidoPatActual;?>">
                        <span class="error"><?php echo $apellidoPatErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-12">
                        <label for="apellidoMat">Apellido Materno: </label>
                        <br>
                        <input id="apellidoMat" name="apellidoMat" class="form-control" type="text" placeholder="i.e. López"
                        value= "<?php echo $apellidoMatActual;?>">
                        <span class="error"><?php echo $apellidoMatErr;?></span>
                        <br><br>
                    </div>

                    <div class="container col-xs-12">
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
                                <?php
                                    for ($i=2001; $i<=2013; $i++){                                       
                                        if ($i==$anoActual)
                                            echo "<option value='".$i."'selected>".$i."</option>";
                                        else
                                            echo "<option value='".$i."'>".$i."</option>";
                                    }
                                ?>
                            </select>                        
                        </div>
                    </div>


                    <div class="container col-xs-12">
                        <label for="institucion">Institucion: </label>
                        <br>

                        <div class="container col-xs-4">
                            <select input type="text"  id="institucion" name="institucion" maxlength = "10" value="<?php echo $_SESSION['institucion'] ?>">
                                <option value="0" >--Seleccione una--</option>

                                <?php
                                    require_once 'conexion.php';
                                    $query = 'SELECT * FROM institucion';
                                    $resQuery = $db->query($query);
                                         
                                    for ($i=0; $i < $resQuery->num_rows; $i++) { 
                                        $result = $resQuery->fetch_assoc();
            
                                        $idI= $result['id'];
                                        
                                        if ($idI==$institucionActual)
                                            echo '<option value="'.$idI.'" selected>'.$result['nombre'].'</option>';
                                        else 
                                            echo '<option value="'.$idI.'">'.$result['nombre'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <br>
                        <span class="error"><?php echo $institucionErr;?></span>
                        <br>
                    </div>  

                   
                    <div class="container col-xs-12">
                        <label for="discapacidad">Discapacidad: </label>
                        <br>

                        <div class="container col-xs-4">
                            <select input type="text"  id="discapacidad"name="discapacidad" maxlength = "10" value="<?php echo $_SESSION['discapacidad'] ?>">
                                <option value="0" >--Seleccione una--</option>

                                <?php
                                    require_once 'conexion.php';
                                    $query = 'SELECT * FROM discapacidad';
                                    $resQuery = $db->query($query);
                                    
                                    for ($i=1; $i <= $resQuery->num_rows; $i++) { 
                                        $result = $resQuery->fetch_assoc();
                                        $idD= $result['id'];
                                        if ($idD==$discapacidadActual)
                                            echo '<option value="'.$result['id'].'" selected>'.$result['descripcion'].'</option>';
                                        else
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
                        <label for="genero">Género:</label>
                        <br>

                        <div class="container col-xs-4">
                            <select id="genero" name="genero" maxlength = "10" value="<?php echo $_SESSION['genero'] ?>">
                                <option value="-" selected>--Seleccione uno--</option>
                                <option value="F" <?php if($generoActual == 'F') echo "selected";?> >Femenino</option>
                                <option value="M" <?php if($generoActual == 'M') echo "selected";?>>Masculino</option>
                            </select>
                        </div>
                        <br>
                        <span class="error"><?php echo $generoErr;?></span>
                        <br>
                    </div>  

                    <div class="container col-xs-12">
                        <label for="grupo">Grupo:</label>
                        <br>
                        <input id="grupo" name="grupo" class="form-control" type="text" 
                        placeholder="i.e. 5"
                        value= "<?php echo $grupoActual;?>">
                        <span class="error"><?php echo $grupoErr;?></span>
                        <br><br>
                    </div>

                    <input name="idNino" type="number" value= "<?php echo $idNinoParam;?>" style='display:none'>

                   <div id="buttonDiv"><button class="btn btn-primary container col-xs-12 botonEliminar" type="button" 
                    onclick="location.href='borradoLogicoNino.php?idNino=<?php echo $idNinoParam; ?>&nombreNino=<?php echo $nombresActual ?>&apellidoNino= <?php echo $apellidoPatActual ?>'">Eliminar</button></div>

                    <div id="buttonDiv"><button class="btn btn-primary container col-xs-12 botonEditar" type="submit" >Editar</button></div>
                </form>
            </div>
        </div>
    </div>
</body>
<footer>Proyecto de Seguridad Informática</footer>
</html>





