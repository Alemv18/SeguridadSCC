<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>SCC - Contacto</title>
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
                    error_reporting(E_WARNING);
                    require_once 'conexion.php';


                    $query = 'SELECT * FROM opcionesNavegacion  WHERE display = "1"';
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
        <?php
        session_start();
        ?>
        
    </div>


<form id="contact_form" action="#" method="POST" enctype="multipart/form-data">
    <div class="col-xs-10" id="formContacto">
        <label for="name">Nombre</label><br>
        <input id="name" class="input" name="name" type="text" value="" size="60" /><br>

        <label for="email">Email</label><br>
        <input id="email" class="input" name="email" type="text" value="" size="60" /><br>
        <br>
        <label for="message">Mensaje</label><br>
        <textarea id="message" class="input" name="message" rows="7" cols="60"></textarea><br /><br>
    <input id="submit_button" type="submit" value="Enviar email" />
      </div>
</form>     

</body>
<!-- <footer>Proyecto de Seguridad Informática</footer> -->
</html>