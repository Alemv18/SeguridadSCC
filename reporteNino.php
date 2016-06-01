<?php
	require('fpdf.php');
	require_once('conexion.php');
	$pdf= new FPDF();
	$pdf->AddPage();

	$sql="SELECT * FROM ninos";
	$query= $db->query($sql);

	$pdf->SetFont('Arial','B',16);	
	$pdf->Cell(7,10, "",0,1,'C');
	$pdf->Cell(180,15, "Reporte de todos los ninos ordenador por institucion",0,1,'C');
	$pdf->Cell(180,10, "",0,1,'C');
	$pdf->Cell(7,10, "",0,0,'C');

	$pdf->SetFont('Arial','B',11);	
	$pdf->Cell(40,8, "Institucion",1,0,'C');
	$pdf->Cell(40,8, "Nombres",1,0,'C');
	$pdf->Cell(40,8, "Apellido Paterno",1,0,'C');
	$pdf->Cell(40,8, "Apellido Materno",1,0,'C');	
	$pdf->Cell(15,8, "Edad",1,1,'C');

	$pdf->SetFont('Arial','',10);	
	foreach($query as $nino){
		$nombres= $nino['nombres'];
		$apellidoPat= $nino['apellidoPat'];
		$apellidoMat= $nino['apellidoMat'];
		$institucion= $nino['nombre'];
		$edad= $nino['edad'];
		$pdf->Cell(7,10, "",0,0,'C');
		$pdf->Cell(40,8, $institucion,1,0,'C');
		$pdf->Cell(40,8, $nombres,1,0,'C');
		$pdf->Cell(40,8, $apellidoPat,1,0,'C');
		$pdf->Cell(40,8, $apellidoMat,1,0,'C');
		$pdf->Cell(15,8, $edad,1,1,'C');
	}
	$pdf->output();





?>