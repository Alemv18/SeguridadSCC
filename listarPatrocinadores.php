<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Patrocinadores</title>
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

	                for ($i=0; $i < $resQuery->num_rows; $i++) { 
	                    $opcion = $resQuery->fetch_assoc();
	                    echo '<li><a href="'.$opcion['href'].'">'.$opcion['nombre'].'</a></li>';
	                }
	            ?>
            
            </ul>
		</nav>
	</header>

		<div class='sesionHeader'>
			<h2 id="contrasenaLabel" class="text-center">Patrocinadores</h2>
		
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
		                foreach ($result as &$perm) {
		                	if(implode($perm) == '9'){
						    	echo "<a id='opcionArribaLista' href='reportePatrocinador.php'>Obtener Reporte</a>";
								
						    }
						    if(implode($perm) == '10'){
								echo "<a id='opcionArribaLista' href='regPatrocinador.php'>Registrar Parocinador</a>";
						    }
						    if(implode($perm) == '11'){
						    	$canEdit = true;
						    }
						    if(implode($perm) == '12'){
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
								<th >Contacto</th>
								<th >Email</th>
								<th >Telefono</th>
								<?php
									if($canEdit)
										echo "<th >Editar</th>";

								?>
							</tr>
						</thead>
						<?php

								$queryP = "SELECT * FROM patrocinador WHERE visible='1'";

		            			$resultado= $db->query($queryP);

								for ($i=0; $i < $resultado->num_rows; $i++) { 
									$patrocinador= $resultado->fetch_assoc();

									$idPat=$patrocinador['id'];
									$nombre= $patrocinador['nombrePatrocinador'];
									$contacto = $patrocinador['nombreContacto'];
		            				$email= $patrocinador['email'];
		            				$telefono= $patrocinador['telefono'];

									echo "<html>";
									echo "<tr>";
									echo "<td >$nombre</td>";
									echo "<td >$contacto</td>";
									echo "<td >$email</td>";
									echo "<td >$telefono</td>";
									if($canEdit)
										echo "<td ><a href= 'editarPatrocinador.php?idPatrocinador=".$idPat."' >Editar</a></td>";

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













