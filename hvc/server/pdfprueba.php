<?php 

require('./fpdf.php');

$pdf=new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(50,10,'Probando FPDF',1,1,'L');

$pdf->Cell(50,5,'salto de linea',1,1);

$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(190,5,'Lorem Ipsum o cualquier texto de relleno. .');

$pdf->Output();