<?php
	//ESTOS SON COMMENTS PARA VER	
	$db = new mysqli('localhost:3306', 'root','','seguridad');
	if ($db-> connect_errno) {
		//printf('Database connection failed miserably: %s\n', $mysqli->connect_error);
		exit();
	}
	//SI FUNCIONA LO DE GIT PUSH Y PULL
	else {
		//printf('Sí se conectó');
		//echo "<br>";
	}	


?>