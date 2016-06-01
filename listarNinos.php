<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Niños</title>
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

		<div class='sesionHeader'>
			<!--a href="index.html"><i id="homeBtn" class="fa fa-home"></i></a-->
			<h2 id="contrasenaLabel" class="text-center">Niños del SCC</h2>
		
		<div class='mainDiv'>
				<div class='sideMenu container col-xs-3'>
		            <h3>Menú Administrativo</h3>
		            <?php
		                //echo "<p>hola</p>";
		                session_start();
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

		                //$db->close();
		            ?>
		        </div>
				<div class='mainContent'>
					<div id="centeredSquare">
					<?php
						$canEdit = false;
						$canDelete = false;
						$query = 'SELECT id FROM usuarioPermiso WHERE username = ?';
						$prep_query= $db->prepare($query);
		                $prep_query->bind_param('s', $_SESSION['usuario']);
		                $prep_query->execute();
		                $resultSet = $prep_query->get_result();
		                $result = $resultSet->fetch_all();

		                echo "<div id='divArribaLista'>";
		                echo "<div id='opcionArribaLista'>";
		                foreach ($result as $perm) {
		                	if(implode($perm) == '20'){
						    	echo "<a id='opcionArribaLista' href='reporteNino.php'>Obtener Reporte</a>";
								
						    }
						    if(implode($perm) == '18'){
								echo "<a id='opcionArribaLista' href='regNino.php'>Registrar Nino</a>";
						    }
						    if(implode($perm) == '19'){
						    	$canEdit = true;
						    }
						    if(implode($perm) == '20'){
						    	$canDelete = true;
						    }
						}
						echo "</div>";
						echo "</div>";
					?>
						<table id="tablaOutsideBordes">
							<thead>
								<tr id="tablaBordes">
									<th >Nombre</th>
									<th >Apellido</th>
									<th >Institución</th>
									<th >Discapacidad</th>
									<th >Grupo</th>
									<?php
										if($canEdit)
											echo "<th >Editar</th>";
									?>
								</tr>
							</thead>
							<?php

									$queryP = "SELECT n.id, n.nombres, n.apellidoPat, i.nombre, d.descripcion, n.grupo FROM institucion i JOIN nino n ON (i.id = n.institucion) JOIN discapacidad d ON (d.id = n.discapacidad) WHERE n.visible ='1';";

			            			$resultado= $db->query($queryP);
			            			
									for ($i=0; $i < $resultado->num_rows; $i++) { 
										$nino= $resultado->fetch_assoc();

										$idNino= $nino['id'];
										$nombres= $nino['nombres'];
			            				$apellido= $nino['apellidoPat'];
			            				$institucion= $nino['nombre'];
			            				$discapacidad= $nino['descripcion'];
			            				$grupo= $nino['grupo'];

										echo "<html>";
										echo "<tr>";
										echo "<td >$nombres</td>";
										echo "<td >$apellido</td>";
										echo "<td >$institucion</td>";
										echo "<td >$discapacidad</td>";
										echo "<td >$grupo</td>";
										if($canEdit)
											echo "<td ><a href='editarNino.php?idNino=".$idNino."'>Editar</a></td>";

										echo "</tr>";
										echo "</html>";
									}

									$db->close();

							 ?>
						</table>
					</div>
			</div>
		</div>
		
</body>
</html>


