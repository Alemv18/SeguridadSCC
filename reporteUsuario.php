<?php
	require('fpdf.php');
	require_once('conexion.php');
	$pdf= new FPDF();
	$pdf->AddPage();


	// ADMINISTRADORES 

	$sql="SELECT * FROM usuariosAdmin";
	$query= $db->query($sql);

	$pdf->SetFont('Arial','B',16);	
	$pdf->Cell(7,10, "",0,1,'C');
	$pdf->Cell(190,15, "Reporte de todos los usuarios",0,1,'C');
	$pdf->Cell(180,10, "",0,1,'C');
	
	$pdf->SetFont('Arial','B',13);
	$pdf->Cell(15,10, "",0,0,'C');
	$pdf->Cell(50,10, "Administradores",0,1,'L');
	

	$pdf->SetFont('Arial','B',11);	
	$pdf->Cell(15,10, "",0,0,'C');
	$pdf->Cell(40,8, "Nombres",1,0,'C');
	$pdf->Cell(40,8, "Apellido Paterno",1,0,'C');
	$pdf->Cell(40,8, "Apellido Materno",1,0,'C');
	$pdf->Cell(40,8, "Nombre de Usuario",1,1,'C');	
	


	$pdf->SetFont('Arial','',10);	
	foreach($query as $admin){
		$nombres= $admin['nombres'];
		$apellidoPat= $admin['apellidoPat'];
		$apellidoMat= $admin['apellidoMat'];
		$username= $admin['username'];
		$pdf->Cell(15,10, "",0,0,'C');
		$pdf->Cell(40,8, $nombres,1,0,'C');
		$pdf->Cell(40,8, $apellidoPat,1,0,'C');
		$pdf->Cell(40,8, $apellidoMat,1,0,'C');
		$pdf->Cell(40,8, $username,1,1,'C');
		
	}

	//MESA
	$sql="SELECT * FROM usuariosMesa";
	$query= $db->query($sql);

	$pdf->Cell(180,10, "",0,1,'C');
	
	$pdf->SetFont('Arial','B',13);
	$pdf->Cell(15,10, "",0,0,'C');
	$pdf->Cell(50,10, "Mesa",0,1,'L');
	

	$pdf->SetFont('Arial','B',11);	
	$pdf->Cell(15,10, "",0,0,'C');
	$pdf->Cell(40,8, "Nombres",1,0,'C');
	$pdf->Cell(40,8, "Apellido Paterno",1,0,'C');
	$pdf->Cell(40,8, "Apellido Materno",1,0,'C');
	$pdf->Cell(40,8, "Nombre de Usuario",1,1,'C');	
	


	$pdf->SetFont('Arial','',10);	
	foreach($query as $mesa){
		$nombres= $mesa['nombres'];
		$apellidoPat= $mesa['apellidoPat'];
		$apellidoMat= $mesa['apellidoMat'];
		$username= $mesa['username'];
		$pdf->Cell(15,10, "",0,0,'C');
		$pdf->Cell(40,8, $nombres,1,0,'C');
		$pdf->Cell(40,8, $apellidoPat,1,0,'C');
		$pdf->Cell(40,8, $apellidoMat,1,0,'C');
		$pdf->Cell(40,8, $username,1,1,'C');
		
	}

	//INSTITUCIONES
	$sql="SELECT * FROM usuariosInst";
	$query= $db->query($sql);

	$pdf->Cell(180,10, "",0,1,'C');	
	$pdf->SetFont('Arial','B',13);
	$pdf->Cell(15,10, "",0,0,'C');
	$pdf->Cell(50,10, "Instituciones",0,1,'L');
	

	$pdf->SetFont('Arial','B',11);	
	$pdf->Cell(15,10, "",0,0,'C');
	$pdf->Cell(60,8, "Nombre de la Institucion",1,0,'C');
	$pdf->Cell(40,8, "Nombre de Usuario",1,1,'C');	
	


	$pdf->SetFont('Arial','',10);	
	foreach($query as $inst){
		$nombre= $inst['nombre'];
		$username= $inst['username'];
		$pdf->Cell(15,10, "",0,0,'C');
		$pdf->Cell(60,8, $nombre,1,0,'C');
		$pdf->Cell(40,8, $username,1,1,'C');
		
	}


	$pdf->output();





?>