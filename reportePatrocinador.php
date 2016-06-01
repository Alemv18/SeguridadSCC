<?php
	require('fpdf.php');
	require_once('conexion.php');
	$pdf= new FPDF();
	$pdf->AddPage();

	$sql="SELECT * FROM patrocinadores";
	$query= $db->query($sql);

	$pdf->SetFont('Arial','B',16);	
	$pdf->Cell(7,10, "",0,1,'C');
	$pdf->Cell(190,15, "Reporte de todos los patrocinadores",0,1,'C');
	$pdf->Cell(180,10, "",0,1,'C');



	

	$pdf->SetFont('Arial','',10);	
	foreach($query as $patrocinador){
		$nombre= $patrocinador['nombrePatrocinador'];
		$contacto= $patrocinador['nombreContacto'];
		$telefono= $patrocinador['telefono'];
		$email= $patrocinador['email'];
		$direccion= $patrocinador['direccion'];

		$pdf->Cell(27,10, "",0,0,'C');
		$pdf->SetFont('Arial','B',12);	
		$pdf->Cell(35,8, "Patrocinador",1,0,'C');
		$pdf->SetFont('Arial','B',11);
		$pdf->Cell(100,8, $nombre,1,1,'C');

		$pdf->Cell(27,10, "",0,0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(35,8, "Contacto",1,0,'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(100,8, $contacto,1,1,'C');

		$pdf->Cell(27,10, "",0,0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(35,8, "Telefono",1,0,'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(100,8, $telefono,1,1,'C');

		$pdf->Cell(27,10, "",0,0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(35,8, "Email",1,0,'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(100,8, $email,1,1,'C');

		$pdf->Cell(27,10, "",0,0,'C');
		$pdf->SetFont('Arial','B',12);	
		$pdf->Cell(35,8, "Direccion",1,0,'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(100,8, $direccion,1,1,'C');

		$pdf->Cell(7,10, "",0,1,'C');

		
		
	}
	$pdf->output();





?>