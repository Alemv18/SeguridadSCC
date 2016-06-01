<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>OLAP</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link href='https://fonts.googleapis.com/css?family=Montserrat|Pacifico|Viga|Damion' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
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

	            ?>
            </ul>
		</nav>
	</header>

		<div class='sesionHeader'><!--a href="index.html"><i id="homeBtn" class="fa fa-home"></i></a-->
			<h2 id="contrasenaLabel" class="text-center">OLAP</h2>
		
		<div class='mainDiv'>
				<div class='sideMenu container col-xs-3'>
		            <h3>Menú Administrativo</h3>
		            <?php
		                //echo "<p>hola</p>";
		                session_start();
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

		                //$db->close();
		            ?>
		        </div>
				<div class='mainContent'>
					<div id="centeredSquare">
					
						<table id='tablaOutsideBordes'> <!--id="tablaBordes"-->
							<thead>
								<tr id="tablaBordes">
									<th >Institucion </th>
									<th >Niño</th>
									<th >Grupo</th>
									<th >Total</th>									
								</tr>
							</thead>
							<?php

								$query= "SELECT * FROM olap;";
								$res= mysqli_query($db,$query);

								for ($i=0; $i < $res->num_rows; $i++) { 
									$olap= $res->fetch_assoc();
									$institucion= $olap['nombre'];
									$niño= $olap['nombres'];
									$grupo= $olap['grupo'];
									$total= $olap['total'];


									echo "<tr >";
									echo "<td >$institucion</td>";
									echo "<td >$niño</td>";
									echo "<td >$grupo</td>";
									echo "<td >$total</td>";
									echo "</tr>";

								}	

							$db->close();

							 ?>
						</table>
					</div>
			</div>
		</div>
		
</body>
</html>


