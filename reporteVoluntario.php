<?php
	require('fpdf.php');
	require_once('conexion.php');
	$pdf= new FPDF();
	$pdf->AddPage();

	$sql="SELECT * FROM voluntarios";
	$query= $db->query($sql);

	$pdf->SetFont('Arial','B',16);	
	$pdf->Cell(7,10, "",0,1,'C');
	$pdf->Cell(180,15, "Reporte de todos los voluntarios",0,1,'C');
	$pdf->Cell(180,10, "",0,1,'C');
	

	$pdf->SetFont('Arial','B',11);	

	$pdf->Cell(25,8, "Matricula",1,0,'C');
	$pdf->Cell(25,8, "Escolaridad",1,0,'C');
	$pdf->Cell(32,8, "Nombres",1,0,'C');
	$pdf->Cell(30,8, "Apellido Pat.",1,0,'C');
	$pdf->Cell(30,8, "Apellido Mat.",1,0,'C');
	$pdf->Cell(45,8, "Email",1,1,'C');	
	


	$pdf->SetFont('Arial','',10);	
	foreach($query as $voluntario){
		$matricula= $voluntario['matricula'];
		$nombres= $voluntario['nombres'];
		$apellidoPat= $voluntario['apellidoPat'];
		$apellidoMat= $voluntario['apellidoMat'];
		$email= $voluntario['email'];
		$escolaridad= $voluntario['escolaridad'];

		$pdf->Cell(25,8, $matricula,1,0,'C');
		$pdf->Cell(25,8, $escolaridad,1,0,'C');
		$pdf->Cell(32,8, $nombres,1,0,'C');
		$pdf->Cell(30,8, $apellidoPat,1,0,'C');
		$pdf->Cell(30,8, $apellidoMat,1,0,'C');
		$pdf->Cell(45,8, $email,1,1,'C');
		
	}
	$pdf->output();





?>