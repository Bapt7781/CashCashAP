<?php
require('fpdf186/fpdf.php');

$NumeroIntervention = isset($_GET['NumeroIntervention']) ? $_GET['NumeroIntervention'] : '';
$NumeroClient = isset($_GET['NumeroClient']) ? $_GET['NumeroClient'] : '';

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,utf8_decode("Numéro Intervention : " . $NumeroIntervention));
$pdf->Ln(10);
$pdf->Cell(40,10,utf8_decode("Numéro Client : " . $NumeroClient));
$pdf->Output();
?>