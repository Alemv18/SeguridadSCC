<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Proyecto</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel='stylesheet' href='css/style.css'>
</head>

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

                $db->close();

            ?>
            </ul>
        </nav> 
   </header>

    <div class='mainDiv'>

    </div>
   
    <div id='eventos'>
        <h1>Descripción del Proyecto</h1><br><br>
        <h3><b>Descripci&oacuten del Sistema</b></h3><br>
        <p>

Super Compucampo cuenta con un sistema básico de registros por medio de Excel y  documentos físicos que no le permite un control óptimo de su información. Este sistema es problemático y difícil de mantener ya que por cuestiones de logística se tienen que utilizar diferentes computadoras lo cual provoca pérdidas de datos al momento de la recopilación. Además es difícil de actualizar y analizar con Excel o a mano. En cuanto a los archivos físicos, existe un alto riesgo de perderse, mojarse, etc. y por consecuencia deberán volver a conseguir los datos perdidos / dañados.<br><br>

Todo lo anterior tiene como consecuencia pérdida de tiempo, deterioro de imagen, inconsistencias en los datos y daños en general.
<br><br>
Para resolver el problema crearemos una aplicación web que les permitirá centralizar su información para mantenerla actualizada, organizada y disponible en cualquier lugar y momento.
<br><br>
El sistema consiste en una página web para el Super CompuCampo en donde los usuarios podrán tener acceso a todo tipo de información sobre la organización. <br>
La primer pantalla de la página muestra las opciones de: <br><br>
<b>Eventos: </b>Información detallada sobre los eventos que han acontecido en años pasados y actualmente, incluye fotos y una breve descripción de lo más relevante de cada uno de ellos.<br>
<b>¿Quienes somos?: </b>Información sobre la organización y  quienes se encuentran al frente de la mesa directiva.<br>
<b>Patrocinadores: </b>Una breve lista de las personas que patrocinan esta noble causa.<br>
<b>Donaciones: </b> Breve descripción del tipo de donaciones que la organización necesita para continuar con los eventos durante el verano, además de un pequeño formulario que puede llenar cualquier persona que esté interesada en hacer una donación.<br>
<b>Contacto: </b>Información de todos los medios por los cuales se puede establecer contacto con la organización.<br>
<b>Iniciar Sesión:</b> En este apartado el usuario, siendo tanto un administrador o un voluntario, puede ingresar para realizar ciertos manejos dentro de la base de datos de la organización.<br><br>

En la sección de iniciar sesion, el usuario puede ingresar con el uso de una matrícula y su contraseña. En caso de que dicho usuario olvide su contraseña, podrá dar click en “¿Olvidó su contraseña?”.
Una vez que el usuario ingresa a su cuenta, podrá observar un menú de opciones en la parte izquierda de su pantalla, en donde vendrán las opciones de :<br><br>

 • Administración de Voluntarios<br>
 • Administración de Instituciones<br>
 • Administración de Patrocinadores<br>
 • Administración de Usuarios<br>
 • Administración de Niños<br>
<br><br>
En cada apartado se podrán hacer registros, editar, bloquear y generar un pdf con los resultados de cada lista.
<br><br>
            <h3><b>Selección de Plataforma de Desarrollo</b></h3><br>
            Desarrollo web <br>
            <ul >
                <li> • PHP<br></li>
                <li> • TML5<br></li>
                <li> • CSS3<br></li>
                <li> • JavaScript<br></li>
                <li> • JQuery<br></li>
                <li> • Bootstrap<br><br></li>
            </ul>

            Bases de Datos<br>
             • MySql Workbench<br>
        </p>
        <h3></h3>
        <br>
    </div>
    

</body>
<footer><br><br>Proyecto de Seguridad Informática</footer>
</html>