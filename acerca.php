<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>SCC - Acerca</title>
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

                for ($i=0; $i < $resQuery->num_rows; $i++) { 
                    $opcion = $resQuery->fetch_assoc();
                    echo '<li><a href="'.$opcion['href'].'">'.$opcion['nombre'].'</a></li>';
                }

                $db->close();

            ?>
            </ul>
        </nav>
    </header>

    <div class='container col-xs-12 mainDiv'>
        <div id='quienesSomos' class='container col-xs-4'>
            <div class='imgMiembro'>
                <img class='fotoMiembro' src="img/lily.jpg">
            </div>
            <h3>Liliana Barraza Pineda:</h3>
            <ul >
                <li ><h4>Estudiante de ITIC</h4></li>
                <li ><h4>6to semestre</h4></li>
                <li ><h4>20 años</h4></li>
                <li ><h4>Géminis</h4></li>
                <li ><h4>Soltera</h4></li>
            </ul>
        </div>

        <div id='quienesSomos' class='container col-xs-4'>
            <div class='imgMiembro'>
                <img class='fotoMiembro' src="img/benji.jpg">
            </div>
            <h3>Benjamin Arredondo Sagui:</h3>
            <ul >
                <li ><h4>Estudiante de ITIC</h4></li>
                <li ><h4>6to semestre</h4></li>
                <li ><h4>20 años</h4></li>
                <li ><h4>Tauro</h4></li>
                <li ><h4>Soltero</h4></li>
            </ul>
        </div>

        <div id='quienesSomos' class='container col-xs-4'>
            <div class='imgMiembro'>
                <img class='fotoMiembro' src="img/ale.jpg">
            </div>
            <h3>Alejandra Muñoz Villalobos:</h3>
            <ul >
                <li ><h4>Estudiante de ITIC</h4></li>
                <li ><h4>6to semestre</h4></li>
                <li ><h4>21 años</h4></li>
                <li ><h4>Piscis</h4></li>
                <li ><h4>Soltera (8711453061)</h4></li>
            </ul>
        </div>
    </div>
    
</body>
<footer><br><br>Proyecto de Seguridad Informática</footer>
</html>