<?php session_start();
require_once('../html2pdf/html2fpdf.php');

//todo el contrato
e
rs
f
sf
dsfs


$html=ob_get_contents();
ob_end_clean();
$pdf = new HTML2FPDF();
$pdf->DisplayPreferences('HideWindowUI');
$pdf->AddPage();
$pdf->WriteHTML($html);
$pdf->Output('doc.pdf','I');


ob_start();

?>