<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>SCC - Inicio</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel='stylesheet' href='css/style.css'>
    <script src="js/modernizr-2.5.3.min.js"></script>
</head>

<body>
    <header class='indexHeader'>
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
             
                $ipaddress = $_SERVER['REMOTE_ADDR'];
                echo $ipaddress;

                $db->close();

            ?>
            
            </ul>
        </nav>
    </header>

    <div id = 'mainDiv' class='mainDivIndex'>
        <div class="wrapper">
            <div class="screen" id="screen-1" data-video="vid/indexVid.mp4">
                
            </div>
        </div>  
    </div>


</body>
<footer class='indexFooter'>Proyecto de Seguridad Informática</footer>
</html>

 <script>window.jQuery || document.write('<script src="js/jquery-1.8.1.min.js"><\/script>')</script>
    <script src="js/jquery-ui-1.8.22.custom.min.js"></script>
    <script src="js/jquery.imagesloaded.min.js"></script>
    <script src="http://vjs.zencdn.net/c/video.js"></script>

    <!-- BigVideo -->
    <script src="js/bigvideo.js"></script>

    <!-- Tutorial Demo -->
    <script src="js/jquery.transit.min.js"></script>
    <script>
        $(function() {

            // Use Modernizr to detect for touch devices, 
            // which don't support autoplay and may have less bandwidth, 
            // so just give them the poster images instead
            var BV,
                videoPlayer,
                isTouch = Modernizr.touch,
                $bigImage = $('.big-image'),
                $window = $(window);
            
            if (!isTouch) {
                // initialize BigVideo
                BV = new $.BigVideo({forceAutoplay:isTouch});
                BV.init();
                showVideo();
                
                BV.getPlayer().addEvent('loadeddata', function() {
                    onVideoLoaded();
                });

            }
            

            function showVideo() {
                BV.show($('#screen-1').attr('data-video'),{ambient:true});
            }

            

            function onVideoLoaded() {
                $('#screen-1').find('.big-image').transit({'opacity':0},500)
            }
            
        });
    </script>


<!--NAV DINÁMICO-->

    <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script-->
    <script>


        //$("#navBar").append("<li><a href='eventos.html'>OPCION EXTRA</a></li>");

    </script>






























