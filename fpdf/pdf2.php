<?php
require('fpdf.php');
$pdf = new fpdf();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Cell(60,10,'pdf created using php!');
$pdf->Cell(60,10,'Powered by FPDF.',0,1,'C');
$pdf->Cell(40,20,'Hello World!');


$pdf->Write(5,'Visit ');
// Then put a blue underlined link
$pdf->SetTextColor(0,0,255);
$pdf->SetFont('','U');
$pdf->Write(5,'www.fpdf.org','http://www.fpdf.org');
$pdf->Output();

?>
